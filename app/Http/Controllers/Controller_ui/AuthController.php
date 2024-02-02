<?php

namespace App\Http\Controllers\Controller_ui;


use App\Http\Requests\EmailRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Verifytoken;
use App\Mail\WelcomeMail;
use App\Mail\ForgotMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Response;
use App\Models\Location;

class AuthController extends Controller
{
    
    public function login()
    {
        return view('admin.login');
    }
    public function register()
    {
        $data = Location::all();
        return view('admin.register', compact('data'));
    }
    public function verify()
    {

        return view('admin.verify');
    }
    public function code()
    {

        return view('admin.sendcode');
    }
    public function forgot()
    {

        return view('admin.forgot');
    }
    public function Registers(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'location_id' => $request->location_id
        ]);
        $validToken = rand(10, 100. . '2022');
        $get_token = new Verifytoken();
        $get_token->token = $validToken;
        $get_token->email = $request->email;
        $get_token->save();
        $get_user_eamil = $request->email;
        $get_user_name = $request->name;
        Mail::to($request->email)->send(new WelcomeMail($get_user_eamil, $validToken, $get_user_name));
        return redirect('login');


    }

    public function verifies(VerifyRequest $request)
    {

        $get_token = $request->code;
        $get_token = Verifytoken::where('token', $get_token)->first();
        if (Carbon::now()->diffInMinutes($get_token->created_at) >= 5) {
            $getting_token = Verifytoken::where('token', $get_token->token)->first();
            $getting_token->delete();
            return redirect('verify')->with('status', 'code het han');
        } else {
            $get_token->is_activated = 1;
            $get_token->save();
            $user = User::where('email', $get_token->email)->first();
            $user->is_activated = 1;
            $user->save();
            $getting_token = Verifytoken::where('token', $get_token->token)->first();
            $getting_token->delete();
            return redirect('login');
        }
    }

    public function loginUser(LoginRequest $request)
    {
        $active = User::where('email', $request->email)->first();
        if ($active->is_activated === 1) {
            if ($request->password == 12345678) {
                $id=$active->id;
                return view('admin.change_pass',compact('id'));
            }else{
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $user = Auth::user();
                    return redirect('/dashboard');
                } else {
                    return redirect('/login')->with('status', 'email hoac mat khau khong chinh xac');
                }
            }
        } else {
            return redirect('/login')->with('status', 'chua xac thuc');
        }


    }

    /**
     * Display the specified resource.
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function get_code(EmailRequest $request)
    {

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $active = verifytoken::where('email', $request->email)->first();
            if ($active) {
                return redirect('/verify')->with('status', 'Code da gui vui long kiem tra mail');
            } else {
                $validToken = rand(10, 100. . '2022');
                $get_token = new Verifytoken();
                $get_token->token = $validToken;
                $get_token->email = $request->email;
                $get_token->save();
                $get_user_eamil = $request->email;
                $get_user_name = $user->name;
                Mail::to($request->email)->send(new WelcomeMail($get_user_eamil, $validToken, $get_user_name));
                return redirect('/verify')->with('status', 'Code da duoc gui qua mail');
            }
        }
    }

    public function forgot_password(EmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make(12345678);
        $user->save();
        $pass = 12345678;
        $get_user_eamil = $request->email;
        $get_user_name = $user->name;
        Mail::to($request->email)->send(new ForgotMail($get_user_eamil, $get_user_name, $pass));
        return redirect('/login')->with('status1', 'Password da duoc reset va gui ve mail');
    }
}
