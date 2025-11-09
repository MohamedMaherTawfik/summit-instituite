<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    protected $table = 'courses';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}