@php
    $newBookings = \App\Models\BookingRequest::where('status', 'new')->count();
    $siteName = \App\Models\Setting::where('key', 'brand_name')->value('value') ?: 'الموقع';
@endphp
<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>@yield('title') · لوحة التحكم</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&family=Reem+Kufi:wght@600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=2">
</head>
<body>
<div class="shell">
    <aside class="side" id="side">
        <div class="side-top">
            <a class="side-brand" href="{{ route('admin.dashboard') }}">
                <span class="mark">م ع</span>
                <span><strong>{{ $siteName }}</strong><small>لوحة التحكم</small></span>
            </a>
            <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="side-nav"
                    onclick="var s=document.getElementById('side');var o=s.classList.toggle('open');this.setAttribute('aria-expanded',o);this.textContent=o?'إغلاق':'القائمة';">القائمة</button>
        </div>

        <nav class="side-nav" id="side-nav" aria-label="القائمة">
            <a href="{{ route('admin.dashboard') }}" @class(['on' => request()->routeIs('admin.dashboard')])>الرئيسية</a>
            <a href="{{ route('admin.bookings.index') }}" @class(['on' => request()->routeIs('admin.bookings.*')])>
                طلبات الحجز
                @if($newBookings > 0)<span class="badge">{{ $newBookings }}</span>@endif
            </a>

            <span class="side-label">محتوى الموقع</span>
            @foreach(config('cms.resources') as $slug => $res)
                <a href="{{ route('admin.resource.index', $slug) }}" @class(['on' => request()->routeIs('admin.resource.*') && request()->route('resource') === $slug])>{{ $res['label'] }}</a>
            @endforeach

            <span class="side-label">الإعدادات</span>
            @foreach(config('cms.settings') as $key => $grp)
                <a href="{{ route('admin.settings.edit', $key) }}" @class(['on' => request()->routeIs('admin.settings.*') && (request()->route('group') ?? array_key_first(config('cms.settings'))) === $key])>{{ $grp['label'] }}</a>
            @endforeach

            <span class="side-label">الحساب</span>
            <a href="{{ route('admin.password.edit') }}" @class(['on' => request()->routeIs('admin.password.*')])>تغيير كلمة المرور</a>
            <a href="{{ route('home') }}" target="_blank" rel="noopener">عرض الموقع ↗</a>
            <form method="post" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="link-btn">تسجيل الخروج</button>
            </form>
        </nav>
    </aside>

    <main class="main">
        <header class="topbar">
            <h1>@yield('title')</h1>
            <div class="topbar-actions">@yield('actions')</div>
        </header>

        @if(session('status'))
            <div class="flash" role="status">{{ session('status') }}</div>
        @endif
        @if($errors->any())
            <div class="flash flash-error" role="alert">لم يتم الحفظ. صحّح الحقول المعلّمة بالأحمر ثم حاول مرة أخرى.</div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>
