<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;


class JwtVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $headers =  explode(' ',$request->header('Authorization'));
        $bearer = isset($headers[0])? $headers[0]:false;
        $token = isset($headers[1])? $headers[1]:false;

        if (!$token || !$bearer){
            return response()->json(['status'=>0, 'msg'=>'Yetkisiz Erisim'],401);
        }

        try {
            $secretKey = getenv('TOKEN_SECRET_KEY');
            $decode = JWT::decode($token, new Key($secretKey, 'HS256'));
            return $next($request);

        }catch (ExpiredException $e){
            return response()->json(['status'=>0, 'msg'=>'ExpiredException Token Süresi Doldu'],401);
        }catch (Exception $e){
            return response()->json(['status'=>0, 'msg'=>'Exception Yetkisiz Erisim'],401);
        }
    }
}
//JWT::decode($token,$secretKey,array('HS256'))
