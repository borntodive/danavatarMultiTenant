<x-card class="mt-3" title="{{ __('Dati attività subacquea') }}">
    <div class="xl:w-1/3 lg:w-1/3 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class=" flex flex-col text-center">
            <span>Scuba</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-form.label>Ricreativa</x-form.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.scuba.recreative',false)"/>
                <x-form.label>Tecnica</x-form.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.scuba.tecnical',false)"/>
            </div>
        </div>
    </div>
    <div class="xl:w-1/3 lg:w-1/3 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class="flex flex-col text-center">
            <span>Apnea</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-form.label>Freedive</x-form.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.apnea.freedive',false)"/>
                <x-form.label>Pesca</x-form.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.apnea.phishing',false)"/>
            </div>
        </div>
    </div>
    <div class="xl:w-1/3 lg:w-1/3 w-full flex flex-col mb-6 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class="flex flex-col text-center">
            <span>Nuoto</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-form.label>Amatoriale</x-form.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.swimming.amateur',false)"/>
                <x-form.label>Agonistico</x-form.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.swimming.agonistic',false)"/>
            </div>
        </div>
    </div>
    <div class="mt-6"></div>
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col  mb-6">
        <x-form.label>{{ __('Modello computer subacqueo') }}</x-form.label>
        {{data_get($anamnesis->data,'divingState.divingComputer','')}}
    </div>
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
        <x-form.label>{{ __('Totale immersioni') }}</x-form.label>
        {{data_get($anamnesis->data,'divingState.totalDives','')}}
    </div>
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>Immersioni effettuate annualmente</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.totalYearlyDives" name="totalYearlyDives" type="radio" value="20" /> 0-20</div>
            <div class="w-2/6"><input wire:model="divingState.totalYearlyDives" name="totalYearlyDives" type="radio" value="50" /> 21-50</div>
            <div class="w-2/6"><input wire:model="divingState.totalYearlyDives" name="totalYearlyDives" type="radio" value="100" /> 51-100</div>
            <div class="w-2/6"><input wire:model="divingState.totalYearlyDives" name="totalYearlyDives" type="radio" value="200" /> 101-200</div>
            <div class="w-2/6"><input wire:model="divingState.totalYearlyDives" name="totalYearlyDives" type="radio" value="300" /> 201-300</div>
            <div class="w-2/6"><input wire:model="divingState.totalYearlyDives" name="totalYearlyDives" type="radio" value="301" /> 301+</div>
        </div>
    </div>
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>Come definiresti le tue capacità sub?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.divingAbility" name="divingAbility" type="radio" value="low" /> Basse</div>
            <div class="w-2/6"><input wire:model="divingState.divingAbility" name="divingAbility" type="radio" value="medium" /> Medie</div>
            <div class="w-2/6"><input wire:model="divingState.divingAbility" name="divingAbility" type="radio" value="high" /> Alte</div>
        </div>
    </div>
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>In quale nazione effettui le immersioni?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.divingCountry" name="divingCountry" type="radio" value="home" /> Nazione di residenza</div>
            <div class="w-2/6"><input wire:model="divingState.divingCountry" name="divingCountry" type="radio" value="aboard" /> Estero</div>
            <div class="w-2/6"><input wire:model="divingState.divingCountry" name="divingCountry" type="radio" value="both" /> Entrambi</div>
        </div>
    </div>
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>In quale nazione effettui maggiormente le tue immersioni?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.divingCountryMore" name="divingCountryMore" type="radio" value="home" /> Nazione di residenza</div>
            <div class="w-2/6"><input wire:model="divingState.divingCountryMore" name="divingCountryMore" type="radio" value="aboard" /> Estero</div>
            <div class="w-2/6"><input wire:model="divingState.divingCountryMore" name="divingCountryMore" type="radio" value="both" /> Entrambi</div>
        </div>
    </div>
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>Quale è il massimo livello di brevetto subacqueo che possiedi?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.divingLevel" name="divingLevel" type="radio" value="owd" /> OWD</div>
            <div class="w-2/6"><input wire:model="divingState.divingLevel" name="divingLevel" type="radio" value="aowd" /> AOWD</div>
            <div class="w-2/6"><input wire:model="divingState.divingLevel" name="divingLevel" type="radio" value="dm" /> Guida</div>
            <div class="w-2/6"><input wire:model="divingState.divingLevel" name="divingLevel" type="radio" value="instructor" /> Istruttore o superiore</div>
        </div>
    </div>
    @if(isset($divingState['divingLevel']) && ($divingState['divingLevel'] =='dm' || $divingState['divingLevel']=='instructor'))
        <div class="md:w-full flex flex-col mb-6">
            <x-form.label>Se sei una guida/istruttore dove eserciti?</x-form.label>
            <div class="md:w-full flex flex-row mt-3">
                <div class="w-2/6"><input wire:model="divingState.teachingCountry" name="teachingCountry" type="radio" value="home" /> Nazione di residenza</div>
                <div class="w-2/6"><input wire:model="divingState.teachingCountry" name="teachingCountry" type="radio" value="aboard" /> Estero</div>
                <div class="w-2/6"><input wire:model="divingState.teachingCountry" name="teachingCountry" type="radio" value="both" /> Entrambi</div>
            </div>
        </div>
    @endif
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>La subacquea è la tua professione?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.divingProfession" name="divingProfession" type="radio" value="yes" /> Si</div>
            <div class="w-2/6"><input wire:model="divingState.divingProfession" name="divingProfession" type="radio" value="no" /> No</div>
            <div class="w-2/6"><input wire:model="divingState.divingProfession" name="divingProfession" type="radio" value="past" /> In passato</div>
        </div>
    </div>
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
            <x-form.label class="mr-4 w-2/3">Hai mai avuto un Barotrauma?</x-form.label>
            <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.scuba.barotrauma',false)"/>
        </div>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
            <x-form.label class="mr-4 w-2/3">Hai mai avuto un episodio da Narcosi da azoto?</x-form.label>
            <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.scuba.narcosi',false)"/>
        </div>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
            <x-form.label class="mr-4 w-2/3">Hai mai avuto una MDD?</x-form.label>
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
                <x-form.label class="mr-4 w-2/3">Hai mai avuto un Taravana?</x-form.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.apnea.taravana',false)"/>
            </div>
            <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
                <x-form.label class="mr-4 w-2/3">Hai mai avuto un Edema/Squize/Emottisi?</x-form.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.apnea.edema',false)"/>
            </div>
            <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
                <x-form.label class="mr-4 w-2/3">Hai mai avuto una Sincope?</x-form.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.apnea.sincope',false)"/>
            </div>
            <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
                <x-form.label class="mr-4 w-2/3">Hai mai avuto una SAMBA?</x-form.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'divingState.anamnesis.apnea.samba',false)"/>
            </div>
    @endif
</x-card>
@endif
