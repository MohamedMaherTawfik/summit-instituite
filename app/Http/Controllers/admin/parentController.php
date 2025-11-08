<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Studentparent;
use App\Models\User;
use Illuminate\Http\Request;

class parentController extends Controller
{

    public function index()
    {
        $students = User::where('role', 'parent')->get();
        return view('admin.parent.index', compact('students'));
    }
    public function addParent(User $student)
    {
        return view('admin.parent.addParent', compact('student'));
    }

    public function storeParent(Request $request, User $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        $data = $request->except('_token');
        $data['role'] = 'parent';
        $data['password_seen'] = $data['password'];
        $data['password'] = bcrypt($data['password']);
        $user = User::create([
            'name' => $data['name'] ?? '-',
            'phone' => $data['phone'] ?? '-',
            'email' => $data['email'] ?? '-',
            'password' => $data['password'] ?? '-',
            'password_seen' => $data['password_seen'] ?? '-',
            'role' => $data['role'] ?? '-',
        ]);
        Studentparent::create([
            'user_id' => $student->id,
            'me_id' => $user->id
        ]);
        return redirect()->route('parents')->with('success', 'تم  انشاء الوالد بنجاح');
    }

    public function edit(User $parent)
    {
        return view('admin.parent.edit', compact('parent'));
    }

    public function update(Request $request, User $parent)
    {
        $data = $request->except('_token');
        $parent->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email']
        ]);
        return redirect()->route('parents')->with('success', 'تم تعديل بيانات الوالد بنجاح');
    }

    public function delete(User $parent)
    {
        $parent->delete();
        return redirect()->route('parents')->with('success', 'تم حذف الوالد بنجاح');
    }
}