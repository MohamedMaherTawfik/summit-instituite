@extends('layouts.admin')

@section('title', 'جميع الشعب في المعهد')
@section('main_title_content', 'جميع الشعب في المعهد')
@section('title_content', 'عرض')
@section('link_content')
    <a href="{{ route('classes') }}">جميع الشعب في المعهد</a>
@endsection

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <!-- زر فتح مودال الإضافة -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addClassModal">
                + إضافة شعبة جديدة
            </button>
        </div>

        <div class="card-body">
            @if ($classes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>الاسم</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $index => $class)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $class->name }}</td>
                                    <td class="text-center">

                                        <!-- زر فتح مودال التعديل -->
                                        <button type="button" class="btn btn-sm btn-warning text-white"
                                            data-bs-toggle="modal" data-bs-target="#editClassModal-{{ $class->id }}">
                                            تعديل
                                        </button>

                                        <!-- فورم الحذف -->
                                        <form action="{{ route('classes.delete', $class->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الشعبة؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                        </form>

                                    </td>
                                </tr>

                                <!-- مودال التعديل -->
                                <div class="modal fade" id="editClassModal-{{ $class->id }}" tabindex="-1"
                                    aria-labelledby="editClassModalLabel-{{ $class->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title" id="editClassModalLabel-{{ $class->id }}">
                                                    تعديل الشعبة
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('classes.update', $class->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">اسم الشعبة</label>
                                                        <input type="text" name="name" class="form-control" required
                                                            value="{{ $class->name }}">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted my-3">لا توجد شعب بعد.</p>
            @endif
        </div>
    </div>

    <!-- مودال الإضافة -->
    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addClassModalLabel">إضافة شعبة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('classes.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">اسم الشعبة</label>
                            <input type="text" name="name" class="form-control" required
                                placeholder="أدخل اسم الشعبة">
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
@endsection
