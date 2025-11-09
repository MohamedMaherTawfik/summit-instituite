<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialInstallments extends Model
{
    protected $table = 'financial_installments';
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
