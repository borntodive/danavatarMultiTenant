@props(['value'])

<dt {{ $attributes->merge(['class' => 'text-sm font-medium text-gray-500']) }}>
    {{ $value ?? $slot }}
</dt>
