<x-medical-record.common-view :medicalRecord="$medicalRecord">
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full mt-5">
            <div class="grid grid-cols-2 gap-8">
                @foreach ($radios as $key => $radio)
                    <div class="flex flex-col mb-6 md:w-full">
                        <x-show.label>{{ $radio['label'] }}</x-form.label>
                        <x-show.value>{{data_get($radio['options'],data_get($medicalRecord->data,"anamnesis.general.".$key.".present",false),'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>Note</x-form.label>
                        @if (isset($radio['if_yes']) && data_get($medicalRecord->data, 'anamnesis.general.' . $key . '.present', null) == 'si')
                            <x-show.value>{{data_get($medicalRecord->data,"anamnesis.general.". $key .".more",'N/A')}}</x-show.value>

                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @foreach ($checkboxs as $checkbox)
        <div class="w-full mt-10">
            <div class="flex flex-col place-content-center">
                <x-show.label>{{ $checkbox['label'] }}</x-form.label>
                <div class="grid grid-cols-2 mt-5 gap- sm:grid-cols-3">
                    @foreach ($checkbox['options'] as $option)
                        <div class="mt-4">
                            <x-show.label class="font-medium">{{ $option }}</x-form.label>
                            <x-check-or-cross
                                    :condition="data_get($medicalRecord->data,$checkbox['target'].'.'.Str::snake($option, '_'),false)"/>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </x-card>
    <x-card title="{{ __('Esami Obiettivi') }}" class="mt-5">
        <div class="grid w-full grid-cols-2 gap-8 mt-10 sm:grid-cols-3">
        @foreach ($numbers as $checkbox)

            <div class="flex flex-col place-content-center">
                <div class="flex flex-col mb-6 md:w-full">
                    <x-show.label>{{ $checkbox['label'] }}</x-form.label>
                    @if (isset($checkbox['max']))
                        <x-show.value>{{data_get($medicalRecord->data,"exams.objectives.general.".Str::snake($checkbox['label']),'N/A')}}</x-show.value>
                    @else
                        <x-show.value>{{data_get($checkbox['options'],data_get($medicalRecord->data,"exams.objectives.general.".Str::snake($checkbox['label']),false),'N/A')}}</x-show.value>
                    @endif
                </div>
            </div>

        @endforeach
        </div>
        <div class="w-full mt-10">
            <x-form.label>Scala di Epworthper la sonnolenza</x-form.label>
            <div class="text-sm">
                <p>Che probabilità hai di appisolarti o di addormentarti nelle seguenti situazioni indipendentemente
                    dalla sensazione di stanchezza?</p>
                <p>La domanda si riferisce alle usuali abitudine di vita dell’ultimo periodo.</p>
                <p>Qualora tu non ti sia trovato di recente in alcune delle situazioni elencate sotto, prova ad
                    immaginare come ti sentiresti.</p>
                <p>Usa la seguente scala per scegliere il punteggio più adatto ad ogni situazione:</p>
                <p>0 = non mi addormento mai</p>
                <p>1 = ho qualche probabilità di addormentarmi</p>
                <p>2 = ho una discreta probabilità di addormentarmi</p>
                <p>3 = ho un'alta probabilità di addormentarmi</p>
            </div>
            <div class="w-full mt-5">
                @foreach ($sums as $field)
                    <div class="grid grid-cols-3 gap-8 mt-2">
                        <x-show.label class="col-span-2">{{ $field['index'] . ' ' . $field['label'] }}</x-form.label>
                        <x-show.value>{{data_get($medicalRecord->data,"exams.objectives.general.epworthper.".$field['index'],'N/A')}}</x-show.value>
                    </div>
                @endforeach
                <div class="w-full mt-2">
                    <x-form.label :class="$sum ? 'text-green-500' : 'text-red-500'">Totale: {{ $sum }}</x-form.label>
                </div>
            </div>
            <div class="w-full mt-5">
                <div class="container grid grid-cols-1 gap-8 pt-6 mx-auto md:grid-cols-2">
                    @foreach ($examsRadios as $key => $radio)
                        <div class="flex flex-col mb-6 md:w-full">
                            <x-show.label>{{ $radio['label'] }}</x-form.label>
                            <x-show.value>{{data_get($medicalRecord->data,"exams.objectives.general.". $key ,'N/A')}}</x-show.value>
                        </div>
                    @endforeach
                </div>
            </div>
            @foreach ($examsCheckboxs as $checkbox)
            <div class="w-full mt-5">
                <div class="flex flex-col place-content-center">
                    <x-form.label>{{ $checkbox['label'] }}</x-form.label>
                    <div class="grid grid-cols-2 gap-6 mt-5 sm:grid-cols-4">

                        @foreach ($checkbox['options'] as $option)
                            <x-show.label class="font-medium">{{ $option }}</x-form.label>

                            <x-check-or-cross
                                    :condition="data_get($medicalRecord->data,$checkbox['target'].'.'.Str::snake($option, '_'),false)"/>

                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </x-card>
    <x-card title="{{ __('Esami Strumentali') }}" class="mt-5">
        @foreach ($instrumentCheckboxs as $checkbox)
            <div class="w-full mt-10">
                <div class="flex flex-col place-content-center">
                    <x-show.label>{{ $checkbox['label'] }}</x-form.label>
                    <div class="grid grid-cols-2 gap-6 mt-5 sm:grid-cols-4">
                        @foreach ($checkbox['options'] as $option)
                            <x-show.label class="font-medium">{{ $option }}</x-form.label>

                            <x-check-or-cross
                                    :condition="data_get($medicalRecord->data,$checkbox['target'].'.'.Str::snake($option, '_'),false)"/>

                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </x-card>
</x-medical-record.common-view>
