@extends('admin.layout')

@section('title', 'تغيير كلمة المرور')

@section('content')
    <form method="post" action="{{ route('admin.password.update') }}" class="panel form narrow">
        @csrf
        @method('PUT')
        <div class="field">
            <label for="current_password">كلمة المرور الحالية</label>
            <input id="current_password" name="current_password" type="password" required autocomplete="current-password" dir="ltr">
            @error('current_password')<span class="err">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="password">كلمة المرور الجديدة</label>
            <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password" dir="ltr">
            <span class="hint">8 أحرف على الأقل.</span>
            @error('password')<span class="err">{{ $message }}</span>@enderror
        </div>
        <div class="field">
            <label for="password_confirmation">أعد كتابة كلمة المرور الجديدة</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" dir="ltr">
        </div>
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">تغيير كلمة المرور</button>
        </div>
    </form>
@endsection
