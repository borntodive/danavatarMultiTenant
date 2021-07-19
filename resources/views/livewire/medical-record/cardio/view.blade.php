<x-medical-record.common-view :medicalRecord="$medicalRecord">
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full">
            <div class="flex flex-col place-content-center">
                <x-form.label>{{ __('Pregresse patologie cardio-vascolari') }}</x-form.label>
                <div class="grid grid-cols-2 gap- sm:grid-cols-3">
                    @foreach ($patologie as $option)
                        <div class="mt-4">
                            <x-form.label>{{ $option }}</x-form.label>
                            <x-check-or-cross
                                    :condition="data_get($medicalRecord->data,'anamnesis.general.patologie.'.Str::snake($option, '_'),false)"/>

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
                            <x-check-or-cross
                                    :condition="data_get($medicalRecord->data,'anamnesis.general.terapie.'.Str::snake($option, '_'),false)"/>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-card>
    <x-card title="{{ __('Esami Obiettivi') }}" class="mt-5">
        <x-show.value>{{data_get($medicalRecord->data,"objectives.general.data",'N/A')}}</x-show.value>

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
                        <x-show.label>Ritmo</x-form.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ecg.ritmo",'N/A')}}</x-show.value>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <x-show.label>Frequenza cardiaca </x-form.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ecg.frequenza",'N/A')}}</x-show.value>

                    </div>
                </div>
            </div>
            <div class="w-full mt-5">
                <div class="grid grid-cols-2 gap-8">
                    @foreach ($ecg as $key => $radio)
                        <div class="flex flex-col mb-6 md:w-full">
                            <x-show.label>{{ $radio['label'] }}</x-form.label>
                            <x-show.value>{{data_get($radio['options'],data_get($medicalRecord->data,"instrumental.ecg.".$key.".present",false),'N/A')}}</x-show.value>
                        </div>
                        <div>
                            <x-show.label>Note</x-form.label>
                            @if (data_get($medicalRecord->data,'instrumental.ecg.'.$key.'.present',null)=='si')
                                <x-show.value>{{data_get($medicalRecord->data,"instrumental.ecg.". $key .".more",'N/A')}}</x-show.value>

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
                    <div>
                        <x-show.label>IVS (mm)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ett.sx.diastole.ivs",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>PW (mm)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ett.sx.diastole.pw",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>EDD (mm)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ett.sx.diastole.edd",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>Volume diastolico (ml)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ett.sx.diastole.volume",'N/A')}}</x-show.value>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="mb-5 border-b-2 border-gray-400">
                        <x-form.label>Ventricolo sinistro Sistole </x-form.label>
                    </div>
                    <div>
                        <x-show.label>IVS (mm)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ett.sx.sistole.ivs",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>PW (mm)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ett.sx.sistole.pw",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>ESD (mm)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ett.sx.sistole.esd",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>Volume sistolico (ml)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ett.sx.sistole.volume",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>EF (%)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.ett.sx.sistole.ef",'N/A')}}</x-show.value>
                    </div>
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
                    <div>
                        <x-show.label>Onda E - mitrale (cm/s)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.doppler.sx.ondae",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>Onda A - mitrale (cm/s)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.doppler.sx.ondaa",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>DTE - mitrale (ms)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.doppler.sx.dte",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>DTI - anello mitralico (cm/s)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.doppler.sx.dti",'N/A')}}</x-show.value>
                    </div>
                </div><div class="flex flex-col">
                    <div class="mb-5 border-b-2 border-gray-400">
                        <x-form.label>Ventricolo destro </x-form.label>
                    </div>
                    <div>
                        <x-show.label>Dimensione diastolica VDx</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.doppler.dx.vdx",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>PAPs (ove presente rigurgito)</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.doppler.dx.paps",'N/A')}}</x-show.value>
                    </div>
                    <div>
                        <x-show.label>Note</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,"instrumental.doppler.dx.note",'N/A')}}</x-show.value>
                    </div>
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
            <div>
                <x-show.label>Valutazione ecocardiografica eseguita con contrastografia salina agitata, risultata negativa per presenza di PFO (Patent Foramen Ovalis), sia in respiro spontaneo che in fase decompressiva post-Valsalva.</x-show.label>
                <x-show.value>{{data_get($medicalRecord->data,"instrumental.fop",'N/A')}}</x-show.value>
            </div>

        </div>
    </x-card>
</x-medical-record.common-view>
