<x-medical-record.common-edit>
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full">
            <div class="container grid gap-8 pt-6 mx-auto sm:grid-cols-1 md:grid-cols-1">
                @foreach ($radios as $key => $radio)
                    <div class="flex flex-col mb-6 md:w-full">
                        <x-form.label>{{ $radio['label'] }}</x-form.label>
                        <div class="flex flex-wrap mt-3 md:w-full">
                            @foreach ($radio['options'] as $idx => $option)
                                <div class="px-10 mt-2"><input wire:model="state.anamnesis.general.{{ $key }}"
                                        type="radio" value="{{ $idx }}" /> {{ $option }}</div>
                            @endforeach
                        </div>
                    </div>
                    @if (isset($radio['if_yes']) && data_get($this->state, 'anamnesis.general.' . $key, null) == 'si')
                        <div class="flex flex-col mb-6 border-b-2 border-gray-300 md:w-full">
                            <x-form.label class="mb-5 border-b-2 border-gray-300">Ulteriori Informazioni</x-form.label>
                            @foreach ($radio['if_yes'] as $yes_key => $yes_radio)
                                <div class="flex flex-col mb-6 md:w-full">
                                    <x-form.label>{{ $yes_radio['label'] }}</x-form.label>
                                    <div class="flex flex-wrap mt-3 ">
                                        @foreach ($yes_radio['options'] as $yes_idx => $yes_option)
                                            <div class="px-10 mt-2"><input
                                                    wire:model="state.anamnesis.general.{{ $yes_key }}"
                                                    type="radio" value="{{ $yes_idx }}" /> {{ $yes_option }}
                                            </div>
                                        @endforeach
                                    </div>
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
                    <x-form.label>{{__('Segni e sintomi iniziali, condizioni ed evoluzione')}}</x-form.label>
                    <div class="grid grid-cols-2 gap- sm:grid-cols-4">
                    @foreach($sintomi as $option)
                        <div class="mt-4">
                            <x-form.label>{{$option}}</x-form.label>
                            <x-form.checkbox value="1" id="sintomi_{{Str::snake($option, '_')}}"
                                            wire:model="state.anamnesis.diving.sintomi.{{Str::snake($option, '_')}}"
                            />

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
                            <x-form.text-input type="number" wire:model="state.anamnesis.diving.scuba.max_depth" label="{{ __('Massima profondità (mt)') }}"
                                               />
                        </div>
                        <div class="flex flex-col mb-6 xl:w-2/5 lg:w-2/5 md:w-2/5">
                            <x-form.text-input type="number" wire:model="state.anamnesis.diving.scuba.runtime" label="{{ __('Tempo totale di ultima immersione (minuti)') }}"
                                               />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap- sm:grid-cols-4">
                    @foreach($scuba as $option)
                        <div class="mt-4">
                            <x-form.label>{{$option}}</x-form.label>
                            <x-form.checkbox value="1" id="scuba_{{Str::snake($option, '_')}}"
                                            wire:model="state.anamnesis.diving.scuba.{{Str::snake($option, '_')}}"
                            />

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
                            <x-form.text-input type="number" wire:model="state.anamnesis.diving.apnea.max_depth" label="{{ __('Massima profondità (mt)') }}"
                                               />
                        </div>
                        <div class="flex flex-col mb-6 xl:w-2/5 lg:w-2/5 md:w-2/5">
                            <x-form.text-input type="number" wire:model="state.anamnesis.diving.apnea.number_dive" label="{{ __('Numeri totali di tuffi') }}"
                                               />
                        </div>
                        <div class="flex flex-col mb-6 xl:w-2/5 lg:w-2/5 md:w-2/5">
                            <x-form.text-input type="number" wire:model="state.anamnesis.diving.apnea.surface_interval" label="{{ __('Media intervallo di superfice (minuti)') }}"
                                               />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap- sm:grid-cols-4">
                    @foreach($apnea as $option)
                        <div class="mt-4">
                            <x-form.label>{{$option}}</x-form.label>
                            <x-form.checkbox value="1" id="apnea_{{Str::snake($option, '_')}}"
                                            wire:model="state.anamnesis.diving.apnea.{{Str::snake($option, '_')}}"
                            />

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
                            <div class="flex flex-wrap mt-3 md:w-full">
                                @foreach ($radio['options'] as $idx => $option)
                                    <div class="px-10 mt-2"><input wire:model="state.anamnesis.general.{{ $key }}"
                                            type="radio" value="{{ $idx }}" /> {{ $option }}</div>
                                @endforeach
                            </div>
                        </div>
                        @if (isset($radio['if_yes']) && data_get($this->state, 'anamnesis.general.' . $key, null) == 'si')
                            <div class="flex flex-col mb-6 border-b-2 border-gray-300 md:w-full">
                                <x-form.label class="mb-5 border-b-2 border-gray-300">Ulteriori Informazioni</x-form.label>
                                @foreach ($radio['if_yes'] as $yes_key => $yes_radio)
                                    <div class="flex flex-col mb-6 md:w-full">
                                        <x-form.label>{{ $yes_radio['label'] }}</x-form.label>
                                        <div class="flex flex-wrap mt-3 ">
                                            @foreach ($yes_radio['options'] as $yes_idx => $yes_option)
                                                <div class="px-10 mt-2"><input
                                                        wire:model="state.anamnesis.general.{{ $yes_key }}"
                                                        type="radio" value="{{ $yes_idx }}" /> {{ $yes_option }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </x-card>
</x-medical-record.common-edit>
