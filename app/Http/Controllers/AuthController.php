<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\Verifytoken;
use App\Mail\WelcomeMail;
use App\Mail\ForgotMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function Register(Request $request){
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'location_id'=>$request->location_id 
        ]);
        $validToken= rand(10,100..'2022');
        $get_token= new Verifytoken();
        $get_token->token= $validToken;
        $get_token->email=$request->email;
        $get_token->save();
        $get_user_eamil=$request->email;
        $get_user_name=$request->name;
        Mail::to($request->email)->send(new WelcomeMail($get_user_eamil,$validToken, $get_user_name));
        return $user;


    }

    public function verify(Request $request){
        $get_token=$request->token;
        $get_token=Verifytoken::where('token',$get_token)->first();
        if(Carbon::now()->diffInMinutes($get_token->created_at)>=1){
            $getting_token=Verifytoken::where('token',$get_token->token)->first();
            $getting_token->delete();
            return "Code da het han";
        }else{
            $get_token->is_activated=1;
            $get_token->save();
            $user=User::where('email',$get_token->email)->first();
            $user->is_activated=1;
            $user->save();
            $getting_token=Verifytoken::where('token',$get_token->token)->first();
            $getting_token->delete();
            return 'verify successfull';
        }
    }

    public function loginUser(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return Response(['message' => $validator->errors()],401);
        }
        $active=User::where('email',$request->email)->first();
        if( $active->is_activated===1){
            if(Auth::attempt($request->all())){
                $user = Auth::user(); 
                $success =  $user->createToken('MyApp')->plainTextToken; 
                return Response(['token' => $success],200);
            }else{
                return Response(['message' => 'email or password wrong'],401);
            }
        }else{
            return Response(['message' => 'Account not Verify'],401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function userDetails(): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            return Response(['data' => $user],200);
        }
        return Response(['data' => 'Unauthorized'],401);
    }

    /**
     * Display the specified resource.
     */
    public function logout(): Response
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return Response(['data' => 'User Logout successfully.'],200);
    }

    public function get_code(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user){
            $active=verifytoken::where('email',$request->email)->first();
            if($active){
                return"Da gui code";
            }else{
                $validToken= rand(10,100..'2022');
                $get_token= new Verifytoken();
                $get_token->token= $validToken;
                $get_token->email=$request->email;
                $get_token->save();
                $get_user_eamil=$request->email;
                $get_user_name=$user->name;
                Mail::to($request->email)->send(new WelcomeMail($get_user_eamil,$validToken, $get_user_name));
                return "Da gui code qua mail";
            }
        }
    }
    
    public function forgot(Request $request){
        $user=User::where('email',$request->email)->first();
        $user->password=Hash::make(12345678);
        $user->save();
        $pass=12345678;
        $get_user_eamil=$request->email;
        $get_user_name=$user->name;
        Mail::to($request->email)->send(new ForgotMail($get_user_eamil, $get_user_name,$pass));
        return "Reset password thanh cong";
    }


}
