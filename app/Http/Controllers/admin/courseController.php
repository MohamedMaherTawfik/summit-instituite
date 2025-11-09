<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\courses;
use Illuminate\Http\Request;

class courseController extends Controller
{
    public function index()
    {
        $courses = courses::all();
        return view('admin.course.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $data = $request->except('_token');
        $data['user_id'] = auth()->user()->id;
        courses::create($data);
        return redirect()->route('courses')->with('success', 'تم انشاء الدوره بنجاح');
    }

    public function update(Request $request, courses $course)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $data = $request->except('_token');
        $course->update($data);
        return redirect()->route('courses')->with('success', 'تم تعديل الدوره بنجاح');
    }

    public function delete(courses $course)
    {
        $course->delete();
        return redirect()->route('courses')->with('success', 'تم حذف الدوره بنجاح');
    }
}
