@extends('layouts.admin')

@section('title', 'جميع الطلاب')
@section('main_title_content', 'جميع الطلاب')
@section('title_content', 'عرض')
@section('link_content')
    <a href="{{ route('students') }}">جميع الطلاب</a>
@endsection

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
            <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                + إضافة طالب جديد
            </a>

            <!-- 🔽 فلاتر -->
            <div class="row g-2 align-items-center">
                <!-- فلتر الاسم -->
                <div class="col-md-4 col-sm-12">
                    <input type="text" id="nameFilter" class="form-control form-control-sm" placeholder="ابحث بالاسم...">
                </div>

                <!-- فلتر السنة الدراسية -->
                <div class="col-md-4 col-sm-6">
                    <select id="yearFilter" class="form-select form-select-sm">
                        <option value="">كل السنوات الدراسية</option>
                        @foreach ($academicYears as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- فلتر الشعبة -->
                <div class="col-md-4 col-sm-6">
                    <select id="classFilter" class="form-select form-select-sm">
                        <option value="">كل الشعب</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->name }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="card-body">
            @if ($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle" id="studentsTable">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>الصف الدراسي</th>
                                <th>الشعبة</th>
                                @if (Auth::user()->role == 'manager')
                                    <th>كلمة المرور</th>
                                @endif
                                <th>رقم الهاتف</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $index => $student)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $student->name }}</td>
                                    <td class="text-center">{{ $student->email }}</td>
                                    <td class="text-center">{{ $student->academic_year ?? '-' }}</td>
                                    <td class="text-center">{{ $student->classes->name ?? '-' }}</td>
                                    @if (Auth::user()->role == 'manager')
                                        <td class="text-center text-muted">{{ $student->password_seen ?? 'غير متاح' }}</td>
                                    @endif
                                    <td class="text-center">{{ $student->phone ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('students.attendances', $student->id) }}"
                                            class="btn btn-sm btn-info text-white">جدول الحضور</a>
                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class="btn btn-sm btn-warning text-white">تعديل</a>

                                        <form action="{{ route('students.delete', $student->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطالب؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                        </form>

                                        <a href="{{ route('students.addParent', $student->id) }}"
                                            class="btn btn-sm btn-success">اضافه ولي امر</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted my-3">لا يوجد طلاب بعد.</p>
            @endif
        </div>
    </div>

    <!-- 🧠 JavaScript Live Filters -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const nameFilter = document.getElementById("nameFilter");
            const yearFilter = document.getElementById("yearFilter");
            const classFilter = document.getElementById("classFilter");
            const rows = document.querySelectorAll("#studentsTable tbody tr");

            function filterTable() {
                const nameValue = nameFilter.value.toLowerCase();
                const yearValue = yearFilter.value.toLowerCase();
                const classValue = classFilter.value.toLowerCase();

                rows.forEach(row => {
                    const nameText = row.cells[1].textContent.toLowerCase();
                    const yearText = row.cells[3].textContent.toLowerCase();
                    const classText = row.cells[4].textContent.toLowerCase();

                    const nameMatch = !nameValue || nameText.includes(nameValue);
                    const yearMatch = !yearValue || yearText.includes(yearValue);
                    const classMatch = !classValue || classText.includes(classValue);

                    row.style.display = (nameMatch && yearMatch && classMatch) ? "" : "none";
                });
            }

            nameFilter.addEventListener("keyup", filterTable);
            yearFilter.addEventListener("change", filterTable);
            classFilter.addEventListener("change", filterTable);
        });
    </script>
@endsection
