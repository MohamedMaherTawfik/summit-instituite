@extends('layouts.admin')

@section('title', 'تعديل عمليه دفع')
@section('main_title_content', 'تعديل عمليه دفع')


@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">تعديل عمليه دفع رقم {{ $financial->payment_number }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('financials.update', $financial->id) }}" method="POST">
                @csrf

                <!-- الصف الأول -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">اسم العميل</label>
                        <input type="text" class="form-control" value="{{ $financial->student->name ?? '' }}" readonly>
                        <input type="hidden" name="student_id" value="{{ $financial->student_id }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">رقم الدفع</label>
                        <input type="text" name="payment_number" class="form-control"
                            value="{{ $financial->payment_number }}" readonly>
                    </div>
                </div>

                <!-- الصف الثاني -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">المبلغ المدفوع</label>
                        <input type="number" name="amount" class="form-control" value="{{ $financial->amount }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">المبلغ بالكامل</label>
                        <input type="number" name="full_amount" class="form-control" value="{{ $financial->full_amount }}"
                            required>
                    </div>
                </div>

                <!-- الصف الثالث -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الحالة</label>
                        <select name="status" class="form-select" required>
                            <option value="قسط" {{ $financial->status == 'قسط' ? 'selected' : '' }}>قسط</option>
                            <option value="مكتمل" {{ $financial->status == 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">تاريخ الدفع</label>
                        <input type="date" name="date" class="form-control" value="{{ $financial->date }}" required>
                    </div>
                </div>

                <!-- الأزرار -->
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success">تحديث</button>
                    <a href="{{ route('financials') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
@endsection
