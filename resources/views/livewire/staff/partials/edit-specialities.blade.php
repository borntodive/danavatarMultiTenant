@if($userToBeUpdated)
<div x-cloak x-data="{ open: @entangle('isSideVisible') }" @keydown.window.escape="open = false;" x-show="open" class="fixed inset-0 overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <section @click.away="open = false;" class="absolute inset-y-0 right-0 pl-10 max-w-full flex sm:pl-16" aria-labelledby="slide-over-heading">
            <div class="w-screen max-w-md" x-description="Slide-over panel, show/hide based on slide-over state." x-show="open" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                <div class="h-full flex flex-col bg-white shadow-xl overflow-y-scroll">
                    <div class="p-6 border-b-4 border-gray-500 border-opacity-0">
                        <div class="flex items-start justify-between">
                            <h2 id="slide-over-heading" class="text-lg font-medium text-gray-900">
                                Specialità di {{($userToBeUpdated) ? $userToBeUpdated->name : ''}}
                            </h2>
                            <div class="ml-3 h-7 flex items-center">
                                <button @click="open = false;" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500">
                                    <span class="sr-only">Close panel</span>
                                    <svg class="h-6 w-6" x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <ul class="divide-y divide-gray-200 overflow-y-auto">
                        @forelse($availableSpeciaties as $specialty)
                        <li class="px-6 py-5 relative">
                            <div class="group flex justify-between items-center">
                                <a wire:click.prevent="toggleSpecialty({{$specialty->id}})" href="#" class="-m-1 p-1 block">
                                    <div class="absolute inset-0 group-hover:bg-gray-50" aria-hidden="true"></div>
                                    <div class="flex-1 flex items-center min-w-0 relative">
                                        <span class="flex-shrink-0 inline-block relative">
                                          <img class="h-10 w-10 rounded-full" src="{{$specialty->avatar()}}" alt="">
                                          <span class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white {{($selectedSpeciality->search($specialty->id) !== false) ? 'bg-green-400' : 'bg-red-400'}}" aria-hidden="true"></span>
                                        </span>
                                        <div class="ml-4 truncate">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{$specialty->name}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                        @empty
                            <p> No Specialità</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>
@endif
