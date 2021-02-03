@php
    $breadcrumbs=[
        'Dashboard'=>route('dashboard'),
        'Cartelle Cliniche'=>route('medical_record.index')
    ];

@endphp

<x-app-layout>
    <x-slot name="header">
        <x-layout.header :title="__('Cartelle Cliniche')" :breadcrumbs="$breadcrumbs" />
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('medical-record.datatable')
        </div>
    </div>
</x-app-layout>
