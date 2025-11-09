<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\attendances;
use App\Models\classes;
use App\Models\User;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->get();
        $classes = Classes::all();
        $academicYears = $students->pluck('academic_year')->unique()->filter()->values();
        return view('admin.student.index', compact('students', 'classes', 'academicYears'));
    }


    public function create()
    {
        $classes = classes::all();
        return view('admin.student.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'academic_stage' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
            'class_id' => 'required',
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
            'classes_id' => $data['class_id'] ?? '-',
        ]);
        return redirect()->route('students')->with('success', 'تم  انشاء الطالب بنجاح');
    }

    public function edit(User $student)
    {
        $classes = classes::all();
        return view('admin.student.edit', compact('student', 'classes'));
    }


    public function update(Request $request, User $student)
    {
        $data = $request->except('_token');
        $student->update([
            'name' => $data['name'],
            'academic_year' => $data['academic_stage'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'classes_id' => $data['class_id'],
        ]);
        return redirect()->route('students')->with('success', 'تم تعديل بيانات الطالب بنجاح');
    }

    public function delete(User $student)
    {
        $student->delete();
        return redirect()->route('students')->with('success', 'تم حذف الطالب بنجاح');
    }

    public function attendances(User $student)
    {
        $attendances = attendances::where('student_id', $student->id)->get();
        return view('admin.student.attendances', compact('attendances'));
    }

    public function installments(User $student)
    {
        $financials = $student->financial;
        return view('admin.student.installments', compact('financials'));
    }
}
