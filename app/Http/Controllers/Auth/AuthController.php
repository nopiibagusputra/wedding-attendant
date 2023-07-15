<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    function index(){
        return view('auth.login');
    }

    function login(Request $request){
        if(Auth::attempt($request->only('email', 'password'))){
            return redirect(Auth::user()->level.'/dashboard');
        }
        return redirect('/')->withErrors(['Username atau Sandi Salah']);
    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }
}
