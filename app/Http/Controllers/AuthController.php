<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->input('remember'))) {
            $successMessage = 'Successfully logged in!';
            session()->flash('success', $successMessage);
            return redirect()->route('dashboard')->with('success', $successMessage);
        } else {
            $errorMessage = 'Invalid Credentials';
            session()->flash('error', $errorMessage);
            return back()->with('error', $errorMessage);
        }
    }

    public function  showEmailLoginForm()
    {
        return view('EmailLogin');
    }

    public function loginEmail(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials, $request->input('remember'))) {
            $successMessage = 'Successfully logged in!';
            session()->flash('success', $successMessage);
            return redirect()->route('dashboard')->with('success', $successMessage);
        } else {
            $errorMessage = 'Invalid Credentials';
            session()->flash('error', $errorMessage);
            return back()->with('error', $errorMessage);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $successMessage = 'Logged out successfully!';
        session()->flash('success', $successMessage);
        return redirect()->route('login')->with('success', $successMessage);
    }
}
