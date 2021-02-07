<form wire:submit.prevent="createMedicalRecord">
    <x-medical-record.header
        :user="$user"
    />
    <div class="mt-5"></div>
    @include('livewire.medical-record.create.'.$specialty->slug)
    <div class="mt-5">
        <x-jet-button>
            {{ __('Salva') }}
        </x-jet-button>
    </div>
</form>

