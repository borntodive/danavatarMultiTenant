@props([
    'center'
]);
<div>
<div x-cloak x-data="{ open: @entangle('showCreateUserModal') }" x-show="open" @keydown.window.escape="open = false; " class="fixed inset-0 overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <section @click.away="open = false; " class="absolute inset-y-0 right-0 pl-10 max-w-full flex sm:pl-16" aria-labelledby="slide-over-heading">
            <div class="w-screen max-w-2xl" x-description="Slide-over panel, show/hide based on slide-over state." x-show="open" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                <form class="h-full flex flex-col bg-white shadow-xl overflow-y-scroll">
                    <div class="flex-1">
                        <!-- Header -->
                        <div class="px-4 py-6 bg-gray-50 sm:px-6">
                            <div class="flex items-start justify-between space-x-3">
                                <div class="space-y-1">
                                    <h2 id="slide-over-heading" class="text-lg font-medium text-gray-900">
                                        Invita nuovo utente
                                    </h2>
                                </div>
                                <div class="h-7 flex items-center">
                                    <button @click="open = false; " class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <span class="sr-only">Close panel</span>
                                        <svg class="h-6 w-6" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Divider container -->
                        <div class="py-6 space-y-6 sm:py-0 sm:space-y-0 sm:divide-y sm:divide-gray-200 mt-5">
                            <livewire:patient.index :tenant="$center"/>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="flex-shrink-0 px-4 border-t border-gray-200 py-5 sm:px-6">
                        <div class="space-x-3 flex justify-end">
                            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
</div>
