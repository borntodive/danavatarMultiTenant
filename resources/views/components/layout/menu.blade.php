@props(
    [
        'mobile'=>false
    ]
    )
<x-layout.menu-link :mobile="$mobile" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-layout.menu-link>
<x-layout.menu-link :mobile="$mobile" href="{{ route('anamnesis') }}" :active="request()->routeIs('anamnesis')">
    {{ __('La tua Anamnesi') }}
</x-layout.menu-link>
<x-layout.menu-link :mobile="$mobile" href="{{ route('medical_record.show',[auth()->user()]) }}" :active="request()->is('medical-record/'.auth()->user()->id)">
    {{ __('La tua Cartella Clinicha') }}
</x-layout.menu-link>
@if(session()->get('tenant')->hasMedicalSpecilities('wearable'))
    <x-layout.menu-link :mobile="$mobile" href="{{ route('wearable.calendar',[auth()->user()]) }}" :active="request()->is('wearable/'.auth()->user()->id)">
        {{ __('Il tuo Wearable') }}
    </x-layout.menu-link>
@endif
@if(auth()->user()->isAbleTo('medical_doctor_permission',session()->get('tenant')->slug))
    <x-layout.menu-link :mobile="$mobile" href="{{ route('medical_record.index') }}" :active="request()->routeIs('medical_record.*') && !request()->is('medical-record/'.auth()->user()->id)  && !request()->is('wearable/'.auth()->user()->id)">
        {{ __('Cartelle Cliniche') }}
    </x-layout.menu-link>
@endif
@if(auth()->user()->isAbleTo('admin_permission',session()->get('tenant')->slug))
<x-layout.menu-link :mobile="$mobile" href="{{ route('patient.index') }}" :active="request()->routeIs('patient.index')">
    {{ __('Pazienti') }}
</x-layout.menu-link>
<x-layout.menu-link :mobile="$mobile" href="{{ route('staff.index') }}" :active="request()->routeIs('staff.index')">
    {{ __('Staff') }}
</x-layout.menu-link>
@endif
