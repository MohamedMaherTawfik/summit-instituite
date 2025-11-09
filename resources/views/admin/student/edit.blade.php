@extends('layouts.admin')

@section('title', 'تعديل بيانات الطالب')
@section('main_title_content', 'تعديل بيانات الطالب')

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">تعديل بيانات الطالب</h5>
            <a href="{{ route('students') }}" class="btn btn-secondary btn-sm">رجوع</a>
        </div>

        <div class="card-body">

            <form action="{{ route('students.update', $student->id) }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" name="name" class="form-control" placeholder="ادخل اسم الطالب"
                            value="{{ old('name', $student->name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control" placeholder="ادخل رقم الهاتف"
                            value="{{ old('phone', $student->phone) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" placeholder="example@email.com"
                            value="{{ old('email', $student->email) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">المرحلة الدراسية</label>
                        <input type="text" name="academic_stage" class="form-control" placeholder="المرحله الدراسيه"
                            value="{{ old('academic_stage', $student->academic_year) }}" required>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="class_id" class="form-label">اختر الشعبة</label>
                        <select name="class_id" id="class_id" class="form-select" required>
                            <option value="" disabled selected>اختر الشعبة</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>




                <button type="submit" class="btn btn-primary px-4">حفظ التعديلات</button>
            </form>
        </div>
    </div>
@endsection
