@props([
    'disabled' => false,
    'hasError' => false,
    'label',
    'name'
    ])

<label {{ $attributes->merge(['class' => 'pb-2 text-sm font-medium text-gray-900']) }}>
    {{ $label}}
</label>

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'border '. ($errors->has($name) ? 'border-red-400' : 'border-gray-300').'
    pl-3 py-3 shadow-sm rounded text-sm focus:outline-none focus:border-indigo-700 text-gray-800']) !!}>

@error($name)
<div class="flex justify-between items-center pt-1 text-red-400">
    <p class="text-xs">{{ $message }}</p>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="15" y1="9" x2="9" y2="15"></line>
        <line x1="9" y1="9" x2="15" y2="15"></line>
    </svg>
</div>
@enderror
