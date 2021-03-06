<x-card title="{{ __('Anamnesi') }}">
    <div class="w-full -mt-5">
        <x-section-heading>
            {{__('Morfologica')}}
        </x-section-heading>
        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.text-input type="number" wire:model="state.general.height" label="{{ __('Altezza (cm)') }}"
                                   autocomplete="height"/>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.text-input type="number" wire:model="state.general.weight" label="{{ __('Peso (kg)') }}"
                                   autocomplete="weight"/>
            </div>
        </div>
        <x-section-heading>
            {{__('Generale')}}
        </x-section-heading>
        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.label>Tipo di lavoro</x-form.label>
                <div class="md:w-full flex flex-row mt-3">
                    <div class="w-1/2"><input wire:model="state.general.jobType" name="jobType" type="radio" value="sedentary" /> Sedenatrio</div>
                    <div class="w-1/2"><input wire:model="state.general.jobType" name="jobType" type="radio" value="active" /> Attivo</div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-form.label>Caratteristiche</x-form.label>
                <div class="md:w-full flex flex-row mt-3">
                    <div class="w-1/2"><input wire:model="state.general.jobPeculiarity" name="jobPeculiarity" type="radio" value="fixed" /> Orari Fissi</div>
                    <div class="w-1/2"><input wire:model="state.general.jobPeculiarity" name="jobPeculiarity" type="radio" value="shifts" /> Turni</div>
                </div>
            </div>

        </div>
        <x-section-heading>
            {{__('Sportiva')}}
        </x-section-heading>
        <div class="px-4 py-3 text-right sm:px-6">
            <button type="button" wire:click.prevent="addSport" class="bg-gray-800 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                Aggiungi Sport
            </button>
        </div>
        @foreach($this->state['general']['sports'] as $idx=>$sport)
            <div class="border border-gray-500 rounded-md mb-3 p-5">
                <div class="grid grid-cols-12 gap-8">
                    <div class="col-span-12 sm:col-span-6 ">
                        <x-form.text-input type="text" wire:model="state.general.sports.{{$loop->index}}.name" label="{{ __('Sport praticato') }}"/>
                    </div>
                    <div class="col-span-12 sm:col-span-6 ">
                        <x-form.label>Livello</x-form.label>
                        <div class="md:w-full flex flex-row mt-3">
                            <div class="w-1/3"><input wire:model="state.general.sports.{{$loop->index}}.level"  type="radio" value="agonistic" /> Agonistico</div>
                            <div class="w-1/3"><input wire:model="state.general.sports.{{$loop->index}}.level"  type="radio" value="amateur" /> Amatoriale</div>
                            <div class="w-1/3"><input wire:model="state.general.sports.{{$loop->index}}.level"  type="radio" value="occasional" /> Saltuario</div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 ">
                        <x-form.label>Quante ore/settimana</x-form.label>
                        <div class="md:w-full flex flex-row mt-3">
                            <div class="w-1/4"><input wire:model="state.general.sports.{{$loop->index}}.time"  type="radio" value="1" /> < 1 ora</div>
                            <div class="w-1/4"><input wire:model="state.general.sports.{{$loop->index}}.time"  type="radio" value="2" /> 1-2 ore</div>
                            <div class="w-1/4"><input wire:model="state.general.sports.{{$loop->index}}.time"  type="radio" value="3" /> 3-6 ore</div>
                            <div class="w-1/4"><input wire:model="state.general.sports.{{$loop->index}}.time"  type="radio" value="6" /> 6+ ore</div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 ">
                        <x-form.label>Preferenze orario di allenamento</x-form.label>
                        <div class="md:w-full flex flex-row mt-3">
                            <div class="w-1/4"><input wire:model="state.general.sports.{{$loop->index}}.hrs"  type="checkbox" value="8" /> 08:00-12:00</div>
                            <div class="w-1/4"><input wire:model="state.general.sports.{{$loop->index}}.hrs"  type="checkbox" value="12" /> 12:00-15:00</div>
                            <div class="w-1/4"><input wire:model="state.general.sports.{{$loop->index}}.hrs"  type="checkbox" value="15" /> 15:00-18:00</div>
                            <div class="w-1/4"><input wire:model="state.general.sports.{{$loop->index}}.hrs"  type="checkbox" value="18" /> 18:00-20:00</div>
                        </div>
                    </div>
                    <div class="col-span-12 text-right">
                        <button type="button" wire:click.prevent="deleteSport({{$idx}})" class="bg-red-800 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-900">
                            Cancella
                        </button>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</x-card>






