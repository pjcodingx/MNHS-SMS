<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function showloginform(){

        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials)){
            return redirect()->intended('/admin/dashboard');
        }

        //? ADD SOON IF NAA NAY STUDENT SIDE I IMPLEMENT
        // if(Auth::guard('student')->attempt($credentials)){
        //     return redirect()->intended('/student/dashboard');
        // }

        if(Auth::guard('faculty')->attempt($credentials)){
            return redirect()->intended('/faculty/dashboard');
        }

        if(Auth::guard('registrar')->attempt($credentials)){
            return redirect()->intended('/registrar/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function logout(Request $request){
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }
        else if(Auth::guard('student')->check()){
            Auth::guard('student')->logout();
        }
        else if(Auth::guard('faculty')->check()){
            Auth::guard('faculty')->logout();
        }
        else if(Auth::guard('registrar')->check()){
            Auth::guard('registrar')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
