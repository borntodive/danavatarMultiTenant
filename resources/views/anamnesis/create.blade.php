@php
    $breadcrumbs=[
        'Dashboard'=>route('dashboard'),
        'Profilo'=>route('profile.show')
    ];

@endphp

<x-app-layout>
    <x-slot name="header">
        <x-layout.header :title="__('Anamnesi')" :breadcrumbs="$breadcrumbs" />
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
           @livewire('anamnesis.create')
        </div>
    </div>
</x-app-layout>
