<x-medical-record.common-edit>
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
                <x-medical-record.neuro-edit-disorders
                    :label="$disorder['label']"
                    :target="$disorder['target']"
                    :options="$disorder['options']"
                    more="date"
                />
            @endforeach
        </div>
        <div class="grid grid-cols-12 gap-8 w-full mt-20">
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.text-area
                    label="Descrizione della sintomatologia"
                    wire:model="state.anamnesis.general.sintomatologia">
                </x-form.text-area>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.text-area
                    label="Accertamenti già eseguiti"
                    wire:model="state.anamnesis.general.accertamenti">
                </x-form.text-area>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.text-area
                    label="Terapie specifiche effettuate"
                    wire:model="state.anamnesis.general.terapie">
                </x-form.text-area>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-8 w-full mt-5">
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.label>Stato di coscienza e orientamento T-S</x-form.label>
                <div class="md:w-full flex flex-row mt-3">
                    <div class="w-1/2"><input wire:model="state.anamnesis.general.statocoscienza" name="statocoscienza" type="radio"
                                              value="normale"/> Normale
                    </div>
                    <div class="w-1/2"><input wire:model="state.anamnesis.general.statocoscienza" name="statocoscienza" type="radio"
                                              value="alterato"/> Alterato
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
        <div class="grid grid-cols-6 gap-4">
            @for($i=1;$i<=12;$i++)
                <x-medical-record.neuro-edit-disorders
                    :label="NumConvert::roman($i)"
                    target="nervi.{{$i}}"
                    :options="['Normale','Sx','Dx']"
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
                        <x-medical-record.neuro-edit-disorders
                            :label="$m['label']"
                            :target="$m['target']"
                            :options="$m['options']"
                            :more="isset($m['more']) ? $m['more'] : null"
                        />
                    @endforeach
                </div>
            </div>
            <div class="w-full mt-5">
                <x-form.label class="mt-5">Arti inferiori</x-form.label>

                <div class="grid grid-cols-6 gap-4 mt-5">
                    @foreach($mobilita['artiInferiori'] as $m)
                        <x-medical-record.neuro-edit-disorders
                            :label="$m['label']"
                            :target="$m['target']"
                            :options="$m['options']"
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
                    <x-medical-record.neuro-edit-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
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
                    <x-medical-record.neuro-edit-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
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
                    <x-medical-record.neuro-edit-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
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
                    <x-medical-record.neuro-edit-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
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
                    <x-medical-record.neuro-edit-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
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
                    <x-medical-record.neuro-edit-disorders
                        :label="$m['label']"
                        :target="$m['target']"
                        :options="$m['options']"
                        :more="isset($m['more']) ? $m['more'] : null"
                    />
                @endforeach
            </div>
        </div>
    </x-card>
</x-medical-record.common-edit>







