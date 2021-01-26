@props(
    [
        'mobile'=>false
    ]
    )

<x-layout.profile-dropdown-link :mobile="$mobile" href="{{ route('profile.show') }}">
{{ __('Profilo') }}
</x-layout.profile-dropdown-link>


<div class="border-t border-gray-100"></div>

<!-- Authentication -->
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <x-layout.profile-dropdown-link
        :mobile="$mobile"  href="{{ route('logout') }}"
        onclick="event.preventDefault();
        this.closest('form').submit();">
        {{ __('Logout') }}
    </x-layout.profile-dropdown-link>
</form>
