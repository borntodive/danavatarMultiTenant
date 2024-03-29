@php
    $breadcrumbs=[
        'Dashboard'=>route('dashboard'),
        'Cartelle Cliniche'=>route('medical_record.index'),
        $user->name=>route('medical_record.show',compact('user'))
    ];

@endphp

<x-app-layout>
    <x-slot name="header">
        <x-layout.header :title="$medicalRecord->specialty->name.' - '.__('Cartella Clinica di').' '.$user->name" :breadcrumbs="$breadcrumbs" />
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-medical-record.header :user="$user"/>
    </div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @livewire('medical-record.'.$specialty->slug.'.view',compact('user','specialty','medicalRecord'))
    </div>
</x-app-layout>
