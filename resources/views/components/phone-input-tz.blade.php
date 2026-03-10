@props([
    'name' => 'phone',
    'oldPhone' => null,
    'required' => true,
])

@php
    $digits = $oldPhone ? preg_replace('/^\+255/', '', $oldPhone) : '';
    if (strlen($digits) === 10 && $digits[0] === '0') {
        $digits = substr($digits, 1);
    }
    $fullValue = $oldPhone ?: '';
@endphp

<div class="input-group @error($name) is-invalid @enderror">
    <span class="input-group-text bg-light">+255</span>
    <input type="hidden" name="{{ $name }}" id="{{ $name }}_full" value="{{ $fullValue }}">
    <input type="tel"
           id="{{ $name }}_digits"
           inputmode="numeric"
           pattern="[0-9]*"
           maxlength="9"
           autocomplete="tel-national"
           class="form-control ps-3 @error($name) is-invalid @enderror"
           placeholder="{{ __('e.g. 712345678') }}"
           value="{{ $digits }}"
           data-phone-full-id="{{ $name }}_full"
           {{ $required ? 'required' : '' }}>
</div>
@error($name)
    <div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
