<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
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
     * @apiParam {String} password Hashed password (WIP)
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

    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'access_token' => $token,
                'token_type'   => 'Bearer',
                'expires_in'   => auth()->factory()->getTTL() * 60
            ]
        );
    }
}
