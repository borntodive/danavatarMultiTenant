<x-card class="mt-3" title="{{ __('Dati attività subacquea') }}">
    <div class="xl:w-1/3 lg:w-1/3 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class=" flex flex-col text-center">
            <span>Scuba</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-show.label>Ricreativa</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.scuba.recreative',false)"/>
                <x-show.label>Tecnica</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.scuba.tecnical',false)"/>
            </div>
        </div>
    </div>
    <div class="xl:w-1/3 lg:w-1/3 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class="flex flex-col text-center">
            <span>Apnea</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-show.label>Freedive</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.apnea.freedive',false)"/>
                <x-show.label>Pesca</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.apnea.phishing',false)"/>
            </div>
        </div>
    </div>
    <div class="xl:w-1/3 lg:w-1/3 w-full flex flex-col mb-6 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class="flex flex-col text-center">
            <span>Nuoto</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-show.label>Amatoriale</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.swimming.amateur',false)"/>
                <x-show.label>Agonistico</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.swimming.agonistic',false)"/>
            </div>
        </div>
    </div>
    <div class="mt-6"></div>
    <dl class="w-full grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
            <x-show.label>{{ __('Modello computer subacqueo') }}</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'divingState.divingComputer','')}}</x-show.value>
        </div>
        <div class="sm:col-span-1">
            <x-show.label>{{ __('Totale immersioni') }}</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'divingState.totalDives','')}}</x-show.value>
        </div>
        <div class="sm:col-span-1">
            <x-show.label>Immersioni effettuate annualmente</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'divingState.totalYearlyDives','')}}</x-show.value>
        </div>
        <div class="sm:col-span-1">
            <x-show.label>Come definiresti le tue capacità sub?</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'divingState.divingAbility','')}}</x-show.value>
        </div>
        <div class="sm:col-span-1">
            <x-show.label>In quale nazione effettui le immersioni?</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'divingState.divingCountry','')}}</x-show.value>
        </div>
        <div class="sm:col-span-1">
            <x-show.label>In quale nazione effettui maggiormente le immersioni?</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'divingState.divingCountryMore','')}}</x-show.value>
        </div>
        <div class="sm:col-span-1">
            <x-show.label>Quale è il massimo livello di brevetto subacqueo che possiedi?</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'divingState.divingLevel','')}}</x-show.value>
        </div>
        @if(isset($divingState['divingLevel']) && ($divingState['divingLevel'] =='dm' || $divingState['divingLevel']=='instructor'))
            <div class="sm:col-span-1">
                <x-show.label>Se sei una guida/istruttore dove eserciti?</x-show.label>
                <x-show.value> {{data_get($anamnesis->data,'divingState.teachingCountry','')}}</x-show.value>
            </div>
        @endif
        <div class="sm:col-span-1">
            <x-show.label>La subacquea è la tua professione?</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'divingState.divingProfession','')}}</x-show.value>
        </div>
    </dl>
</x-card>
@if(data_get($anamnesis->data,'divingState.scuba.recreative',false) || data_get($anamnesis->data,'divingState.scuba.tecnical',false) || data_get($anamnesis->data,'divingState.apnea.freedive',false) || data_get($anamnesis->data,'divingState.apnea.phishing',false))
<x-card class="mt-3" title="{{ __('Dati anamnestici subacquei') }}">
    @if(data_get($anamnesis->data,'divingState.scuba.recreative',false) || data_get($anamnesis->data,'divingState.scuba.tecnical',false))
        <div class="w-full mt-5">
        <div class="relative mb-5">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-start">
                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                  {{__('Scuba')}}
                </span>
            </div>
        </div>
    </div>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
            <x-show.label class="mr-4 w-2/3">Hai mai avuto un Barotrauma?</x-show.label>
            <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.scuba.barotrauma',false)"/>
        </div>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
            <x-show.label class="mr-4 w-2/3">Hai mai avuto un episodio da Narcosi da azoto?</x-show.label>
            <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.scuba.narcosi',false)"/>
        </div>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
            <x-show.label class="mr-4 w-2/3">Hai mai avuto una MDD?</x-show.label>
            <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.scuba.dcs',false)"/>
        </div>
    @endif
    @if(data_get($anamnesis->data,'divingState.apnea.freedive',false) || data_get($anamnesis->data,'divingState.apnea.phishing',false))
        <div class="w-full mt-5">
        <div class="relative mb-5">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-start">
        <span class="pr-3 bg-white text-lg font-medium text-gray-900">
          {{__('Apnea')}}
        </span>
            </div>
        </div>
    </div>
            <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
                <x-show.label class="mr-4 w-2/3">Hai mai avuto un Taravana?</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.apnea.taravana',false)"/>
            </div>
            <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
                <x-show.label class="mr-4 w-2/3">Hai mai avuto un Edema/Squize/Emottisi?</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.apnea.edema',false)"/>
            </div>
            <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
                <x-show.label class="mr-4 w-2/3">Hai mai avuto una Sincope?</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.apnea.sincope',false)"/>
            </div>
            <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
                <x-show.label class="mr-4 w-2/3">Hai mai avuto una SAMBA?</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.apnea.samba',false)"/>
            </div>
    @endif
</x-card>
@endif
