<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

@livewireStyles



@livewireScripts
<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>


</head>

<body class="font-sans antialiased bg-gray-200">
<div class="" style="">
    <div class="bg-gray-200">

    @livewire('layout.flash-message')
    @if(app()->environment('local', 'staging'))
        <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="relative sticky top-0 z-50 bg-red-600">
                <div class="px-3 py-3 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="pr-16 sm:text-center sm:px-16">
                        <p class="font-medium text-white">
                            <span>
                                    Sei in {{app()->environment('local') ? "DEVELOPMENT" : "STAGING"}}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

        @endif
        <div>
            <nav x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-indigo-600">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8"
                                     src="{{session()->get('tenant') ? session()->get('tenant')->profile_photo_url : 'https://tailwindui.com/img/logos/workflow-mark-indigo-300.svg'}}"
                                     alt="Workflow">
                            </div>
                            <div class="hidden md:block">
                                <div class="flex items-baseline ml-10 space-x-4">
                                    @if(auth()->user()->isAbleTo('medical_doctor_permission',session()->get('tenant')->slug))
                                        <x-layout.doctor-menu/>
                                    @else
                                        <x-layout.menu/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="flex items-center ml-4 md:ml-6">
                                <button
                                    class="p-1 text-indigo-200 bg-indigo-600 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white">
                                    <span class="sr-only">View notifications</span>
                                    <svg class="w-6 h-6" x-description="Heroicon name: bell"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                </button>

                                <!-- Profile dropdown -->
                                <div @click.away="open = false" class="relative ml-3" x-data="{ open: false }">
                                    <div>
                                        <button @click="open = !open"
                                                class="flex items-center max-w-xs text-sm text-white bg-indigo-600 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white"
                                                id="user-menu" aria-haspopup="true" x-bind:aria-expanded="open"
                                                aria-expanded="true">
                                            <span class="sr-only">Open user menu</span>
                                            <img class="w-8 h-8 rounded-full"
                                                 src="{{ Auth::user()->profile_photo_url }}"
                                                 alt="{{ Auth::user()->name }}">
                                        </button>
                                    </div>
                                    <div x-cloak x-show="open"
                                         x-description="Profile dropdown panel, show/hide based on dropdown state."
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                         class="absolute right-0 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                                         role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                        <x-layout.profile-dropdown/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex -mr-2 md:hidden">
                            <!-- Mobile menu button -->
                            <button @click="open = !open"
                                    class="inline-flex items-center justify-center p-2 text-indigo-200 bg-indigo-600 rounded-md hover:text-white hover:bg-indigo-500 hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white"
                                    x-bind:aria-expanded="open">
                                <span class="sr-only">Open main menu</span>
                                <svg x-state:on="Menu open" x-state:off="Menu closed"
                                     :class="{ 'hidden': open, 'block': !open }" class="block w-6 h-6"
                                     x-description="Heroicon name: menu" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                <svg x-state:on="Menu open" x-state:off="Menu closed"
                                     :class="{ 'hidden': !open, 'block': open }" class="hidden w-6 h-6"
                                     x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div x-cloak x-description="Mobile menu, toggle classes based on menu state." x-state:on="Open"
                     x-state:off="closed" :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                        <x-layout.menu :mobile="true"/>
                    </div>
                    <div class="pt-4 pb-3 border-t border-indigo-700">
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <img class="w-10 h-10 rounded-full"
                                     src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-white">{{Auth::user()->name}}</div>
                                <div class="text-sm font-medium text-indigo-300">{{Auth::user()->email}}</div>
                            </div>
                            <button
                                class="flex-shrink-0 p-1 ml-auto text-indigo-200 bg-indigo-600 border-2 border-transparent rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white">
                                <span class="sr-only">View notifications</span>
                                <svg class="w-6 h-6" x-description="Heroicon name: bell"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="px-2 mt-3 space-y-1">
                            <x-layout.profile-dropdown :mobile="true"/>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- This example requires Tailwind CSS v2.0+ -->


            <header class="bg-white shadow">

                <div class="flex px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
                {{$header}}

                <!-- This example requires Tailwind CSS v2.0+ -->


                </div>
            </header>
            <main>
                @impersonating
                <div class="relative bg-indigo-600">
                    <div class="px-3 py-3 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="pr-16 sm:text-center sm:px-16">
                            <p class="font-medium text-white">
        <span>
          Stai impersonando {{auth()->user()->name}}
        </span>
                                <span class="block sm:ml-2 sm:inline-block">
          <a href="{{ route('impersonate.leave') }}" class="font-bold text-white underline"> Lascia <span
                  aria-hidden="true">&rarr;</span></a>
        </span>
                            </p>
                        </div>

                    </div>
                </div>
                @endImpersonating
                <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{$slot}}
                </div>
            </main>
        </div>

    </div>
</div>
<div style="clear: both; display: block; height: 0px;"/>

@stack('modals')


<script>
    window.addEventListener('danavatar:scroll-to', (ev) => {
        ev.stopPropagation();

        const selector = ev?.detail?.query;
        if (!selector) {
            return;
        }

        const el = window.document.querySelector(selector);
        if (!el) {
            return;
        }

        try {

            el.scrollIntoView({
                behavior: 'smooth',
            });
        } catch {
        }

    }, false);

    window.addEventListener('scrollToTop', event => {
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
</script>
</body>
</html>
