@extends('admin.layout')

@section('title', $groups[$group]['label'])

@section('content')
    <nav class="tabs" aria-label="أقسام الإعدادات">
        @foreach($groups as $key => $grp)
            <a href="{{ route('admin.settings.edit', $key) }}" @class(['on' => $key === $group])>{{ $grp['label'] }}</a>
        @endforeach
    </nav>

    <form method="post" action="{{ route('admin.settings.update', $group) }}" enctype="multipart/form-data" class="panel form">
        @csrf
        @method('PUT')

        @foreach($fields as $name => $field)
            @include('admin.partials.field', ['name' => $name, 'field' => $field, 'value' => $values[$name] ?? null])
        @endforeach

        <div class="form-actions">
            <button class="btn btn-primary" type="submit">حفظ التغييرات</button>
            <a class="btn" href="{{ route('home') }}" target="_blank" rel="noopener">معاينة الموقع ↗</a>
        </div>
    </form>
@endsection
