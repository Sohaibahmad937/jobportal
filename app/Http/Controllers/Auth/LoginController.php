<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
     /*

|--------------------------------------------------------------------------
     | Login Controller

|--------------------------------------------------------------------------
     |
     | This controller handles authenticating users for the application
and
     | redirecting them to your home screen. The controller uses a trait
     | to conveniently provide its functionality to your applications.
     |
     */

     use AuthenticatesUsers;
     public function username(){
         return 'username';
     }

     /**
      * Where to redirect users after login.
      *
      * @var string
      */
     protected $redirectTo = 'admin/home';

     /**
      * Create a new controller instance.
      *
      * @return void
      */
     public function __construct()
     {
         $this->middleware('guest')->except('logout');
     }

     public function loginUser(Request $request)
     {
        if (Auth::attempt(['email' => $request->email, 'password' =>$request->password]))
        {
            $role = Auth::user()->role;
            if($role == 1 || $role == 2 || $role == 3){
               return redirect()->route('admin.home')->withSuccess('you are logged in.');
            }
            else{
               return redirect()->route('front.jobs');
            }
           return redirect('/home');
        }
        session()->flash('error','You are not allowed');
        return back()->with('error','you are not allowed.');
     }

     public function logout(Request $request)
     {
         Auth::guard('web')->logout();
         session()->flush();
         $request->session()->regenerate();
         return redirect()
             ->route('front.login')
             ->with('status','You\'re logged out!');
     }
}

