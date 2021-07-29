@props(['value','sublabel'=>false])

@php
    $font=$sublabel ? "font-normal" : 'font-bold';
@endphp

<label {{ $attributes->merge(['class' => 'block text-sm text-gray-800 '.$font]) }}>
    {{ $value ?? $slot }}
</label>
