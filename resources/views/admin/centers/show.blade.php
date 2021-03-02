@php
$breadcrumbs=[
    'Dashboard'=>route('admin.dashboard'),
    'Centri'=>route('admin.centers'),
];
/*$actions=[
    's1'=>[
       'Test'=>'#'
    ],
];*/
@endphp

<x-admin-layout>
    <x-slot name="header">
        <x-layout.header :title="__('Centro').' - '.$tenant->name" :breadcrumbs="$breadcrumbs"/>
    </x-slot>

    <p>

    </p>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:admin.centers.show :center="$tenant"/>
        </div>
    </div>
</x-admin-layout>
