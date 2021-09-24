<x-medical-record.common-edit>
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full">
            <div class="container grid grid-cols-1 gap-8 pt-6 mx-auto md:grid-cols-2">
                @foreach ($radios as $key => $radio)
                    <div class="flex flex-col mb-6 md:w-full">
                        <x-form.label>{{ $radio['label'] }}</x-form.label>
                        <div class="flex flex-wrap mt-3 md:w-full">
                            @foreach ($radio['options'] as $idx => $option)
                                <div class="px-10 mt-2"><input name="anamnesis_general_{{ $key }}.present"
                                        wire:model="state.anamnesis.general.{{ $key }}.present" type="radio"
                                        value="{{ $idx }}" /> {{ $option }}</div>
                            @endforeach
                        </div>
                    </div>
                    @if (isset($radio['if_yes']) && data_get($this->state, 'anamnesis.general.' . $key . '.present', null) == 'si')
                        <div class="flex flex-col">
                            <x-form.text-input wire:model='state.anamnesis.general.{{ $key }}.more'
                                :label="$radio['if_yes']" />
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @foreach ($checkboxs as $checkbox)
            <div class="w-full mt-10">
                <div class="flex flex-col place-content-center">
                    <x-form.label>{{ $checkbox['label'] }}</x-form.label>
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4">
                        @foreach ($checkbox['options'] as $option)
                            <div class="flex flex-col content-center mt-4">
                                <x-form.label class="text-center" :sublabel="true">{{ $option }}</x-form.label>
                                <x-form.checkbox class="mt-2 text-center" value="1"
                                    id="sintomi_{{ Str::snake($option, '_') }}"
                                    wire:model="{{ $checkbox['target'] }}.{{ Str::snake($option, '_') }}" />

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

    </x-card>
    <x-card title="{{ __('Esami Obiettivi') }}" class="mt-5">
        @foreach ($numbers as $checkbox)
            <div class="w-full mt-10">
                <div class="flex flex-col place-content-center">
                    <x-form.label>{{ $checkbox['label'] }}</x-form.label>
                    @if (isset($checkbox['max']))
                        <div class="grid grid-cols-2 gap-6 sm:grid-cols-{{ $checkbox['max'] + 1 }}">
                            @for ($i = 0; $i <= $checkbox['max']; $i++)
                                <div class="flex flex-col content-center mt-4">
                                    <div class="mt-2 text-center">{{ $i }} <input type="radio"
                                            value="{{ $i }}"
                                            name="general_{{ Str::snake($checkbox['label'], '_') }}"
                                            id="general_{{ Str::snake($checkbox['label'], '_') }}"
                                            wire:model="state.exams.objectives.general.{{ Str::snake($checkbox['label'], '_') }}" />
                                    </div>

                                </div>
                            @endfor
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-6 sm:grid-cols-{{ count($checkbox['options']) }}">
                            @foreach ($checkbox['options'] as $idx => $option)
                                <div class="flex flex-col content-center mt-4">
                                    <div class="mt-2 text-center">{{ $option }} <input type="radio"
                                            value="{{ $idx }}"
                                            name="general_{{ Str::snake($checkbox['label'], '_') }}"
                                            id="general_{{ Str::snake($checkbox['label'], '_') }}"
                                            wire:model="state.exams.objectives.general.{{ Str::snake($checkbox['label'], '_') }}" />
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        @endforeach
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
                        <x-form.label class="col-span-2">{{ $field['index'] . ' ' . $field['label'] }}</x-form.label>

                        <x-form.text-input class="w-1/3" type="number" wire:change="updateSum()"
                            wire:model="state.exams.objectives.general.epworthper.{{ $field['index'] }}" />
                    </div>
                @endforeach
                <div class="w-full mt-2">
                    <x-form.label>Totale: {{ $sum }}</x-form.label>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="container grid grid-cols-1 gap-8 pt-6 mx-auto md:grid-cols-2">
                @foreach ($examsRadios as $key => $radio)
                    <div class="flex flex-col mb-6 md:w-full">
                        <x-form.label>{{ $radio['label'] }}</x-form.label>
                        <div class="flex flex-wrap mt-3 md:w-full">
                            @for ($i = 0; $i <= $radio['max']; $i++)
                                <div class="px-5 mt-2"><input name="exams_objectives_general_{{ $key }}"
                                        wire:model="exams.objectives.general.{{ $key }}" type="radio"
                                        value="{{ $i }}" /> {{ $i }}</div>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @foreach ($examsCheckboxs as $checkbox)
            <div class="w-full mt-10">
                <div class="flex flex-col place-content-center">
                    <x-form.label>{{ $checkbox['label'] }}</x-form.label>
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4">
                        @foreach ($checkbox['options'] as $option)
                            <div class="flex flex-col content-center mt-4">
                                <x-form.label class="text-center" :sublabel="true">{{ $option }}
                                </x-form.label>
                                <x-form.checkbox class="mt-2 text-center" value="1"
                                    id="sintomi_{{ Str::snake($option, '_') }}"
                                    wire:model="{{ $checkbox['target'] }}.{{ Str::snake($option, '_') }}" />

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </x-card>
    <x-card title="{{ __('Esami Obiettivi') }}" class="mt-5">
        @foreach ($instrumentCheckboxs as $checkbox)
            <div class="w-full mt-10">
                <div class="flex flex-col place-content-center">
                    <x-form.label>{{ $checkbox['label'] }}</x-form.label>
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4">
                        @foreach ($checkbox['options'] as $option)
                            <div class="flex flex-col content-center mt-4">
                                <x-form.label class="text-center" :sublabel="true">{{ $option }}
                                </x-form.label>
                                <x-form.checkbox class="mt-2 text-center" value="1"
                                    id="sintomi_{{ Str::snake($option, '_') }}"
                                    wire:model="{{ $checkbox['target'] }}.{{ Str::snake($option, '_') }}" />

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </x-card>
</x-medical-record.common-edit>
