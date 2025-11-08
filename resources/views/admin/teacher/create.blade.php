@extends('layouts.admin')

@section('title', 'إضافة استاذ جديد')
@section('main_title_content', 'إضافة استاذ جديد')
@section('title_content', 'إضافة')
@section('link_content')
    <a href="{{ route('teachers') }}">جميع الاساتذه</a>
@endsection

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">إضافة استاذ جديد</h5>
            <a href="{{ route('teachers') }}" class="btn btn-secondary btn-sm">رجوع</a>
        </div>

        <div class="card-body">
            <form action="{{ route('teachers.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" name="name" class="form-control" placeholder="ادخل اسم الاستاذ"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control" placeholder="ادخل رقم الهاتف"
                            value="{{ old('phone') }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" placeholder="البريد الالكتروني"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">الماده العلميه</label>
                        <input type="text" name="academic_stage" class="form-control" placeholder="الماده العلميه"
                            value="{{ old('academic_stage') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">كلمة المرور</label>
                    <input type="password" name="password" class="form-control" placeholder="ادخل كلمة المرور" required>
                </div>

                <button type="submit" class="btn btn-success px-4">إضافة الطالب</button>
            </form>
        </div>
    </div>
@endsection
