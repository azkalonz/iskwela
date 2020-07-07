<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use \App\Models\User;
use \App\Transformers\UserTransformer;

class UserController extends Controller
{
    /**
     * User Detail
     *
     * @api {POST} HOST/api/class/user/ User Detail
     * @apiVersion 1.0.0
     * @apiName UserDetail
     * @apiDescription Get user details
     * @apiGroup User
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of user. current user's ID if not supplied
	 *
     * @apiSuccess {Number} id ID of user
	 * @apiSuccess {String} first_name of the user
	 * @apiSuccess {String} last_name of the user
	 * @apiSuccess {Number} school_id school ID of the user
	 * @apiSuccess {String} user_type S - Student; T - Teacher
	 * @apiSuccess {String} username Username of the user
	 * @apiSuccess {String} email email address of user
	 * @apiSuccess {Number} phone_number phone number of user
	 * @apiSuccess {Number} status 1 - active; 0 - inactive
	 * @apiSuccess {Object} preference user preferences
	 * @apiSuccess {String} preference.profile_picture URL of profile_picture
	 * @apiSuccess {Number} preference.push_notification 1 - enabled; 0 disabled
	 * @apiSuccess {Number} preference.email 1 - enabled; 0 disabled
     * @apiSuccessExample {json} Sample Response
        {
			"id": 9,
			"first_name": "teacher jayson",
			"last_name": "barino",
			"school_id": 1,
			"user_type": "t",
			"username": "tjayson",
			"email": "xxx@gamil.com",
			"phone_number": 111,
			"status": 1,
			"preferences": {
				"profile_picture": "https://iskwela.sgp1.digitaloceanspaces.com/SCHOOL01/public/NuAwve8r1j20KLNde6HjFQVhxGp4Q69p0KO38wIL.jpeg",
				"push_notification": 1,
				"email_subscription": 0
			}
		}
     *
     * 
     * 
     */
    public function show(Request $request)
    {
		$this->validate($request, [
            'id' => 'integer'
        ]);
		
		$user =  Auth::user();
		
		if($request->id)
		{
			$user = User::find($request->id);
		}
		
        $fractal = fractal()->item($user, new UserTransformer);

        return response()->json($fractal->toArray());
    }


    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
