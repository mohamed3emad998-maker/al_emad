@extends('admin.layout')

@section('title', $r['label'])

@section('actions')
    <a class="btn btn-primary" href="{{ route('admin.resource.create', $r['slug']) }}">+ إضافة {{ $r['singular'] }}</a>
@endsection

@section('content')
    <section class="panel">
        @if($items->isEmpty())
            <p class="empty">لا توجد عناصر في {{ $r['label'] }} بعد. اضغط "إضافة {{ $r['singular'] }}" لإضافة أول عنصر.</p>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="num-col">الترتيب</th>
                        @foreach($r['list'] as $col => $label)
                            <th>{{ $label }}</th>
                        @endforeach
                        <th>الحالة</th>
                        <th class="actions-col"><span class="sr">إجراءات</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="num-col ltr">{{ $item->sort_order }}</td>
                            @foreach($r['list'] as $col => $label)
                                <td>
                                    @if($loop->first)
                                        <a href="{{ route('admin.resource.edit', [$r['slug'], $item->id]) }}"><strong>{{ $item->{$col} ?: '—' }}</strong></a>
                                    @else
                                        {{ $item->{$col} ?: '—' }}
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                @if($item->is_active)
                                    <span class="pill pill-done">ظاهر</span>
                                @else
                                    <span class="pill pill-cancelled">مخفي</span>
                                @endif
                            </td>
                            <td class="actions-col">
                                <a class="btn btn-sm" href="{{ route('admin.resource.edit', [$r['slug'], $item->id]) }}">تعديل</a>
                                <form method="post" action="{{ route('admin.resource.destroy', [$r['slug'], $item->id]) }}" onsubmit="return confirm('حذف هذا العنصر نهائيًا؟ لا يمكن التراجع عن الحذف.');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <p class="hint">العناصر تظهر في الموقع حسب رقم الترتيب من الأصغر إلى الأكبر.</p>
        @endif
    </section>
@endsection
