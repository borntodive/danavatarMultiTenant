@props([
    'section'=>'',
    'label'=>'',
    'divingLevel'=>null
])
@php
$profession='La subacquea Ricreativa';
if ($section=='scuba.tecnical')
    $profession='La subacquea Tecnica';
elseif ($section=='apnea.freedive')
    $profession='L\'apnea';
elseif ($section=='apnea.phishing')
    $profession='La pesca';
@endphp
<div class="mt-6"></div>
<div class="relative mb-5 w-full">
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
        <div class="w-full border-t border-gray-300"></div>
    </div>
    <div class="relative flex justify-start">
                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                  {{$label}}
                </span>
    </div>
</div>
<div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
    <x-form.text-input type="number" wire:model="divingState.{{$section}}.totalDives" label="{{ __('Totale immersioni') }}"
                       autocomplete="totalDives"/>
</div>
<div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col  mb-6">
    <x-form.text-input wire:model="divingState.{{$section}}.divingComputer" label="{{ __('Modello computer subacqueo') }}"
                       autocomplete="divingComputer"/>
</div>

<div class="md:w-full flex flex-col mb-6">
    <x-form.label>Immersioni effettuate annualmente</x-form.label>
    <div class="md:w-full flex flex-row mt-3">
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.totalYearlyDives" name="{{$section}}_totalYearlyDives" type="radio" value="20" /> 0-20</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.totalYearlyDives" name="{{$section}}_totalYearlyDives" type="radio" value="50" /> 21-50</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.totalYearlyDives" name="{{$section}}_totalYearlyDives" type="radio" value="100" /> 51-100</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.totalYearlyDives" name="{{$section}}_totalYearlyDives" type="radio" value="200" /> 101-200</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.totalYearlyDives" name="{{$section}}_totalYearlyDives" type="radio" value="300" /> 201-300</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.totalYearlyDives" name="{{$section}}_totalYearlyDives" type="radio" value="301" /> 301+</div>
    </div>
</div>
<div class="md:w-full flex flex-col mb-6">
    <x-form.label>Come definiresti le tue capacità sub?</x-form.label>
    <div class="md:w-full flex flex-row mt-3">
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingAbility" name="{{$section}}_divingAbility" type="radio" value="low" /> Basse</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingAbility" name="{{$section}}_divingAbility" type="radio" value="medium" /> Medie</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingAbility" name="{{$section}}_divingAbility" type="radio" value="high" /> Alte</div>
    </div>
</div>
<div class="md:w-full flex flex-col mb-6">
    <x-form.label>In quale nazione effettui le immersioni?</x-form.label>
    <div class="md:w-full flex flex-row mt-3">
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingCountry" name="{{$section}}_divingCountry" type="radio" value="home" /> Nazione di residenza</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingCountry" name="{{$section}}_divingCountry" type="radio" value="aboard" /> Estero</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingCountry" name="{{$section}}_divingCountry" type="radio" value="both" /> Entrambi</div>
    </div>
</div>
<div class="md:w-full flex flex-col mb-6">
    <x-form.label>In quale nazione effettui maggiormente le tue immersioni?</x-form.label>
    <div class="md:w-full flex flex-row mt-3">
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingCountryMore" name="{{$section}}_divingCountryMore" type="radio" value="home" /> Nazione di residenza</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingCountryMore" name="{{$section}}_divingCountryMore" type="radio" value="aboard" /> Estero</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingCountryMore" name="{{$section}}_divingCountryMore" type="radio" value="both" /> Entrambi</div>
    </div>
</div>
<div class="md:w-full flex flex-col mb-6">
    <x-form.label>Quale è il massimo livello di brevetto subacqueo che possiedi?</x-form.label>
    <div class="md:w-full flex flex-row mt-3">
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingLevel" name="{{$section}}_divingLevel" type="radio" value="owd" /> Base</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingLevel" name="{{$section}}_divingLevel" type="radio" value="aowd" /> Avanzato</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingLevel" name="{{$section}}_divingLevel" type="radio" value="dm" /> Guida</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingLevel" name="{{$section}}_divingLevel" type="radio" value="instructor" /> Istruttore o superiore</div>
    </div>
</div>
@if($divingLevel && ($divingLevel =='dm' || $divingLevel=='instructor'))
    <div class="md:w-full flex flex-col mb-6">
        <x-form.label>Se sei una guida/istruttore dove eserciti?</x-form.label>
        <div class="md:w-full flex flex-row mt-3">
            <div class="w-2/6"><input wire:model="divingState.{{$section}}.teachingCountry" name="{{$section}}_teachingCountry" type="radio" value="home" /> Nazione di residenza</div>
            <div class="w-2/6"><input wire:model="divingState.{{$section}}.teachingCountry" name="{{$section}}_teachingCountry" type="radio" value="aboard" /> Estero</div>
            <div class="w-2/6"><input wire:model="divingState.{{$section}}.teachingCountry" name="{{$section}}_teachingCountry" type="radio" value="both" /> Entrambi</div>
        </div>
    </div>
@endif
<div class="md:w-full flex flex-col mb-6">
    <x-form.label>{{$profession}} è la tua professione?</x-form.label>
    <div class="md:w-full flex flex-row mt-3">
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingProfession" name="{{$section}}_divingProfession" type="radio" value="yes" /> Si</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingProfession" name="{{$section}}_divingProfession" type="radio" value="no" /> No</div>
        <div class="w-2/6"><input wire:model="divingState.{{$section}}.divingProfession" name="{{$section}}_divingProfession" type="radio" value="past" /> In passato</div>
    </div>
</div>
