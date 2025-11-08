<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">تسجيل الدخول</h2>
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- ✅ عرض كل الأخطاء من الفاليديشن --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">كلمة المرور</label>
                <input type="password" id="password" name="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                دخول
            </button>

            {{-- <!-- Register Link -->
            <p class="text-center text-gray-600 text-sm mt-3">
                ليس لديك حساب؟
                <a href="{{ route('signup') }}" class="text-blue-600 hover:underline">إنشاء حساب</a>
            </p> --}}
        </form>
    </div>

</body>

</html>
