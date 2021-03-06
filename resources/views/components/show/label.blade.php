@props(['value'])

<dt {{ $attributes->merge(['class' => 'text-sm font-bold text-gray-800']) }}>
    {{ $value ?? $slot }}
</dt>
