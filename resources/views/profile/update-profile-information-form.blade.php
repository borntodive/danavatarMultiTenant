<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profilo') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Aggiorna le informazione del tuo profilo') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-6">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Foto') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Seleziona una nuova foto') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Rimuovi Foto') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif



        <!-- Name -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="firstname" value="{{ __('Nome') }}" />
            <x-jet-input id="firstname" type="text" class="mt-1 block w-full" wire:model.defer="state.firstname" autocomplete="firstname" />
            <x-jet-input-error for="firstname" class="mt-2" />
        </div>

        <!-- Lastname -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="lastname" value="{{ __('Cognome') }}" />
            <x-jet-input id="lastname" type="text" class="mt-1 block w-full" wire:model.defer="state.lastname" autocomplete="lastname" />
            <x-jet-input-error for="lastname" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="gender" value="{{ __('Sesso') }}" />
            <select id="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="state.gender">
                <option></option>
                @foreach(\App\Enums\UserGender::asSelectArray() as $key=>$gender)
                    <option wire:key="{{ $loop->index }}" {{($gender == $key) ? "selected" : ""}} value="{{$key}}">{{$gender}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="gender" class="mt-2" />
        </div>


        <!-- Birthplace -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="place_of_birth" value="{{ __('Luogo di Nascita') }}" />
            <x-jet-input id="place_of_birth" type="text" class="mt-1 block w-full" wire:model.defer="state.place_of_birth" autocomplete="place_of_birth" />
            <x-jet-input-error for="place_of_birth" class="mt-2" />
        </div>

        <!-- Birthdate -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="dob" value="{{ __('Data di Nascita') }}" />
            <x-form.masked-date-input
                wire:model="state.dob"
                :value="($state['dob']) ? \Carbon\Carbon::create($state['dob'])->isoFormat('L') : null"
                :min="1900-01-01"
                :max="now()->format('Y-m-d')"
            />
            <x-jet-input-error for="dob" class="mt-2" />
        </div>

        <!-- CF -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="codice_fiscale" value="{{ __('Codice Fiscale') }}" />
            <x-jet-input id="codice_fiscale" type="text" class="mt-1 block w-full" wire:model.defer="state.codice_fiscale" autocomplete="codice_fiscale" />
            <x-jet-input-error for="codice_fiscale" class="mt-2" />
        </div>
        <!-- Address -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="address" value="{{ __('Indirizzo') }}" />
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.address" autocomplete="address" />
            <x-jet-input-error for="address" class="mt-2" />
        </div>

        <!-- Zipcode -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="zipcode" value="{{ __('CAP') }}" />
            <x-jet-input id="zipcode" type="text" class="mt-1 block w-full" wire:model.defer="state.zipcode" autocomplete="zipcode" />
            <x-jet-input-error for="zipcode" class="mt-2" />
        </div>

        <!-- City -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="city" value="{{ __('Città') }}" />
            <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="state.city" autocomplete="city" />
            <x-jet-input-error for="city" class="mt-2" />
        </div>
        <!-- State -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="state" value="{{ __('Provincia') }}" />
            <x-jet-input id="state" type="text" class="mt-1 block w-full" wire:model.defer="state.state" autocomplete="state" />
            <x-jet-input-error for="state" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="col-span-6 sm:col-span-2">
            <x-jet-label for="country" value="{{ __('Stato') }}" />
            <x-jet-input id="country" type="text" class="mt-1 block w-full" wire:model.defer="state.country" autocomplete="country" />
            <x-jet-input-error for="country" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Salvato.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Salva') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
