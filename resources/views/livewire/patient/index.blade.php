<div class="px-5">
    <div wire:loading.delay wire:target="sendInvite, createUser, inviteUser">
        <x-loader/>
        .
    </div>
    <div class="bg-white shadow sm:rounded-lg w-full md:w-1/2 mx-auto">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Cerca Paziente
            </h3>
            <div class="mt-2 max-w-xl text-sm text-gray-500">
                <p>
                    Change the email address you want associated with your account.
                </p>
            </div>
            <form wire:submit.prevent="searchCF()" class="mt-5 sm:flex sm:items-center sm:flex-col">
                <div class="max-w-xs w-full flex">
                    <x-form.text-input wire:model="searchedCF"/>
                    <span
                        class="mt-3 inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        wire:click="openCFCalculation()"
                    >
                        Calcola</span>
                </div>
                <div class="mt-5">
                    <button type="submit"
                            class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cerca
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-6"></div>
    @if($foundUser)
        <section aria-labelledby="profile-overview-title">
            <div class="rounded-lg bg-white overflow-hidden shadow">
                <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
                <div class="bg-white p-6">
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <div class="sm:flex sm:space-x-5">
                            <div class="flex-shrink-0">
                                <img class="mx-auto h-20 w-20 rounded-full" src="{{$foundUser->profile_photo_url}}"
                                     alt="">
                            </div>
                            <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                <p class="my-5 text-xl font-bold text-gray-900 sm:text-2xl">{{$foundUser->name}}</p>
                            </div>
                        </div>
                        <div class="mt-5 flex justify-center sm:mt-0">
                            <a wire:click.prevent="inviteUser()" href="#"
                               class="flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Invita
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-3 sm:divide-y-0 sm:divide-x">

                    <div class="px-6 py-5 text-sm font-medium text-center">
                        <span class="text-gray-900">{{$foundUser->email}}</span>
                    </div>

                    <div class="px-6 py-5 text-sm font-medium text-center">
                        <span class="text-gray-900">{{($foundUser->dob) ? $foundUser->dob->isoFormat('L') : ''}}</span>
                    </div>

                    <div class="px-6 py-5 text-sm font-medium text-center">
                        <span class="text-gray-900">{{$foundUser->codice_fiscale}}</span>
                        <!-- space -->
                    </div>

                </div>
            </div>
        </section>
    @endif
    @if($searched && !$foundUser)
    <div class="w-full">
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex justify-center">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: solid/exclamation -->
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Il codice fiscale che ha inserito non corrisponde a nessun utente. Puoi crearne una nuovo qui
                        sotto
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-12">
            <x-card title="Nuovo Utente">
                <form action="#" wire:submit.prevent="createUser()"
                      class="w-full grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">


                    <div>
                        <x-form.text-input label="Nome" wire:model="newUserData.firstname"/>
                    </div>
                    <div>
                        <x-form.text-input label="Cognome" wire:model="newUserData.lastname"/>

                    </div>
                    <div>
                        <x-form.text-input type="email" label="Email" wire:model="newUserData.email"/>
                    </div>
                    <div>
                        <x-form.label>Data di Nascita</x-form.label>
                        <x-form.masked-date-input
                            wire:model="calcCF.dob"
                            :min="1900-01-01"
                            :max="now()->format('Y-m-d')"
                        />
                    </div>
                    <div>
                        <x-form.text-input label="Codice Fiscale" wire:model="newUserData.codice_fiscale"/>
                    </div>

                    <div class="sm:col-span-2">
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Crea
                        </button>
                    </div>

                </form>
            </x-card>
        </div>
    </div>
    @endif
    @if($showCFCalculation)
    @include('patient.partials.cf-search-modal')
    @endif
</div>

