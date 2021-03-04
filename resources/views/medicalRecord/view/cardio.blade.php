<x-card title="{{ __('Dati biometrici') }}">
    <dl class="w-full grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
            <x-show.label>{{ __('Altezza (cm)') }}</x-show.label>
            <x-show.value> {{data_get($medicalRecord->data,'height')}}</x-show.value>
        </div>
        <div class="sm:col-span-1">
            <x-show.label>{{ __('Peso') }}</x-show.label>
            <x-show.value> {{data_get($medicalRecord->data,'weight')}}</x-show.value>
        </div>
    </dl>
</x-card>
