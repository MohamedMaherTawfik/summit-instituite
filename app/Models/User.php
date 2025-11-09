<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function classes()
    {
        return $this->belongsTo(classes::class);
    }

    public function attendances()
    {
        return $this->hasMany(attendances::class, 'student_id');
    }

    public function teachers()
    {
        return $this->hasMany(attendances::class, 'teacher_id');
    }

    public function financial()
    {
        return $this->hasMany(FinancialInstallments::class, 'student_id');
    }

    public function courses()
    {
        return $this->belongsToMany(courses::class);
    }

    public function notifications()
    {
        return $this->hasMany(notifications::class);
    }
}
