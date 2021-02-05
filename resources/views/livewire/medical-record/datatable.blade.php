<div class="flex flex-col">
    <div class="flex flex-row justify-between">
        <x-form.text-input wire:model.debounce.500ms="search" label="{{ __('Cerca') }}" class="w-1/4 mb-5"/>
    </div>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-x-scroll xl:overflow-x-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <button wire:click="sortBy('firstname')" class="bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nome</button>
                                <x-sort-icon
                                    field="firstname"
                                    :sortField="$sortField"
                                    :sortAsc="$sortAsc"
                                />
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <button wire:click="sortBy('dob')" class="bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Data di Nascita</button>
                                <x-sort-icon
                                    field="dob"
                                    :sortField="$sortField"
                                    :sortAsc="$sortAsc"
                                />
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full"
                                         src="{{$user->profile_photo_url}}" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$user->name}}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{$user->email}}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ ($user->dob) ? $user->dob->isoFormat('L') : ''}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <x-dotted-menu>
                                <a href="{{route('medical_record.show',$user)}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Visualizza</a>
                                <span @click="open = false" wire:click.prevent="showEdit({{$user->id}})" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Nuova</span>
                            </x-dotted-menu>
                        </td>
                    </tr>
                    @endforeach
                    <!-- More items... -->
                    </tbody>
                </table>

            </div>
            <div class="mt-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>
    @if($isSpecialitiesModalVisible)
        @include('livewire.medical-record.partials.specialities-modal')
    @endif
</div>



