<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Models\StudentActivity;
use App\Models\StudentActivityQuestionnaire;
use App\Models\ClassActivity;
use App\Transformers\StudentActivityTransformer;

class StudentActivityController extends Controller
{
	const QUIZ = 1;
	const PERIODICAL = 2;
	const ASSIGNMENT = 3;


	public function saveQuiz(Request $request)
	{
		return $this->save($request, self::QUIZ);
	}

	public function quizzes(Request $request)
	{
		return $this->getList($request, self::QUIZ);
	}

	public function publishQuiz(Request $request)
	{
		return $this->publish($request, self::QUIZ, 'Quiz');
	}

	public function unpublishQuiz(Request $request)
	{
		return $this->unpublish($request, self::QUIZ, 'Quiz');
	}

	public function deleteQuiz(Request $request)
	{
		return $this->delete($request, self::QUIZ, 'Quiz');
	}

	public function addQuizQuestionnaire(Request $request)
	{
		return $this->addQuestionnaire($request, self::QUIZ, 'Quiz');
	}

	public function removeQuizQuestionnaire(Request $request)
	{
		return $this->removeQuestionnaire($request, self::QUIZ, 'Quiz');
	}

	public function getQuiz(Request $request)
	{
		return $this->details($request, self::QUIZ, 'Quiz');
	}


	// PERIODICAL

	public function savePeriodical(Request $request)
	{
		return $this->save($request, self::PERIODICAL);
	}

	public function periodicals(Request $request)
	{
		return $this->getList($request, self::PERIODICAL);
	}

	public function publishPeriodical(Request $request)
	{
		return $this->publish($request, self::PERIODICAL, 'Periodical');
	}

	public function unpublishPeriodical(Request $request)
	{
		return $this->unpublish($request, self::PERIODICAL, 'Periodical');
	}

	public function deletePeriodical(Request $request)
	{
		return $this->delete($request, self::PERIODICAL, 'Periodical');
	}

	public function addPeriodicalQuestionnaire(Request $request)
	{
		return $this->addQuestionnaire($request, self::PERIODICAL, 'Periodical');
	}

	public function removePeriodicalQuestionnaire(Request $request)
	{
		return $this->removeQuestionnaire($request, self::PERIODICAL, 'Periodical');
	}

	public function getPeriodical(Request $request)
	{
		return $this->details($request, self::PERIODICAL, 'Periodical');
	}


	// ASSIGNMENT

	public function saveAssignment(Request $request)
	{
		return $this->save($request, self::ASSIGNMENT);
	}

	public function assignments(Request $request)
	{
		return $this->getList($request, self::ASSIGNMENT);
	}

	public function publishAssignment(Request $request)
	{
		return $this->publish($request, self::ASSIGNMENT, 'Assignment');
	}

	public function unpublishAssignment(Request $request)
	{
		return $this->unpublish($request, self::ASSIGNMENT, 'Assignment');
	}

	public function deleteAssignment(Request $request)
	{
		return $this->delete($request, self::ASSIGNMENT, 'Assignment');
	}

	public function addAssignmentQuestionnaire(Request $request)
	{
		return $this->addQuestionnaire($request, self::ASSIGNMENT, 'Assignment');
	}

	public function removeAssignmentQuestionnaire(Request $request)
	{
		return $this->removeQuestionnaire($request, self::ASSIGNMENT, 'Assignment');
	}

	public function getAssignment(Request $request)
	{
		return $this->details($request, self::ASSIGNMENT, 'Assignment');
	}


	// FUNCTIONS
	private function removeQuestionnaire(Request $request, int $activity_type, string $activity_name = 'Activity')
	{
		$this->validate($request, [
			'id' => 'required|integer',
			'questionnaire_id' => 'required|integer'
		]);

		$user = Auth::user();

		$activity = StudentActivity::whereId($request->id)->whereActivityType($activity_type)->first();
		if(!$activity) {
			return response("$activity_name not found", 404);
		}

		$activity_questionnaire = StudentActivityQuestionnaire::whereQuestionnaireId($request->questionnaire_id)
					->whereStudentActivityId($request->id)->first();

		$success = false;
		if($activity_questionnaire->delete()) {
			$success = true;
		}

		return response()->json(['success' => $success]);
	}


	private function addQuestionnaire(Request $request, int $activity_type, string $activity_name)
	{
		$this->validate($request, [
			'id' => 'required|integer',
			'questionnaires' => 'required|array',
			'questionnaires.*.id' => 'required|integer'
		]);

		$user = \Auth::user();
		$activity = StudentActivity::whereId($request->id)->whereActivityType($activity_type)->first();

		if(!$activity) {
			return response("$activity_name not found", 404);
		}

		try {
			$this->attachQuestionnaireToActivity($request->questionnaires, $activity);
		}
		catch(Exception $e) {
			return response("Unable to add questionannaires to $activity_name", 500);
		}

		return response()->json(['success' => true]);

	}

	private function delete(Request $request, int $activity_type, string $activity_name = 'Activity')
	{
		$user = Auth::user();

		$activity = StudentActivity::whereId($request->id)->whereActivityType($activity_type)->first();
		if(!$activity) {
			return response("$activity_name not found", 404);
		}

		// delete from class_actiivity
		$class_activities = ClassActivity::whereStudentActivityId($activity->id)->get();

		$class_activities->map(function($ca) {
			if(!$ca->delete()) {
				return response("Error deleting $activity_name", 500);
			}
		});

		$success = false;
		if($activity->delete()) {
			$success = true;
		}

		return response()->json(['success' => $success]);
	}

	private function getList(Request $request, int $activity_type)
	{
		$user = Auth::user();

		$student_activities = StudentActivity::whereActivityType($activity_type);

		if ($user->user_type == 't') {
			$this->validate($request, [
				'class_id' => 'integer'
			]);

			$student_activities->whereCreatedBy($user->getKey());
			$published_by = $user->getKey();
		}
		else {
			$this->validate($request, [
				'class_id' => 'integer|required'
			]);
			$published_by = null;
		}

		if($request->class_id) {
			$student_activities->inClass($published_by, $request->class_id);
		}

		$fractal = fractal()->collection($student_activities->get(), new StudentActivityTransformer);

        return response()->json($fractal->toArray());
	}

	private function unpublish(Request $request, int $activity_type, string $activity_name = 'Activity')
	{
		$this->validate($request, [
			'id' => 'required|integer',
			'class_id' => 'required|integer',
		]);

		$user = \Auth::user();
		$activity = StudentActivity::whereId($request->id)->whereActivityType($activity_type)
				->inClass($user->getKey(), $request->class_id)->first();

		if(!$activity) {
			return response("NOT FOUND ERROR: $activity_name was not published in the specified class.", 404);
		}

		$class_activity = ClassActivity::whereStudentActivityId($request->id)
				->whereClassId($request->class_id)->first();

		$success = false;
		if($class_activity->delete()) {
			$success = true;
		}
		

		return response()->json(['success' => $success]);
	}

	// think of needed policy
	private function publish(Request $request, int $activity_type, string $activity_name = 'Activity')
	{
		$this->validate($request, [
			'id' => 'required|integer',
			'class_id' => 'required|integer',
			'schedule_id' => 'required|integer'
		]);

		$user = \Auth::user();
		$activity = StudentActivity::whereId($request->id)->whereActivityType($activity_type)->first();

		if(!$activity) {
			return response("$activity_name not found", 404);
		}

		$class_activity = new ClassActivity();
		$class_activity->student_activity_id = $request->id;
		$class_activity->class_id = $request->class_id;
		$class_activity->schedule_id = $request->schedule_id;
		$class_activity->published_by = $user->getKey();
		
		$success = false;
		if($class_activity->save()) {
			$success = true;
		}

		return response()->json(['success' => $success]);
	}

	private function details(Request $request, int $activity_type, string $activity_name = "Activity")
	{
		$student_activity = StudentActivity::whereId($request->id)->whereActivityType($activity_type)->first();
		if(!$student_activity) {
			return response("$activity_name not found", 404);
		}

		$fractal = fractal()->item($student_activity, new StudentActivityTransformer);

        return response()->json($fractal->toArray());
	}


	private function save(Request $request, int $activity_type)
	{
		$this->validate($request, [
			'title' => 'required|string',
			'instruction' => 'string',
			'duration' => 'required|integer',
			'category_id' => 'required|integer',
			'subject_id' => 'required|integer',
			'questionnaires' => 'required|array',
			'questionnaires.*.id' => 'required|integer'
		]);

		$user = Auth::User();
		$student_activity = new StudentActivity();
		$student_activity->title = $request->title;
		$student_activity->instruction = $request->instruction ?? "";
		$student_activity->duration = $request->duration;
		$student_activity->category_id = $request->category_id;
		$student_activity->subject_id = $request->subject_id;
		$student_activity->created_by = $user->getKey();
		$student_activity->school_id = $user->school_id;
		$student_activity->activity_type = $activity_type;
		
		if($student_activity->save() && $request->questionnaires) {
			$this->attachQuestionnaireToActivity($request->questionnaires, $student_activity);
		}

		$fractal = fractal()->item($student_activity, new StudentActivityTransformer);

        return response()->json($fractal->toArray());
	}

	private function attachQuestionnaireToActivity(Array $questionnaires, \App\Models\StudentActivity $student_activity)
	{
		collect($questionnaires)->map(function($qnr) use ($student_activity) {
			$sta = new StudentActivityQuestionnaire();
			$sta->student_activity_id = $student_activity->id;
			$sta->questionnaire_id = $qnr['id'];
			$sta->save();
		});
	}
}
