<style>
    /* تصغير حجم الخط والمسافات بين العناصر في النافبار */
    .navbar .nav-link,
    .navbar .dropdown-item {
        font-size: 14px !important;
        /* أصغر بحوالي 2px من الافتراضي */
        padding: 4px 8px !important;
        /* تقليل الحواف الداخلية */
    }

    /* تصغير الأيقونات والمسافات بينها */
    .navbar .fa {
        font-size: 14px !important;
    }

    /* تصغير شعار الموقع قليلاً */
    .navbar-brand img {
        width: 85px !important;
        height: 40px !important;
    }

    /* تقليل التباعد بين القوائم */
    .navbar-nav .nav-item {
        margin-left: 4px !important;
        margin-right: 4px !important;
    }

    /* تصغير القوائم المنسدلة */
    .dropdown-menu {
        font-size: 14px !important;
        min-width: 160px !important;
    }

    /* تصغير الأزرار الصغيرة مثل الإشعارات */
    .badge {
        font-size: 10px !important;
        padding: 2px 5px !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
        <img src="{{ asset('') }}" style="width: 100px; height: 50px; opacity: .8" alt="Logo">
    </a>

    <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav ml-auto">
            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ Auth::user()->username }}</a>
                </li>
            @endif


            <!-- إدارة المستخدمين -->
            @if (Auth::user()->role == 'manager' || Auth::user()->role == 'guide')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('dashboard/user*') || request()->is('dashboard/lawyer*') || request()->is('dashboard/client*') || request()->is('dashboard/request*') || request()->is('dashboard/action*') || request()->is('dashboard/visit*') ? 'active' : '' }}"
                        href="#" data-toggle="dropdown">
                        إدارة المستخدمين
                    </a>
                    <div class="dropdown-menu ">
                        <a class="dropdown-item {{ request()->is('dashboard/user*') ? 'active' : '' }}"
                            href="{{ route('students') }}">
                            جميع المستخدمين </a>
                        <a class="dropdown-item {{ request()->is('dashboard/user*') ? 'active' : '' }}"
                            href="{{ route('students') }}">
                            جميع الطلاب </a>
                        <a class="dropdown-item {{ request()->is('dashboard/user*') ? 'active' : '' }}"
                            href="{{ route('parents') }}">
                            جميع اولياء الامور </a>
                        <a class="dropdown-item {{ request()->is('dashboard/user*') ? 'active' : '' }}" href="">
                            جميع الأساتذه </a>

                    </div>
                </li>
            @endif

            <!-- زر تسجيل الخروج -->
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">خروج</a>
            </li>

        </ul>
    </div>
</nav>
