<x-form.card title="{{ __('Dati biometrici') }}">
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
        <x-form.text-input id="height" name="state.height" wire:model="state.height" label="{{ __('Altezza (cm)') }}"
                           autocomplete="height"/>
    </div>
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
        <x-form.text-input id="weight" name="weight" wire:model.lazy="state.weight" label="{{ __('Peso (kg)') }}"
                           autocomplete="weight"/>
    </div>
</x-form.card>
<x-form.card class="mt-3" title="{{ __('Dati anamnestici') }}">
    <div class="w-full">
        <div class="relative mb-5">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-start">
                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                  {{__('Condizioni mediche')}}
                </span>
            </div>
        </div>
        <div class="xl:flex lg:flex md:flex flex-wrap justify-between">
            <div class="xl:w-2/6 lg:w-2/6 md:w-2/6 flex flex-col mb-6 px-2 -ml-2">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-6">
                    </div>
                    <div class="col-span-3 text-center">
                        {{ __('Presente') }}
                    </div>
                    <div class="col-span-3 text-center">
                        {{ __('Passato') }}
                    </div>
                </div>
            </div>
            <div class="hidden md:block xl:w-2/6 lg:w-2/6 md:w-2/6 flex flex-col mb-6 px-2 -ml-2">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-6">
                    </div>
                    <div class="col-span-3 text-center">
                        {{ __('Presente') }}
                    </div>
                    <div class="col-span-3 text-center">
                        {{ __('Passato') }}
                    </div>
                </div>
            </div>
            <div class="hidden md:block xl:w-2/6 lg:w-2/6 md:w-2/6 flex flex-col mb-6 px-2 -ml-2">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-6">
                    </div>
                    <div class="col-span-3 text-center">
                        {{ __('Presente') }}
                    </div>
                    <div class="col-span-3 text-center">
                        {{ __('Passato') }}
                    </div>
                </div>
            </div>


            @foreach($medicalConditions as $name=>$displayName)
                <div class="xl:w-2/6 lg:w-2/6 md:w-2/6 flex flex-col mb-6 px-2 -ml-2">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-6 text-sm font-medium text-gray-900">
                            {{$displayName}}
                        </div>
                        <div class="col-span-3 text-center">
                            <x-form.checkbox value="1" id="anamnesisData_{{$name}}_present"
                                             wire:model.lazy="state.anamnesisData.{{$name}}.present"/>
                        </div>
                        <div class="col-span-3 text-center">
                            <x-form.checkbox value="1" id="anamnesisData_{{$name}}_past"
                                             wire:model.lazy="state.anamnesisData.{{$name}}.past"/>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="w-full">
        <div class="relative mb-5">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-start">
                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                </span>
            </div>
        </div>
        <div class="max-w-xl w-full -mx-auto">
            <div class="flex items-center justify-between">
                <span class="flex-grow flex flex-col" id="toggleLabel">
                    <span class="text-sm font-medium text-gray-900">{{ __('Pregresse cardio-vasculopatie?') }}</span>
                </span>
                <button type="button" @click="on = !on" :aria-pressed="on.toString()" aria-pressed="false"
                        aria-labelledby="toggleLabel" x-data="{ on: @entangle('state.prev_cardio') }"
                        :class="{ 'bg-gray-200': !on, 'bg-indigo-600': on }"
                        class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 bg-gray-200">
                    <span class="sr-only">Use setting</span>
                    <span aria-hidden="true" :class="{ 'translate-x-5': on, 'translate-x-0': !on }"
                          class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 translate-x-0"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="w-full mt-5">
        <div class="relative mb-5">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-start">
                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                  {{__('Farmaci')}}
                </span>
            </div>
        </div>
    </div>
</x-form.card>





