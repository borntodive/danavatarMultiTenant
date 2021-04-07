<div class="bg-white py-16 px-4  sm:px-6 lg:px-8 lg:py-24">
    <div class="relative max-w-xl mx-auto">
        <svg class="absolute left-full transform translate-x-1/2" width="404" height="404" fill="none" viewBox="0 0 404 404" aria-hidden="true">
            <defs>
                <pattern id="85737c0e-0916-41d7-917f-596dc7edfa27" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                </pattern>
            </defs>
            <rect width="404" height="404" fill="url(#85737c0e-0916-41d7-917f-596dc7edfa27)" />
        </svg>
        <svg class="absolute right-full bottom-0 transform -translate-x-1/2" width="404" height="404" fill="none" viewBox="0 0 404 404" aria-hidden="true">
            <defs>
                <pattern id="85737c0e-0916-41d7-917f-596dc7edfa27" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                </pattern>
            </defs>
            <rect width="404" height="404" fill="url(#85737c0e-0916-41d7-917f-596dc7edfa27)" />
        </svg>
        <div class="text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Contact sales
            </h2>
            <p class="mt-4 text-lg leading-6 text-gray-500">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eget nisi in felis venenatis dignissim ut ut enim. Cras egestas, libero id mattis auctor, magna turpis posuere sapien, nec condimentum mauris sem at libero. Maecenas dignissim egestas euismod. Ut ullamcorper imperdiet elit, eu finibus arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec nec mi non sem euismod euismod quis ut urna. Morbi tincidunt nunc eget dui auctor, eleifend egestas lectus porttitor. Nulla eu facilisis sem. Cras eleifend magna quis ipsum elementum condimentum. Integer sed enim lacus. Quisque congue bibendum ligula, a molestie dui facilisis in. Aenean sollicitudin ultricies massa ut varius. Aenean ullamcorper ex a turpis consectetur ultrices.
            </p>
            <p>
            </p>
        </div>
        <div class="mt-12">
            <form action="#" wire:submit.prevent="acceptInvite()" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                @if (!$user)
                <div>
                    <x-form.text-input label="Nome" wire:model="firstname"/>
                </div>
                <div>
                    <x-form.text-input label="Cognome" wire:model="lastname"/>

                </div>
                <div>
                    <x-form.text-input label="Email" wire:model="email"/>
                </div>
                <div>
                    <x-form.label>Data di Nascita</x-form.label>
                    <x-form.masked-date-input
                        wire:model="dob"
                        :min="1900-01-01"
                        :max="now()->format('Y-m-d')"
                    />
                </div>
                <div class="sm:col-span-2">
                    <x-form.text-input label="Codice Fiscale" wire:model="codice_fiscale"/>
                </div>
                <div>
                    <x-form.text-input type="password" label="Password" wire:model="password"/>
                </div>
                <div>
                    <x-form.text-input type="password" label="Conferma Password" wire:model="password_confirmation"/>

                </div>
                @endif
                <div class="sm:col-span-2">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
                            <x-form.toggle entangle="acceptPrivacy"/>
                        </div>
                        <div class="ml-3">
                            <p class="text-base text-gray-500">
                                Selezionando accetti la
                                <a href="#" class="font-medium text-gray-700 underline">Privacy Policy</a>
                                e la
                                <a href="#" class="font-medium text-gray-700 underline">Cookie Policy</a>.
                            </p>
                        </div>

                    </div>
                    @error('acceptPrivacy')
                    <p wire:key="error_acceptPrivacy"
                       class="mt-2 text-sm text-red-600" id="email-error">{{$message}}</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Accetta
                    </button>
                </div>
            </form>
        </div>
    </div>
    @if($showSuccessModal)
    <div x-cloak x-data="{ open: @entangle('showSuccessModal') }" x-init="
    () => document.body.classList.add('overflow-hidden');
    $watch('open', value => {
      if (value === true) { document.body.classList.add('overflow-hidden') }
      else { document.body.classList.remove('overflow-hidden') }
    });" x-show="open" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" x-description="Background overlay, show/hide based on modal state." x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div x-show="open" x-description="Modal panel, show/hide based on modal state." x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-green-600" x-description="Heroicon name: outline/check" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            Dati Salvati con successo
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Ora puoi accedere al centro medico {{$invite->center->name}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <a href="{{route('login')}}" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                        Effettua il login
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
