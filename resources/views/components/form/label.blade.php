@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-bold text-gray-800']) }}>
    {{ $value ?? $slot }}
</label>
