<x-card class="mt-3" title="{{ __('Dati attività subacquea') }}">
    <div
        class="xl:w-1/2 lg:w-1/2 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class=" flex flex-col text-center">
            <span>Scuba</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-show.label>Ricreativa</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'diving.scuba.recreative',false)"/>
                <x-show.label>Tecnica</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'diving.scuba.tecnical',false)"/>
            </div>
        </div>
    </div>
    <div
        class="xl:w-1/2 lg:w-1/2 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class="flex flex-col text-center">
            <span>Apnea</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-show.label>Freedive</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'diving.apnea.freedive',false)"/>
                <x-show.label>Pesca</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'diving.apnea.phishing',false)"/>
            </div>
        </div>
    </div>
    @if(data_get($anamnesis->data,'diving.scuba.recreative',false))
        <x-anamnesis.diving-view-section label="Scuba Ricreativa" :anamnesis="$anamnesis" section="scuba.recreative"
                                         :divingLevel="data_get($anamnesis->data,'diving.scuba.recreative.divingLevel',null)"/>
    @endif
    @if(data_get($anamnesis->data,'diving.scuba.tecnical',false))
        <x-anamnesis.diving-view-section label="Scuba Tecnica" :anamnesis="$anamnesis" section="scuba.tecnical"
                                         :divingLevel="data_get($anamnesis->data,'diving.scuba.tecnical.divingLevel',null)"/>
    @endif
    @if(data_get($anamnesis->data,'diving.apnea.freedive',false) )
        <x-anamnesis.diving-view-section label="Apnea Freedive" :anamnesis="$anamnesis" section="apnea.freedive"
                                         :divingLevel="data_get($anamnesis->data,'diving.apnea.freedive.divingLevel',null)"/>

    @endif
    @if(data_get($anamnesis->data,'diving.apnea.phishing',false) )
        <x-anamnesis.diving-view-section label="Apnea Pesca" :anamnesis="$anamnesis" section="apnea.phishing"
                                         :divingLevel="data_get($anamnesis->data,'diving.apnea.phishing.divingLevel',null)"/>

    @endif

</x-card>
@if(data_get($anamnesis->data,'diving.scuba.recreative',false) || data_get($anamnesis->data,'diving.scuba.tecnical',false) || data_get($anamnesis->data,'diving.apnea.freedive',false) || data_get($anamnesis->data,'diving.apnea.phishing',false))
    <x-card class="mt-3" title="{{ __('Dati anamnestici subacquei') }}">
        <div class="grid grid-cols-2 gap-6 w-full">
            @if(data_get($anamnesis->data,'diving.scuba.recreative',false))
                <div class="col-span-2 md:col-span-1">
                    <div class="relative mt-5 mb-5">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                          {{__('Scuba Ricreativa')}}
                        </span>
                        </div>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Barotrauma?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.recreative.barotrauma',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un episodio da Narcosi da azoto?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.recreative.narcosi',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una MDD?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.recreative.dcs',false)"/>
                    </div>
                </div>
            @endif
            @if(data_get($anamnesis->data,'diving.scuba.tecnical',false))
                <div class="col-span-2 md:col-span-1">

                    <div class="relative mt-5 mb-5">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-start">
                    <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                      {{__('Scuba Tecnica')}}
                    </span>
                        </div>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Barotrauma?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.tecnical.barotrauma',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un episodio da Narcosi da azoto?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.tecnical.narcosi',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una MDD?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.tecnical.dcs',false)"/>
                    </div>
                </div>
            @endif
            @if(data_get($anamnesis->data,'diving.apnea.freedive',false))
                <div class="col-span-2 md:col-span-1">

                    <div class="w-full mt-5">
                        <div class="relative mb-5">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-start">
            <span class="pr-3 bg-white text-lg font-medium text-gray-900">
              {{__('Apnea Freedive')}}
            </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Taravana?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.freedive.taravana',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Edema/Squize/Emottisi?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.freedive.edema',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una Sincope?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.freedive.sincope',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una SAMBA?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.freedive.samba',false)"/>
                    </div>
                </div>
            @endif
            @if(data_get($anamnesis->data,'diving.apnea.phishing',false))
                <div class="col-span-2 md:col-span-1">

                    <div class="w-full mt-5">
                        <div class="relative mb-5">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-start">
            <span class="pr-3 bg-white text-lg font-medium text-gray-900">
              {{__('Apnea Pesca')}}
            </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Taravana?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.phishing.taravana',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Edema/Squize/Emottisi?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.phishing.edema',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una Sincope?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.phishing.sincope',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una SAMBA?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.phishing.samba',false)"/>
                    </div>
                </div>
            @endif
        </div>

    </x-card>
@endif
