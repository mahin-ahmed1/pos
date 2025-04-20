<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // $token =
        $result = JWTToken::verifyToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJwb3MiLCJpYXQiOjE3NDQ4MTM0OTksImV4cCI6MTc0NDgxMzc5OSwiZW1haWwiOiJtYWhpbm1haG1lZDMyMUBnbWFpbC5jb20ifQ.D4PHON1_nwRUJ1i5FIEj5nn9ulFETw7z7IjQwyorIBA');
        if($result == 'unauthorized'){

            return response()->json([
                'status'=>'unauthorized',
                'message'=>'unauthorized request'
            ]);
        }else{

            $request->headers->set('email',$result);
            
           return $next($request);
        }
        
        

       
    }
}
