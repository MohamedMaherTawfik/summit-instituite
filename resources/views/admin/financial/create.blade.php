@extends('layouts.admin')

@section('title', 'إضافة عمليه دفع جديده')
@section('main_title_content', 'إضافة عمليه دفع جديده')


@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">إضافة عمليه دفع جديده</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('financials.store') }}" method="POST">
                @csrf

                <!-- اختيار الطالب -->
                <div class="row">
                    <div class="col-md-6 mb-3 position-relative">
                        <label class="form-label">اسم الطالب</label>
                        <input type="text" id="student_name" class="form-control" placeholder="اكتب اسم الطالب"
                            autocomplete="off" required>
                        <input type="hidden" name="student_id" id="student_id">
                        <div id="student_suggestions" class="list-group position-absolute w-100"
                            style="z-index: 1000; max-height: 200px; overflow-y: auto; display: none;"></div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">رقم الدفع</label>
                        <input type="text" name="payment_number" class="form-control" value="{{ $next_number }}"
                            readonly>
                    </div>
                </div>

                <!-- المبالغ -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">المبلغ المدفوع</label>
                        <input type="number" name="amount" class="form-control" placeholder="أدخل المبلغ المدفوع"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">المبلغ بالكامل</label>
                        <input type="number" name="full_amount" class="form-control" placeholder="أدخل المبلغ الكامل"
                            required>
                    </div>
                </div>

                <!-- الحالة والتاريخ -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الحالة</label>
                        <select name="status" class="form-select" required>
                            <option value="قسط">قسط</option>
                            <option value="مكتمل">مكتمل</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">تاريخ الدفع</label>
                        <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}"
                            required>
                    </div>
                </div>

                <!-- زر الحفظ -->
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{ route('financials') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>

        </div>
    </div>

    {{-- سكربت اختيار الطالب --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const students = @json($users);
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
