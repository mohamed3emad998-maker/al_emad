@extends('admin.layout')

@section('title', $item->exists ? 'تعديل '.$r['singular'] : 'إضافة '.$r['singular'])

@section('actions')
    <a class="btn" href="{{ route('admin.resource.index', $r['slug']) }}">رجوع إلى {{ $r['label'] }}</a>
@endsection

@section('content')
    <form method="post"
          action="{{ $item->exists ? route('admin.resource.update', [$r['slug'], $item->id]) : route('admin.resource.store', $r['slug']) }}"
          enctype="multipart/form-data"
          class="panel form">
        @csrf
        @if($item->exists)
            @method('PUT')
        @endif

        @foreach($r['fields'] as $name => $field)
            @include('admin.partials.field', ['name' => $name, 'field' => $field, 'value' => $item->{$name}])
        @endforeach

        <div class="form-actions">
            <button class="btn btn-primary" type="submit">{{ $item->exists ? 'حفظ التغييرات' : 'إضافة' }}</button>
            <a class="btn" href="{{ route('admin.resource.index', $r['slug']) }}">إلغاء</a>
        </div>
    </form>
@endsection
