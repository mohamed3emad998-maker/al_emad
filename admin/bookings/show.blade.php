@extends('admin.layout')

@section('title', 'طلب حجز: '.$booking->name)

@section('actions')
    <a class="btn" href="{{ route('admin.bookings.index') }}">رجوع إلى الطلبات</a>
@endsection

@section('content')
    @php($digits = preg_replace('/\D+/', '', $booking->phone))
    <div class="two-col">
        <section class="panel">
            <div class="panel-head">
                <h2>تفاصيل الطلب</h2>
                <span class="pill pill-{{ $booking->status }}">{{ $booking->statusLabel() }}</span>
            </div>
            <dl class="details">
                <div><dt>الاسم</dt><dd>{{ $booking->name }}</dd></div>
                <div><dt>الهاتف</dt><dd class="ltr">{{ $booking->phone }}</dd></div>
                <div><dt>الخدمة</dt><dd>{{ $booking->service ?: '—' }}</dd></div>
                <div><dt>الوجهة</dt><dd>{{ $booking->destination ?: '—' }}</dd></div>
                <div><dt>تاريخ السفر</dt><dd class="ltr">{{ $booking->travel_date?->format('Y-m-d') ?? '—' }}</dd></div>
                <div><dt>عدد المسافرين</dt><dd>{{ $booking->travelers ?: '—' }}</dd></div>
                <div><dt>وصل في</dt><dd class="ltr">{{ $booking->created_at->format('Y-m-d H:i') }}</dd></div>
            </dl>
            @if($booking->notes)
                <h3 class="sub">ملاحظات العميل</h3>
                <p class="note">{!! nl2br(e($booking->notes)) !!}</p>
            @endif
            <div class="form-actions">
                <a class="btn btn-primary" href="tel:{{ $booking->phone }}">اتصال</a>
                @if($digits)
                    @php($wa = str_starts_with($digits, '0') ? '249'.substr($digits, 1) : $digits)
                    <a class="btn" href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener">واتساب</a>
                @endif
            </div>
        </section>

        <section class="panel">
            <h2>متابعة الطلب</h2>
            <form method="post" action="{{ route('admin.bookings.update', $booking) }}" class="form">
                @csrf
                @method('PATCH')
                <div class="field">
                    <label for="status">الحالة</label>
                    <select id="status" name="status">
                        @foreach(\App\Models\BookingRequest::STATUSES as $key => $label)
                            <option value="{{ $key }}" @selected(old('status', $booking->status) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')<span class="err">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="admin_notes">ملاحظات داخلية</label>
                    <textarea id="admin_notes" name="admin_notes" rows="5">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                    <span class="hint">لا تظهر للعميل.</span>
                    @error('admin_notes')<span class="err">{{ $message }}</span>@enderror
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">حفظ</button>
                </div>
            </form>

            <form method="post" action="{{ route('admin.bookings.destroy', $booking) }}" onsubmit="return confirm('حذف هذا الطلب نهائيًا؟ لا يمكن التراجع عن الحذف.');" class="danger-zone">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">حذف الطلب</button>
            </form>
        </section>
    </div>
@endsection
