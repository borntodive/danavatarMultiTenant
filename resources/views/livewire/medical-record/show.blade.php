
@php
$button1=null;
$button2=null;
if ($user->id!=auth()->user()->id) {
    $button1['label']='Nuova Visita';
    $button1['wireClick']="showEdit({$user->id})";
}
if(session()->get('tenant')->hasMedicalSpecilities('wearable')) {
     $button2['label']='Wearable';
     $button2['href']=route('wearable.calendar',[$user]);
}
@endphp

<div wire:key="time().'medical'">
    @if ($isSpecialitiesModalVisible)
    @include('livewire.medical-record.partials.specialities-modal')
    @endif
    <x-medical-record.header
        :user="$user"
        :button="$button1"
        :button2="$button2"
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

