<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = classes::all();
        return view('admin.classes.index', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $data = $request->except('_token');
        classes::create($data);
        return redirect()->route('classes')->with('success', 'تم انشاء الشعبه بنجاح');
    }

    public function update(Request $request, classes $class)
    {
        $data = $request->except('_token');
        $class->update($data);
        return redirect()->route('classes')->with('success', 'تم تعديل بيانات الشعبه بنجاح');
    }

    public function delete(classes $class)
    {
        $class->delete();
        return redirect()->route('classes')->with('success', 'تم حذف الشعبه بنجاح');
    }
}