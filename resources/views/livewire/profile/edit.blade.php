<div>
    <x-card title="{{ __('I tuoi dati') }}">
        <form class="w-full" wire:submit.prevent="updateProfileInformation">
            <!-- Profile section -->
            <div class="py-6 px-4 sm:p-6 lg:pb-8">


                <div class="mt-6 flex flex-col lg:flex-row">
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

                </div>

                <div class="mt-6 grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-4">
                        <x-form.text-input id="firstname" wire:model="state.firstname" label="Nome"/>
                    </div>

                    <div class="col-span-12 sm:col-span-4">
                        <x-form.text-input id="lastname" wire:model="state.lastname" label="Cognome"/>
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <x-form.text-input id="email" type="email" wire:model="state.email" label="Email"/>
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <x-jet-label for="state.gender" value="{{ __('Sesso') }}" />
                        <select id="state.gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="state.gender">
                            <option></option>
                            @foreach(\App\Enums\UserGender::asSelectArray() as $key=>$gender)
                                <option wire:key="{{ $loop->index }}" {{($gender == $key) ? "selected" : ""}} value="{{$key}}">{{$gender}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="gender" class="mt-2" />
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <x-form.text-input id="place_of_birth" wire:model="state.place_of_birth" label="Luogo di Nascita"/>
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <x-form.masked-date-input
                            wire:model.defer="state.dob"
                            :min="1900-01-01"
                            :max="now()->format('Y-m-d')"
                            label="Data di Nascita"
                        />
                        <x-jet-input-error for="dob" class="mt-2" />

                    </div>
                    <div class="col-span-12 sm:col-span-8">
                        <x-form.text-input id="codice_fiscale" wire:model="state.codice_fiscale" label="Codice Fiscale"/>
                    </div>

                    <div class="col-span-12 sm:col-span-8">
                        <x-form.text-input id="address" wire:model="state.address" label="Indirizzo"/>
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <x-form.text-input id="zipcode" wire:model="state.zipcode" label="CAP"/>
                    </div>

                    <div class="col-span-12 sm:col-span-4">
                        <x-form.text-input id="city" wire:model="state.city" label="Città"/>
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <x-form.text-input id="state" wire:model="state.state" label="Provincia"/>
                    </div>
                    <div class="col-span-12 sm:col-span-4">
                        <x-form.text-input id="country" wire:model="state.country" label="Stato"/>
                    </div>
                </div>
            </div>

            <div class="mt-5">

                <x-jet-button>
                    {{ __('Salva') }}
                </x-jet-button>
            </div>
        </form>
    </x-card>
</div>
