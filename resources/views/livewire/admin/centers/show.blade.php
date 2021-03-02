<div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="rounded-lg bg-white overflow-hidden shadow">
        <h2 class="sr-only" id="profile-overview-title">Dati del Centro</h2>
        <div class="bg-white p-6">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="sm:flex sm:space-x-5">
                    <div class="flex-shrink-0">
                        <img class="mx-auto h-20 w-20 rounded-full" src="{{$center->profile_photo_url}}" alt="">
                    </div>
                    <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                        <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{$center->name}}</p>
                        <a target="_blank" href="{{$center->full_url}}" class="text-sm font-medium text-gray-600">{{$center->full_url}}</a>
                    </div>
                </div>
                <div class="mt-5 flex justify-center sm:mt-0">
                    <a href="{{route('admin.centers.update',['tenant'=>$center])}}"
                       class="flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Modifica
                    </a>
                </div>
            </div>
        </div>
        <div
            class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x">
            <div class="px-6 py-5 text-sm font-medium text-center">
                <span class="text-gray-900">{{$center->users()->count()}}</span>
                <span class="text-gray-600">Utenti</span>
            </div>

            <div class="px-6 py-5 text-sm font-medium text-center">
                <span class="text-gray-900">{{$center->medicalRecord()->count()}}</span>
                <span class="text-gray-600">Cartelle Cliniche</span>
            </div>

        </div>
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <section>
        <div class="my-10 pb-5 border-b border-gray-400 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Utenti
            </h3>
            <div class="mt-3 sm:mt-0 sm:ml-4">
                <button
                    wire:click="$set('showCreateUserModal', true)"
                    type="button"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Crea nuovo utente
                </button>
            </div>
        </div>

        <livewire:staff.datatable :tenant="$center"/>
    </section>
    <div class="my-10 pb-5 border-b border-gray-400 sm:flex sm:items-center sm:justify-between">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Specialità
        </h3>
    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        @foreach(\App\Models\MedicalSpecialty::withoutGlobalScopes([\App\Scopes\TenantScope::class,\App\Scopes\OnlyForDoctorScope::class])->get() as $specialty)
            <a href="#" wire:click.prevent="toggleCenterSpecialty({{$specialty->id}})" class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                <div class="flex-shrink-0">
                    <span class="flex-shrink-0 inline-block relative">
                      <img class="h-10 w-10 rounded-full" src="{{$specialty->avatar()}}" alt="">
                      <span
                          class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white {{($selectedSpeciality->search($specialty->id) !== false) ? 'bg-green-400' : 'bg-red-400'}}"
                          aria-hidden="true"></span>
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                <span class="focus:outline-none">
                    <span class="absolute inset-0" aria-hidden="true"></span>
                    <p class="text-sm font-medium text-gray-900">
                        {{$specialty->name}}
                    </p>
                </span>
                </div>
            </a>
        @endforeach
    </div>

    <x-admin.create-user :center="$center"/>
</div>
