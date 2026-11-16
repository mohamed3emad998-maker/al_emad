<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>تسجيل الدخول · لوحة التحكم</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&family=Reem+Kufi:wght@600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=2">
</head>
<body class="login-page">
<main class="login-card">
    <div class="side-brand">
        <span class="mark">م ع</span>
        <span><strong>لوحة التحكم</strong><small>شركة محمد عماد للخدمات</small></span>
    </div>

    <form method="post" action="{{ route('admin.login.attempt') }}" class="stack">
        @csrf
        <div class="field">
            <label for="email">البريد الإلكتروني</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" dir="ltr">
            @error('email')<span class="err">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="password">كلمة المرور</label>
            <input id="password" name="password" type="password" required autocomplete="current-password" dir="ltr">
            @error('password')<span class="err">{{ $message }}</span>@enderror
        </div>
        <label class="check"><input type="checkbox" name="remember" id="remember" value="1"> تذكرني على هذا الجهاز</label>
        <button class="btn btn-primary" type="submit">دخول</button>
    </form>

    <a class="muted-link" href="{{ route('home') }}">العودة إلى الموقع</a>
</main>
</body>
</html>
