<x-card class="mt-3" title="{{ __('Dati attività subacquea') }}">
    <div class="xl:w-1/2 lg:w-1/2 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
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
    <div class="xl:w-1/2 lg:w-1/2 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
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
@if($this->divingState['scuba']['recreative'] || $this->divingState['scuba']['tecnical'])
        <div class="mt-6"></div>
        <div class="relative mb-5 w-full">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-start">
                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                  {{__('Scuba')}}
                </span>
            </div>
        </div>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col  mb-6">
            <x-form.text-input wire:model="divingState.scuba.divingComputer" label="{{ __('Modello computer subacqueo') }}"
                               autocomplete="divingComputer"/>
        </div>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
            <x-form.text-input type="number" wire:model="divingState.scuba.totalDives" label="{{ __('Totale immersioni') }}"
                               autocomplete="totalDives"/>
        </div>
        <div class="md:w-full flex flex-col mb-6">
            <x-form.label>Immersioni effettuate annualmente</x-form.label>
            <div class="md:w-full flex flex-row mt-3">
                <div class="w-2/6"><input wire:model="divingState.scuba.totalYearlyDives" name="totalYearlyDives" type="radio" value="20" /> 0-20</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.totalYearlyDives" name="totalYearlyDives" type="radio" value="50" /> 21-50</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.totalYearlyDives" name="totalYearlyDives" type="radio" value="100" /> 51-100</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.totalYearlyDives" name="totalYearlyDives" type="radio" value="200" /> 101-200</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.totalYearlyDives" name="totalYearlyDives" type="radio" value="300" /> 201-300</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.totalYearlyDives" name="totalYearlyDives" type="radio" value="301" /> 301+</div>
            </div>
        </div>
        <div class="md:w-full flex flex-col mb-6">
            <x-form.label>Come definiresti le tue capacità sub?</x-form.label>
            <div class="md:w-full flex flex-row mt-3">
                <div class="w-2/6"><input wire:model="divingState.scuba.divingAbility" name="divingAbility" type="radio" value="low" /> Basse</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingAbility" name="divingAbility" type="radio" value="medium" /> Medie</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingAbility" name="divingAbility" type="radio" value="high" /> Alte</div>
            </div>
        </div>
        <div class="md:w-full flex flex-col mb-6">
            <x-form.label>In quale nazione effettui le immersioni?</x-form.label>
            <div class="md:w-full flex flex-row mt-3">
                <div class="w-2/6"><input wire:model="divingState.scuba.divingCountry" name="divingCountry" type="radio" value="home" /> Nazione di residenza</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingCountry" name="divingCountry" type="radio" value="aboard" /> Estero</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingCountry" name="divingCountry" type="radio" value="both" /> Entrambi</div>
            </div>
        </div>
        <div class="md:w-full flex flex-col mb-6">
            <x-form.label>In quale nazione effettui maggiormente le tue immersioni?</x-form.label>
            <div class="md:w-full flex flex-row mt-3">
                <div class="w-2/6"><input wire:model="divingState.scuba.divingCountryMore" name="divingCountryMore" type="radio" value="home" /> Nazione di residenza</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingCountryMore" name="divingCountryMore" type="radio" value="aboard" /> Estero</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingCountryMore" name="divingCountryMore" type="radio" value="both" /> Entrambi</div>
            </div>
        </div>
        <div class="md:w-full flex flex-col mb-6">
            <x-form.label>Quale è il massimo livello di brevetto subacqueo che possiedi?</x-form.label>
            <div class="md:w-full flex flex-row mt-3">
                <div class="w-2/6"><input wire:model="divingState.scuba.divingLevel" name="divingLevel" type="radio" value="owd" /> OWD</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingLevel" name="divingLevel" type="radio" value="aowd" /> AOWD</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingLevel" name="divingLevel" type="radio" value="dm" /> Guida</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingLevel" name="divingLevel" type="radio" value="instructor" /> Istruttore o superiore</div>
            </div>
        </div>
        @if(isset($divingState['scuba']['divingLevel']) && ($divingState['scuba']['divingLevel'] =='dm' || $divingState['scuba']['divingLevel']=='instructor'))
            <div class="md:w-full flex flex-col mb-6">
                <x-form.label>Se sei una guida/istruttore dove eserciti?</x-form.label>
                <div class="md:w-full flex flex-row mt-3">
                    <div class="w-2/6"><input wire:model="divingState.scuba.teachingCountry" name="teachingCountry" type="radio" value="home" /> Nazione di residenza</div>
                    <div class="w-2/6"><input wire:model="divingState.scuba.teachingCountry" name="teachingCountry" type="radio" value="aboard" /> Estero</div>
                    <div class="w-2/6"><input wire:model="divingState.scuba.teachingCountry" name="teachingCountry" type="radio" value="both" /> Entrambi</div>
                </div>
            </div>
        @endif
        <div class="md:w-full flex flex-col mb-6">
            <x-form.label>La subacquea è la tua professione?</x-form.label>
            <div class="md:w-full flex flex-row mt-3">
                <div class="w-2/6"><input wire:model="divingState.scuba.divingProfession" name="divingProfession" type="radio" value="yes" /> Si</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingProfession" name="divingProfession" type="radio" value="no" /> No</div>
                <div class="w-2/6"><input wire:model="divingState.scuba.divingProfession" name="divingProfession" type="radio" value="past" /> In passato</div>
            </div>
        </div>
    @endif
    @if($this->divingState['apnea']['freedive'] || $this->divingState['apnea']['phishing'])
    <div class="mt-6"></div>
        <div class="relative mb-5 w-full">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-start">
                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                  {{__('Apnea')}}
                </span>
            </div>
        </div>
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col  mb-6">
        <x-form.text-input wire:model="divingState.apnea.divingComputer" label="{{ __('Modello computer subacqueo') }}"
                           autocomplete="divingComputer"/>
    </div>
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
        <x-form.text-input type="number" wire:model="divingState.apnea.totalDives" label="{{ __('Totale immersioni') }}"
                           autocomplete="totalDives"/>
    </div>
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>Immersioni effettuate annualmente</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.apnea.totalYearlyDives" name="totalYearlyDives" type="radio" value="20" /> 0-20</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.totalYearlyDives" name="totalYearlyDives" type="radio" value="50" /> 21-50</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.totalYearlyDives" name="totalYearlyDives" type="radio" value="100" /> 51-100</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.totalYearlyDives" name="totalYearlyDives" type="radio" value="200" /> 101-200</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.totalYearlyDives" name="totalYearlyDives" type="radio" value="300" /> 201-300</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.totalYearlyDives" name="totalYearlyDives" type="radio" value="301" /> 301+</div>
        </div>
    </div>
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>Come definiresti le tue capacità sub?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.apnea.divingAbility" name="divingAbility" type="radio" value="low" /> Basse</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingAbility" name="divingAbility" type="radio" value="medium" /> Medie</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingAbility" name="divingAbility" type="radio" value="high" /> Alte</div>
        </div>
    </div>
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>In quale nazione effettui le immersioni?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.apnea.divingCountry" name="divingCountry" type="radio" value="home" /> Nazione di residenza</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingCountry" name="divingCountry" type="radio" value="aboard" /> Estero</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingCountry" name="divingCountry" type="radio" value="both" /> Entrambi</div>
        </div>
    </div>
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>In quale nazione effettui maggiormente le tue immersioni?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.apnea.divingCountryMore" name="divingCountryMore" type="radio" value="home" /> Nazione di residenza</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingCountryMore" name="divingCountryMore" type="radio" value="aboard" /> Estero</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingCountryMore" name="divingCountryMore" type="radio" value="both" /> Entrambi</div>
        </div>
    </div>
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>Quale è il massimo livello di brevetto subacqueo che possiedi?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.apnea.divingLevel" name="divingLevel" type="radio" value="owd" /> OWD</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingLevel" name="divingLevel" type="radio" value="aowd" /> AOWD</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingLevel" name="divingLevel" type="radio" value="dm" /> Guida</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingLevel" name="divingLevel" type="radio" value="instructor" /> Istruttore o superiore</div>
        </div>
    </div>
    @if(isset($divingState['apnea']['divingLevel']) && ($divingState['apnea']['divingLevel'] =='dm' || $divingState['apnea']['divingLevel']=='instructor'))
        <div class="md:w-full flex flex-col mb-6">
            <x-form.label>Se sei una guida/istruttore dove eserciti?</x-form.label>
            <div class="md:w-full flex flex-row mt-3">
                <div class="w-2/6"><input wire:model="divingState.apnea.teachingCountry" name="teachingCountry" type="radio" value="home" /> Nazione di residenza</div>
                <div class="w-2/6"><input wire:model="divingState.apnea.teachingCountry" name="teachingCountry" type="radio" value="aboard" /> Estero</div>
                <div class="w-2/6"><input wire:model="divingState.apnea.teachingCountry" name="teachingCountry" type="radio" value="both" /> Entrambi</div>
            </div>
        </div>
    @endif
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>La subacquea è la tua professione?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.apnea.divingProfession" name="divingProfession" type="radio" value="yes" /> Si</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingProfession" name="divingProfession" type="radio" value="no" /> No</div>
            <div class="w-2/6"><input wire:model="divingState.apnea.divingProfession" name="divingProfession" type="radio" value="past" /> In passato</div>
        </div>
    </div>
    @endif
</x-card>
@if($this->divingState['scuba']['recreative'] || $this->divingState['scuba']['tecnical'] || $this->divingState['apnea']['freedive'] || $this->divingState['apnea']['phishing'])
<x-card class="mt-3" title="{{ __('Dati anamnestici subacquei') }}">
@if($this->divingState['scuba']['recreative'] || $this->divingState['scuba']['tecnical'])
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
        <x-form.toggle entangle="divingState.anamnesis.scuba.barotrauma"/>
    </div>
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
        <x-form.label class="mr-4 w-2/3">Hai mai avuto un episodio da Narcosi da azoto?</x-form.label>
        <x-form.toggle entangle="divingState.anamnesis.scuba.narcosi"/>
    </div>
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
        <x-form.label class="mr-4 w-2/3">Hai mai avuto una MDD?</x-form.label>
        <x-form.toggle entangle="divingState.anamnesis.scuba.dcs"/>
    </div>
@endif
@if($this->divingState['apnea']['freedive'] || $this->divingState['apnea']['phishing'])
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
            <x-form.toggle entangle="divingState.anamnesis.apnea.taravana"/>
        </div>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
            <x-form.label class="mr-4 w-2/3">Hai mai avuto un Edema/Squize/Emottisi?</x-form.label>
            <x-form.toggle entangle="divingState.anamnesis.apnea.edema"/>
        </div>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
            <x-form.label class="mr-4 w-2/3">Hai mai avuto una Sincope?</x-form.label>
            <x-form.toggle entangle="divingState.anamnesis.apnea.sincope"/>
        </div>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-row  mb-6">
            <x-form.label class="mr-4 w-2/3">Hai mai avuto una SAMBA?</x-form.label>
            <x-form.toggle entangle="divingState.anamnesis.apnea.samba"/>
        </div>
@endif
</x-card>
@endif
