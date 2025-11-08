<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studentparent extends Model
{
    protected $table = 'studentparents';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function me()
    {
        return $this->belongsTo(User::class, 'me_id');
    }
}