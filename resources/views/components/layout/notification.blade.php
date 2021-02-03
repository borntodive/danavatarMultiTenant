@props(
    [
        'type'=>'success',
        'message'=>'',
    ]
    )
<div x-data="{ show: true }" x-show="show"
     x-init="setTimeout(function(){ show = false; $wire.messages=[]}, 3000)"
         x-description="Notification panel, show/hide based on alert state."
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden absolute right-2 top-4 z-50">
        <div class="p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    @if($type=='success')
                        <svg class="h-6 w-6 text-green-400" x-description="Heroicon name: check-circle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @elseif($type=='error')
                        <svg class="h-6 w-6 text-red-400" x-description="Heroicon name: check-circle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @endif
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900">
                        @if($type=='success')
                            {{__('Ottimo!!!')}}
                        @elseif($type=='error')
                            {{__('Oooops!!!')}}
                        @endif
                    </p>
                    <p class="mt-1 text-sm text-gray-500">
                        {{$message}}
                    </p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="function(){ show = false; $wire.messages=[]}" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>


