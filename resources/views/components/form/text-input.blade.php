@props([
    'disabled' => false,
    'label'=>null,
    'placeholder'=>null,
    'type'=>'text',
    'icon'=>false,
    'id'=>null
    ])
@php
if (!$id) {
    $id=$attributes->whereStartsWith('wire:model')->first();
}
@endphp
<div class="{{$attributes->get('class')}}">
    @if ($label)
        <x-form.label for="{{$id}}"> {{ $label}} </x-form.label>
    @endif
    <div class="relative mt-1 rounded-md shadow-sm">
        <input
            @if ($disabled)
            disabled
            @endif
            type="{{$type}}"
            {{$attributes->whereStartsWith('wire:model')}}
            {{$attributes->whereStartsWith('wire:change')}}
            id="{{$id}}"
            @error($id)
            class="block w-full pr-10 text-red-900 placeholder-red-300 border-red-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            @else
            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            @endif
            placeholder="{{$placeholder}}"
            @error($id)
            aria-invalid="true"
            aria-describedby="email-error"
            @enderror
            />
        @error($id)
        <div wire:key="error_svg_{{$id}}" class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <!-- Heroicon name: exclamation-circle -->
            <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </div>
        @elseif($icon)
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <!-- Heroicon name: question-mark-circle -->
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
            </div>
        @enderror

    </div>
    @error($id)
    <p wire:key="error_{{$id}}"
       class="mt-2 text-sm text-red-600" id="{{$id}}-error">{{$message}}</p>
    @enderror
</div>
