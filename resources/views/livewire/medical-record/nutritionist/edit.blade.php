<x-medical-record.common-edit>
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full -mt-5">
            <x-section-heading>
                {{__('Morfologica')}}
            </x-section-heading>
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.text-input type="number" wire:model="state.anamnesis.general.height" label="{{ __('Altezza (cm)') }}"
                                       autocomplete="height"/>
                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.text-input type="number" wire:model="state.anamnesis.general.weight" label="{{ __('Peso (kg)') }}"
                                       autocomplete="weight"/>
                </div>
            </div>
            <x-section-heading>
                {{__('Generale')}}
            </x-section-heading>
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.label>Tipo di lavoro</x-form.label>
                    <div class="md:w-full flex flex-row mt-3">
                        <div class="w-1/2"><input wire:model="state.anamnesis.general.jobType" name="jobType" type="radio" value="sedentary" /> Sedenatrio</div>
                        <div class="w-1/2"><input wire:model="state.anamnesis.general.jobType" name="jobType" type="radio" value="active" /> Attivo</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.label>Caratteristiche</x-form.label>
                    <div class="md:w-full flex flex-row mt-3">
                        <div class="w-1/2"><input wire:model="state.anamnesis.general.jobPeculiarity" name="jobPeculiarity" type="radio" value="fixed" /> Orari Fissi</div>
                        <div class="w-1/2"><input wire:model="state.anamnesis.general.jobPeculiarity" name="jobPeculiarity" type="radio" value="shifts" /> Turni</div>
                    </div>
                </div>

            </div>
            <x-section-heading>
                {{__('Sportiva')}}
            </x-section-heading>
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.toggle entangle="doSports" label="Pratichi attività sportiva?"/>
                </div>
            </div>
            @if($doSports)
                <div>
                    <div class="px-4 py-3 text-right sm:px-6">
                        <button type="button" wire:click.prevent="addSport" class="bg-gray-800 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                            Aggiungi Sport
                        </button>
                    </div>
                    @foreach($this->state['general']['sports'] as $idx=>$sport)
                        <div class="border border-gray-500 rounded-md mb-3 p-5">
                            <div class="grid grid-cols-12 gap-8">
                                <div class="col-span-12 sm:col-span-6 ">
                                    <x-form.text-input type="text" wire:model="state.anamnesis.general.sports.{{$loop->index}}.name" label="{{ __('Sport praticato') }}"/>
                                </div>
                                <div class="col-span-12 sm:col-span-6 ">
                                    <x-form.label>Livello</x-form.label>
                                    <div class="md:w-full flex flex-row mt-3">
                                        <div class="w-1/3"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.level"  type="radio" value="agonistic" /> Agonistico</div>
                                        <div class="w-1/3"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.level"  type="radio" value="amateur" /> Amatoriale</div>
                                        <div class="w-1/3"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.level"  type="radio" value="occasional" /> Saltuario</div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 ">
                                    <x-form.label>Quante ore/settimana</x-form.label>
                                    <div class="md:w-full flex flex-row mt-3">
                                        <div class="w-1/4"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.time"  type="radio" value="1" /> < 1 ora</div>
                                        <div class="w-1/4"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.time"  type="radio" value="2" /> 1-2 ore</div>
                                        <div class="w-1/4"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.time"  type="radio" value="3" /> 3-6 ore</div>
                                        <div class="w-1/4"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.time"  type="radio" value="6" /> 6+ ore</div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 ">
                                    <x-form.label>Preferenze orario di allenamento</x-form.label>
                                    <div class="md:w-full flex flex-row mt-3">
                                        <div class="w-1/4"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.hrs"  type="checkbox" value="8" /> 08:00-12:00</div>
                                        <div class="w-1/4"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.hrs"  type="checkbox" value="12" /> 12:00-15:00</div>
                                        <div class="w-1/4"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.hrs"  type="checkbox" value="15" /> 15:00-18:00</div>
                                        <div class="w-1/4"><input wire:model="state.anamnesis.general.sports.{{$loop->index}}.hrs"  type="checkbox" value="18" /> 18:00-20:00</div>
                                    </div>
                                </div>
                                <div class="col-span-12 text-right">
                                    <button type="button" wire:click.prevent="deleteSport({{$idx}})" class="bg-red-800 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-900">
                                        Cancella
                                    </button>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-12 gap-8 mt-3">
                    <div class="col-span-12  ">
                        <x-form.label>Tempo di inattività</x-form.label>
                        <div class="md:w-full flex flex-row mt-3">
                            <div class="w-1/4"><input wire:model="state.anamnesis.general.sportsInactivity"  type="radio" value="always" /> Da sempre</div>
                            <div class="w-1/4"><input wire:model="state.anamnesis.general.sportsInactivity"  type="radio" value="years" /> 2+ anni</div>
                            <div class="w-1/4"><input wire:model="state.anamnesis.general.sportsInactivity"  type="radio" value="months" /> 6+mesi</div>
                            <div class="w-1/4"><input wire:model="state.anamnesis.general.sportsInactivity"  type="radio" value="weeks" /> Qualche settimana</div>
                        </div>
                    </div>
                </div>
            @endif

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
                                @if(!empty($medicalCondition['more'] ) && (!empty($state['general']['medicalConditions'][$fieldName]['present']) || !empty($state['general']['medicalConditions'][$fieldName]['past'])))
                                    <x-form.text-input wire:model="state.anamnesis.general.medicalConditions.{{$fieldName}}.moredata"/>
                                @endif

                            </div>
                            <div class="col-span-3 text-center flex flex-wrap content-center">
                                @if($medicalCondition['present'])
                                    <x-form.checkbox  value="1" id="medicalConditions{{$fieldName}}_present"
                                                      wire:model.lazy="state.anamnesis.general.medicalConditions.{{$fieldName}}.present"/>
                                @endif
                            </div>
                            <div class="col-span-3 text-center flex flex-wrap content-center">
                                @if($medicalCondition['past'])
                                    <x-form.checkbox value="1" id="medicalConditions{{$fieldName}}_past"
                                                     wire:model.lazy="state.anamnesis.general.medicalConditions.{{$fieldName}}.past"/>
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
                                <x-form.text-input class="w-full" wire:model="state.anamnesis.general.medications.{{$fieldName}}"
                                                   autocomplete="{{$fieldName}}"/>
                            </div>
                        @endforeach

                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-12 gap-8 mt-5">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.text-input type="text" wire:model="state.anamnesis.general.trauma" label="{{ __('Traumi (Fratture, lesioni, incidenti) ') }}"/>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-8 mt-5">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.label>Fumatore</x-form.label>
                    <div class="md:w-full flex flex-row mt-3">
                        <div class="w-1/3"><input wire:model="state.anamnesis.general.smoker" name="smoker" type="radio" value="0" /> Mai</div>
                        <div class="w-1/3"><input wire:model="state.anamnesis.general.smoker" name="smoker" type="radio" value="5" /> Meno di 5</div>
                        <div class="w-1/3"><input wire:model="state.anamnesis.general.smoker" name="smoker" type="radio" value="20" /> 6-20+</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.label>Alcolici / superalcolici</x-form.label>
                    <div class="md:w-full flex flex-row mt-3">
                        <div class="w-1/3"><input wire:model="state.anamnesis.general.alchol" name="alchol" type="radio" value="never" /> Mai</div>
                        <div class="w-1/3"><input wire:model="state.anamnesis.general.alchol" name="alchol" type="radio" value="weekend" /> Nel weekend</div>
                        <div class="w-1/3"><input wire:model="state.anamnesis.general.alchol" name="alchol" type="radio" value="everyDay" /> Tutti i giorni</div>
                    </div>
                </div>
            </div>

            <x-section-heading>
                {{__('Alimentare')}}
            </x-section-heading>

            <div class="grid grid-cols-12 gap-8 mt-5">
                <div class="col-span-12">
                    <x-form.text-area  wire:model="state.anamnesis.general.diet" label="{{ __('Indica eventuali Diete attuali o passate che hai praticato.') }}"/>
                </div>
                <div class="col-span-12">
                    <x-form.text-area  wire:model="state.anamnesis.general.allergy" label="{{ __('Indicare eventuali intolleranze alimentari o allergie diagnosticate.') }}"/>
                </div>
                <div class="col-span-12">
                    <x-form.text-area  wire:model="state.anamnesis.general.allergy" label="{{ __('Assumi integratori alimentari? quali?') }}"/>
                </div>

            </div>



        </div>
    </x-card>
</x-medical-record.common-edit>







