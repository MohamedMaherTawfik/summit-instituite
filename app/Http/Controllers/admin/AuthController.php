<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin()
    {
        return view('admin.auth.signin');
    }


    public function login(Request $request)
    {
        $data = $request->except('_token');
        Auth::attempt($data);
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login')->with('error', 'Invalid email or password');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('signin');
    }

}