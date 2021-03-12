<x-medical-record.common-view :medicalRecord="$medicalRecord">
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
                    <x-check-or-cross
                        :condition="data_get($medicalRecord->data,'anamnesis.general.brace.upper.present',false)"/>
                </div>
                <div>
                    <x-check-or-cross
                        :condition="data_get($medicalRecord->data,'anamnesis.general.brace.upper.past',false)"/>
                </div>
                <div>
                    <x-form.label>Sotto</x-form.label>
                </div>
                <div>
                    <x-check-or-cross
                        :condition="data_get($medicalRecord->data,'anamnesis.general.brace.lower.present',false)"/>

                </div>
                <div>
                    <x-check-or-cross
                        :condition="data_get($medicalRecord->data,'anamnesis.general.brace.lower.past',false)"/>
                </div>
            </div>
        </div>
        @if(session()->get('tenant')->hasMedicalSpecilities('diving'))
            <div class="grid grid-cols-12 gap-8 mt-5 w-full">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-view.label>Livello di compensazione percepito</x-view.label>
                    <x-show.value>{{data_get($equalizationLevel,data_get($medicalRecord->data,'anamnesis.diving.equalization.level',0),'N/A')}}</x-show.value>
                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-view.label>Tipo di compensanzione maggiormente usata</x-view.label>
                    <x-show.value>{{data_get($equalizationTecnique,data_get($medicalRecord->data,'anamnesis.diving.equalization.tecnique',0),'N/A')}}</x-show.value>
                    @if(data_get($medicalRecord->data,'anamnesis.diving.equalization.tecnique',false) == "4")
                        <x-show.value>{{data_get($medicalRecord->data,'anamnesis.diving.equalization.tecnique.other','N/A')}}</x-show.value>
                    @endif
                </div>
            </div>

        @endif
    </x-card>
    <x-card title="{{ __('Esami Obiettivi') }}" class="mt-5">
        <div class="grid grid-cols-12 gap-8 w-full">
            <div class="col-span-12 sm:col-span-6 ">
                <x-view.label>Classe di Angle</x-view.label>
                <x-show.value>{{__('dentist.angle.'.data_get($medicalRecord->data,'exams.objectives.angle','na'))}}</x-show.value>
            </div>
            @if(data_get($medicalRecord->data,'exams.objectives.angle',false) == "2")
                <div class="col-span-12 sm:col-span-6 ">
                    <x-view.label>Divisione</x-view.label>
                    <x-show.value>{{__('dentist.angle.division.'.data_get($medicalRecord->data,'exams.objectives.division','na'))}}</x-show.value>
                </div>
            @endif
            <div class="col-span-12 sm:col-span-6 ">
                <x-view.label>Classe di Gravità</x-view.label>
                <x-show.value>{{__('dentist.gravity.'.data_get($medicalRecord->data,'exams.objectives.gravity','na'))}}</x-show.value>
            </div>
        </div>
    </x-card>
    <x-card title="{{ __('Esami Strumentali') }}" class="mt-5">
        <div class="grid grid-cols-12 gap-8 w-full">
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Livello compensazione misurato</x-show.label>
                <x-show.textarea>{{data_get($medicalRecord->data,'exams.instrumental.equalization.level','N/A')}}</x-show.textarea>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Impronta dentale</x-show.label>
                <x-show.value>{{data_get($medicalRecord->data,'exams.instrumental.dentalImpressions','N/A')}}</x-show.value>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <div class="flex flex-col content-center">
                    <x-show.label>Ortopantomografia</x-show.label>
                    @if(data_get($medicalRecord->data,'exams.instrumental.orthopantomography',false))
                        <x-show.textarea>{{data_get($medicalRecord->data,'exams.instrumental.orthopantomography.data','N/A')}}</x-show.textarea>
                    @else
                        <x-show.value>N/A</x-show.value>
                    @endif
                </div>

            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <div class="flex flex-col content-center">
                    <x-show.label>Rx latero-laterale</x-show.label>
                    @if(data_get($medicalRecord->data,'exams.instrumental.rx',false))
                        <x-show.textarea>{{data_get($medicalRecord->data,'exams.instrumental.rx.data','N/A')}}</x-show.textarea>
                    @else
                        <x-show.value>N/A</x-show.value>
                    @endif
                </div>

            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Dati cefalometrici</x-show.label>
                <x-show.textarea>{{data_get($medicalRecord->data,'exams.instrumental.cephalometry','N/A')}}</x-show.textarea>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Morfologia viso e orale</x-show.label>
                <x-show.textarea>{{data_get($medicalRecord->data,'exams.instrumental.morphology','N/A')}}</x-show.textarea>
            </div>
        </div>
    </x-card>

</x-medical-record.common-view>
