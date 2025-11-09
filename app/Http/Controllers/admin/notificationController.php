<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\notifications;
use App\Models\Studentparent;
use App\Models\User;
use Illuminate\Http\Request;

class notificationController extends Controller
{
    public function index(User $student)
    {
        $parentid = Studentparent::where('user_id', $student->id)->first();
        $parent = User::find($parentid->me_id);
        $notifications = Notifications::whereIn('user_id', [$student->id, $parent->id])->get();
        return view('admin.notification.index', compact('notifications', 'student', 'parent'));
    }

    public function store(Request $request, User $student)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);
        $data = $request->except('_token');
        $data['user_id'] = $student->id;
        $data['teacher_id'] = auth()->user()->id;
        notifications::create($data);
        return redirect()->route('notifications', $student->id)->with('success', 'تم ارسال الاشعار بنجاح');
    }

    public function storeParent(Request $request, User $parent)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);
        $data = $request->except('_token');
        $data['user_id'] = $parent->id;
        $data['teacher_id'] = auth()->user()->id;
        notifications::create($data);
        return redirect()->back()->with('success', 'تم ارسال الاشعار بنجاح');
    }

    public function update(Request $request, notifications $notification)
    {
        $data = $request->except('_token');
        $notification->update($data);
        return redirect()->back()->with('success', 'تم تعديل الاشعار بنجاح');
    }

    public function delete(notifications $notification)
    {
        $notification->delete();
        return redirect()->back()->with('success', 'تم حذف الاشعار بنجاح');
    }

}
