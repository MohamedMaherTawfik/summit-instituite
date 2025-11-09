@extends('layouts.admin')
@section('title', ' جميع الاقساط ')
@section('main_title_content', ' جميع الاقساط ')

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <!-- زر فتح مودال الإضافة -->
            <a href="{{ route('financials.create') }}" class="btn btn-primary">اضافه عمليه دفع جديده +</a>
        </div>

        <div class="card-body">
            @if ($financials->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle" id="financialTable">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>رقم العمليه</th>
                                <th>اسم العميل</th>
                                <th>المبلغ المدفوع</th>
                                <th>المبلغ الكامل</th>
                                <th>تاريخ الدفع</th>
                                <th>حاله الدفع</th>
                                <th>المبلغ المتبقي</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($financials as $class)
                                <tr>
                                    <td class="text-center">{{ $class->id }}</td>
                                    <td class="text-center name-cell">{{ $class->student->name }}</td>
                                    <td class="text-center">{{ $class->amount }}</td>
                                    <td class="text-center">{{ $class->full_amount }}</td>
                                    <td class="text-center date-cell">{{ $class->date }}</td>
                                    <td class="text-center">{{ $class->status }}</td>
                                    <td class="text-center" style="color: rgb(207, 2, 2); font-size: 20px;">
                                        {{ $class->full_amount - $class->amount }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('financials.edit', $class->id) }}" class="btn btn-warning btn-sm">
                                            تعديل
                                        </a>
                                        <form action="{{ route('financials.delete', $class->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه العملية؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted my-3">لا توجد بيانات مالية بعد.</p>
            @endif
        </div>
    </div>
@endsection
