<x-medical-record.common-view :medicalRecord="$medicalRecord">
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full">
            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                           {{__('Disturbi lamentati')}}
                        </span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-4">
            @foreach($disorders as $disorder)
                <x-medical-record.neuro-view-disorders
                    :label="$disorder['label']"
                    :target="$disorder['target']"
                    :options="$disorder['options']"
                    :medicalRecord="$medicalRecord"
                    more="date"
                />
            @endforeach
        </div>
        <div class="grid grid-cols-12 gap-8 w-full mt-20">
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Descrizione della sintomatologia</x-show.label>
                <x-show.textarea>{{data_get($medicalRecord->data,'anamnesis.general.sintomatologia','N/A')}}</x-show.textarea>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Accertamenti già eseguiti</x-show.label>
                <x-show.textarea>{{data_get($medicalRecord->data,'anamnesis.general.accertamenti','N/A')}}</x-show.textarea>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Terapie specifiche effettuate</x-show.label>
                <x-show.textarea>{{data_get($medicalRecord->data,'anamnesis.general.terapie','N/A')}}</x-show.textarea>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-8 w-full mt-5">
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Stato di coscienza e orientamento T-S</x-show.label>
                <div class="md:w-full flex flex-row mt-3">
                    <div class="w-1/2 flex flex-row "><x-check-or-cross
                            :condition="data_get($medicalRecord->data,'anamnesis.general.statocoscienza',false)=='normale'"/> Normale
                    </div>
                    <div class="w-1/2 flex flex-row "><x-check-or-cross
                            :condition="data_get($medicalRecord->data,'anamnesis.general.statocoscienza',false)=='alterato'"/> Alterato
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full mt-10">
            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                           {{__('Nervi Cranici')}}
                        </span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-4 w-full">
            @for($i=1;$i<=12;$i++)
                <x-medical-record.neuro-view-disorders
                    :label="NumConvert::roman($i)"
                    target="nervi.{{$i}}"
                    :options="['Normale','Sx','Dx']"
                    :medicalRecord="$medicalRecord"
                    more="text"
                />
            @endfor
        </div>
        <div class="w-full mt-10">
            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                           {{__('Mobilità e forza')}}
                        </span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 divide-y divide-gray-300 w-full">
            <div class="w-full">
                <x-form.label>Arti superiori</x-form.label>

                <div class="grid grid-cols-6 gap-4 mt-5">
                    @foreach($mobilita['artiSuperiori'] as $m)
                        <x-medical-record.neuro-view-disorders
                            :label="$m['label']"
                            :target="$m['target']"
                            :options="$m['options']"
                            :medicalRecord="$medicalRecord"
                            :more="isset($m['more']) ? $m['more'] : null"
                        />
                    @endforeach
                </div>
            </div>
            <div class="w-full mt-5">
                <x-form.label class="mt-5">Arti inferiori</x-form.label>

                <div class="grid grid-cols-6 gap-4 mt-5">
                    @foreach($mobilita['artiInferiori'] as $m)
                        <x-medical-record.neuro-view-disorders
                            :label="$m['label']"
                            :target="$m['target']"
                            :options="$m['options']"
                            :medicalRecord="$medicalRecord"
                            :more="isset($m['more']) ? $m['more'] : null"
                        />
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-full mt-10">
            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                           {{__('Tono')}}
                        </span>
                </div>
            </div>
        </div>
        <div class="w-full mt-5">
            <div class="grid grid-cols-6 gap-4 mt-5">
                @foreach($tono as $m)
                    <x-medical-record.neuro-view-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
                        :medicalRecord="$medicalRecord"
                        :more="isset($m['more']) ? $m['more'] : null"
                    />
                @endforeach
            </div>
        </div>
        <div class="w-full mt-10">
            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                           {{__('Sensibilità')}}
                        </span>
                </div>
            </div>
        </div>
        <div class="w-full mt-5">
            <div class="grid grid-cols-6 gap-4 mt-5">
                @foreach($sensibilita as $m)
                    <x-medical-record.neuro-view-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
                        :medicalRecord="$medicalRecord"
                        :more="isset($m['more']) ? $m['more'] : null"
                    />
                @endforeach
            </div>
        </div>
        <div class="w-full mt-10">
            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                           {{__('Riflessi')}}
                        </span>
                </div>
            </div>
        </div>
        <div class="w-full mt-5">
            <div class="grid grid-cols-6 gap-4 mt-5">
                @foreach($riflessi as $m)
                    <x-medical-record.neuro-view-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
                        :medicalRecord="$medicalRecord"
                        :more="isset($m['more']) ? $m['more'] : null"
                    />
                @endforeach
            </div>
        </div>
        <div class="w-full mt-10">
            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                           {{__('Coordinazione')}}
                        </span>
                </div>
            </div>
        </div>
        <div class="w-full mt-5">
            <div class="grid grid-cols-6 gap-4 mt-5">
                @foreach($coordinazione as $m)
                    <x-medical-record.neuro-view-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
                        :medicalRecord="$medicalRecord"
                        :more="isset($m['more']) ? $m['more'] : null"
                    />
                @endforeach
            </div>
        </div>
        <div class="w-full mt-10">
            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                           {{__('Prove antigravitarie')}}
                        </span>
                </div>
            </div>
        </div>
        <div class="w-full mt-5">
            <div class="grid grid-cols-6 gap-4 mt-5">
                @foreach($antigravitarie as $m)
                    <x-medical-record.neuro-view-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
                        :medicalRecord="$medicalRecord"
                        :more="isset($m['more']) ? $m['more'] : null"
                    />
                @endforeach
            </div>
        </div>
        <div class="w-full mt-10">
            <div class="relative my-5">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                           {{__('Stazione eretta e deambulazione')}}
                        </span>
                </div>
            </div>
        </div>
        <div class="w-full mt-5">
            <div class="grid grid-cols-6 gap-4 mt-5">
                @foreach($deambulazione as $m)
                    <x-medical-record.neuro-view-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
                        :medicalRecord="$medicalRecord"
                        :more="isset($m['more']) ? $m['more'] : null"
                    />
                @endforeach
            </div>
        </div>
    </x-card>
</x-medical-record.common-view>
