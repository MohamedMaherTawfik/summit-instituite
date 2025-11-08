<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.student.index', compact('students'));
    }

    public function create()
    {
        return view('admin.student.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'academic_stage' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        $data = $request->except('_token');
        $data['role'] = 'student';
        $data['password_seen'] = $data['password'];
        $data['password'] = bcrypt($data['password']);
        User::create([
            'name' => $data['name'] ?? '-',
            'phone' => $data['phone'] ?? '-',
            'email' => $data['email'] ?? '-',
            'password' => $data['password'] ?? '-',
            'role' => $data['role'] ?? '-',
            'password_seen' => $data['password_seen'] ?? '-',
            'academic_year' => $data['academic_stage'] ?? '-',
        ]);
        return redirect()->route('students')->with('success', 'تم  انشاء الطالب بنجاح');
    }

    public function show(User $student)
    {
        return view('admin.student.show', compact('student'));
    }


    public function edit(User $student)
    {
        return view('admin.student.edit', compact('student'));
    }


    public function update(Request $request, User $student)
    {
        $data = $request->except('_token');
        $student->update([
            'name' => $data['name'],
            'academic_year' => $data['academic_stage'],
            'phone' => $data['phone'],
            'email' => $data['email']
        ]);
        return redirect()->route('students')->with('success', 'تم تعديل بيانات الطالب بنجاح');
    }

    public function delete(User $student)
    {
        $student->delete();
        return redirect()->route('students')->with('success', 'تم حذف الطالب بنجاح');
    }
}