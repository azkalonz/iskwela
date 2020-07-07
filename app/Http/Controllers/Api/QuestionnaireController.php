<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Transformers\QuestionnaireBuilderTransformer;
use App\Transformers\QuestionnaireTransformer;

use \App\Gateways\QuestionnaireBuilderGateway;

use \App\Models\Questionnaire;
use \App\Models\Classes;
use \App\Models\ClassQuiz;

class QuestionnaireController extends Controller
{
	/**
     * Questionnaire
     *
     * @api {post} <HOST>/api/questionnaire/save Save Questionnaire
     * @apiVersion 1.0.0
     * @apiName SaveQuestionnaire
     * @apiDescription Save Questionnaire
     * @apiGroup Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String} title Questionnaire title
     * @apiParam {String} intro Questionnaire intro/instruction
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
     * @apiSuccess {Number} id ID of the added Questionnaire
     * @apiSuccess {String} title Questionnaire title
     * @apiSuccess {String} intro Questionnaire intro/instruction
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
			"title": "Questionnaire 1",
			"intro": "this is a Questionnaire to answer",
			"subject_id": 1,
			"questions": [
				{
					"id": 199,
					"question": "test",
					"question_type": "mcq",
					"media_url": "http://sample-media.com/q1-Questionnaire1",
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
		$questionnaire_gw = new QuestionnaireBuilderGateway();

		//add and attach questions to questionnaire
		$questionnaire_gw->setQuestionnaireDetails($request->toArray());
		$questionnaire_gw->save();

		$fractal = fractal()->item($questionnaire_gw, new QuestionnaireBuilderTransformer);

        return response()->json($fractal->toArray());
	}

	/**
     * Questionnaire
     *
     * @api {get} <HOST>/api/questionnaires Questionnaire list
     * @apiVersion 1.0.0
     * @apiName QuestionnaireList
     * @apiDescription Get questionnaire list
     * @apiGroup Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Array=myQnrs, schoolQnrs} types available questionnaire types. <ul><li>myQnrs: questionnaires created by logged in teacher</li><li>schoolQnrs: questionnaires published by different teachers to the school</li></ul>
     * @apiParam {Number} class_id get questionnaires of the specified class. If this is passed, the "types" param will be invalidated
	 * @apiParam {Number} limit number of rows returned per request. Default: 20, Max: 100
	 * @apiParam {Number} offset the offset. Min: 0
	 *
	 * @apiUse QuestionnaireDetailResponse
	 * @apiUse QuestionnaireSampleResponse
	 *
	*/
	public function questionnaires(Request $request)
	{
		$this->validate($request, [
			'types' => 'array|distinct',
			'types.*' => 'in:'.implode(',', config('school_hub.questionnaire_types')),
			'limit' => 'integer|max:100', // set limit to 50 by default
			'offset' => 'integer|min:0' // set to 0 by default
		]);

		if(!$request->types) {
			$request->types = config('school_hub.questionnaire_types');
		}

		$user = \Auth::user();
		$questionnaire = Questionnaire::with('questions');

		$union = collect();

		array_reduce($request->types, function($index, $type) use ($questionnaire, $user, &$union, $request) {
			switch($type) {
				case 'myQnrs':
					// get own questionnaires
					$own_questionnaires = clone $questionnaire;
					$own_questionnaires->whereCreatedBy($user->getKey());
					$union->push($own_questionnaires);
				break;
/* 				case 'classQuizzes':
					// quizzes published to classes
					$class_quizzes = clone $quiz;
					$class_quizzes->publishedToClass($user->getKey(), $request->class_id);
					$union->push($class_quizzes);
				break; */
				case 'schoolQnrs':
					$school_questionnaires = clone $questionnaire;
					$school_questionnaires->whereSchoolPublished(1);
					$union->push($school_questionnaires);
				break;
			}
		});

		$questionnaire = $union->first();
		($union->slice(1))->map(function($query) use (&$questionnaire) {
			$questionnaire->union($query);
		});

		if(!$request->limit) {
			$request->limit = 20;
		}
		if(!$request->offset) {
			$request->offset = 0;
		}
		
		$questionnaire->offset($request->offset);
		$questionnaire->limit($request->limit);

		$fractal = fractal()->collection($questionnaire->get(), new QuestionnaireTransformer);

        return response()->json($fractal->toArray());
	}

	/**
     * Questionnaire
     *
     * @api {post} <HOST>/api/questionnaire/school-publish/:id Publish Questionnaire to School
     * @apiVersion 1.0.0
     * @apiName QuestionnaireSchoolPublish
     * @apiDescription Publish the questionnaire to the school
     * @apiGroup Questionnaire
     *
     * @apiUse JWTHeader
     * @apiParam {Number} id ID of questionnaire to publish
     * @apiSuccess {Boolean} success true/false
	 * 
	 * 
	*/
	public function schoolPublish(Request $request)
	{
		$user = \Auth::user();
		$questionnaire = Questionnaire::find($request->id);

		if(!$questionnaire) {
			return response('Questionnaire not found', 404);
		}
		$questionnaire->school_published = 1;
		$questionnaire->school_published_date = date('Y-m-d H:i:s');
		
		$success = false;
		if($questionnaire->created_by == $user->getKey() && $questionnaire->save()) {
			$success = true;
		}

		return response()->json(['success' => $success]);
	}


	/**
     * Questionnaire
     *
     * @api {delete} <HOST>/api/questionnaire/delete/:id Delete Questionnaire
     * @apiVersion 1.0.0
     * @apiName DeleteQuestionnaire
     * @apiDescription Deletes the questionnaire
     * @apiGroup Questionnaire
     *
     * @apiUse JWTHeader
     *
	 * @apiParam {Number} id ID of questionnaire to delete
     * @apiSuccess {Boolean} success true/false
	 * 
	 * 
	*/
	public function deleteQuestionnaire(Request $request)
	{
		$user = \Auth::user();
		$questionnaire = Questionnaire::find($request->id);

		if(!$questionnaire) {
			return response('Questionnaire not found', 404);
		}

		$success = false;
		if($questionnaire->created_by == $user->getKey() && $questionnaire->delete()) {
			$success = true;
		}

		return response()->json(['success' => $success]);
	}

	/**
     * Questionnaire
     *
     * @api {get} <HOST>/api/questionnaire/:id Get Questionnaire Detail
     * @apiVersion 1.0.0
     * @apiName QuestionnaireDetail
     * @apiDescription Returns questionnaire detail
     * @apiGroup Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id questionnaire ID
	 * 
	 * @apiUse QuestionnaireDetailResponse
	 * @apiUse QuestionnaireSampleResponse
	 * 
	*/
	public function show(Request $request)
	{
		//todo: add policy who can view the questionnaire
		$user = \Auth::user();
		$questionnaire = Questionnaire::find($request->id);

		if(!$questionnaire) {
			return response('Questionnaire not found', 404);
		}

		$fractal = fractal()->item($questionnaire, new QuestionnaireTransformer);

        return response()->json($fractal->toArray());
	}


	/**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
	*/
	
	/**
     * @apiDefine QuestionnaireDetailResponse
     * @apiSuccess {Number} id ID of the added questionnaire
     * @apiSuccess {String} title Questionnaire title
     * @apiSuccess {String} intro Questionnaire intro/instruction
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
	 * @apiDefine QuestionnaireSampleResponse
	 * @apiSuccessExample {json} Sample Response
		{
			"id": 6,
			"title": "Questionnaire 2",
			"intro": "this is a questionnaire to answer",
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
					"media_url": "http://sample-media.com/q1-questionnaire1",
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
					"media_url": "http://sample-media.com/q2-questionnaire1",
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
