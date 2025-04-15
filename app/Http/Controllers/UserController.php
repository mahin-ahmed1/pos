<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;

class UserController  extends Controller
{

    public function user_registration(Request $req){

        $name = $req->input('name');
        $email = $req->input('email');
        $password = $req->input('password');

        try{
            User::create([
                'name'=>$name,
                'email'=>$email,
                'password'=>$password
            ]);

            return response()->json([
                'status'=>"user created",
                "message"=>"user created successfully"
            ],200);
        }
        catch(Exception $e){

            return response()->json([
                'status'=>"failed",
                'message'=>$e->getMessage()
            ]);
        }

    }


    public function userLogin(Request $req){

        $email = $req->input('email');
        $password = $req->input('password');

        $count = User::where('email',$email)->where('password',$password)->count();

        if($count){

            $token = JWTToken::createToken($email);

            return response()->json([
            'status'=>'success',
            'token'=>$token
            ]);
        }else{

            return 'username or password did not match';
        }

    }
}
