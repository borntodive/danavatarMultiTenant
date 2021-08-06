@php
$account=[
    [
        'href'=>route('anamnesis'),
        'label'=>'La tua Anamnesi'
    ],
    [
        'href'=>route('medical_record.show',[auth()->user()]),
        'label'=>'La tua Cartella Clinica'
    ]
];
if (session()->get('tenant')->hasMedicalSpecilities('wearable')) {
    $account[]=[
        'href'=>route('wearable.calendar',[auth()->user()]),
        'label'=>'Il tuo Wearable'
];
}
@endphp

@props(
    [
        'mobile'=>false
    ]
    )

<x-layout.menu-link :mobile="$mobile" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-layout.menu-link>
@if(auth()->user()->isAbleTo('medical_doctor_permission',session()->get('tenant')->slug))
    <x-layout.menu-link :mobile="$mobile" href="{{ route('medical_record.index') }}" :active="request()->routeIs('medical_record.*') && !request()->is('medical-record/'.auth()->user()->id)  && !request()->is('wearable/'.auth()->user()->id)">
        {{ __('Pazienti') }}
    </x-layout.menu-link>
@endif

<x-layout.dropdown-menu-link firstlevel="Account Personale" :dropdown="$account" :mobile="$mobile" :active="request()->routeIs('anamnesis')  || request()->is('medical-record/'.auth()->user()->id) || request()->is('wearable/'.auth()->user()->id)" />


@if(auth()->user()->isAbleTo('admin_permission',session()->get('tenant')->slug))
<x-layout.menu-link :mobile="$mobile" href="{{ route('patient.index') }}" :active="request()->routeIs('patient.index')">
    {{ __('Nuovi Pazienti') }}
</x-layout.menu-link>
<x-layout.menu-link :mobile="$mobile" href="{{ route('staff.index') }}" :active="request()->routeIs('staff.index')">
    {{ __('Staff') }}
</x-layout.menu-link>
@endif
