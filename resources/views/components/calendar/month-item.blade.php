@props([
    'month' => 'test',
    'sensors'=>[]
])
@php
use Carbon\Carbon;
Carbon::setLocale('IT_it');
setlocale(LC_TIME, 'IT_it');
    $m= Carbon::create()->startOfMonth()->month($month)->startOfMonth()->format('M');

@endphp
<div wire:click='goToMonth({{$month}})' class="p-2 border-2 border-gray-300 rounded dark:border-gray-700" style="min-height: 6rem">
    <h2>{{$m}}</h2>
    <div class="flex flex-col gap-1 px-3 mt-3">
    @foreach ($sensors as $sensor)
        <span style="background-color: {{$sensor['color']}}" class="w-full px-2 py-1 text-sm text-white rounded-sm"> {{$sensor['title']}}</span>
    @endforeach
    </div>
</div>
