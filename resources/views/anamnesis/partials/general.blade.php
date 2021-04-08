<x-card title="{{ __('Dati biometrici') }}">
    <dl class="w-full grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
            <x-show.label>{{ __('Altezza (cm)') }}</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'general.height')}}</x-show.value>
        </div>
        <div class="sm:col-span-1">
            <x-show.label>{{ __('Peso') }}</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'general.weight')}}</x-show.value>
        </div>

    </dl>
</x-card>
<x-card class="mt-3" title="{{ __('Dati anamnestici') }}">
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
        <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-3 pt-6 gap-8">
            @foreach(array_chunk($medicalConditions, floor(count($medicalConditions)/3),true) as $chunk)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-6">

                    </div>
                    <div class="col-span-3 text-center">
                        {{ __('Presente') }}
                    </div>
                    <div class="col-span-3 text-center">
                        {{ __('Passato') }}
                    </div>

                    @foreach($chunk as $fieldName=>$medicalCondition)

                        <div class="col-span-6 flex flex-col" x-data="{show: false}">
                            <x-show.label>{{ $medicalCondition['name'] }}</x-show.label>
                            <x-show.label>{{ data_get($anamnesis->data,'general.anamnesisData.'.$fieldName.'.moredata',false)}}</x-show.label>

                        </div>
                        <div class="col-span-3 text-center flex flex-wrap justify-center">
                            @if($medicalCondition['present'])
                                <x-check-or-cross :condition="data_get($anamnesis->data,'general.anamnesisData.'.$fieldName.'.present',false)"/>
                            @endif
                        </div>
                        <div class="col-span-3 text-center flex flex-wrap justify-center">
                            @if($medicalCondition['past'])
                                <x-check-or-cross :condition="data_get($anamnesis->data,'general.anamnesisData.'.$fieldName.'.past',false)"/>

                            @endif
                        </div>
                    @endforeach

                </div>
            @endforeach
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
        <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 pt-6 gap-8">
            <!-- Remove class [ h-24 ] when adding a card block -->
            <!-- Remove class [ border-gray-300 border-dashed border-2 ] to remove dotted border -->

            @foreach(array_chunk($medications, ceil(count($medications)/2),true) as $chunk)
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-6">

                    </div>
                    <div class="col-span-6">
                        Nome Farmaco
                    </div>
                    @foreach($chunk as $fieldName=>$displayName)
                        <div class="col-span-6 flex items-center">
                            <x-show.label>{{ $displayName }}</x-show.label>

                        </div>
                        <div class="col-span-6">
                            <x-show.value>{{data_get($anamnesis->data,'general.medications.'.$fieldName)}}</x-show.value>

                        </div>
                    @endforeach

                </div>
            @endforeach
        </div>
    </div>
</x-card>
<x-card class="mt-3" title="{{ __('Dati Sportivi') }}">

    <div class="mt-3 grid grid-cols-2 gap-8 w-full">
        @forelse(data_get($anamnesis->data,'general.sports',[])  as $idx=>$sport)
            <div class="col-span-2 sm:col-span-1 border border-gray-500 rounded-md mb-3 p-5 mr-2">
                <div class="grid grid-cols-4 gap-8 ">
                    <div class="col-span-4 sm:col-span-2 ">
                        <x-show.label>Sport praticato</x-show.label>
                        <x-show.value>{{data_get($sport,'name','N/A')}}</x-show.value>
                    </div>
                    <div class="col-span-4 sm:col-span-2">
                        <x-show.label>Livello</x-show.label>
                        <x-show.value>{{__('anamnesis.'.data_get($sport,'level','na'))}}</x-show.value>

                    </div>
                </div>

            </div>
        @empty
        <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 col-span-2">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <!-- Heroicon name: solid/exclamation -->
                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Nessuno sport

                        </p>
                    </div>
                </div>
            </div>

        @endforelse
    </div>
</x-card>
