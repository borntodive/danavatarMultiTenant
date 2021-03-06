@props([
   'medicalRecord'
])
<div class="w-full">
    <x-card title="{{ __('Motivo della visita') }}">
        <x-show.textarea>
            {{data_get($medicalRecord->data,'reason','N/A')}}
        </x-show.textarea>
    </x-card>
    {{$slot}}
    <x-card title="{{ __('Diagnosi') }}" class="mt-5">
        <x-show.textarea>
            {{data_get($medicalRecord->data,'diagnosis','N/A')}}
        </x-show.textarea>
    </x-card>
    <x-card title="{{ __('Terapia') }}" class="mt-5">
        <x-show.textarea>
            {{data_get($medicalRecord->data,'therapy','N/A')}}
        </x-show.textarea>
    </x-card>
    <x-card title="{{ __('FollowUp') }}" class="mt-5">
        <x-show.textarea>
            {{data_get($medicalRecord->data,'followup','N/A')}}
        </x-show.textarea>

    </x-card>
    <x-card title="{{ __('Commenti') }}" class="mt-5">
        <x-show.textarea>
            {{data_get($medicalRecord->data,'comments','N/A')}}
        </x-show.textarea>
    </x-card>
</div>






