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
use App\Transformers\StudentActivityTransformer;

class StudentActivityController extends Controller
{
	public function save(Request $request)
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
		
		if($student_activity->save()) {
			collect($request->questionnaires)->map(function($qnr) use ($student_activity) {
				$sta = new StudentActivityQuestionnaire();
				$sta->student_activity_id = $student_activity->id;
				$sta->questionnaire_id = $qnr['id'];
				$sta->save();
			});
		}

		$fractal = fractal()->item($student_activity, new StudentActivityTransformer);

        return response()->json($fractal->toArray());
	}
}
