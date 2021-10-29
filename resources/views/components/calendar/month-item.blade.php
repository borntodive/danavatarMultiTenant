@props([
    'month' => 'test',
])
@php
use Carbon\Carbon;
Carbon::setLocale('it');
setlocale(LC_TIME, 'it');
    $m= Carbon::create()->startOfMonth()->month($month)->startOfMonth()->format('M');

@endphp
<div class="h-24 border-2 border-gray-300 rounded dark:border-gray-700">
    {{$m}}
</div>
