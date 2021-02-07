
<div wire:key="time().'medical'">
    @if ($isSpecialitiesModalVisible)
    @include('livewire.medical-record.partials.specialities-modal')
    @endif
    <x-medical-record.header
        :user="$user"
        buttonLabel="Nuova Visita"
    />
    <div class="mt-8"/>
    <div wire:key="all_cards">
        <x-card title="{{ __('Anamnesi') }}">
            @livewire('medical-record.show.card',['user'=>$user,'modelName'=>'Anamnesis'],key('anamnesis'))
        </x-card>
        @foreach(\App\Models\MedicalSpecialty::orderBy('name')->get() as $ms)
            <x-card class="mt-4" title="{{ $ms->name }}">
                @livewire('medical-record.show.card',['user'=>$user,'modelName'=>'MedicalRecord','specialtyId'=>$ms->id],key($ms->name))
            </x-card>
        @endforeach
    </div>
</div>

