@props([
    'section'=>'',
    'label'=>'',
    'divingLevel'=>null,
    'anamnesis'=>null
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
<div class="relative mt-6 mb-5 w-full">
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
        <div class="w-full border-t border-gray-300"></div>
    </div>
    <div class="relative flex justify-start">
                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                  {{$label}}
                </span>
    </div>
</div>
<dl class="w-full grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
    <div class="sm:col-span-1">
        <x-show.label>{{ __('Totale immersioni') }}</x-show.label>
        <x-show.value> {{data_get($anamnesis->data,'diving.'.$section.'.totalDives','')}}</x-show.value>
    </div>
    <div class="sm:col-span-1">
        <x-show.label>{{ __('Modello computer subacqueo') }}</x-show.label>
        <x-show.value> {{data_get($anamnesis->data,'diving.'.$section.'.divingComputer','')}}</x-show.value>
    </div>

    <div class="sm:col-span-1">
        <x-show.label>Immersioni effettuate annualmente</x-show.label>
        <x-show.value> {{data_get($anamnesis->data,'diving.'.$section.'.totalYearlyDives','')}}</x-show.value>
    </div>
    <div class="sm:col-span-1">
        <x-show.label>Come definiresti le tue capacità sub?</x-show.label>
        <x-show.value> {{data_get($anamnesis->data,'diving.'.$section.'.divingAbility','')}}</x-show.value>
    </div>
    <div class="sm:col-span-1">
        <x-show.label>In quale nazione effettui le immersioni?</x-show.label>
        <x-show.value> {{data_get($anamnesis->data,'diving.'.$section.'.divingCountry','')}}</x-show.value>
    </div>
    <div class="sm:col-span-1">
        <x-show.label>In quale nazione effettui maggiormente le immersioni?</x-show.label>
        <x-show.value> {{data_get($anamnesis->data,'diving.'.$section.'.divingCountryMore','')}}</x-show.value>
    </div>
    <div class="sm:col-span-1">
        <x-show.label>Quale è il massimo livello di brevetto che possiedi?</x-show.label>
        <x-show.value> {{data_get($anamnesis->data,'diving.'.$section.'.divingLevel','')}}</x-show.value>
    </div>
    @if(($divingLevel) && ($divingLevel =='dm' || $divingLevel=='instructor'))
        <div class="sm:col-span-1">
            <x-show.label>Se sei una guida/istruttore dove eserciti?</x-show.label>
            <x-show.value> {{data_get($anamnesis->data,'diving.'.$section.'.teachingCountry','')}}</x-show.value>
        </div>
    @endif
    <div class="sm:col-span-1">
        <x-show.label>{{$profession}} è la tua professione?</x-show.label>
        <x-show.value> {{data_get($anamnesis->data,'diving.'.$section.'.divingProfession','')}}</x-show.value>
    </div>
</dl>
