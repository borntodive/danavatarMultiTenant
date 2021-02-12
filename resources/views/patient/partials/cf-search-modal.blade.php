<div x-cloak x-data="{ open: @entangle('showCFCalculation') }" x-init="
    () => document.body.classList.add('overflow-hidden');
    $watch('open', value => {
      if (value === true) { document.body.classList.add('overflow-hidden') }
      else { document.body.classList.remove('overflow-hidden') }
    });" x-show="open" class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="open" x-description="Background overlay, show/hide based on modal state." x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
        <div x-show="open" x-description="Modal panel, show/hide based on modal state." x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                <button @click="open = false" type="button" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" x-description="Heroicon name: outline/x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="#" wire:submit.prevent="createCF()"
                  class="w-full ">

                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            Crea il codice fiscale
                        </h3>
                        <div class="mt-2 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                            <div>
                                <x-form.text-input label="Nome" wire:model="calcCF.firstname"/>
                            </div>
                            <div>
                                <x-form.text-input label="Cognome" wire:model="calcCF.lastname"/>

                            </div>
                            <div>
                                <x-form.label>Sesso</x-form.label>
                                <select id="calcCF.gender" wire:model="calcCF.gender" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option></option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                                @error('calcCF.gender')
                                <p wire:key="error_calcCF.gender"
                                   class="mt-2 text-sm text-red-600" id="email-error">{{$message}}</p>
                                @enderror
                            </div>
                            <div>
                                <x-form.label>Data di Nascita</x-form.label>
                                <x-form.masked-date-input
                                    wire:model="calcCF.dob"
                                    :min="1900-01-01"
                                    :max="now()->format('Y-m-d')"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <x-form.label>Comune di Nascita (Seleziona dalla lista)</x-form.label>
                                <input type="text"  placeholder="Seleziona dalla lista" wire:model.debounce.200ms="searchedCity" id="searched_city" class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                @if(count($foundCities)>0)
                                <ul class="overflow-y-auto h-52 divide-y divide-gray-200 border border-gray-200 mt-1 p-3 rounded-md">
                                    @foreach($foundCities as $code=>$city)
                                    <li wire:click="selectCity('{{$code}}')" class="py-4 flex">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{\Illuminate\Support\Str::title($city)}}</p>
                                            <p class="text-sm text-gray-500">{{$code}}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                                @error('calcCF.birth_place')
                                <p wire:key="error_calcCF.birth_place"
                                   class="mt-2 text-sm text-red-600" id="email-error">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="sm:col-span-2 float-right">
                                <button type="submit"
                                        class="float-right inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                                    Crea
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
