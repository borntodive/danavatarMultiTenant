@props([
    'label'=>null,
    'placeholder'=>null,
    'type'=>'text',
    'options',
    'selected'=>null,
    ])
<div>

    @if ($label)
        <x-form.label for="{{$attributes->whereStartsWith('wire:model')->first()}}"> {{ $label}} </x-form.label>
    @endif
        <select {{ $attributes->merge(['class' => 'mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md'])}}>
            @if($placeholder)
                <option value="0">{{$placeholder}}</option>
            @endif
            @foreach($options as $value=>$text)
                <option value="{{$value}}" {{($value == $selected) ? 'selected' : '' }}>{{$text}}</option>
            @endforeach
        </select>

    @error($attributes->whereStartsWith('wire:model')->first())
    <p wire:key="error_{{$attributes->whereStartsWith('wire:model')->first()}}"
       class="mt-2 text-sm text-red-600" id="email-error">{{$message}}</p>
    @enderror
</div>
