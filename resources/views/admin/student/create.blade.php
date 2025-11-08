@extends('layouts.admin')

@section('title', 'إضافة طالب جديد')
@section('main_title_content', 'إضافة طالب جديد')
@section('title_content', 'إضافة')
@section('link_content')
    <a href="{{ route('students') }}">جميع الطلاب</a>
@endsection

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">إضافة طالب جديد</h5>
            <a href="{{ route('students') }}" class="btn btn-secondary btn-sm">رجوع</a>
        </div>

        <div class="card-body">
            {{-- ✅ عرض الأخطاء --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ✅ عرض رسالة نجاح --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('students.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" name="name" class="form-control" placeholder="ادخل اسم الطالب"
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
                        <input type="email" name="email" class="form-control" placeholder="example@email.com"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">المرحلة الدراسية</label>
                        <input type="text" name="academic_stage" class="form-control" placeholder="المرحله الدراسيه"
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
