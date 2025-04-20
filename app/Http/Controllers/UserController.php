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

    // USER REGISTRATION

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


    // USER LOGIN

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


    // OTP SEND

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

    /// VERIFY OTP

    public function VerifyOTP(Request $req){

        $email = $req->input('email');
        $otp = $req->input('otp');
        $count = User::where('email',$email)->where('otp',$otp)->count();

        //return $count;

        if($count == 1){

           try{
            $token = JWTToken::CreateOtpToken($email);
            User::where('email',$email)->update(['otp'=>'0']);

            return response()->json([
                'status'=>'OTP Verified',
                'message'=> 'OTP verification success',
                'token'=>$token
            ]);

           }catch(Exception $e){

            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ]);
           }

        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>"otp didn't match"
            ]);
        }
    }

    ///reset pass 

    public function resetPass(Request $req){

        $email = $req->header('email');
        $password = $req->input('password');

        User::where('email',$email)->update(['password'=>$password]);
        return response()->json([
                'status'=>'success',
                'message'=>"password updated"
            ]);
    }


    /// front end controller method

    public function login(Request $req){

        return view('pages.auth.loginpage');
    }

    public function signup(Request $req){

        return view('pages.auth.signup-page');
    }

    public function forget(Request $req){

        return view('pages.auth.forgetpass-page');
    }

    public function otpSubmit(Request $req){

        return view('pages.auth.otp-verify-page');
    }

    public function setPassword(Request $req){

        return view('pages.auth.reset-password-page');
    }
}

