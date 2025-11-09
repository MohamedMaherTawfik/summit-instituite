@extends('layouts.admin')

@section('title', 'جدول الحضور في المعهد')
@section('main_title_content', 'جدول الحضور في المعهد')
@section('title_content', 'عرض')
@section('link_content')
    <a href="{{ route('attendances') }}">جدول الحضور في المعهد</a>
@endsection

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            @if ($attendances->count() > 0)
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
                            @foreach ($attendances as $index => $class)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $class->student->name }}</td>
                                    <td class="text-center">{{ $class->status }}</td>
                                    <td class="text-center">{{ $class->date }}</td>
                                    <td class="text-center">

                                        <!-- فورم الحذف -->
                                        <form action="{{ route('attendances.delete', $class->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الشعبة؟');">
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
                <p class="text-center text-muted my-3">لا توجد شعب بعد.</p>
            @endif
        </div>
    </div>

@endsection
