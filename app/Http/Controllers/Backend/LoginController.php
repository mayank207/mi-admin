<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {

    }
    /*For the backend(admin) login */
    public function login(Request $request)
    {
        if($request->method() == 'POST'){
            if($request->input('email')){
                $email = $request->input('email');
                $password = $request->input('password');
                $user = User::where('email',$email)->where('role_id',1)->where('is_delete','0')->first();
                if(!empty($user)){
                        if(Hash::check($password, $user->password)){
                            if($user->status == 1){
                                $user = User::where(['email'=>$email,'status'=>1])->first();
                                    if($user){
                                        //set data in session
                                        $request->session()->put('user_id', $user['id']);
                                        $request->session()->put('user_email', $user['email']);
                                        $request->session()->put('user_name', $user['name']);
                                        return redirect()->route('backend.home');

                                    }else{
                                        $request->session()->flash('errorLogin', 'Email or Password Incorrect.');
                                        return redirect()->route('backend.login');
                                    }
                            }
                            else if($user->status == 0){
                                $request->session()->flash('errorLogin', 'Your account has been inactivated. Please contact admin');
                                return redirect()->route('backend.login');
                            }else{
                                $request->session()->flash('errorLogin', 'Email or password incorrect.');
                                return redirect()->route('backend.login');
                            }
                    }else{
                        return redirect()->route('backend.login')->with('toast-error','Email or password incorrect.');
                    }
                }
                else{
                    return redirect()->route('backend.login')->with('toast-error','This email is not registered, please sign up with your email.');
                }
            }
        }else{
            return view('backend.login');
        }
    }
    /*Logout from backend */
    public function logout(Request $request){
        $request->session()->forget('user_id');
        $request->session()->forget('user_email');
        $request->session()->forget('user_name');
        return  redirect()->route('backend.login');
    }
}
