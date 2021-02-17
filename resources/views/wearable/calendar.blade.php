@php
    $breadcrumbs=[
        'Dashboard'=>route('dashboard'),
        'Wearable'=>route('wearable.calendar',[$user])
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <x-layout.header :title="__('Wearable di').' '.$user->name" :breadcrumbs="$breadcrumbs" />
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @livewire('weareble.calendar',compact('user'))
    </div>
</x-app-layout>
