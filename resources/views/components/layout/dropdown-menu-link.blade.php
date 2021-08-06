@props(['active','mobile','firstlevel','dropdown'])

<!-- Current: "bg-indigo-700 text-white", Default: "text-white hover:bg-indigo-500 hover:bg-opacity-75" -->

@php
    $classes = ($active ?? false)
                ? 'bg-indigo-700 text-white px-3 py-2 rounded-md text-sm font-medium inline-flex items-center text-base'
                : 'text-white hover:bg-indigo-500 hover:bg-opacity-75 px-3 py-2 rounded-md text-sm font-medium inline-flex items-center text-base';
    if ($mobile)
        $classes.=" block";
@endphp

<!-- This example requires Tailwind CSS v2.0+ -->
<div x-data="{ isOpen: false }" class="relative">
    <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
    <button type="button" class="{{$classes}}" aria-expanded="false" @click="isOpen = !isOpen">
      <span>{{$firstlevel}}</span>
      <!--
        Heroicon name: solid/chevron-down

        Item active: "text-gray-600", Item inactive: "text-gray-400"
      -->
      <svg class="w-5 h-5 ml-2 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
      </svg>
    </button>

    <!--
      Flyout menu, show/hide based on flyout menu state.

      Entering: "transition ease-out duration-200"
        From: "opacity-0 translate-y-1"
        To: "opacity-100 translate-y-0"
      Leaving: "transition ease-in duration-150"
        From: "opacity-100 translate-y-0"
        To: "opacity-0 translate-y-1"
    -->
    <div
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-1"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-1"
    @click.away="isOpen = false"
    class="absolute z-10 w-screen max-w-xs px-2 mt-3 transform -translate-x-1/2 left-1/2 sm:px-0">
      <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
        <div class="relative grid gap-6 px-5 py-6 bg-white sm:gap-8 sm:p-8">
            @foreach ($dropdown as $secondlevel)
                <a href="{{$secondlevel['href']}}" class="block p-3 -m-3 transition duration-150 ease-in-out rounded-md hover:bg-gray-50">
                    <p class="text-base font-medium text-gray-900">
                    {{$secondlevel['label']}}
                    </p>
                </a>
            @endforeach

        </div>
      </div>
    </div>
  </div>

