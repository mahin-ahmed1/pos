<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;





class JWTToken{

    public static function createToken($email){

        $key = env('JWT_KEY');

        $payload = [
            'iss'=>'pos',
            'iat'=>time(),
            'exp'=>time()+60*60,
            'email'=>$email
        ];

        return JWT::encode($payload,$key,'HS256');
    }

    public static function verifyToken($token){

        $key = env('JWT_KEY');

       try{
        $decode = JWT::decode($token,new Key($key,'HS256'));

        return $decode;
       }
       catch(Exception $e){
        return response()->json([
            'status'=>'unauthorized'
            ]);
       }
    }
}
