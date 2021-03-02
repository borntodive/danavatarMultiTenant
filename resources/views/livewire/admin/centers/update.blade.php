<div>
    <x-card title="{{ __('Dati del centro') }}">
        <form class="w-full" wire:submit.prevent="updateTenantInformation">
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
                            <img src="{{ $this->center->profile_photo_url }}" alt="{{ $this->center->name }}" class="rounded-full h-20 w-20 object-cover">
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

                        @if ($this->center->profile_photo_path)
                            <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                {{ __('Rimuovi Foto') }}
                            </x-jet-secondary-button>
                        @endif

                        <x-jet-input-error for="photo" class="mt-2" />
                    </div>

                </div>

                <div class="mt-6 grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-4">
                        <x-form.text-input wire:model="center.name" label="Nome"/>
                    </div>

                    <div class="col-span-12 sm:col-span-4">
                        <x-form.text-input wire:model="center.url" label="Url"/>
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
