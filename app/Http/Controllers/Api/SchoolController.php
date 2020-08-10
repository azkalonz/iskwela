<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Models\User;

use App\Transformers\UserTransformer;

class SchoolController extends Controller
{

	/**
     * School Admin
     *
     * @api {get} HOST/api/schooladmin/teachers School Teachers
     * @apiVersion 1.0.0
     * @apiName SchoolTeachers
     * @apiDescription Get List of school teachers
     * @apiGroup School Admin
     *
     * @apiUse JWTHeader
     *
     * @apiSuccess {Number} id teacher's ID
     * @apiSuccess {String} first_name
     * @apiSuccess {String} last_name
     * @apiSuccess {String} user_type
     * @apiSuccess {String} username
     * @apiSuccess {String} email
     * @apiSuccess {Number} phone_number
     * @apiSuccess {Number} status
     * @apiSuccess {Object} preferences
     * @apiSuccess {String} preferences.profile_picture
     * @apiSuccess {Number} preferences.push_notifications
     * @apiSuccess {Number} preferences.email_subscription
     * @apiSuccessExample {json} Sample Response
		[
			{
				"id": 8,
				"first_name": "teacher tom",
				"last_name": "cruz",
				"school_id": 1,
				"user_type": "t",
				"username": "ttom",
				"email": "xxx@gamil.com",
				"phone_number": 111,
				"status": 1,
				"preferences": {
					"profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg",
					"push_notification": 1,
					"email_subscription": 0
				}
			},
			{}
		]
    */
	public function teachers(Request $request)
	{
		$user = \Auth::user();

		if(!in_array($user->user_type, ['a','su'])) {
			return response('Unauthorized access', 403);
		}
		$teachers = User::whereUserType('t')
				->whereSchoolId($user->school_id)
				->whereStatus(1)
				->get();

		$fractal = fractal()->collection($teachers, new UserTransformer);

		return response()->json($fractal->toArray());
	}

	/**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
