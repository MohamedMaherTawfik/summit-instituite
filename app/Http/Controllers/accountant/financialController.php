<?php

namespace App\Http\Controllers\accountant;

use App\Http\Controllers\Controller;
use App\Models\FinancialInstallments;
use App\Models\User;
use Illuminate\Http\Request;

class financialController extends Controller
{
    public function index()
    {
        $financials = FinancialInstallments::all();
        return view('admin.financial.index', compact('financials'));
    }

    public function installments()
    {
        $financials = FinancialInstallments::where('status', 'قسط')->get();
        return view('admin.financial.index', compact('financials'));
    }
    public function create()
    {
        $users = User::all();
        $next_number = FinancialInstallments::count() + 1;
        return view('admin.financial.create', compact('users', 'next_number'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'amount' => 'required',
            'full_amount' => 'required',
            'date' => 'required',
            'status' => 'required',
            'payment_number' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        FinancialInstallments::create($data);
        return redirect()->route('financials')->with('success', 'تم انشاء عمليه الدفع بنجاح');
    }

    public function edit(FinancialInstallments $financial)
    {
        return view('admin.financial.edit', compact('financial'));
    }
    public function update(Request $request, FinancialInstallments $financial)
    {
        $request->validate([
            'student_id' => 'required',
            'amount' => 'required',
            'full_amount' => 'required',
            'date' => 'required',
            'status' => 'required',
            'payment_number' => 'required',
        ]);
        $data = $request->all();
        $financial->update($data);
        return redirect()->route('financials')->with('success', 'تم تعديل عمليه الدفع بنجاح');
    }

    public function delete(FinancialInstallments $financial)
    {
        $financial->delete();
        return redirect()->back()->with('success', 'تم حذف عمليه الدفع بنجاح');
    }
}
