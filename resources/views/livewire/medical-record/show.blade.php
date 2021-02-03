
<div>
    <x-medical-record.header
        :user="$user"
        buttonLabel="Nuova Visita"
    />
    <div class="mt-8">
        <x-card title="{{ __('Anamnesi') }}">

        </x-card>
    </div>
    @include('livewire.medical-record.partials.specialities-modal')
</div>
