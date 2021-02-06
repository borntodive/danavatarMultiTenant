@props([
    'label'=>null,
    'placeholder'=>null,
    'type'=>'text',
    'options',
    'selected'=>null,
    'buttonText' =>''
    ])

<div class="{{$attributes->get('class')}}">
    @if ($label)
        <x-form.label for="{{$attributes->whereStartsWith('wire:model')->first()}}"> {{ $label}} </x-form.label>
    @endif
    <div class="mt-1 flex rounded-md shadow-sm">
        <div class="relative flex items-stretch flex-grow focus-within:z-10">
            <select {{ $attributes->except('wire:click')->except('class')->merge(['class' => 'focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md pl-10 sm:text-sm border-gray-300'])}}>
                @if($placeholder)
                    <option value="0">{{$placeholder}}</option>
                @endif
                @foreach($options as $value=>$text)
                    <option value="{{$value}}">{{$text}}</option>
                @endforeach
            </select>
        </div>
        <button
            wire:click="{{$attributes->whereStartsWith('wire:click')->first()}}"
            class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
            <!-- Heroicon name: sort-ascending -->
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>{{$buttonText}}</span>
        </button>
    </div>
    @error($attributes->whereStartsWith('wire:model')->first())
    <p wire:key="error_{{$attributes->whereStartsWith('wire:model')->first()}}"
       class="mt-2 text-sm text-red-600" id="email-error">{{$message}}</p>
    @enderror
</div>
