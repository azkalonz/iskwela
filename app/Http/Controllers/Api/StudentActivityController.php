<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Models\StudentActivity;
use App\Models\Questionnaire;
use App\Models\StudentActivityQuestionnaire;
use App\Models\ClassActivity;
use App\Models\StudentActivitySubmission;
use App\Transformers\StudentActivityTransformer;

class StudentActivityController extends Controller
{
	const QUIZ = 1;
	const PERIODICAL = 2;
	const ASSIGNMENT = 3;


	/**
     * Quizzes
     *
     * @api {post} <HOST>/api/quiz/save Add/Edit Quiz
     * @apiVersion 1.0.0
     * @apiName AddQuiz
     * @apiDescription Saves a new quiz with attached questionnaires
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} [activity_id] if provided, edits the existing record
     * @apiParam {String=questionnaires} [include] if specified, includes the questionnaire details in response data
     * @apiParam {String} title the quiz title
     * @apiParam {String} instruction descriptions/instructions/introduction texts
     * @apiParam {Number} duration time limit on answering this class
     * @apiParam {Number} category_id to which category this quiz should be: written, performance, etc (whatever is defined by the school)
     * @apiParam {Number} subject_id 
     * @apiParam {Array} questionnaires array of questionnaire IDs attached to the quiz
     * @apiParam {Number} questionnaires.id questionnaire ID attached by teacher
     *
	 * 
     * @apiSuccess {Number} id ID of newly created quiz
     * @apiSuccess {String} title
     * @apiSuccess {String} instruction
     * @apiSuccess {Number} duration
     * @apiSuccess {String} activity_availability_status OPEN by default
     * @apiSuccess {Object} subject subject details
     * @apiSuccess {Number} subject.id
     * @apiSuccess {Number} subject.subject_name
     * @apiSuccess {Object} category the category details
     * @apiSuccess {Number} category.id
     * @apiSuccess {Number} category.school_id
     * @apiSuccess {String} category.category the category title
     * @apiSuccess {Float} category.category_percentage the weight of the category in overall grade calculation
     * @apiSuccess {Array} questionnaires refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details
     * 
     * @apiSuccessExample {json} Sample Response
		{
			"id": 21,
			"title": "quiz3 - written",
			"instruction": "answer this",
			"duration": 60,
			"subject": {
				"id": 2,
				"subject_name": "Filipino"
			},
			"activity_availability_status": "OPEN",
			"category": {
				"id": 1,
				"school_id": 1,
				"category": "Written Works",
				"category_percentage": "0.3"
			},
			"questionnaires": [
				{
					"id": 2,
					"title": "Questionnaire 1",
					"intro": "this is a quiz to answer",
					"subject_id": 1,
					"school_published": 0,
					"school_published_date": null,
					"author": {
						"id": 8,
						"first_name": "teacher tom",
						"last_name": "cruz"
					},
					"questions": [
						{
							"id": 3,
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
							"id": 4,
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
			]
		}
     * 
     * 
     */
	public function saveQuiz(Request $request)
	{
		return $this->save($request, self::QUIZ);
	}

	/**
     * Quizzes
     *
     * @api {get} <HOST>/api/quizzes Get Quizzes
     * @apiVersion 1.0.0
     * @apiName ListQuizzes
     * @apiDescription Returns array of quizzes
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String=questionnaires} [include] if specified, includes the questionnaire details in response data
     * @apiParam {Number} class_id filter the list to return published quizzes to the class.<br> OPTIONAL for teacher; and if not specified, returns all the quizzes created by the logged in teacher<br><br> REQUIRED for school admin andstudents.
     * @apiParam {Number} subject_id filter the list to return quizzes of the specified subject only.
     * @apiParam {Number} teacher_id required if logged in as school admin (for viewing the list of quizzes published by the specified teacher_id)
     *
	 * 
     * @apiSuccess {Number} id the quiz ID
     * @apiSuccess {String} title
     * @apiSuccess {String} instruction
     * @apiSuccess {Number} duration
	 * @apiSuccess {String} activity_availability_status OPEN/CLOSED
     * @apiSuccess {String} submission_status available in student profile only. Values: TO DO/ONGOING/DONE
     * @apiSuccess {DateTimeOrNull} submission_date available in student profile only
     * @apiSuccess {Object} subject subject details
     * @apiSuccess {Number} subject.id
     * @apiSuccess {Number} subject.subject_name
     * @apiSuccess {Object} category the category details
     * @apiSuccess {Number} category.id
     * @apiSuccess {Number} category.school_id
     * @apiSuccess {String} category.category the category title
     * @apiSuccess {Float} category.category_percentage the weight of the category in overall grade calculation
     * @apiSuccess {Array} questionnaires refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details
     * 
     * @apiSuccessExample {json} Sample Response
		[
			{
				"id": 21,
				"title": "quiz3 - written",
				"instruction": "answer this",
				"duration": 60,
				"activity_availability_status": "OPEN",
				"submission_status": "DONE",
    			"submission_date": "2020-08-29 10:56:18",
				"subject": {
					"id": 2,
					"subject_name": "Filipino"
				},
				"category": {
					"id": 1,
					"school_id": 1,
					"category": "Written Works",
					"category_percentage": "0.3"
				},
				"questionnaires": [
					{
						"id": 2,
						"title": "Questionnaire 1",
						"intro": "this is a quiz to answer",
						"subject_id": 1,
						"school_published": 0,
						"school_published_date": null,
						"author": {
							"id": 8,
							"first_name": "teacher tom",
							"last_name": "cruz"
						},
						"questions": [
							{
								"id": 3,
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
								"id": 4,
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
					},
					{}
				]
			}
		]
     * 
     * 
     */
	
	public function quizzes(Request $request)
	{
		return $this->getList($request, self::QUIZ);
	}

	/**
     * Quizzes
     *
     * @api {post} <HOST>/api/quiz/publish Publish Quiz
     * @apiVersion 1.0.0
     * @apiName PublishQuiz
     * @apiDescription Publishes the quiz to class
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the quiz to be published
     * @apiParam {Number} class_id the target class where the quiz will be published to
     * @apiParam {Number} schedule_id which schedule the quiz should be published
     *
	 * 
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	public function publishQuiz(Request $request)
	{
		return $this->publish($request, self::QUIZ, 'Quiz');
	}

	/**
     * Quizzes
     *
     * @api {post} <HOST>/api/quiz/unpublish Unpublish Quiz
     * @apiVersion 1.0.0
     * @apiName UnpublishQuiz
     * @apiDescription Removes the quiz from the class
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the quiz to be unpublished
     * @apiParam {Number} class_id which class the quiz will be removed from
	 * 
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	public function unpublishQuiz(Request $request)
	{
		return $this->unpublish($request, self::QUIZ, 'Quiz');
	}

	/**
     * Quizzes
     *
     * @api {delete} <HOST>/api/quiz/delete/:id Delete Quiz
     * @apiVersion 1.0.0
     * @apiName DeleteQuiz
     * @apiDescription Delete the quiz from the quiz bank
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	public function deleteQuiz(Request $request)
	{
		return $this->delete($request, self::QUIZ, 'Quiz');
	}

	/**
     * Quizzes
     *
     * @api {post} <HOST>/api/quiz/questionnaire/add Add Questionnaire
     * @apiVersion 1.0.0
     * @apiName AddQuizQuestionnaire
     * @apiDescription Allows adding more questionnaires to the existing quiz
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the quiz
     * @apiParam {Array} questionnaires array of questionnaire IDs to be added to the quiz
     * @apiParam {Number} questionnaires.id the questionnaire ID
	 * 
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	public function addQuizQuestionnaire(Request $request)
	{
		return $this->addQuestionnaire($request, self::QUIZ, 'Quiz');
	}

	/**
     * Quizzes
     *
     * @api {post} <HOST>/api/quiz/questionnaire/remove Remove Questionnaire
     * @apiVersion 1.0.0
     * @apiName RemoveQuizQuestionnaire
     * @apiDescription Allows removing questionnaires to the existing quiz. Only one questionnaire can be removed at a time
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the quiz
     * @apiParam {Number} questionnaire_id the ID of the questionnaire to be removed
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	public function removeQuizQuestionnaire(Request $request)
	{
		return $this->removeQuestionnaire($request, self::QUIZ, 'Quiz');
	}

	/**
     * Quizzes
     *
     * @api {get} <HOST>/api/quiz/:id Get Quiz Detail
     * @apiVersion 1.0.0
     * @apiName QuizDetail
     * @apiDescription Returns details of the specified quiz ID
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String=questionnaires} [include] if specified, includes the questionnaire details in response data
	 * 
     * @apiSuccess {Number} id the quiz ID
     * @apiSuccess {String} title
     * @apiSuccess {String} instruction
     * @apiSuccess {Number} duration
     * @apiSuccess {String} activity_availability_status OPEN/CLOSED
     * @apiSuccess {String} submission_status available in student profile only. Values: TO DO/ONGOING/DONE
     * @apiSuccess {DateTimeOrNull} submission_date available in student profile only
     * @apiSuccess {Object} subject subject details
     * @apiSuccess {Number} subject.id
     * @apiSuccess {Number} subject.subject_name
     * @apiSuccess {Object} category the category details
     * @apiSuccess {Number} category.id
     * @apiSuccess {Number} category.school_id
     * @apiSuccess {String} category.category the category title
     * @apiSuccess {Float} category.category_percentage the weight of the category in overall grade calculation
     * @apiSuccess {Array} questionnaires refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details
     * 
     * @apiSuccessExample {json} Sample Response
		{
			"id": 17,
			"title": "quiz2 - written",
			"instruction": "answer this",
			"duration": 60,
			"activity_availability_status": "OPEN",
			"submission_status": "DONE",
    		"submission_date": "2020-08-29 10:56:18",
			"subject": {
				"id": 1,
				"subject_name": "English"
			},
			"category": {
				"id": 1,
				"school_id": 1,
				"category": "Written Works",
				"category_percentage": "0.3"
			},
			"questionnaires": [
				{
					"id": 2,
					"title": "Questionnaire 1",
					"intro": "this is a quiz to answer",
					"subject_id": 1,
					"school_published": 0,
					"school_published_date": null,
					"author": {
						"id": 8,
						"first_name": "teacher tom",
						"last_name": "cruz"
					},
					"questions": [
						{
							"id": 3,
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
							"id": 4,
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
			]
		}
     * 
     * 
     */
	public function getQuiz(Request $request)
	{
		return $this->details($request, self::QUIZ, 'Quiz');
	}


	// PERIODICAL

	/**
     * Periodicals
     *
     * @api {post} <HOST>/api/periodical/save Add/Edit Periodical
     * @apiVersion 1.0.0
     * @apiName AddPeriodical
     * @apiDescription Saves a new periodical with attached questionnaires
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
	 * @apiParam {Number} [activity_id] if provided, edits the existing record
     * @apiParam {String=questionnaires} [include] if specified, includes the questionnaire details in response data
     * @apiParam {String} title the periodical title
     * @apiParam {String} instruction descriptions/instructions/introduction texts
     * @apiParam {Number} duration time limit on answering this class
     * @apiParam {Number} category_id to which category this periodical should be: written, performance, etc (whatever is defined by the school)
     * @apiParam {Number} subject_id 
     * @apiParam {Array} questionnaires array of questionnaire IDs attached to the periodical
     * @apiParam {Number} questionnaires.id questionnaire ID attached by teacher
     *
	 * 
     * @apiSuccess {Number} id ID of newly created periodical
     * @apiSuccess {String} title
     * @apiSuccess {String} instruction
     * @apiSuccess {Number} duration
     * @apiSuccess {String} activity_availability_status OPEN by default
     * @apiSuccess {Object} subject subject details
     * @apiSuccess {Number} subject.id
     * @apiSuccess {Number} subject.subject_name
     * @apiSuccess {Object} category the category details
     * @apiSuccess {Number} category.id
     * @apiSuccess {Number} category.school_id
     * @apiSuccess {String} category.category the category title
     * @apiSuccess {Float} category.category_percentage the weight of the category in overall grade calculation
     * @apiSuccess {Array} questionnaires refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details
     * 
     * @apiSuccessExample {json} Sample Response
		{
			"id": 21,
			"title": "Periodical - written",
			"instruction": "answer this",
			"duration": 60,
			"activity_availability_status": "OPEN",
			"subject": {
				"id": 2,
				"subject_name": "Filipino"
			},
			"category": {
				"id": 1,
				"school_id": 1,
				"category": "Written Works",
				"category_percentage": "0.3"
			},
			"questionnaires": [
				{
					"id": 2,
					"title": "Questionnaire 1",
					"intro": "this is a quiz to answer",
					"subject_id": 1,
					"school_published": 0,
					"school_published_date": null,
					"author": {
						"id": 8,
						"first_name": "teacher tom",
						"last_name": "cruz"
					},
					"questions": [
						{
							"id": 3,
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
							"id": 4,
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
			]
		}
     * 
     * 
     */

	public function savePeriodical(Request $request)
	{
		return $this->save($request, self::PERIODICAL);
	}

	/**
     * Periodicals
     *
     * @api {get} <HOST>/api/periodicals Get Periodicals
     * @apiVersion 1.0.0
     * @apiName ListPeriodicals
     * @apiDescription Returns array of periodicals
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String=questionnaires} [include] if specified, includes the questionnaire details in response data
     * @apiParam {Number} class_id filter the list to return published periodicals to the class.<br> OPTIONAL for teacher; and if not specified, returns all the periodicals created by teacher<br><br> REQUIRED for school admin and students.
     * @apiParam {Number} subject_id filter the list to return periodiclas of the specified subject only.
	 * @apiParam {Number} teacher_id required if logged in as school admin (for viewing the list of periodicals published by the specified teacher_id)
     *
	 * 
     * @apiSuccess {Number} the periodical ID
     * @apiSuccess {String} title
     * @apiSuccess {String} instruction
	 * @apiSuccess {Number} duration
	 * @apiSuccess {String} activity_availability_status OPEN/CLOSED
     * @apiSuccess {String} submission_status available in student profile only. Values: TO DO/ONGOING/DONE
     * @apiSuccess {DateTimeOrNull} submission_date available in student profile only
     * @apiSuccess {Object} subject subject details
     * @apiSuccess {Number} subject.id
     * @apiSuccess {Number} subject.subject_name
     * @apiSuccess {Object} category the category details
     * @apiSuccess {Number} category.id
     * @apiSuccess {Number} category.school_id
     * @apiSuccess {String} category.category the category title
     * @apiSuccess {Float} category.category_percentage the weight of the category in overall grade calculation
     * @apiSuccess {Array} questionnaires refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details
     * 
     * @apiSuccessExample {json} Sample Response
		[
			{
				"id": 21,
				"title": "periodical - written",
				"instruction": "answer this",
				"duration": 60,
				"activity_availability_status": "CLOSED",
				"submission_status": "DONE",
				"submission_date": "2020-08-29 10:56:18",
				"subject": {
					"id": 2,
					"subject_name": "Filipino"
				},
				"category": {
					"id": 1,
					"school_id": 1,
					"category": "Written Works",
					"category_percentage": "0.3"
				},
				"questionnaires": [
					{
						"id": 2,
						"title": "Questionnaire 1",
						"intro": "this is a quiz to answer",
						"subject_id": 1,
						"school_published": 0,
						"school_published_date": null,
						"author": {
							"id": 8,
							"first_name": "teacher tom",
							"last_name": "cruz"
						},
						"questions": [
							{
								"id": 3,
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
								"id": 4,
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
					},
					{}
				]
			}
		]
     * 
     * 
     */
	
	
	public function periodicals(Request $request)
	{
		return $this->getList($request, self::PERIODICAL);
	}


	/**
     * Periodicals
     *
     * @api {post} <HOST>/api/periodical/publish Publish Periodical
     * @apiVersion 1.0.0
     * @apiName PublishPeriodical
     * @apiDescription Publishes the periodical to class
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the periodical to be published
     * @apiParam {Number} class_id the target class where the periodical will be published to
     * @apiParam {Number} schedule_id which schedule the periodical should be published
     *
	 * 
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	public function publishPeriodical(Request $request)
	{
		return $this->publish($request, self::PERIODICAL, 'Periodical');
	}

	/**
     * Periodicals
     *
     * @api {post} <HOST>/api/periodical/unpublish Unpublish Periodical
     * @apiVersion 1.0.0
     * @apiName UnpublishPeriodical
     * @apiDescription Removes the periodical from the class
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the periodical to be unpublished
     * @apiParam {Number} class_id which class the periodical will be removed from
	 * 
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	
	public function unpublishPeriodical(Request $request)
	{
		return $this->unpublish($request, self::PERIODICAL, 'Periodical');
	}

	/**
     * Periodicals
     *
     * @api {delete} <HOST>/api/periodical/delete/:id Delete Periodical
     * @apiVersion 1.0.0
     * @apiName DeletePeriodical
     * @apiDescription Delete the periodical from the periodical bank
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	public function deletePeriodical(Request $request)
	{
		return $this->delete($request, self::PERIODICAL, 'Periodical');
	}


	/**
     * Periodicals
     *
     * @api {post} <HOST>/api/periodical/questionnaire/add Add Questionnaire
     * @apiVersion 1.0.0
     * @apiName AddPeriodicalQuestionnaire
     * @apiDescription Allows adding more questionnaires to the existing periodical
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the periodical
     * @apiParam {Array} questionnaires array of questionnaire IDs to be added to the periodical
     * @apiParam {Number} questionnaires.id the questionnaire ID
	 * 
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	
	public function addPeriodicalQuestionnaire(Request $request)
	{
		return $this->addQuestionnaire($request, self::PERIODICAL, 'Periodical');
	}

	/**
     * Periodicals
     *
     * @api {post} <HOST>/api/periodical/questionnaire/remove Remove Questionnaire
     * @apiVersion 1.0.0
     * @apiName RemovePeriodicalQuestionnaire
     * @apiDescription Allows removing questionnaires to the existing periodical. Only one questionnaire can be removed at a time
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the periodical
     * @apiParam {Number} questionnaire_id the ID of the questionnaire to be removed
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	
	public function removePeriodicalQuestionnaire(Request $request)
	{
		return $this->removeQuestionnaire($request, self::PERIODICAL, 'Periodical');
	}

	/**
     * Periodicals
     *
     * @api {get} <HOST>/api/periodical/:id Get Periodical Detail
     * @apiVersion 1.0.0
     * @apiName PeriodicalDetail
     * @apiDescription Returns details of the specified periodical ID
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String=questionnaires} [include] if specified, includes the questionnaire details in response data
	 * 
     * @apiSuccess {Number} id the periodical ID
     * @apiSuccess {String} title
     * @apiSuccess {String} instruction
     * @apiSuccess {Number} duration
     * @apiSuccess {String} activity_availability_status OPEN/CLOSED
     * @apiSuccess {String} submission_status available in student profile only. Values: TO DO/ONGOING/DONE
     * @apiSuccess {DateTimeOrNull} submission_date available in student profile only
     * @apiSuccess {Object} subject subject details
     * @apiSuccess {Number} subject.id
     * @apiSuccess {Number} subject.subject_name
     * @apiSuccess {Object} category the category details
     * @apiSuccess {Number} category.id
     * @apiSuccess {Number} category.school_id
     * @apiSuccess {String} category.category the category title
     * @apiSuccess {Float} category.category_percentage the weight of the category in overall grade calculation
     * @apiSuccess {Array} questionnaires refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details
     * 
     * @apiSuccessExample {json} Sample Response
		{
			"id": 17,
			"title": "quiz2 - written",
			"instruction": "answer this",
			"duration": 60,
			"activity_availability_status": "OPEN",
			"submission_status": "DONE",
    		"submission_date": "2020-08-29 10:56:18",
			"subject": {
				"id": 1,
				"subject_name": "English"
			},
			"category": {
				"id": 1,
				"school_id": 1,
				"category": "Written Works",
				"category_percentage": "0.3"
			},
			"questionnaires": [
				{
					"id": 2,
					"title": "Questionnaire 1",
					"intro": "this is a quiz to answer",
					"subject_id": 1,
					"school_published": 0,
					"school_published_date": null,
					"author": {
						"id": 8,
						"first_name": "teacher tom",
						"last_name": "cruz"
					},
					"questions": [
						{
							"id": 3,
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
							"id": 4,
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
			]
		}
     * 
     * 
     */
	
	public function getPeriodical(Request $request)
	{
		return $this->details($request, self::PERIODICAL, 'Periodical');
	}


	// ASSIGNMENT


	/**
     * Assignments
     *
     * @api {post} <HOST>/api/assignment/save Add/Edit assignment
     * @apiVersion 1.0.0
     * @apiName AddAssignment
     * @apiDescription Saves a new assignment with attached questionnaires
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
	 * @apiParam {Number} [activity_id] if provided, edits the existing record
     * @apiParam {String=questionnaires} [include] if specified, includes the questionnaire details in response data
     * @apiParam {String} title the assignment title
     * @apiParam {String} instruction descriptions/instructions/introduction texts
     * @apiParam {Number} duration time limit on answering this class
     * @apiParam {Number} category_id to which category this assignment should be: written, performance, etc (whatever is defined by the school)
     * @apiParam {Number} subject_id 
     * @apiParam {Array} questionnaires array of questionnaire IDs attached to the assignment
     * @apiParam {Number} questionnaires.id questionnaire ID attached by teacher
     *
	 * 
     * @apiSuccess {Number} id ID of newly created assignment
     * @apiSuccess {String} title
     * @apiSuccess {String} instruction
     * @apiSuccess {Number} duration
     * @apiSuccess {String} activity_availability_status OPEN by default
     * @apiSuccess {Object} subject subject details
     * @apiSuccess {Number} subject.id
     * @apiSuccess {Number} subject.subject_name
     * @apiSuccess {Object} category the category details
     * @apiSuccess {Number} category.id
     * @apiSuccess {Number} category.school_id
     * @apiSuccess {String} category.category the category title
     * @apiSuccess {Float} category.category_percentage the weight of the category in overall grade calculation
     * @apiSuccess {Array} questionnaires refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details
     * 
     * @apiSuccessExample {json} Sample Response
		{
			"id": 21,
			"title": "assignment - written",
			"instruction": "answer this",
			"duration": 60,
			"activity_availability_status": "OPEN",
			"subject": {
				"id": 2,
				"subject_name": "Filipino"
			},
			"category": {
				"id": 1,
				"school_id": 1,
				"category": "Written Works",
				"category_percentage": "0.3"
			},
			"questionnaires": [
				{
					"id": 2,
					"title": "Questionnaire 1",
					"intro": "this is a quiz to answer",
					"subject_id": 1,
					"school_published": 0,
					"school_published_date": null,
					"author": {
						"id": 8,
						"first_name": "teacher tom",
						"last_name": "cruz"
					},
					"questions": [
						{
							"id": 3,
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
							"id": 4,
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
			]
		}
     * 
     * 
     */

	
	public function saveAssignment(Request $request)
	{
		return $this->save($request, self::ASSIGNMENT);
	}


	/**
     * Assignments
     *
     * @api {get} <HOST>/api/assignments Get Assignments
     * @apiVersion 1.0.0
     * @apiName ListAssignments
     * @apiDescription Returns array of assignments
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String=questionnaires} [include] if specified, includes the questionnaire details in response data
     * @apiParam {Number} class_id filter the list to return published assignments to the class.<br> OPTIONAL for teacher; and if not specified, returns all the periodicals created by teacher<br><br> REQUIRED for school admin and students.
     * @apiParam {Number} subject_id filter the list to return periodiclas of the specified subject only.
	 * @apiParam {Number} teacher_id required if logged in as school admin (for viewing the list of assignments published by the specified teacher_id)
     *
	 * 
     * @apiSuccess {Number} the assignment ID
     * @apiSuccess {String} title
     * @apiSuccess {String} instruction
     * @apiSuccess {Number} duration
	 * @apiSuccess {String} activity_availability_status OPEN/CLOSED
     * @apiSuccess {String} submission_status available in student profile only. Values: TO DO/ONGOING/DONE
     * @apiSuccess {DateTimeOrNull} submission_date available in student profile only
     * @apiSuccess {Object} subject subject details
     * @apiSuccess {Number} subject.id
     * @apiSuccess {Number} subject.subject_name
     * @apiSuccess {Object} category the category details
     * @apiSuccess {Number} category.id
     * @apiSuccess {Number} category.school_id
     * @apiSuccess {String} category.category the category title
     * @apiSuccess {Float} category.category_percentage the weight of the category in overall grade calculation
     * @apiSuccess {Array} questionnaires refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details
     * 
     * @apiSuccessExample {json} Sample Response
		[
			{
				"id": 21,
				"title": "assignment - written",
				"instruction": "answer this",
				"duration": 60,
				"activity_availability_status": "CLOSED",
				"submission_status": "DONE",
				"submission_date": "2020-08-29 10:56:18",
				"subject": {
					"id": 2,
					"subject_name": "Filipino"
				},
				"category": {
					"id": 1,
					"school_id": 1,
					"category": "Written Works",
					"category_percentage": "0.3"
				},
				"questionnaires": [
					{
						"id": 2,
						"title": "Questionnaire 1",
						"intro": "this is a quiz to answer",
						"subject_id": 1,
						"school_published": 0,
						"school_published_date": null,
						"author": {
							"id": 8,
							"first_name": "teacher tom",
							"last_name": "cruz"
						},
						"questions": [
							{
								"id": 3,
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
								"id": 4,
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
					},
					{}
				]
			}
		]
     * 
     * 
     */
	
	
	
	public function assignments(Request $request)
	{
		return $this->getList($request, self::ASSIGNMENT);
	}


	/**
     * Assignments
     *
     * @api {post} <HOST>/api/assignment/publish Publish Assignment
     * @apiVersion 1.0.0
     * @apiName PublishAssignment
     * @apiDescription Publishes the assignment to class
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the assignment to be published
     * @apiParam {Number} class_id the target class where the assignment will be published to
     * @apiParam {Number} schedule_id which schedule the assignment should be published
     *
	 * 
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	
	public function publishAssignment(Request $request)
	{
		return $this->publish($request, self::ASSIGNMENT, 'Assignment');
	}


	/**
     * Assignments
     *
     * @api {post} <HOST>/api/assignment/unpublish Unpublish Assignment
     * @apiVersion 1.0.0
     * @apiName UnpublishAssignment
     * @apiDescription Removes the assignment from the class
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the assignment to be unpublished
     * @apiParam {Number} class_id which class the assignment will be removed from
	 * 
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	
	
	public function unpublishAssignment(Request $request)
	{
		return $this->unpublish($request, self::ASSIGNMENT, 'Assignment');
	}


	/**
     * Assignments
     *
     * @api {delete} <HOST>/api/assignment/delete/:id Delete Assignment
     * @apiVersion 1.0.0
     * @apiName DeleteAssignment
     * @apiDescription Delete the assignment from the assignment bank
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	
	public function deleteAssignment(Request $request)
	{
		return $this->delete($request, self::ASSIGNMENT, 'Assignment');
	}

	/**
     * Assignments
     *
     * @api {post} <HOST>/api/assignment/questionnaire/add Add Questionnaire
     * @apiVersion 1.0.0
     * @apiName AddAssignmentQuestionnaire
     * @apiDescription Allows adding more questionnaires to the existing assignment
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the assignment
     * @apiParam {Array} questionnaires array of questionnaire IDs to be added to the assignment
     * @apiParam {Number} questionnaires.id the questionnaire ID
	 * 
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	
	
	public function addAssignmentQuestionnaire(Request $request)
	{
		return $this->addQuestionnaire($request, self::ASSIGNMENT, 'Assignment');
	}

	/**
     * Assignments
     *
     * @api {post} <HOST>/api/assignment/questionnaire/remove Remove Questionnaire
     * @apiVersion 1.0.0
     * @apiName RemoveAssignmentQuestionnaire
     * @apiDescription Allows removing questionnaires to the existing assignment. Only one questionnaire can be removed at a time
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the ID of the assignment
     * @apiParam {Number} questionnaire_id the ID of the questionnaire to be removed
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
		{
			"success": true
		}
     * 
     * 
     */
	
	
	
	public function removeAssignmentQuestionnaire(Request $request)
	{
		return $this->removeQuestionnaire($request, self::ASSIGNMENT, 'Assignment');
	}

	/**
     * Assignments
     *
     * @api {get} <HOST>/api/assignment/:id Get Assignment Detail
     * @apiVersion 1.0.0
     * @apiName AssignmentDetail
     * @apiDescription Returns details of the specified assignment ID
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {String=questionnaires} [include] if specified, includes the questionnaire details in response data
	 * 
     * @apiSuccess {Number} id the assignment ID
     * @apiSuccess {String} title
     * @apiSuccess {String} instruction
     * @apiSuccess {Number} duration
     * @apiSuccess {String} activity_availability_status OPEN/CLOSED
     * @apiSuccess {String} submission_status available in student profile only. Values: TO DO/ONGOING/DONE
     * @apiSuccess {DateTimeOrNull} submission_date available in student profile only
     * @apiSuccess {Object} subject subject details
     * @apiSuccess {Number} subject.id
     * @apiSuccess {Number} subject.subject_name
     * @apiSuccess {Object} category the category details
     * @apiSuccess {Number} category.id
     * @apiSuccess {Number} category.school_id
     * @apiSuccess {String} category.category the category title
     * @apiSuccess {Float} category.category_percentage the weight of the category in overall grade calculation
     * @apiSuccess {Array} questionnaires refer to <a href='#api-Questionnaire-QuestionnaireDetail'><font color='blue'><HOST>/api/questionnaire/:id</font></a> for the questionnaire details
     * 
     * @apiSuccessExample {json} Sample Response
		{
			"id": 17,
			"title": "quiz2 - written",
			"instruction": "answer this",
			"duration": 60,
			"activity_availability_status": "OPEN",
			"submission_status": "DONE",
    		"submission_date": "2020-08-29 10:56:18",
			"subject": {
				"id": 1,
				"subject_name": "English"
			},
			"category": {
				"id": 1,
				"school_id": 1,
				"category": "Written Works",
				"category_percentage": "0.3"
			},
			"questionnaires": [
				{
					"id": 2,
					"title": "Questionnaire 1",
					"intro": "this is a quiz to answer",
					"subject_id": 1,
					"school_published": 0,
					"school_published_date": null,
					"author": {
						"id": 8,
						"first_name": "teacher tom",
						"last_name": "cruz"
					},
					"questions": [
						{
							"id": 3,
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
							"id": 4,
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
			]
		}
     * 
     * 
     */
	
	
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
				'class_id' => 'integer',
				'subject_id' => 'integer'
			]);

			$student_activities->whereCreatedBy($user->getKey());
			$published_by = $user->getKey();
		}
		else if ($user->user_type == 'a') {
			$this->validate($request, [
				'class_id' => 'integer|required',
				'subject_id' => 'integer',
				'teacher_id' => 'integer|required'
			]);
			$published_by = $request->teacher_id;
		}
		else {
			$this->validate($request, [
				'class_id' => 'integer|required',
				'subject_id' => 'integer'
			]);
			$published_by = null;
		}

		if($request->class_id) {
			$student_activities->inClass($published_by, $request->class_id);
		}

		if($request->subject_id) {
			$student_activities->whereSubjectId($request->subject_id);
		}

		$student_activities->submissionStatus($user->getKey());

		$fractal = fractal()->collection($student_activities->get(['student_activities.*', 'student_activity_submission.status', 'student_activity_submission.created_at as submitted_date']), new StudentActivityTransformer);

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
		$user = Auth::user();
		$student_activity = StudentActivity::select(['student_activities.*', 'student_activity_submission.status', 'student_activity_submission.created_at as submitted_date'])
				->where('student_activities.id', '=', $request->id)->whereActivityType($activity_type)
				->submissionStatus($user->getKey())->first();

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
		
		if($request->activity_id) {
			$student_activity = StudentActivity::whereId($request->activity_id)->whereActivityType($activity_type)->first();

			if(!$student_activity) {
				return response("Error editing the activity", 500);
			}
		}

		else {
			$student_activity = new StudentActivity();
		}
		
		$student_activity->title = $request->title;
		$student_activity->instruction = $request->instruction ?? "";
		$student_activity->duration = $request->duration;
		$student_activity->category_id = $request->category_id;
		$student_activity->subject_id = $request->subject_id;
		$student_activity->created_by = $user->getKey();
		$student_activity->school_id = $user->school_id;
		$student_activity->activity_type = $activity_type;
		$student_activity->perfect_score = $this->getActivityTotalScore($request->questionnaires);
		$student_activity->availability_status = 1;
		if($student_activity->save() && $request->questionnaires) {
			$this->attachQuestionnaireToActivity($request->questionnaires, $student_activity);
		}

		$fractal = fractal()->item($student_activity, new StudentActivityTransformer);

        return response()->json($fractal->toArray());
	}

	private function attachQuestionnaireToActivity(Array $questionnaires, \App\Models\StudentActivity $student_activity)
	{
		collect($questionnaires)->map(function($qnr) use ($student_activity) {
			$question_is_attached = StudentActivityQuestionnaire::whereQuestionnaireId($qnr['id'])
				->whereStudentActivityId($student_activity->id)->first();
			
			if(!$question_is_attached) {
				$sta = new StudentActivityQuestionnaire();
				$sta->student_activity_id = $student_activity->id;
				$sta->questionnaire_id = $qnr['id'];
				$sta->save();
			}
		});
	}

	private function getActivityTotalScore(array $questionnaires)
	{
		$perfect_score = 0;

		collect($questionnaires)->map(function($qs) use (&$perfect_score) {
			$questionnaire = Questionnaire::find($qs['id']);
			$questionnaire->questions->map(function ($q) use (&$perfect_score) {
				$perfect_score += $q->pivot->weight;
			});
		});

        return $perfect_score;
	}

	/**
     * Quizzes
     *
     * @api {post} <HOST>/quiz/complete/:id Complete Quiz (for Student)
     * @apiVersion 1.0.0
     * @apiName QuizComplete
     * @apiDescription Mark quiz as complete (student side)
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the quiz ID
     * @apiSuccessExample {json} Sample Response
		{"success": true}
	*/ 
	public function completeQuiz(Request $request)
	{
		return $this->completeActivity($request, self::QUIZ, 'Quiz');
	}

	/**
     * Quizzes
     *
     * @api {post} <HOST>/quiz/close/:id Close Quiz (for Teacher)
     * @apiVersion 1.0.0
     * @apiName QuizClose
     * @apiDescription Close the quiz to prevent the student from taking the quiz
     * @apiGroup Quizzes
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the quiz ID
     * @apiSuccessExample {json} Sample Response
		{"success": true}
	*/ 
	public function closeQuiz(Request $request)
	{
		return $this->closeActivity($request, self::QUIZ, 'Quiz');
	}


	/**
     * Assignments
     *
     * @api {post} <HOST>/assignment/complete/:id Complete Assignment (for Student)
     * @apiVersion 1.0.0
     * @apiName AssignmentComplete
     * @apiDescription Mark assignment as complete (student side)
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the assignment ID
     * @apiSuccessExample {json} Sample Response
		{"success": true}
	*/ 
	public function completeAssignment(Request $request)
	{
		return $this->completeActivity($request, self::ASSIGNMENT, 'Assignment');
	}

	/**
     * Assignments
     *
     * @api {post} <HOST>/assignment/close/:id Close Assignment (for Teacher)
     * @apiVersion 1.0.0
     * @apiName AssignmentClose
     * @apiDescription Close the assignment to prevent the student from taking the assignment
     * @apiGroup Assignments: Questionnaire
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the assingment ID
     * @apiSuccessExample {json} Sample Response
		{"success": true}
	*/ 
	public function closeAssignment(Request $request)
	{
		return $this->closeActivity($request, self::ASSIGNMENT, 'Assignment');
	}

	/**
     * Periodicals
     *
     * @api {post} <HOST>/periodical/complete/:id Complete Periodical (for Student)
     * @apiVersion 1.0.0
     * @apiName PeriodicalComplete
     * @apiDescription Mark periodical as complete (student side)
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the quiz ID
     * @apiSuccessExample {json} Sample Response
		{"success": true}
	*/ 
	public function completePeriodical(Request $request)
	{
		return $this->completeActivity($request, self::PERIODICAL, 'Periodical');
	}

	/**
     * Periodicals
     *
     * @api {post} <HOST>/quiz/close/:id Close Periodical (for Teacher)
     * @apiVersion 1.0.0
     * @apiName PeriodicalClose
     * @apiDescription Close the periodical to prevent the student from taking the periodical
     * @apiGroup Periodicals
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id the periodical ID
     * @apiSuccessExample {json} Sample Response
		{"success": true}
	*/ 
	public function closePeriodical(Request $request)
	{
		return $this->closeActivity($request, self::PERIODICAL, 'Periodical');
	}

	public function closeActivity(Request $request, int $activity_type, string $activity_name = 'Activity')
	{
		$user = Auth::user();
		$activity = StudentActivity::whereId($request->id)->whereActivityType($activity_type);
		if($user->user_type != 'a') {
			$activity->whereCreatedBy($user->getKey());
		}

		$activity = $activity->first();
		if(!$activity) {
			return response("Unable to close $activity_name. Please contact your administrator", 403);
		}
		$success = false;
		$activity->availability_status = 0;
		if($activity->save()) {
			$success = true;
		}
		return response()->json(['success' => $success]);
	}

	private function completeActivity(Request $request, int $activity_type, string $activity_name = 'Activity')
	{
		$user = Auth::user();
		$activity = StudentActivity::whereId($request->id)->whereActivityType($activity_type)->first();
		if(!$activity) {
			return response("$activity_name not found", 404);
		}

		$success = false;
		$activitySubmit = StudentActivitySubmission::whereActivityId($request->id)
						  ->whereUserId($user->getKey())->first();

		if(!$activitySubmit) {
			$activitySubmit = new StudentActivitySubmission();
		}

		$activitySubmit->user_id = $user->getKey();
		$activitySubmit->activity_id = $request->id;
		$activitySubmit->status = 1;

		if($activitySubmit->save()) {
			$success = true;
		}
		return response()->json(['success' => $success]);
	}

	/**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}


