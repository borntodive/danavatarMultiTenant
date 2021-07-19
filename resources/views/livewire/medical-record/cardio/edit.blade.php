<x-medical-record.common-edit>
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full">
            <div class="flex flex-col place-content-center">
                <x-form.label>{{ __('Pregresse patologie cardio-vascolari') }}</x-form.label>
                <div class="grid grid-cols-2 gap- sm:grid-cols-3">
                    @foreach ($patologie as $option)
                        <div class="mt-4">
                            <x-form.label>{{ $option }}</x-form.label>
                            <x-form.checkbox value="1" id="patologie_{{ Str::snake($option, '_') }}"
                                wire:model="state.anamnesis.general.patologie.{{ Str::snake($option, '_') }}" />

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-full mt-10">
            <div class="flex flex-col place-content-center">
                <x-form.label>{{ __('Terapie croniche cardiologiche') }}</x-form.label>
                <div class="grid grid-cols-2 gap- sm:grid-cols-3">
                    @foreach ($terapie as $option)
                        <div class="mt-4">
                            <x-form.label>{{ $option }}</x-form.label>
                            <x-form.checkbox value="1" id="terapie_{{ Str::snake($option, '_') }}"
                                wire:model="state.anamnesis.general.terapie.{{ Str::snake($option, '_') }}" />

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-card>
    <x-card title="{{ __('Esami Obiettivi') }}" class="mt-5">
        <x-form.text-area class="w-full" wire:model="state.objectives.general.data"></x-form.text-area>
    </x-card>
    <x-card title="{{ __('Esami Strumentali') }}" class="mt-5">
        <div class="w-full">
            <div class="relative mb-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                    <span class="pr-3 text-lg font-medium text-gray-900 bg-white">
                        ECG per la valutazione di
                    </span>
                </div>
            </div>
            <div class="w-full">
                <div class="grid grid-cols-12 gap-8">
                    <div class="col-span-12 sm:col-span-6">
                        <x-form.label>Ritmo</x-form.label>
                        <x-form.text-area wire:model="state.instrumental.ecg.ritmo"></x-form.text-area>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <x-form.label>Frequenza cardiaca </x-form.label>
                        <x-form.text-input type="number" wire:model="state.instrumental.ecg.frequenza"/>
                    </div>
                </div>
            </div>
            <div class="w-full mt-5">
                <div class="grid grid-cols-2 gap-8">
                    @foreach ($ecg as $key => $radio)
                        <div class="flex flex-col mb-6 md:w-full">
                            <x-form.label>{{ $radio['label'] }}</x-form.label>
                            <div class="flex flex-wrap mt-3 md:w-full">
                                @foreach ($radio['options'] as $idx => $option)
                                    <div class="px-10 mt-2"><input wire:model="state.instrumental.ecg.{{ $key }}.present"
                                            type="radio" value="{{ $idx }}" /> {{ $option }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            @if (data_get($state,'instrumental.ecg.'.$key.'.present',null)=='si')
                                <x-form.text-area class="w-full pt-10" wire:model="state.instrumental.ecg.{{ $key }}.more"></x-form.text-area>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-full mt-5">
            <div class="relative mb-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                    <span class="pr-3 text-lg font-medium text-gray-900 bg-white">
                        ETT ( Elettrocardiografia transtoracia)
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                <div class="flex flex-col">
                    <div class="mb-5 border-b-2 border-gray-400">
                        <x-form.label>Ventricolo sinistro Diastole </x-form.label>
                    </div>
                    <x-form.text-input type="number" class="mt-3" label="IVS (mm)" wire:model="state.instrumental.ett.sx.diastole.ivs"/>
                    <x-form.text-input type="number" class="mt-3" label="PW (mm)" wire:model="state.instrumental.ett.sx.diastole.pw"/>
                    <x-form.text-input type="number" class="mt-3" label="EDD (mm)" wire:model="state.instrumental.ett.sx.diastole.edd"/>
                    <x-form.text-input type="number" class="mt-3" label="Volume diastolico (ml)" wire:model="state.instrumental.ett.sx.diastole.volume"/>
                </div><div class="flex flex-col">
                    <div class="mb-5 border-b-2 border-gray-400">
                        <x-form.label>Ventricolo sinistro Sistole </x-form.label>
                    </div>
                    <x-form.text-input type="number" class="mt-3" label="IVS (mm)" wire:model="state.instrumental.ett.sx.sistole.ivs"/>
                    <x-form.text-input type="number" class="mt-3" label="PW (mm)" wire:model="state.instrumental.ett.sx.sistole.pw"/>
                    <x-form.text-input type="number" class="mt-3" label="ESD (mm)" wire:model="state.instrumental.ett.sx.sistole.esd"/>
                    <x-form.text-input type="number" class="mt-3" label="Volume sistolico (ml)" wire:model="state.instrumental.ett.sx.sistole.volume"/>
                    <x-form.text-input type="number" class="mt-3" label="EF (%)" wire:model="state.instrumental.ett.sx.sistole.ef"/>
                </div>
            </div>
        </div>
        <div class="w-full mt-5">
            <div class="relative mb-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                    <span class="pr-3 text-lg font-medium text-gray-900 bg-white">
                        ETT ( Elettrocardiografia transtoracia) - Doppler
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                <div class="flex flex-col">
                    <div class="mb-5 border-b-2 border-gray-400">
                        <x-form.label>Ventricolo sinistro</x-form.label>
                    </div>
                    <x-form.text-input type="number" class="mt-3" label="Onda E - mitrale (cm/s)" wire:model="state.instrumental.doppler.sx.ondae"/>
                    <x-form.text-input type="number" class="mt-3" label="Onda A - mitrale (cm/s)" wire:model="state.instrumental.doppler.sx.ondaa"/>
                    <x-form.text-input type="number" class="mt-3" label="DTE - mitrale (ms)" wire:model="state.instrumental.doppler.sx.dte"/>
                    <x-form.text-input type="number" class="mt-3" label="DTI - anello mitralico (cm/s)" wire:model="state.instrumental.doppler.sx.dti"/>
                </div><div class="flex flex-col">
                    <div class="mb-5 border-b-2 border-gray-400">
                        <x-form.label>Ventricolo destro </x-form.label>
                    </div>
                    <x-form.text-area label="Dimensione diastolica VDx" wire:model="state.instrumental.doppler.dx.vdx"/>
                    <x-form.text-area label="PAPs (ove presente rigurgito)" wire:model="state.instrumental.doppler.dx.paps"/>
                    <x-form.text-area label="Note" wire:model="state.instrumental.doppler.dx.note"/>
                </div>
            </div>
        </div>
        <div class="w-full mt-5">
            <div class="relative mb-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                    <span class="pr-3 text-lg font-medium text-gray-900 bg-white">
                        FOP
                    </span>
                </div>
            </div>
            <x-form.text-area label="Valutazione ecocardiografica eseguita con contrastografia salina agitata, risultata negativa per presenza di PFO (Patent Foramen Ovalis), sia in respiro spontaneo che in fase decompressiva post-Valsalva." wire:model="state.instrumental.fop"/>

        </div>
    </x-card>
</x-medical-record.common-edit>
