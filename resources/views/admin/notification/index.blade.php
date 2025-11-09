@extends('layouts.admin')

@section('title', 'جميع الملاحظات لدي الطالب ')
@section('main_title_content', 'جميع الملاحظات لدي الطالب ')

@section('content')
    <div class="card mt-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <!-- زر فتح مودال الإضافة -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addClassModal">
                + ارسال ملاحظة جديدة الي {{ $student->name ?? 'الطالب' }}
            </button>

            <!-- زر فتح مودال الملاحظة لأهل الطالب -->
            @if (!empty($parent))
                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#addParentNoteModal">
                    + ارسال ملاحظة جديدة الي ولي الامر {{ $parent->name ?? '' }}
                </button>
            @endif

        </div>

        <div class="card-body">
            @if ($notifications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>رقم الملاحظة</th>
                                <th>مرسل الي</th>
                                <th>العنوان</th>
                                <th>الملاحظة</th>
                                <th>التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $index => $class)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $class->user->name ?? '-' }}</td>
                                    <td class="text-center">{{ $class->title ?? '-' }}</td>
                                    <td class="text-center">{{ $class->message ?? '-' }}</td>
                                    <td class="text-center">
                                        <!-- زر التعديل -->
                                        <button type="button" class="btn btn-sm btn-warning text-white"
                                            data-bs-toggle="modal" data-bs-target="#editClassModal-{{ $class->id }}">
                                            تعديل
                                        </button>

                                        <!-- فورم الحذف -->
                                        <form action="{{ route('notifications.delete', $class->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('هل أنت متأكد من حذف هذه الملاحظة؟');">
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
                                                    تعديل الملاحظة
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('notifications.update', $class->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">العنوان </label>
                                                        <input type="text" name="title" class="form-control" required
                                                            value="{{ $class->title }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">الملاحظة </label>
                                                        <input type="text" name="message" class="form-control" required
                                                            value="{{ $class->message }}">
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
                <p class="text-center text-muted my-3">لا توجد ملاحظات بعد.</p>
            @endif
        </div>
    </div>

    <!-- مودال إضافة ملاحظة للطالب -->
    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addClassModalLabel">إضافة ملاحظة جديدة للطالب</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('notifications.store', $student->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">العنوان</label>
                            <input type="text" name="title" class="form-control" required placeholder="أدخل العنوان">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الملاحظة</label>
                            <input type="text" name="message" class="form-control" required placeholder="أدخل الملاحظة">
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

    <!-- مودال إرسال ملاحظة لأهل الطالب -->
    <div class="modal fade" id="addParentNoteModal" tabindex="-1" aria-labelledby="addParentNoteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="addParentNoteModalLabel">إرسال ملاحظة إلى {{ $parent->name ?? '' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('notifications.store.parent', $parent->id ?? '') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">العنوان</label>
                            <input type="text" name="title" class="form-control" required
                                placeholder="أدخل العنوان">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الملاحظة</label>
                            <input type="text" name="message" class="form-control" required
                                placeholder="أدخل الملاحظة">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-secondary">إرسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
