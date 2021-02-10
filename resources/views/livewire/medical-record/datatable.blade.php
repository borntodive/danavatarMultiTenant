<div class="flex flex-col">
    <div class="flex flex-row justify-between">

        <x-form.search-input wire:model.debounce.500ms="search" placeholder="{{ __('Cerca') }}" class="w-1/4 mb-5"/>
    </div>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach($users as $user)
                <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="flex-1 flex flex-col p-8">
                        <img class="w-32 h-32 flex-shrink-0 mx-auto bg-black rounded-full" src="{{$user->profile_photo_url}}" alt="">
                        <h3 class="mt-6 text-gray-900 text-sm font-medium">{{$user->name}}</h3>
                        <dl class="mt-1 flex-grow flex flex-col justify-between">
                            <dt class="sr-only">Email</dt>
                            <dd class="text-gray-500 text-sm">{{$user->email}}</dd>
                            <dt class="sr-only">Birthdate</dt>
                            <dd class="text-gray-500 text-sm">{{ ($user->dob) ? $user->dob->isoFormat('L') : ''}}</dd>
                            <dt class="sr-only">Codice Fiscale</dt>
                            <dd class="text-gray-500 text-sm">{{$user->codice_fiscale}}</dd>
                        </dl>
                    </div>
                    <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            <div class="w-0 flex-1 flex">
                                <a href="{{route('medical_record.show',$user)}}" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    <span class="ml-3">Visualizza</span>
                                </a>
                            </div>
                            <div class="-ml-px w-0 flex-1 flex">
                                <a wire:click.prevent="showEdit({{$user->id}})" href="#" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    <span class="ml-3">Nuova</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="mt-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>
    @if($isSpecialitiesModalVisible)
        @include('livewire.medical-record.partials.specialities-modal')
    @endif
</div>



