@php
    $color="text-green-500";
    if ((isset($value) && str_starts_with($value,'N/A')) || str_starts_with($slot,'N/A') )
        $color="text-red-500";
@endphp
<div {{ $attributes->merge(['class' => 'w-full mt-1 max-w-prose text-sm '.$color]) }}>
    <p>
        {{$slot}}
    </p>
</div>
