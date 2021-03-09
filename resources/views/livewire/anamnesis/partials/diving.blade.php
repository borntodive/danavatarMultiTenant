<x-card class="mt-3" title="{{ __('Dati attività subacquee') }}">
    <div
        class="xl:w-1/2 lg:w-1/2 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class=" flex flex-col text-center">
            <span>Scuba</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-form.label>Ricreativa</x-form.label>
                <x-form.toggle entangle="divingState.scuba.recreative"/>
                <x-form.label>Tecnica</x-form.label>
                <x-form.toggle entangle="divingState.scuba.tecnical"/>
            </div>
        </div>
    </div>
    <div
        class="xl:w-1/2 lg:w-1/2 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class="flex flex-col text-center">
            <span>Apnea</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-form.label>Freedive</x-form.label>
                <x-form.toggle entangle="divingState.apnea.freedive"/>
                <x-form.label>Pesca</x-form.label>
                <x-form.toggle entangle="divingState.apnea.phishing"/>
            </div>
        </div>
    </div>

    @if($this->divingState['scuba']['recreative'])
        <x-anamnesis.diving-form-section label="Scuba Ricreativa" section="scuba.recreative"
                                         :divingLevel="data_get($divingState,'scuba.recreative.divingLevel',null)"/>
    @endif
    @if($this->divingState['scuba']['tecnical'])
        <x-anamnesis.diving-form-section label="Scuba Tecnica" section="scuba.tecnical"
                                         :divingLevel="data_get($divingState,'scuba.tecnical.divingLevel',null)"/>
    @endif

    @if($this->divingState['apnea']['freedive'])
        <x-anamnesis.diving-form-section label="Apnea Freedive" section="apnea.freedive"
                                         :divingLevel="data_get($divingState,'apnea.freedive.divingLevel',null)"/>
    @endif
    @if($this->divingState['apnea']['phishing'])
        <x-anamnesis.diving-form-section label="Apnea Pesca" section="apnea.phishing"
                                         :divingLevel="data_get($divingState,'apnea.phishing.divingLevel',null)"/>
    @endif

</x-card>

@if($this->divingState['scuba']['recreative'] || $this->divingState['scuba']['tecnical'] || $this->divingState['apnea']['freedive'] || $this->divingState['apnea']['phishing'])

    <x-card class="mt-3" title="{{ __('Dati anamnestici subacquei') }}">
        <div class="grid grid-cols-2 gap-6 w-full">

            @if($this->divingState['scuba']['recreative'])
                <div class="col-span-2 md:col-span-1">

                    <div class="relative mt-5 mb-5">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-start">
                    <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                      {{__('Scuba Ricreativo')}}
                    </span>
                        </div>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-form.label class="mr-4 w-2/3">Hai mai avuto un Barotrauma?</x-form.label>
                        <x-form.toggle entangle="divingState.anamnesis.scuba.recreative.barotrauma"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-form.label class="mr-4 w-2/3">Hai mai avuto un episodio da Narcosi da azoto?</x-form.label>
                        <x-form.toggle entangle="divingState.anamnesis.scuba.recreative.narcosi"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-form.label class="mr-4 w-2/3">Hai mai avuto una MDD?</x-form.label>
                        <x-form.toggle entangle="divingState.anamnesis.scuba.recreative.dcs"/>
                    </div>
                    @endif
                </div>
                @if($this->divingState['scuba']['tecnical'])
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
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto un Barotrauma?</x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.scuba.tecnical.barotrauma"/>
                        </div>
                        <div class="flex flex-row  mb-6">
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto un episodio da Narcosi da azoto?
                            </x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.scuba.tecnical.narcosi"/>
                        </div>
                        <div class="flex flex-row  mb-6">
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto una MDD?</x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.scuba.tecnical.dcs"/>
                        </div>
                    </div>
                @endif

                @if($this->divingState['apnea']['freedive'])
                    <div class="col-span-2 md:col-span-1">

                        <div class="w-full mt-5">
                            <div class="relative mt-5 mb-5">
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
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto un Taravana?</x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.apnea.freedive.taravana"/>
                        </div>
                        <div class="flex flex-row  mb-6">
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto un Edema/Squize/Emottisi?</x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.apnea.freedive.edema"/>
                        </div>
                        <div class="flex flex-row  mb-6">
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto una Sincope?</x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.apnea.freedive.sincope"/>
                        </div>
                        <div class="flex flex-row  mb-6">
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto una SAMBA?</x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.apnea.freedive.samba"/>
                        </div>
                    </div>
                @endif
                @if($this->divingState['apnea']['phishing'])
                    <div class="col-span-2 md:col-span-1">

                        <div class="w-full mt-5">
                            <div class="relative mt-5 mb-5">
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
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto un Taravana?</x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.apnea.phishing.taravana"/>
                        </div>
                        <div class="flex flex-row  mb-6">
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto un Edema/Squize/Emottisi?</x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.apnea.phishing.edema"/>
                        </div>
                        <div class="flex flex-row  mb-6">
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto una Sincope?</x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.apnea.phishing.sincope"/>
                        </div>
                        <div class="flex flex-row  mb-6">
                            <x-form.label class="mr-4 w-2/3">Hai mai avuto una SAMBA?</x-form.label>
                            <x-form.toggle entangle="divingState.anamnesis.apnea.phishing.samba"/>
                        </div>
                    </div>
                @endif
        </div>
    </x-card>
@endif
