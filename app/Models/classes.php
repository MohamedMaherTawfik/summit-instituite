<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    protected $table = 'classes';
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
