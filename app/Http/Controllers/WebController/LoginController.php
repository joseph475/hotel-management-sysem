<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()){
            return redirect('/');
        }
        return view('pages.admin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|alphaNum|min:3'
        ]);

        $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
        );

        if (Auth::attempt($user_data)) {
            return redirect('/');
        } else {
            return redirect()->back()->with('success', 'your message here');
        }
    }

    // public function successlogin()
    // {
    //     return view('successlogin');
    // }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
