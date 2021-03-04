@props([
    'disabled' => false,
    'hasError' => false,
    'id'
    ])
<input
    type="checkbox"
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'border '. ($errors->has($id) ? 'border-red-400' : 'border-gray-300').'
    shadow-sm rounded text-sm focus:outline-none focus:border-indigo-700 text-green-800 m-auto']) !!}
>
