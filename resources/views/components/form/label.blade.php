@props(['value'])

<label {{ $attributes->merge(['class' => 'pb-2 text-sm font-bold text-gray-800']) }}>
    {{ $value ?? $slot }}
</label>
