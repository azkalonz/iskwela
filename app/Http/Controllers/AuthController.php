<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use ResetsPasswords;

    public function register(Request $request)
    {
        $user = User::create(
            [
            'username'    => $request->username,
            'password'      => $request->password,
            'name'      => $request->name
            ]
        );

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * User Login
     *
     * @api {post} HOST/api/login User login
     * @apiVersion 1.0.0
     * @apiName login
     * @apiDescription Generates token for user
     * @apiGroup Auth
     *
     * @apiParam {String} username Username/student ID
     * @apiParam {String} password password entered by user.
     *
     * @apiSuccess {String} access_token The auth token
     * @apiSuccess {String=Bearer} token_type Defined class name
     * @apiSuccess {Number} expires_in Token lifespan
     * 
     * 
     * @apiSuccessExample {json} Sample Response
       {
           "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90YWxpbmEubG9jYWw6ODA4MFwvYXBpXC9sb2dpbiIsImlhdCI6MTU4OTE5OTE4NSwiZXhwIjoxNTg5MjAyNzg1LCJuYmYiOjE1ODkxOTkxODUsImp0aSI6ImN2TVhWakdhNjRTT0x3NmkiLCJzdWIiOiJKREpWSkdELTdhbjZlbDUiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3Iiwia2V5Ijo4fQ.V_9sTyiSHk5VuaIm6uy3cGzigvqDRBoL4Ek7SjR49Vg",
           "token_type": "Bearer",
           "expires_in": 3600
       }
     *
     * 
     * 
     */
    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
    public function login()
    {
        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * User Change Password
     *
     * @api {post} HOST/api/changePassword User Change Password
     * @apiVersion 1.0.0
     * @apiName ChangePassword
     * @apiDescription Changes password for a given user ID. Returns HTTP error code 401 if supplied credentials is invalid
     * @apiGroup Auth
     *
     * @apiParam {String} username username/student ID
     * @apiParam {String} password new password 
     * @apiParam {String} current_password old password
     *
     * @apiSuccess {String} success returns true if change password is successful
     * 
     * 
     * @apiSuccessExample {json} Sample Response
       {
            "success": true
        }
     *
     * 
     * 
     */
    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
    public function changePassword(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'current_password' => 'required',
            'password' => 'required'
        ]);

        $user = User::whereUsername($request->username);
        $user = $user->first();
        
        if (Hash::check($request->current_password, $user->password)) 
        {
            $user->password = $request->password;
            $user->save();

            return response()->json(['success' => true]);
        }
        else
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'expires_in'   => auth()->factory()->getTTL()
            ]
        );
    }
}
