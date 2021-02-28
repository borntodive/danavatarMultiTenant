@php
$breadcrumbs=[
    'Dashboard'=>route('dashboard'),
];
/*$actions=[
    's1'=>[
       'Test'=>'#'
    ],
];*/
@endphp

<x-admin-layout>
    <x-slot name="header">
        <x-layout.header :title="__('Centri')" :breadcrumbs="$breadcrumbs"/>
    </x-slot>

    <p>

    </p>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:admin.centers.index/>
        </div>
    </div>
</x-admin-layout>
