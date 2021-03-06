<form wire:submit.prevent="createMedicalRecord">
    <x-card title="{{ __('Motivo della visita') }}">
        <div class="w-full">
            <x-form.text-area wire:model="state.reason"/>
        </div>
    </x-card>
    {{$slot}}
    <x-card title="{{ __('Diagnosi') }}" class="mt-5">
        <div class="w-full">
            <x-form.text-area wire:model="state.diagnosis"/>
        </div>

    </x-card>
    <x-card title="{{ __('Terapia') }}" class="mt-5">
        <div class="w-full">
            <x-form.text-area wire:model="state.therapy"/>
        </div>
    </x-card>
    <x-card title="{{ __('FollowUp') }}" class="mt-5">
        <div class="w-full">
            <x-form.text-area wire:model="state.followup"/>
        </div>
    </x-card>
    <x-card title="{{ __('Commenti') }}" class="mt-5">
        <div class="w-full">
            <x-form.text-area wire:model="state.comments"/>
        </div>
    </x-card>
    <div class="mt-5">

        <x-jet-button>
            {{ __('Salva') }}
        </x-jet-button>
    </div>
</form>






