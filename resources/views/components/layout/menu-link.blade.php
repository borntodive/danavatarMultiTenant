@props(['active','mobile'])

<!-- Current: "bg-indigo-700 text-white", Default: "text-white hover:bg-indigo-500 hover:bg-opacity-75" -->

@php
    $classes = ($active ?? false)
                ? 'bg-indigo-700 text-white px-3 py-2 rounded-md text-sm font-medium'
                : 'text-white hover:bg-indigo-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium';
    if ($mobile)
        $classes.=" block";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
