<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Transformers\QuizBuilderTransformer;

use \App\Gateways\QuizBuilderGateway;

class QuizController extends Controller
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
		$quiz_gw->setQuizDetails($request->toArray());
		$quiz_gw->save();

		$fractal = fractal()->item($quiz_gw, new QuizBuilderTransformer);

        return response()->json($fractal->toArray());
	}
}
