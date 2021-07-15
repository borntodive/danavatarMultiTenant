<x-medical-record.common-view :medicalRecord="$medicalRecord">
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full">
            <div class="container grid gap-8 pt-6 mx-auto sm:grid-cols-1 md:grid-cols-1">
                @foreach ($radios as $key => $radio)
                    <div class="flex flex-col mb-6 md:w-full">
                        <x-form.label>{{ $radio['label'] }}</x-form.label>
                        <x-show.value>{{data_get($radio['options'],data_get($medicalRecord->data,"anamnesis.general.$key",false),'N/A')}}</x-show.value>
                    </div>
                    @if (isset($radio['if_yes']) && data_get($medicalRecord->data, 'anamnesis.general.' . $key, null) == 'si')
                        <div class="flex flex-col mb-6 border-b-2 border-gray-300 md:w-full">
                            <x-form.label class="mb-5 border-b-2 border-gray-300">Ulteriori Informazioni</x-form.label>
                            @foreach ($radio['if_yes'] as $yes_key => $yes_radio)
                                <div class="flex flex-col mb-6 md:w-full">
                                    <x-form.label>{{ $yes_radio['label'] }}</x-form.label>
                                    <x-show.value>{{data_get($yes_radio['options'],data_get($anamnesis->data,"anamnesis.general.$yes_key",false),'N/A')}}</x-show.value>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="w-full">
            <div class="relative mb-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                    <span class="pr-3 text-lg font-medium text-gray-900 bg-white">
                        Anamnesi subacquea

                    </span>
                </div>
            </div>
            <div class="w-full">
                <div class="flex flex-col place-content-center">
                    <x-form.label>{{ __('Segni e sintomi iniziali, condizioni ed evoluzione') }}</x-form.label>
                    <div class="grid grid-cols-2 gap- sm:grid-cols-4">
                        @foreach ($sintomi as $option)
                            <div class="mt-4">
                                <x-form.label>{{ $option }}</x-form.label>
                                <x-check-or-cross
                                    :condition="data_get($medicalRecord->data,'anamnesis.diving.sintomi.'.Str::snake($option, '_'),false)"/>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w-full mt-10">
                <div class="flex flex-col place-content-center">
                    <x-form.label>Dettagli dell'immersione scuba</x-form.label>
                    <div class="flex-wrap justify-between mt-5 xl:flex lg:flex md:flex">
                        <div class="flex flex-col mb-6 xl:w-2/5 lg:w-2/5 md:w-2/5">
                            <x-show.label>Massima profondità (mt)</x-show.label>
                            <x-show.value>{{data_get($medicalRecord->data,"anamnesis.diving.scuba.max_depth",'N/A')}}</x-show.value>
                        </div>
                        <div class="flex flex-col mb-6 xl:w-2/5 lg:w-2/5 md:w-2/5">
                            <x-show.label>Tempo totale di ultima immersione (minuti)</x-show.label>
                            <x-show.value>{{data_get($medicalRecord->data,"anamnesis.diving.scuba.runtime",'N/A')}}</x-show.value>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap- sm:grid-cols-4">
                        @foreach ($scuba as $option)
                            <div class="mt-4">
                                <x-form.label>{{ $option }}</x-form.label>
                                <x-check-or-cross
                                    :condition="data_get($medicalRecord->data,'anamnesis.diving.scuba.'.Str::snake($option, '_'),false)"/>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w-full mt-10">
                <div class="flex flex-col place-content-center">
                    <x-form.label>Dettagli dell'immersione apnea</x-form.label>
                    <div class="flex-wrap justify-between mt-5 xl:flex lg:flex md:flex">
                        <div class="flex flex-col mb-6 xl:w-2/5 lg:w-2/5 md:w-2/5">
                            <x-show.label>Massima profondità (mt)</x-show.label>
                            <x-show.value>{{data_get($medicalRecord->data,"anamnesis.diving.apnea.max_depth",'N/A')}}</x-show.value>
                        </div>
                        <div class="flex flex-col mb-6 xl:w-2/5 lg:w-2/5 md:w-2/5">
                            <x-show.label>Numeri totali di tuffi</x-show.label>
                            <x-show.value>{{data_get($medicalRecord->data,"anamnesis.diving.apnea.number_dive",'N/A')}}</x-show.value>
                        </div>
                        <div class="flex flex-col mb-6 xl:w-2/5 lg:w-2/5 md:w-2/5">
                            <x-show.label>Media intervallo di superfice (minuti)</x-show.label>
                            <x-show.value>{{data_get($medicalRecord->data,"anamnesis.diving.apnea.surface_interval",'N/A')}}</x-show.value>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap- sm:grid-cols-4">
                        @foreach ($apnea as $option)
                            <div class="mt-4">
                                <x-form.label>{{ $option }}</x-form.label>
                                <x-check-or-cross
                                    :condition="data_get($medicalRecord->data,'anamnesis.diving.apnea.'.Str::snake($option, '_'),false)"/>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full mt-10">
            <div class="relative mb-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                    <span class="pr-3 text-lg font-medium text-gray-900 bg-white">
                        Trasporto e trattamento

                    </span>
                </div>
            </div>
            <div class="w-full">
                <div class="container grid gap-8 pt-6 mx-auto sm:grid-cols-1 md:grid-cols-1">
                    @foreach ($dcs as $key => $radio)
                        <div class="flex flex-col mb-6 md:w-full">
                            <x-form.label>{{ $radio['label'] }}</x-form.label>
                            <x-show.value>{{data_get($radio['options'],data_get($medicalRecord->data,"anamnesis.general.$key",false),'N/A')}}</x-show.value>
                        </div>
                        @if (isset($radio['if_yes']) && data_get($this->state, 'anamnesis.general.' . $key, null) == 'si')
                            <div class="flex flex-col mb-6 border-b-2 border-gray-300 md:w-full">
                                <x-form.label class="mb-5 border-b-2 border-gray-300">Ulteriori Informazioni
                                </x-form.label>
                                @foreach ($radio['if_yes'] as $yes_key => $yes_radio)
                                    <div class="flex flex-col mb-6 md:w-full">
                                        <x-form.label>{{ $yes_radio['label'] }}</x-form.label>
                                        <x-show.value>{{data_get($yes_radio['options'],data_get($anamnesis->data,"anamnesis.general.$yes_key",false),'N/A')}}</x-show.value>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @if (data_get($medicalRecord->data, 'anamnesis.general.camera_iperbarica', 'no') == 'si')
                @foreach (data_get($medicalRecord->data, 'anamnesis.diving.dcs', ['none']) as $item)
                    <div class="w-full px-4 py-5 mb-10 bg-gray-200 border border-gray-500 rounded-lg sm:px-6">
                        <div class="flex flex-wrap items-center justify-between -mt-4 -ml-4 sm:flex-nowrap">
                            <div class="mt-4 ml-4">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                    Trattamento {{ $loop->iteration }}
                                </h3>
                            </div>

                        </div>
                        <div class="flex-wrap justify-between mt-5 xl:flex lg:flex md:flex">
                            <div class="flex flex-col mb-6 xl:w-2/5 lg:w-2/5 md:w-2/5">
                                <x-form.label>Data</x-form.label>
                                <x-show.value>{{data_get($medicalRecord->data,"anamnesis.diving.dcs.".$loop->index.".date",'N/A')}}</x-show.value>

                            </div>
                        </div>
                        <div class="container grid grid-cols-1 gap-8 pt-6 mx-auto sm:grid-cols-3">
                            @php
                                $r = $first_treatment;
                                if (!$loop->first) {
                                    $r = $others_treatment;
                                }
                            @endphp
                            @foreach ($r as $key => $radio)
                                <div class="flex flex-col mb-6 md:w-full">
                                    <x-form.label>{{ $radio['label'] }}</x-form.label>
                                    <x-show.value>{{data_get($radio['options'],data_get($medicalRecord->data,"anamnesis.diving.dcs.".$loop->parent->index.".".$key,false),'N/A')}}</x-show.value>
                                </div>
                            @endforeach
                        </div>
                    </div>

                @endforeach
            @endif
        </div>
    </x-card>
</x-medical-record.common-view>
