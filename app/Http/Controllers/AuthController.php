<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended()
                        ->with("Success", 'You have Successfully loggedin');
        }
  
        return back()->withErrors('Oppes! You have entered invalid credentials');
    }

    public function registration(Request $request)
    {
        $attributes = $request->validate([
            "name" => "required",
            'email' => ['required', "email", "unique:users"],
            'password' => 'required',
        ]);
   
        User::create($attributes);
  
        return redirect("/")->with("success", 'You Are Registered!');
    }

    public function destroy()
    {
        Auth::logout();
  
        return redirect()->route("login")->with("out", "sorry to ses you leaving!");
    }

}
