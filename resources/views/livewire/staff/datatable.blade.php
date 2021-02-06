<div class="flex flex-col">
    <div class="flex flex-row justify-between">
        <x-form.search-input wire:model.debounce.500ms="search" label="{{ __('Cerca') }}" class="w-1/4 mb-5"/>
        <x-form.select-button id="role_filter"
                              wire:model="roleFilter"
                               wire:change="filterRole($event.target.value)"
                               wire:click="clearRole()"
                               :options="$roles->pluck('display_name','id')"
                               label="Filtra Ruoli"
                               placeholder="Seleziona un ruolo"
                               class="w-1/4 mb-5"

        />
    </div>
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                            Ruolo
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
                            <x-form.select id="role_{{$user->id}}"
                                           wire:change="updateRole({{$user->id}}, $event.target.value)"
                                           :options="$roles->pluck('display_name','id')"
                                           :selected="$user->roles()->first()->id"
                                           />


                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @if($user->roles()->first()->name=='medical_doctor')
                            <button wire:click="showSideEdit({{$user->id}})" class="text-indigo-600 hover:text-indigo-900">Modifica</button>
                            @endif
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

    @include('livewire.staff.partials.edit-specialities')
</div>

