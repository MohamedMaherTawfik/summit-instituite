<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\attendances;
use App\Models\User;
use Illuminate\Http\Request;

class attendanceController extends Controller
{
    public function index()
    {
        $attendance = attendances::where('teacher_id', auth()->user()->id)->get();
        $students = User::where('role', 'student')->get();
        return view('admin.attendance.index', compact('attendance', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'date' => 'required|string|max:255',
        ]);
        $data = $request->except('_token');
        attendances::create([
            'student_id' => $data['user_id'],
            'status' => $data['status'],
            'date' => $data['date'],
            'teacher_id' => auth()->user()->id
        ]);
        return redirect()->route('attendances')->with('success', 'تم انشاء الحضور بنجاح');
    }

    public function update(Request $request, attendances $attendance)
    {
        $data = $request->except('_token');
        $attendance->update($data);
        return redirect()->back()->with('success', 'تم تعديل الحضور بنجاح');
    }
    public function delete(attendances $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances')->with('success', 'تم حذف الحضور بنجاح');
    }
}