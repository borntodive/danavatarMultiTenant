<x-medical-record.common-edit>
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-1/2">
            <x-form.label>Terapia con apparecchio</x-form.label>
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div></div>
                <div>
                    <x-form.label>Presente</x-form.label>
                </div>
                <div>
                    <x-form.label>Passato</x-form.label>
                </div>
                <div>
                    <x-form.label>Sopra</x-form.label>
                </div>
                <div>
                    <x-form.checkbox value="1" id="brace_upper_present"
                                     wire:model.lazy="state.anamnesis.general.brace.upper.present"/>
                </div>
                <div>
                    <x-form.checkbox value="1" id="brace_upper_past"
                                     wire:model.lazy="state.anamnesis.general.brace.upper.past"/>
                </div>
                <div>
                    <x-form.label>Sotto</x-form.label>
                </div>
                <div>
                    <x-form.checkbox value="1" id="brace_upper_present"
                                     wire:model.lazy="state.anamnesis.general.brace.lower.present"/>
                </div>
                <div>
                    <x-form.checkbox value="1" id="brace_upper_past"
                                     wire:model.lazy="state.anamnesis.general.brace.lower.past"/>
                </div>
            </div>
        </div>
        @if(session()->get('tenant')->hasMedicalSpecilities('diving'))
            <div class="grid grid-cols-12 gap-8 mt-5 w-full">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.label>Livello di compensazione percepito</x-form.label>
                    <x-form.select id="equalization_level"
                                   wire:model="state.anamnesis.diving.equalization.level"
                                   :options="$equalizationLevel"
                    />
                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.label>Tipo di compensanzione maggiormente usata</x-form.label>
                    <x-form.select id="equalization_tecnique"
                                   wire:model="state.anamnesis.diving.equalization.tecnique"
                                   :options="$equalizationTecnique"
                    />
                    @if(data_get($state,'anamnesis.diving.equalization.tecnique',false) == "4")
                        <x-form.text-input class="mt-2" wire:model="state.anamnesis.diving.equalization.tecnique.other"
                                           label="Specifica"/>
                    @endif
                </div>
            </div>

        @endif
    </x-card>
    <x-card title="{{ __('Esami Obiettivi') }}" class="mt-5">
        <div class="grid grid-cols-12 gap-8 w-full">
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.label>Classe di Angle</x-form.label>
                <div class="md:w-full flex flex-row mt-3">
                    <div class="w-1/2"><input wire:model="state.exams.objectives.angle" name="angle" type="radio"
                                              value="1"/> 1° Classe
                    </div>
                    <div class="w-1/2"><input wire:model="state.exams.objectives.angle" name="angle" type="radio"
                                              value="2"/> 2° Classe
                    </div>
                    <div class="w-1/2"><input wire:model="state.exams.objectives.angle" name="angle" type="radio"
                                              value="3"/> 3° Classe
                    </div>
                </div>
            </div>
            @if(data_get($state,'exams.objectives.angle',false) == "2")
                <div class="col-span-12 sm:col-span-6 ">
                    <x-form.label>Divisione</x-form.label>
                    <div class="md:w-full flex flex-row mt-3">
                        <div class="w-1/2"><input wire:model="state.exams.objectives.angle.division" name="division"
                                                  type="radio" value="1"/> 1° Divisione
                        </div>
                        <div class="w-1/2"><input wire:model="state.exams.objectives.angle.division" name="division"
                                                  type="radio" value="2"/> 2° Divisione
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.label>Classe di Gravità</x-form.label>
                <div class="md:w-full flex flex-row mt-3">
                    <div class="w-1/2"><input wire:model="state.exams.objectives.gravity" name="gravity" type="radio"
                                              value="1"/> 1° Grado
                    </div>
                    <div class="w-1/2"><input wire:model="state.exams.objectives.gravity" name="gravity" type="radio"
                                              value="2"/> 2° Grado
                    </div>
                    <div class="w-1/2"><input wire:model="state.exams.objectives.gravity" name="gravity" type="radio"
                                              value="3"/> 3° Grado
                    </div>
                </div>
            </div>
        </div>
    </x-card>
    <x-card title="{{ __('Esami Strumentali') }}" class="mt-5">
        <div class="grid grid-cols-12 gap-8 w-full">
            <div class="col-span-12 sm:col-span-6 ">

                <x-form.text-area
                    label="Livello compensazione misurato"
                    wire:model="state.exams.instrumental.equalization.level">

                </x-form.text-area>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.masked-date-input
                    label="Impronta dentale"
                    wire:model="state.exams.instrumental.dentalImpressions"
                />
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <div class="flex flex-col content-center">
                    <x-form.toggle
                        entangle="state.exams.instrumental.orthopantomography"
                        label="Ortopantomografia"
                    />
                    @if(data_get($state,'exams.instrumental.orthopantomography',false))
                        <x-form.text-area
                            class="mt-5 w-full"
                            wire:model="state.exams.instrumental.orthopantomography.data"
                        />
                    @endif
                </div>

            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <div class="flex flex-col content-center">
                    <x-form.toggle
                        entangle="state.exams.instrumental.rx"
                        label="Rx latero-laterale"
                    />
                    @if(data_get($state,'exams.instrumental.rx',false))
                        <x-form.text-area
                            class="mt-5 w-full"
                            wire:model="state.exams.instrumental.rx.data"
                        />
                    @endif
                </div>

            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.text-area
                    label="Dati cefalometrici"
                    wire:model="state.exams.instrumental.cephalometry">
                </x-form.text-area>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.text-area
                    label="Morfologia viso e orale"
                    wire:model="state.exams.instrumental.morphology">
                </x-form.text-area>
            </div>
        </div>
    </x-card>

</x-medical-record.common-edit>








