<x-card title="{{ __('Dati biometrici') }}">
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
        <x-form.text-input wire:model="state.height" label="{{ __('Altezza (cm)') }}"
                           autocomplete="height"/>
    </div>
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
        <x-form.text-input wire:model="state.weight" label="{{ __('Peso (kg)') }}"
                           autocomplete="weight"/>
    </div>
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
                            <span class="text-sm font-medium text-gray-900">{{ $medicalCondition['name'] }}</span>
                            @if(!empty($medicalCondition['more'] ) && (!empty($state['anamnesisData'][$fieldName]['present']) || !empty($state['anamnesisData'][$fieldName]['past'])))
                            <x-form.text-input wire:model="state.anamnesisData.{{$fieldName}}.moredata"/>
                            @endif

                        </div>
                        <div class="col-span-3 text-center flex flex-wrap content-center">
                            @if($medicalCondition['present'])
                            <x-form.checkbox  value="1" id="anamnesisData_{{$fieldName}}_present"
                                             wire:model.lazy="state.anamnesisData.{{$fieldName}}.present"/>
                            @endif
                        </div>
                        <div class="col-span-3 text-center flex flex-wrap content-center">
                            @if($medicalCondition['past'])
                            <x-form.checkbox value="1" id="anamnesisData_{{$fieldName}}_past"
                                             wire:model.lazy="state.anamnesisData.{{$fieldName}}.past"/>
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
                <div class="col-span-6 text-center">
                    Nome Farmaco
                </div>
                @foreach($chunk as $fieldName=>$displayName)
                    <div class="col-span-6 flex items-center">
                        <x-form.label>{{ $displayName }}</x-form.label>

                    </div>
                    <div class="col-span-6">
                        <x-form.text-input class="w-full" wire:model="state.medications.{{$fieldName}}"
                                           autocomplete="{{$fieldName}}"/>
                    </div>
                @endforeach

            </div>
            @endforeach
        </div>
    </div>
</x-card>





