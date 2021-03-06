<x-medical-record.common-view :medicalRecord="$medicalRecord">
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full -mt-5">
            <x-section-heading>
                {{__('Morfologica')}}
            </x-section-heading>
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>{{ __('Altezza (cm)') }}</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.height','N/A')}}</x-show.value>
                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>{{ __('Peso (kg)') }}</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.weight','N/A')}}</x-show.value>
                </div>
            </div>
            <x-section-heading>
                {{__('Generale')}}
            </x-section-heading>
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>Tipo di lavoro</x-show.label>
                    <x-show.value>{{__('nutrizionist.'.data_get($medicalRecord->data,'anamnesis.general.jobType','na'))}}</x-show.value>
                </div>

            </div>
        </div>
    </x-card>
</x-medical-record.common-view>
