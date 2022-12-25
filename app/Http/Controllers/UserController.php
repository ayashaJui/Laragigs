<?php

namespace App\Http\Controllers;

// use auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {
        return view('users/register');

    }

    public function store(Request $request){
        $formFiels = $request->validate([
            "name" => "required",
            "email" => ["required", Rule::unique('users', 'email')],
            "password" => "required|confirmed|min:3",
        ]);

        $formFiels['password'] = bcrypt($formFiels['password']);

        $user = User::create($formFiels);

        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in successfully');
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out successfully');
    }

    public function login(){
        return view('users/login');
    }

    public function authenticate(Request $request){
        $formFiels = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        if(auth()->attempt($formFiels)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You have been logged in successfully!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

}
