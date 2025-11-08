<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class teacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teacher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'academic_stage' => 'nullable|string|max:255',
        ]);
        $data = $request->except('_token');
        $data['role'] = 'teacher';
        $data['password_seen'] = $data['password'];
        $data['password'] = bcrypt($data['password']);
        User::create([
            'name' => $data['name'] ?? '-',
            'phone' => $data['phone'] ?? '-',
            'email' => $data['email'] ?? '-',
            'academic_year' => $data['academic_stage'] ?? '-',
            'password' => $data['password'] ?? '-',
            'role' => $data['role'] ?? '-',
            'password_seen' => $data['password_seen'] ?? '-',
        ]);
        return redirect()->route('teachers')->with('success', 'تم  انشاء المعلم بنجاح');
    }

    public function edit(User $teacher)
    {
        return view('admin.teacher.edit', compact('teacher'));
    }
    public function update(Request $request, User $teacher)
    {
        $data = $request->except('_token');
        $teacher->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'academic_year' => $data['academic_stage']
        ]);
        return redirect()->route('teachers')->with('success', 'تم تعديل بيانات المعلم بنجاح');
    }

    public function delete(User $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers')->with('success', 'تم حذف المعلم بنجاح');
    }
}