@props(['value'])
<dd {{ $attributes->merge(['class' => "mt-1 text-sm text-gray-900"])}}>
    {{ $value ?? $slot }}
</dd>
