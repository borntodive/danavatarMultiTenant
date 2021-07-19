@props(['value'])
@php
    $color="text-green-500";
    if ((isset($value) && str_starts_with($value,'N/A')) || str_starts_with($slot,'N/A') )
        $color="text-red-500";
@endphp
<dd {{ $attributes->merge(['class' => "mt-1 text-sm ".$color])}}>
    {{ $value ?? $slot }}
</dd>
