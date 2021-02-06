@php
    $breadcrumbs=[
        'Dashboard'=>route('dashboard'),
        'Cartella Clinica'=>route('medical_record.show',['user'=>$anamnesis->user])
    ];

@endphp

<x-app-layout>
    <x-slot name="header">
        <x-layout.header :title="__('Anamnesi').' di '.$anamnesis->user->name.' del '.$anamnesis->created_at->isoFormat('L')" :breadcrumbs="$breadcrumbs" />
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <x-medical-record.header :user="$anamnesis->user"/>
        </div>
        @include('anamnesis.partials.general')
        @if(session()->get('tenant')->hasMedicalSpecilities('diving'))
            @include('anamnesis.partials.diving')
        @endif

    </div>
</x-app-layout>
