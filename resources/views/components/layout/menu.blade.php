@props(
    [
        'mobile'=>false
    ]
    )
<x-layout.menu-link :mobile="$mobile" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-layout.menu-link>
<x-layout.menu-link :mobile="$mobile" href="{{ route('anamnesis') }}" :active="request()->routeIs('anamnesis')">
    {{ __('Anamnesi') }}
</x-layout.menu-link>
@if(auth()->user()->isAbleTo('medical_doctor_permission',session()->get('tenant')->slug))
    <x-layout.menu-link :mobile="$mobile" href="{{ route('medical_record.index') }}" :active="request()->routeIs('medical_record.index')">
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
