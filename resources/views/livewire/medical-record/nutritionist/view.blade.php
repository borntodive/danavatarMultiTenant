<x-medical-record.common-view :medicalRecord="$medicalRecord">
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full -mt-5">
            <x-section-heading>
                {{__('Morfologica')}}
            </x-section-heading>
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>{{ __('Altezza (cm)') }}</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.height','N/A')}}</x-show.value>
                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>{{ __('Peso (kg)') }}</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.weight','N/A')}}</x-show.value>
                </div>
            </div>
            <x-section-heading>
                {{__('Generale')}}
            </x-section-heading>
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>Tipo di lavoro</x-show.label>
                    <x-show.value>{{__('nutrizionist.'.data_get($medicalRecord->data,'anamnesis.general.jobType','na'))}}</x-show.value>
                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>Caratteristiche</x-show.label>
                    <x-show.value>{{__('nutrizionist.'.data_get($medicalRecord->data,'anamnesis.general.jobPeculiarity','na'))}}</x-show.value>
                </div>
            </div>
            <x-section-heading>
                {{__('Sportiva')}}
            </x-section-heading>
            @forelse(data_get($medicalRecord->data,'anamnesis.general.sports',[]) as $idx=>$sport)
                <div class="border border-gray-500 rounded-md mb-3 p-5">
                    <div class="grid grid-cols-12 gap-8">
                        <div class="col-span-12 sm:col-span-6 ">
                            <x-show.label>{{__('Sport praticato')}}</x-show.label>
                            <x-show.value>{{data_get($sport,'name','na')}}</x-show.value>
                        </div>
                        <div class="col-span-12 sm:col-span-6 ">
                            <x-show.label>Livello</x-show.label>
                            <x-show.value>{{__('nutrizionist.'.data_get($sport,'level','na'))}}</x-show.value>
                        </div>
                        <div class="col-span-12 sm:col-span-6 ">
                            <x-show.label>Quante ore/settimana</x-show.label>
                            <x-show.value>{{__('nutrizionist.sportTime.'.data_get($sport,'time','na'))}}</x-show.value>
                        </div>
                        <div class="col-span-12 sm:col-span-6 ">
                            <x-show.label>Preferenze orario di allenamento</x-show.label>
                            <div class="flex flex-rows">
                                @forelse(data_get($sport,'hrs',[]) as $hrs)
                                    <x-show.value class="mr-2">
                                        {{__('nutrizionist.sportHrs.'.$hrs)}}
                                    </x-show.value>
                                @empty
                                    <x-show.value>
                                        {{__('nutrizionist.na')}}
                                    </x-show.value>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="grid grid-cols-12 gap-8 mt-3">
                    <div class="col-span-12  ">
                        <x-form.label>Tempo di inattività</x-form.label>
                        <x-show.value>{{__('nutrizionist.'.data_get($medicalRecord->data,'anamnesis.general.sportsInactivity','na'))}}</x-show.value>
                    </div>
                </div>
            @endforelse
            <x-section-heading>
                {{__('Clinica')}}
            </x-section-heading>

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
                                @if(data_get($medicalRecord->data,'anamnesis.general.medicalConditions.'.$fieldName.'.moredata',false))
                                    <x-show.value>
                                        {{data_get($medicalRecord->data,'anamnesis.general.medicalConditions.'.$fieldName.'.moredata',__('nutrizionist.na'))}}
                                    </x-show.value>
                                @endif

                            </div>
                            <div class="col-span-3 text-center flex flex-wrap content-center">
                                @if($medicalCondition['present'])
                                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.medicalConditions.'.$fieldName.'.present',false)"/>
                                @endif
                            </div>
                            <div class="col-span-3 text-center flex flex-wrap content-center">
                                @if($medicalCondition['past'])
                                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.medicalConditions.'.$fieldName.'.past',false)"/>
                                @endif
                            </div>
                        @endforeach

                    </div>
                @endforeach
            </div>

            <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 pt-6 gap-8">

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
                                <x-show.value>
                                    {{data_get($medicalRecord->data,'anamnesis.general.medications.'.$fieldName,'')}}
                                </x-show.value>
                            </div>
                        @endforeach

                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-12 gap-8 mt-5">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>{{ __('Traumi (Fratture, lesioni, incidenti) ') }}</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.trauma','N/A')}}</x-show.value>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-8 mt-5">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>Fumatore</x-show.label>
                    <x-show.value>{{__('nutrizionist.'.data_get($medicalRecord->data,'anamnesis.general.smoker','na'))}}</x-show.value>
                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>Alcolici / superalcolici</x-show.label>
                    <x-show.value>{{__('nutrizionist.'.data_get($medicalRecord->data,'anamnesis.general.alchol','na'))}}</x-show.value>
                </div>
            </div>

            <x-section-heading>
                {{__('Alimentare')}}
            </x-section-heading>

            <div class="grid grid-cols-12 gap-8 mt-5">
                <div class="col-span-12">
                    <x-show.label>{{ __('Indica eventuali Diete attuali o passate che hai praticato.') }}</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.diet','N/A')}}</x-show.value>
                </div>
                <div class="col-span-12">
                    <x-show.label>{{__('Indicare eventuali intolleranze alimentari o allergie diagnosticate.') }}</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.allergy','N/A')}}</x-show.value>
                </div>
                <div class="col-span-12">
                    <x-show.label>{{__('Issumi integratori alimentari? quali?') }}</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.supplement','N/A')}}</x-show.value>
                </div>

            </div>

        </div>
    </x-card>
</x-medical-record.common-view>
