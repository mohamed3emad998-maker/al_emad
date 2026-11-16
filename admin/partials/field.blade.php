{{-- Renders one form field. Expects: $name, $field, $value --}}
@php($type = $field['type'])
<div class="field {{ $type === 'boolean' ? 'field-check' : '' }}">
    @if($type === 'boolean')
        <label class="check">
            <input type="checkbox" id="f_{{ $name }}" name="{{ $name }}" value="1" @checked(old($name, $value))>
            {{ $field['label'] }}
        </label>
    @else
        <label for="f_{{ $name }}">{{ $field['label'] }}</label>

        @switch($type)
            @case('textarea')
            @case('lines')
                <textarea id="f_{{ $name }}" name="{{ $name }}" rows="{{ $type === 'lines' ? 5 : 4 }}">{{ old($name, $value) }}</textarea>
                @break

            @case('number')
                <input id="f_{{ $name }}" name="{{ $name }}" type="number" min="0" step="1" value="{{ old($name, $value) }}" class="short">
                @break

            @case('icon')
                <div class="icon-select">
                    <select id="f_{{ $name }}" name="{{ $name }}">
                        @foreach(config('cms.icons') as $icon => $label)
                            <option value="{{ $icon }}" @selected(old($name, $value) === $icon)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                @break

            @case('image')
                @if($value)
                    <div class="media-preview">
                        <img src="{{ asset($value) }}" alt="" loading="lazy">
                        <label class="check"><input type="checkbox" name="remove_{{ $name }}" value="1"> حذف الصورة الحالية</label>
                    </div>
                @endif
                <input id="f_{{ $name }}" name="{{ $name }}" type="file" accept="image/jpeg,image/png,image/webp">
                <span class="hint">JPG أو PNG أو WEBP، حتى 5 ميجابايت.</span>
                @break

            @case('video')
                @if($value)
                    <div class="media-preview">
                        <video src="{{ asset($value) }}" muted playsinline controls preload="metadata"></video>
                        <label class="check"><input type="checkbox" name="remove_{{ $name }}" value="1"> حذف الفيديو الحالي</label>
                    </div>
                @endif
                <input id="f_{{ $name }}" name="{{ $name }}" type="file" accept="video/mp4,video/webm">
                @break

            @default
                <input id="f_{{ $name }}" name="{{ $name }}" type="text" value="{{ old($name, $value) }}">
        @endswitch
    @endif

    @if(!empty($field['hint']))
        <span class="hint">{{ $field['hint'] }}</span>
    @endif
    @error($name)<span class="err">{{ $message }}</span>@enderror
</div>
