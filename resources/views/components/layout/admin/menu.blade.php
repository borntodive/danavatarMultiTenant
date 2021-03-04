@props(
    [
        'mobile'=>false
    ]
    )
<x-layout.menu-link :mobile="$mobile" href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
    {{ __('Dashboard') }}
</x-layout.menu-link>

<x-layout.menu-link :mobile="$mobile" href="{{ route('admin.centers') }}" :active="request()->routeIs('admin.centers')">
    {{ __('Centri') }}
</x-layout.menu-link>
