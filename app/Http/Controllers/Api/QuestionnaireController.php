<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Transformers\QuizBuilderTransformer;
use App\Transformers\QuizTransformer;

use \App\Gateways\QuizBuilderGateway;

use \App\Models\Quiz;
use \App\Models\Classes;
use \App\Models\ClassQuiz;

class QuestionnaireController extends Controller
{
	/**
     * Quiz
     *
     * @api {post} <HOST>/api/quiz/save Save Quiz
     * @apiVersion 1.0.0
     * @apiName SaveQuiz
     * @apiDescription Save Quiz
     * @apiGroup Quiz
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String} title Quiz title
     * @apiParam {String} intro Quiz intro/instruction
     * @apiParam {Number} subject_id
     * @apiParam {Array} questions array of question object
     * @apiParam {String} questions.question the question text
     * @apiParam {String=mcq} questions.question_type accepts multiple choice for now
     * @apiParam {Number} questions.weight the score of the question
     * @apiParam {Array} questions.choices array of question choices (up to 5 choices for now)
     * @apiParam {Number} questions.choices.option the choice text
     * @apiParam {Boolean} questions.choices.is_correct multiple choices can be marked as correct
     * @apiParam {String} media_url link to attachment
	 * 
     * @apiSuccess {Number} id ID of the added quiz
     * @apiSuccess {String} title Quiz title
     * @apiSuccess {String} intro Quiz intro/instruction
     * @apiSuccess {Number} subject_id
     * @apiSuccess {Array} questions array of question object
     * @apiSuccess {Number} questions.id ID of the added question
     * @apiSuccess {String} questions.question the question text
     * @apiSuccess {String=mcq} questions.question_type accepts multiple choice for now
     * @apiSuccess {Number} questions.weight the score of the question
     * @apiSuccess {Array} questions.choices array of question choices (up to 5 choices for now)
     * @apiSuccess {Number} questions.choices.option the choice text
     * @apiSuccess {Boolean} questions.choices.is_correct multiple choices can be marked as correct
     * @apiSuccess {String} media_url link to attachment
     * 
     * 
     * @apiSuccessExample {json} Sample Response
		{
			"id": 109,
			"title": "Quiz 1",
			"intro": "this is a quiz to answer",
			"subject_id": 1,
			"questions": [
				{
					"id": 199,
					"question": "test",
					"question_type": "mcq",
					"media_url": "http://sample-media.com/q1-quiz1",
					"weight": 1,
					"choices": [
						{
							"option": "a",
							"is_correct": true
						},
						{
							"option": "b",
							"is_correct": false
						},
						{
							"option": "c",
							"is_correct": false
						},
						{
							"option": "d",
							"is_correct": false
						},
						{
							"option": "e",
							"is_correct": false
						}
					]
				},
				{},
				{}
			]
		}
     * 
     */
    
	public function save(Request $request)
	{
		$quiz_gw = new QuizBuilderGateway();

		//add and attach questions to quiz
		$quiz_gw->setQuestionnaireDetails($request->toArray());
		$quiz_gw->save();

		$fractal = fractal()->item($quiz_gw, new QuizBuilderTransformer);

        return response()->json($fractal->toArray());
	}

	/**
     * Quiz
     *
     * @api {get} <HOST>/api/quizzes Quiz list
     * @apiVersion 1.0.0
     * @apiName QuizList
     * @apiDescription Get quiz list
     * @apiGroup Quiz
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Array=myQuizzes, schoolQuizzes, classQuizzes} types available quiz types. <ul><li>myQuizzes: quizzes created by logged in teacher</li><li>schoolQuizzes: quizzes published by different teachers to the school</li><li>classQuizzes: quizzes published by logged in teacher to his/her classes</li></ul>
     * @apiParam {Number} class_id get quizzes of the specified class. If this is passed, the "types" param will be invalidated
	 * @apiParam {Number} limit number of rows returned per request. Default: 20, Max: 100
	 * @apiParam {Number} offset the offset. Min: 0
	 *
	 * @apiUse QuizDetailResponse
	 * @apiUse QuizSampleResponse
	 *
	*/
	public function quizzes(Request $request)
	{
		$this->validate($request, [
			'types' => 'array|distinct',
			'types.*' => 'in:'.implode(',', config('school_hub.quiz_types')),
			'class_id' => 'integer',
			'limit' => 'integer|max:100', // set limit to 50 by default
			'offset' => 'integer|min:0' // set to 0 by default
		]);

		if(!$request->types) {
			$request->types = config('school_hub.quiz_types');
		}
		elseif ($request->class_id) {
			$request->types = ['classQuizzes'];
		}

		$user = \Auth::user();
		$quiz = Quiz::with('questions');

		$union = collect();

		array_reduce($request->types, function($index, $type) use ($quiz, $user, &$union, $request) {
			switch($type) {
				case 'myQuizzes':
					// get own quizzes
					$own_quizzes = clone $quiz;
					$own_quizzes->whereCreatedBy($user->getKey());
					$union->push($own_quizzes);
				break;
				case 'classQuizzes':
					// quizzes published to classes
					$class_quizzes = clone $quiz;
					$class_quizzes->publishedToClass($user->getKey(), $request->class_id);
					$union->push($class_quizzes);
				break;
				case 'schoolQuizzes':
					$school_quizzes = clone $quiz;
					$school_quizzes->whereSchoolPublished(1);
					$union->push($school_quizzes);
				break;
			}
		});

		$quiz = $union->first();
		($union->slice(1))->map(function($query) use (&$quiz) {
			$quiz->union($query);
		});

		if(!$request->limit) {
			$request->limit = 20;
		}
		if(!$request->offset) {
			$request->offset = 0;
		}
		
		$quiz->offset($request->offset);
		$quiz->limit($request->limit);

		$fractal = fractal()->collection($quiz->get(), new QuizTransformer);

        return response()->json($fractal->toArray());
	}

	/**
     * Quiz
     *
     * @api {post} <HOST>/api/quiz/school-publish/{id} Publish Quiz to School
     * @apiVersion 1.0.0
     * @apiName QuizSchoolPublish
     * @apiDescription Publish the quiz to the school
     * @apiGroup Quiz
     *
     * @apiUse JWTHeader
     * @apiParam {Number} id ID of quiz to publish
     * @apiSuccess {Boolean} success true/false
	 * 
	 * 
	*/
	public function schoolPublish(Request $request)
	{
		$user = \Auth::user();
		$quiz = Quiz::find($request->id);

		if(!$quiz) {
			return response('Quiz not found', 404);
		}
		$quiz->school_published = 1;
		$quiz->school_published_date = date('Y-m-d H:i:s');
		
		$success = false;
		if($quiz->created_by == $user->getKey() && $quiz->save()) {
			$success = true;
		}

		return response()->json(['success' => $success]);
	}

	/**
     * Quiz
     *
     * @api {post} <HOST>/api/quiz/class-publish Publish Quiz to Class
     * @apiVersion 1.0.0
     * @apiName QuizClassPublish
     * @apiDescription Publish the quiz to the class
     * @apiGroup Quiz
     *
     * @apiUse JWTHeader
     * 
	 * @apiParam {Number} quiz_id the quiz ID to be published
	 * @apiParam {Number} class_id ID of class where the quiz will be published to
	 * 
     * @apiSuccess {Boolean} success true/false
	 * 
	 * 
	*/
	public function classPublish(Request $request)
	{
		$user = \Auth::user();
		$quiz = Quiz::find($request->quiz_id);
		$class = Classes::find($request->class_id);

		if(!$quiz) {
			return response('Quiz not found', 404);
		}
		if(!$class || $class->teacher_id != $user->getKey()) {
			return response('Error: cannot publish the quiz to the specified class.', 500);
		}

		try {
			$class_quiz = ClassQuiz::create([
				'quiz_id' => $request->quiz_id,
				'class_id' => $class->id,
				'published_by' => $user->getKey(),
				'published_at' => date('Y-m-d H:i:s')
			]);

			return response()->json(['success' => true]);
		}
		catch(\Exception $e) {
			return response('Error: unable to publish.', 500);
		}

	}


	/**
     * Quiz
     *
     * @api {delete} <HOST>/api/quiz/delete/{id} Delete Quiz
     * @apiVersion 1.0.0
     * @apiName DeleteQuiz
     * @apiDescription Deletes the quiz
     * @apiGroup Quiz
     *
     * @apiUse JWTHeader
     *
	 * @apiParam {Number} id ID of quiz to delete
     * @apiSuccess {Boolean} success true/false
	 * 
	 * 
	*/
	public function deleteQuiz(Request $request)
	{
		$user = \Auth::user();
		$quiz = Quiz::find($request->id);

		if(!$quiz) {
			return response('Quiz not found', 404);
		}

		$success = false;
		if($quiz->created_by == $user->getKey() && $quiz->delete()) {
			$success = true;
		}

		return response()->json(['success' => $success]);
	}

	/**
     * Quiz
     *
     * @api {get} <HOST>/api/quiz/{id} Get Quiz Detail
     * @apiVersion 1.0.0
     * @apiName QuizDetail
     * @apiDescription Returns quiz detail
     * @apiGroup Quiz
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id quiz ID
	 * 
	 * @apiUse QuizDetailResponse
	 * @apiUse QuizSampleResponse
	 * 
	*/
	public function show(Request $request)
	{
		//todo: add policy who can view the quiz
		$user = \Auth::user();
		$quiz = Quiz::find($request->id);

		if(!$quiz) {
			return response('Quiz not found', 404);
		}

		$fractal = fractal()->item($quiz, new QuizTransformer);

        return response()->json($fractal->toArray());
	}


	/**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
	*/
	
	/**
     * @apiDefine QuizDetailResponse
     * @apiSuccess {Number} id ID of the added quiz
     * @apiSuccess {String} title Quiz title
     * @apiSuccess {String} intro Quiz intro/instruction
     * @apiSuccess {Number} subject_id
     * @apiSuccess {Number} school_published 0: not published to school, 1: published to school
     * @apiSuccess {Number} school_published_date published date or NULL
     * @apiSuccess {Object} author
     * @apiSuccess {Number} author.id creator ID
     * @apiSuccess {String} author.first_name
     * @apiSuccess {String} author.last_name
     * @apiSuccess {Array} questions array of question object
     * @apiSuccess {Number} questions.id ID of the added question
     * @apiSuccess {String} questions.question the question text
     * @apiSuccess {String=mcq} questions.question_type accepts multiple choice for now
     * @apiSuccess {Number} questions.weight the score of the question
     * @apiSuccess {Array} questions.choices array of question choices (up to 5 choices for now)
     * @apiSuccess {Number} questions.choices.option the choice text
     * @apiSuccess {Boolean} questions.choices.is_correct multiple choices can be marked as correct
     * @apiSuccess {String} media_url link to attachment
	*/
	
	/**
	 * @apiDefine QuizSampleResponse
	 * @apiSuccessExample {json} Sample Response
		{
			"id": 6,
			"title": "Quiz 2",
			"intro": "this is a quiz to answer",
			"subject_id": 1,
			"school_published": 1,
			"school_published_date": null,
			"author": {
				"id": 9,
				"first_name": "teacher jayson",
				"last_name": "barino"
			},
			"questions": [
				{
					"id": 13,
					"question": "test",
					"question_type": "mcq",
					"media_url": "http://sample-media.com/q1-quiz1",
					"weight": 1,
					"choices": [
						{
							"option": "a",
							"is_correct": 1
						},
						{
							"option": "b",
							"is_correct": 0
						},
						{
							"option": "c",
							"is_correct": 0
						},
						{
							"option": "d",
							"is_correct": 0
						},
						{
							"option": "e",
							"is_correct": 0
						}
					]
				},
				{
					"id": 14,
					"question": "test2",
					"question_type": "mcq",
					"media_url": "http://sample-media.com/q2-quiz1",
					"weight": 5,
					"choices": [
						{
							"option": "a",
							"is_correct": 0
						},
						{
							"option": "b",
							"is_correct": 1
						},
						{
							"option": "c",
							"is_correct": 1
						}
					]
				}
			]
		}
	 */
}
