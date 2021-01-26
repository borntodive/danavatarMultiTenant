@props(['value'])

<label {{ $attributes->merge(['class' => 'pb-2 text-sm font-medium text-gray-900']) }}>
    {{ $value ?? $slot }}
</label>
