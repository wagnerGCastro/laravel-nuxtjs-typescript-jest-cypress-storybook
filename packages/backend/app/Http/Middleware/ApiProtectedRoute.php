<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class ApiProtectedRoute extends BaseMiddleware
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
        try {

            $user = JWTAuth::parseToken()->authenticate();

        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['code' => 401, 'message' => 'Token is Invalid 2'], 401 );
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                 return response()->json(['code' => 403, 'message' => 'Token is Expired'], 403 );
            }else{
                return response()->json(['code' => 401, 'message' => 'Authorization Token not found'], 401);
            }
        }

        return $next($request);
    }
}