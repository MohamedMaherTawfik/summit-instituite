@extends('layouts.admin')

@section('title', 'جميع اولياء الامور')
@section('main_title_content', 'جميع اولياء الامور')
@section('title_content', 'عرض')
@section('link_content')
    <a href="{{ route('parents') }}">جميع اولياء الامور</a>
@endsection

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-body">

            @if ($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th class="text-center">#</th>
                                <th class="text-center">الاسم</th>
                                <th class="text-center">البريد الإلكتروني</th>

                                @if (Auth::user()->role == 'manager')
                                    <th class="text-center">كلمة المرور</th>
                                @endif
                                <th class="text-center">رقم الهاتف</th>
                                <th class="text-center">التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $index => $student)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $student->name }}</td>
                                    <td class="text-center">{{ $student->email }}</td>
                                    @if (Auth::user()->role == 'manager')
                                        <td class="text-center text-muted">{{ $student->password_seen ?? 'غير متاح' }}</td>
                                    @endif
                                    <td class="text-center">{{ $student->phone ?? '-' }}</td>
                                    <td class="text-center">

                                        {{-- تعديل --}}
                                        <a href="{{ route('parents.edit', $student->id) }}"
                                            class="btn btn-sm btn-warning text-white">
                                            تعديل
                                        </a>

                                        {{-- حذف --}}
                                        <form action="{{ route('parents.delete', $student->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطالب؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                حذف
                                            </button>
                                        </form>
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
@endsection
