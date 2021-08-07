<form wire:submit.prevent="createMedicalRecord">

    <x-card title="{{ __('Osservazione') }}" class="mt-5">
        <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-2">
            <x-form.text-input label="Nome del luogo" wire:model="state.misurazioni.luogo"/>
            <x-form.text-input label="Nome del AMP" wire:model="state.misurazioni.amp"/>
        </div>
        <div class="w-1/2 mt-5">
            <x-form.masked-date-input
                wire:model.lazy="state.misurazioni.date"
                :min="1900-01-01"
                :max="now()->format('Y-m-d')"
                label="Data"
            />
        </div>
        <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-2">
            <x-form.text-input label="Profondità Massima" wire:model="state.misurazioni.profondita.max"/>
            <x-form.text-input label="Profondità Media" wire:model="state.misurazioni.profondita.mean"/>
        </div>
        <div class="grid w-full grid-cols-4 gap-8 mt-10">
            <div></div>
            <div class="col-span-3 text-center">
                Rilevamento delle temperatura dell'acqua durante il campionamento in ºC e della visibilità in mt
            </div>
            <div></div>
            <div class="text-center">
                <x-form.label>Profondità Massima</x-form.label>
            </div>
            <div class="text-center">
                <x-form.label>Profondità Media</x-form.label>
            </div>
            <div class="text-center">
                <x-form.label>Superficie (0-5 mt)</x-form.label>
            </div>
            @foreach ($fields as $idx=>$field)
            <div>
                <x-form.label>{{$field['name']}}</x-form.label>
            </div>
                @foreach(['max','mean','min'] as $d)
                    @if($field['type']=='text')

                        <div class="text-center">
                            <x-form.text-input wire:model="state.misurazioni.{{$idx}}.{{$d}}"/>
                        </div>
                    @else
                        <div class="text-center">
                            <x-form.select id="state.misurazioni.{{$idx}}.{{$d}}"
                                   wire:model="state.misurazioni.{{$idx}}.{{$d}}"
                                   :options="$field['options']"/>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </x-card>

    <div class="mt-5">

        <x-jet-button>
            {{ __('Salva') }}
        </x-jet-button>
    </div>
</form>








