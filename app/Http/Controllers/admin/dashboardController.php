<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $users = User::get();
            $students = User::where('role', 'student')->get();
            $teachers = User::where('role', 'teacher')->get();
            $guides = User::where('role', 'guide')->get();
            return view('admin.index', compact('students', 'teachers', 'guides', 'users'));
        }
        return redirect()->route('signin')->with('error', 'يرجى تسجيل الدخول');

    }
}
