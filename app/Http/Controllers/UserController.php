<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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


    public function sendOtp(Request $req){

       $email =  $req->input('email');

        $count = User::where('email',$email)->count();

        $otp = rand(1000,9999);

        if($count){

            try{

                // send mail
                Mail::to($email)->send(new OTPMail($otp));

                User::where('email',$email)->update(['otp'=>$otp]);

                return response()->json([
                    'status'=>"success",
                    'message'=>"otp send successfully"
                ],200);

            }catch(Exception $e){

                return response()->json([
                    'status'=>"failed",
                    'message'=>$e->getMessage()
                ],401);
            }
        }else{
            return "Email Doesn't Exist";
        }
    }
}

