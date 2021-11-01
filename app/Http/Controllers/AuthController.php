<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function signup () {
        return view ('auth.pages.signup');
    }
    public function register(Request $request) {   
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        'username' => 'required|min:5|max:255|unique:users',
        'email' => 'required|email:dns|unique:users',
        'password' => 'required|min:8|max:10',
        'confirmPassword' =>'required|same:password'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['confirmPassword'] = $validatedData['password'];
        User::create($validatedData);
        return redirect('/auth/sign-in')->with('loginSuccess','Registration Successful');
    }

    public function signin() {
        return view ('auth.pages.signin');
    }
    
    public function authenticate(Request $request) {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginFailed','Email atau Password salah');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}