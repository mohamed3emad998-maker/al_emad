@extends('admin.layout')

@section('title', 'طلبات الحجز')

@section('content')
    <nav class="tabs" aria-label="تصفية حسب الحالة">
        <a href="{{ route('admin.bookings.index') }}" @class(['on' => $status === null])>الكل <small>({{ $all }})</small></a>
        @foreach(\App\Models\BookingRequest::STATUSES as $key => $label)
            <a href="{{ route('admin.bookings.index', ['status' => $key]) }}" @class(['on' => $status === $key])>{{ $label }} <small>({{ $counts[$key] ?? 0 }})</small></a>
        @endforeach
    </nav>

    <section class="panel">
        @if($bookings->isEmpty())
            <p class="empty">لا توجد طلبات في هذا القسم. تظهر هنا الطلبات التي يرسلها الزوار من نموذج "اطلب حجزك" في الموقع.</p>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                    <tr><th>الاسم</th><th>الهاتف</th><th>الخدمة</th><th>الوجهة</th><th>تاريخ السفر</th><th>الحالة</th><th>وصل في</th></tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $b)
                        <tr @class(['row-new' => $b->status === 'new'])>
                            <td><a href="{{ route('admin.bookings.show', $b) }}"><strong>{{ $b->name }}</strong></a></td>
                            <td class="ltr">{{ $b->phone }}</td>
                            <td>{{ $b->service ?: '—' }}</td>
                            <td>{{ $b->destination ?: '—' }}</td>
                            <td class="ltr">{{ $b->travel_date?->format('Y-m-d') ?? '—' }}</td>
                            <td><span class="pill pill-{{ $b->status }}">{{ $b->statusLabel() }}</span></td>
                            <td class="ltr">{{ $b->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $bookings->links('admin.partials.pagination') }}
        @endif
    </section>
@endsection
