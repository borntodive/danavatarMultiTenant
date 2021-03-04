<form wire:submit.prevent="createAnamnesis">
    <div>
    @include('livewire.anamnesis.partials.general')
    </div>
    @if(session()->get('tenant')->hasMedicalSpecilities('diving'))
        @include('livewire.anamnesis.partials.diving')
    @endif
    <div class="mt-5">

        <x-jet-button>
            {{ __('Salva') }}
        </x-jet-button>
    </div>
</form>
