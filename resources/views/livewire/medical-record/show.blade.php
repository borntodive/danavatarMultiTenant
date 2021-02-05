
<div>
    <x-medical-record.header
        :user="$user"
        buttonLabel="Nuova Visita"
    />
    <div class="mt-8">
        <x-card title="{{ __('Anamnesi') }}">
            @livewire('medical-record.show.card',['user'=>$user,'modelName'=>'Anamnesis'])
        </x-card>
        @foreach(\App\Models\MedicalSpecialty::orderBy('name')->get() as $ms)
            <x-card class="mt-4" title="{{ $ms->name }}">
                @livewire('medical-record.show.card',['user'=>$user,'modelName'=>'MedicalRecord','specialtyId'=>$ms->id])
            </x-card>
        @endforeach
    </div>
</div>
