@props([
    'entangle'=>null,
    'label'=>null,
    'id'=>null
    ])
@php
    if (!$id) {
        $id=$attributes->whereStartsWith('entangle')->first();
    }
@endphp
<div>
    @if ($label)
        <x-form.label class="mb-3" for="{{$id}}"> {{ $label}} </x-form.label>
    @endif
    <button type="button" class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            @if($entangle)
                x-data="{ on: @entangle($entangle) }"
            @else
            x-data="{ on: false }"
            @endif
            aria-pressed="false" :aria-pressed="on.toString()" @click="on = !on" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'bg-indigo-600': on, 'bg-gray-200': !(on) }">
        <span class="sr-only">Use setting</span>
        <span aria-hidden="true" class="translate-x-0 pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'translate-x-5': on, 'translate-x-0': !(on) }"></span>
    </button>

</div>
