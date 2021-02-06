@props([
    'disabled' => false,
    'label'=>null,
    'placeholder'=>null,
    'type'=>'text',
    ])
<div class="{{$attributes->get('class')}}">
    <div class="flex-1 min-w-0">
    @if ($label)
        <x-form.label for="{{$attributes->whereStartsWith('wire:model')->first()}}"> {{ $label}} </x-form.label>
    @endif
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <!-- Heroicon name: mail -->
                    <svg class="h-5 w-5 text-gray-400" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input
                    @if ($disabled)
                    disabled
                    @endif
                    type="search"
                    {{$attributes->whereStartsWith('wire:model')}}
                    id="{{$attributes->whereStartsWith('wire:model')->first()}}"
                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md
"
                    placeholder="{{$placeholder}}"
                    @error($attributes->whereStartsWith('wire:model')->first())
                    aria-invalid="true"
                    aria-describedby="email-error"
                    @enderror
            </div>
            @error($attributes->whereStartsWith('wire:model')->first())
            <p wire:key="error_{{$attributes->whereStartsWith('wire:model')->first()}}"
               class="mt-2 text-sm text-red-600" id="email-error">{{$message}}</p>
            @enderror
        </div>
</div>
</div>
