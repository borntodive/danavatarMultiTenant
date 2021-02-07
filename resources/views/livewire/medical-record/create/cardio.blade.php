<x-card title="{{ __('Dati biometrici') }}">
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
        <x-form.text-input type="number" wire:model="state.height" label="{{ __('Altezza (cm)') }}"
                           autocomplete="height"/>
    </div>
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
        <x-form.text-input type="number" wire:model="state.weight" label="{{ __('Peso (kg)') }}"
                           autocomplete="weight"/>
    </div>
</x-card>






