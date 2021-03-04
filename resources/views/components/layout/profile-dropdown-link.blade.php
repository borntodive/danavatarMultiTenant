@props(['mobile'])

@php
    $classes = (!$mobile)
                ? 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100'
                : 'block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75';
@endphp
<a {{ $attributes->merge(['class' =>$classes]) }} role="menuitem">

    {{$slot}}
</a>
