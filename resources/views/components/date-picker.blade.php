@props(['options' => []])

@php
    $options = array_merge([
                    'dateFormat' => 'Y-m-d',
                    'enableTime' => false,
                    'altFormat' =>  'd/m/Y',
                    'altInput' => true
                    ], $options);
@endphp

<div>
    <input
        x-data
        x-init="flatpickr($refs.input, {{json_encode((object)$options)}});"
        x-ref="input"
        type="text"
        {{ $attributes->merge(['class' => 'form-input w-full rounded-md shadow-sm']) }}
    />
    @error($attributes->whereStartsWith('wire:model')->first())
    <p wire:key="error_{{$attributes->whereStartsWith('wire:model')->first()}}"
       class="mt-2 text-sm text-red-600" id="email-error">{{$message}}</p>
    @enderror
</div>
