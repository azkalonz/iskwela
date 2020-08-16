<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use \App\Models\User;
use \App\Models\UserPreference;
use \App\Transformers\UserTransformer;

class UserController extends Controller
{

	const ADMIN = 'a';
    const PARENTS = 'p';
    const TEACHER = 't';
    const STUDENT = 's';
	const SUPER_USER = 'su';

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

    public function students(Request $request)
    {
        return $this->getUsers($request, self::STUDENT);
    }

    public function parents(Request $request)
    {
        return $this->getUsers($request, self::PARENTS);
    }

    public function getUsers(Request $request, $user_type)
    {
        $this->validate($request, [
            'school_id' => 'integer'
        ]);
        
        $user = Auth::user();

        if($user->user_type == self::SUPER_USER)
        {
            $school_id = $request->school_id ?? $user->school_id;
        }
        else{
            $school_id = $user->school_id;
        }

        $students = User::whereSchoolId($school_id)->whereUserType($user_type);

        $fractal = fractal()->collection($students->get(), new UserTransformer);
        
        if($user_type == self::PARENTS)
        {
            $fractal->includeChildren();
        }

        return response()->json($fractal->toArray());
    }
	

    public function registerParent(Request $request)
    {
        return $this->register($request, self::PARENTS);
    }
    
    public function registerAdmin(Request $request)
    {
        return $this->register($request, self::ADMIN);
    }

    public function registerStudent(Request $request)
    {
        return $this->register($request, self::STUDENT);
    }

    public function registerTeacher(Request $request)
    {
        return $this->register($request, self::TEACHER);
    }

    public function registerSuperAdmin(Request $request)
    {
        return $this->register($request, self::SUPER_USER);
    }

    private function register(Request $request, $user_type)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'school_id' => 'integer'
        ]);

        $admin = Auth::user();
		
        if ($admin->user_type == self::SUPER_USER)
        {
            $school_id = $request->school_id ?? $admin->school_id;
        }else if ($admin->user_type == self::ADMIN)
        {
            $school_id = $admin->school_id;
        }
        else{
            return response("Unauthorized", 401);
        }

        $user = User::create(
            [
            'username'    => $request->username,
            'password'      => $request->password,
            'first_name'      => $request->first_name,
            'middle_name'      => $request->middle_name,
            'last_name'      => $request->last_name,
            'gender'      => $request->gender ?? 'u',
            'email'      => $request->email,
            'phone_number'      => $request->phone_number,
			'school_id'      => $school_id,
			'change_password_required'      => 1,
			'user_type'      => $user_type,
            'created_by'      => $admin->id,
			'status'      => $request->status ?? 1
            ]
        );

        $user_preference = UserPreference::Create(
            [
                'user_id' => $user->id,
                'push_notifications' => $request->push_notification ?? 1,
                'email_subscription' => $request->email_subscription ?? 0
            ]
		);
		$user_response = User::find($user->id);
		//$token = auth()->login($user);
		$fractal = fractal()->item($user_response, new UserTransformer);

        return response()->json($fractal->toArray());
    }


    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
