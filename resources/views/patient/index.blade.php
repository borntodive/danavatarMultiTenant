@php
    $breadcrumbs=[
        'Dashboard'=>route('dashboard'),
        'Pazienti'=>route('patient.index')
    ];

@endphp

<x-app-layout>
    <x-slot name="header">
        <x-layout.header :title="__('Pazienti')" :breadcrumbs="$breadcrumbs" />
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('patient.index')
        </div>
    </div>
</x-app-layout>
