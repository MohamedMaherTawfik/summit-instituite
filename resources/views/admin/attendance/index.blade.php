@extends('layouts.admin')

@section('title', 'كل الحضور في المعهد')
@section('main_title_content', 'كل الحضور في المعهد')

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <!-- زر فتح مودال الإضافة -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addClassModal">
                + إضافة حضور جديد
            </button>
        </div>

        <div class="card-body">
            @if ($attendance->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>الاسم</th>
                                <th>حاله الحضور</th>
                                <th>التاريخ</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance as $index => $class)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $class->student->name }}</td>
                                    <td class="text-center">{{ $class->status }}</td>
                                    <td class="text-center">{{ $class->date }}</td>
                                    <td class="text-center">

                                        <!-- زر تعديل -->
                                        <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal"
                                            data-bs-target="#editAttendanceModal-{{ $class->id }}">
                                            تعديل
                                        </button>

                                        <!-- فورم الحذف -->
                                        <form action="{{ route('attendances.delete', $class->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الحضور؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- مودال تعديل -->
                                <div class="modal fade" id="editAttendanceModal-{{ $class->id }}" tabindex="-1"
                                    aria-labelledby="editAttendanceModalLabel-{{ $class->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title" id="editAttendanceModalLabel-{{ $class->id }}">
                                                    تعديل حضور الطالب
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <form action="{{ route('attendances.update', $class->id) }}" method="POST">
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">اسم الطالب</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $class->student->name }}" readonly>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">تاريخ الحضور</label>
                                                        <input type="date" name="date" class="form-control"
                                                            value="{{ $class->date }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">حالة الحضور</label>
                                                        <select name="status" class="form-select" required>
                                                            <option value="حاضر"
                                                                {{ $class->status == 'حاضر' ? 'selected' : '' }}>حاضر
                                                            </option>
                                                            <option value="غائب"
                                                                {{ $class->status == 'غائب' ? 'selected' : '' }}>غائب
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-warning text-white">تحديث</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- نهاية مودال التعديل -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted my-3">لا توجد بيانات حضور بعد.</p>
            @endif
        </div>
    </div>

    <!-- مودال الإضافة -->
    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addClassModalLabel">إضافة حضور جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('attendances.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 position-relative">
                            <label class="form-label">اسم الطالب</label>
                            <input type="text" id="student_name" class="form-control" placeholder="اكتب اسم الطالب"
                                autocomplete="off" required>
                            <input type="hidden" name="user_id" id="student_id">
                            <div id="student_suggestions" class="list-group position-absolute w-100"
                                style="z-index: 1000; max-height: 200px; overflow-y: auto; display: none;"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">تاريخ الحضور</label>
                            <input type="date" name="date" class="form-control" required
                                value="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">حالة الحضور</label>
                            <select name="status" class="form-select" required>
                                <option value="حاضر">حاضر</option>
                                <option value="غائب">غائب</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const students = @json($students);
            const input = document.getElementById('student_name');
            const hiddenInput = document.getElementById('student_id');
            const suggestionsBox = document.getElementById('student_suggestions');

            input.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                suggestionsBox.innerHTML = '';
                hiddenInput.value = '';

                if (query.length < 1) return suggestionsBox.style.display = 'none';

                const filtered = students.filter(s => s.name.toLowerCase().includes(query));

                if (!filtered.length) return suggestionsBox.style.display = 'none';

                filtered.forEach(s => {
                    const item = document.createElement('button');
                    item.type = 'button';
                    item.className = 'list-group-item list-group-item-action';
                    item.textContent = s.name;
                    item.onclick = () => {
                        input.value = s.name;
                        hiddenInput.value = s.id;
                        suggestionsBox.style.display = 'none';
                    };
                    suggestionsBox.appendChild(item);
                });

                suggestionsBox.style.display = 'block';
            });
        });
    </script>

@endsection
