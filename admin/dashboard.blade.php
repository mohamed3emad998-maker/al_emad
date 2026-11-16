@extends('admin.layout')

@section('title', 'الرئيسية')

@section('actions')
    <a class="btn" href="{{ route('home') }}" target="_blank" rel="noopener">عرض الموقع ↗</a>
@endsection

@section('content')
    <section class="stats">
        <a class="stat stat-hot" href="{{ route('admin.bookings.index', ['status' => 'new']) }}">
            <span class="stat-num">{{ $newBookings }}</span>
            <span class="stat-label">طلبات حجز جديدة</span>
        </a>
        <a class="stat" href="{{ route('admin.bookings.index') }}">
            <span class="stat-num">{{ $totalBookings }}</span>
            <span class="stat-label">كل طلبات الحجز</span>
        </a>
        @foreach(['services', 'destinations', 'faqs'] as $slug)
            @isset($counts[$slug])
                <a class="stat" href="{{ route('admin.resource.index', $slug) }}">
                    <span class="stat-num">{{ $counts[$slug]['active'] }}</span>
                    <span class="stat-label">{{ $counts[$slug]['label'] }} ظاهرة</span>
                </a>
            @endisset
        @endforeach
    </section>

    <section class="panel">
        <div class="panel-head">
            <h2>آخر طلبات الحجز</h2>
            <a href="{{ route('admin.bookings.index') }}">عرض الكل</a>
        </div>
        @if($latest->isEmpty())
            <p class="empty">لا توجد طلبات بعد. تظهر هنا الطلبات التي يرسلها الزوار من نموذج "اطلب حجزك" في الموقع.</p>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead><tr><th>الاسم</th><th>الهاتف</th><th>الوجهة</th><th>الحالة</th><th>التاريخ</th></tr></thead>
                    <tbody>
                    @foreach($latest as $b)
                        <tr>
                            <td><a href="{{ route('admin.bookings.show', $b) }}">{{ $b->name }}</a></td>
                            <td class="ltr">{{ $b->phone }}</td>
                            <td>{{ $b->destination ?: '—' }}</td>
                            <td><span class="pill pill-{{ $b->status }}">{{ $b->statusLabel() }}</span></td>
                            <td class="ltr">{{ $b->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    <section class="panel">
        <div class="panel-head"><h2>تعديل محتوى الموقع</h2></div>
        <div class="quick">
            @foreach(config('cms.settings') as $key => $grp)
                <a href="{{ route('admin.settings.edit', $key) }}">{{ $grp['label'] }}</a>
            @endforeach
            @foreach($counts as $slug => $c)
                <a href="{{ route('admin.resource.index', $slug) }}">{{ $c['label'] }} <small>({{ $c['total'] }})</small></a>
            @endforeach
        </div>
    </section>
@endsection
