<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
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
}
