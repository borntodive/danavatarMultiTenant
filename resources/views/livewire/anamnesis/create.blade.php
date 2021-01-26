<form wire:submit.prevent="createAnamnesis">
    <div>
    @include('livewire.anamnesis.partials.general')
    </div>
    <div class="mt-5">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Salvato.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Salva') }}
        </x-jet-button>
    </div>
</form>
