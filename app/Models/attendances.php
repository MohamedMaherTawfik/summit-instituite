<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class attendances extends Model
{
    protected $table = 'attendances';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}