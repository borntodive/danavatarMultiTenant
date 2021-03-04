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
                            @if(!empty($medicalCondition['more'] ) && (!empty($state['anamnesisData'][$fieldName]['present']) || !empty($state['anamnesisData'][$fieldName]['past'])))
                                <x-form.text-input wire:model="state.anamnesisData.{{$fieldName}}.moredata"/>
                            @endif

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
