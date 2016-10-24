<?php

namespace App\Http\Middleware;

use App\User;
use App\Models as Md;
use Closure;
use App\Library\Token;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class ApiMiddleware extends BaseMiddleware
{
    use Token;

    public function handle($request, \Closure $next)
    {
        if (!$token = \JWTAuth::setRequest($request)->getToken()) {
            return $this->respond('tymon.jwt.absent', 'token_not_provided', 400);
        }

        try {
            $user = $this->validateUser();
        } catch (TokenExpiredException $e) {
            return $this->respond('tymon.jwt.expired', 'token_expired', $e->getStatusCode(), [$e]);
        } catch (JWTException $e) {
            return $this->respond('tymon.jwt.invalid', 'token_invalid', $e->getStatusCode(), [$e]);
        }

        if (!$user) {
            return $this->respond('tymon.jwt.user_not_found', 'user_not_found', 404);
        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }

    private function validateUser()
    {
        $user = $this->getAuthenticatedUser();

        $find = User::where([
            'id'     => $user['id']
        ])->first();

        return (empty($find)) ? false : true;
    }
}
