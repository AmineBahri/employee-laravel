<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try 
        {
            $token = $request->header('token');
            $data = JWTAuth::setToken($token)->getPayload()->toArray();
        } 
        
        catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $e)
        {
            return response()->json(['Token_expired'], 500);
        }
        catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
        {
            return response()->json(['Token_invalid'], 500);
        }
        catch(\Tymon\JWTAuth\Exceptions\JWTException $e)
        {
            $response = [
              'message' => 'Token is required'
            ];
            return response()->json($response, 500);
        }
        return $next($request);
    }
}
