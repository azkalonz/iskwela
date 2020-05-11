<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Auth;
use Firebase\JWT\JWT;
use App\Exceptions\InvalidJWTException;
use App\Models\User;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = $request->header('Authorization');

        if (!$auth) {
            throw new InvalidJWTException("No JWT provided");
        }
        if (strpos($auth, 'Bearer ') === false) {
            throw new InvalidJWTException("The Authorization header had no Bearer value");
        }
        list($nothing, $token) = explode('Bearer ', $auth);

        if (empty($token)) {
            throw new InvalidJWTException(sprintf("There was no value for the Bearer token [found: %s]", $auth));
        }

        try {
            $payload = Auth::parseToken()->getPayload();
            if ($payload->get('exp') < time()) {
                throw new InvalidJWTException("Token has expired");
            }

            if ($payload->get('sub') != env('JWT_SUB')) {
                throw new InvalidJWTException("Invalid token signature");
            }
            // login the user
            Auth::login(User::find($payload->get('key')));
        } catch (\UnexpectedValueException $e) {
            throw new InvalidJWTException(get_class($e).': '.$e->getMessage());
        } catch (\DomainException $e) {
            throw new InvalidJWTException(get_class($e).': '.$e->getMessage());
        }

        return $next($request);
    }
}
