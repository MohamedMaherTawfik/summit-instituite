@extends('layouts.admin')

@section('title', 'تعديل بيانات الاستاذ')
@section('main_title_content', 'تعديل بيانات الاستاذ')

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">تعديل بيانات الاستاذ</h5>
            <a href="{{ route('teachers') }}" class="btn btn-secondary btn-sm">رجوع</a>
        </div>

        <div class="card-body">

            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" name="name" class="form-control" placeholder="ادخل اسم الاستاذ"
                            value="{{ old('name', $teacher->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control" placeholder="ادخل رقم الهاتف"
                            value="{{ old('phone', $teacher->phone) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" placeholder="example@email.com"
                            value="{{ old('email', $teacher->email) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">المرحلة الدراسية</label>
                        <input type="text" name="academic_stage" class="form-control" placeholder="المرحله الدراسيه"
                            value="{{ old('academic_stage', $teacher->academic_year) }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4">حفظ التعديلات</button>
            </form>
        </div>
    </div>
@endsection
