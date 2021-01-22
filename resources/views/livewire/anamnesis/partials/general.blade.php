<x-form.card title="{{ __('Dati biometrici') }}">
    <div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
        <x-form.text-input id="height" name="state.height" wire:model="state.height" label="{{ __('Altezza (cm)') }}" autocomplete="height"/>
    </div><div class="xl:w-2/5 lg:w-2/5 md:w-2/5 flex flex-col mb-6">
        <x-form.text-input id="weight" name="weight" wire:model="state.weight" label="{{ __('Peso (kg)') }}" autocomplete="weight"/>
    </div>
</x-form.card>
<x-form.card class="mt-3" title="{{ __('Dati anamnestici') }}">

    <div class="xl:w-2/6 lg:w-2/6 md:w-2/6 flex flex-col mb-6 px-2 -ml-2">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-6">
            </div>
            <div class="col-span-3 text-center">
                Presente
            </div>
            <div class="col-span-3 text-center">
                Passato
            </div>
        </div>
    </div>
    <div class="hidden md:block xl:w-2/6 lg:w-2/6 md:w-2/6 flex flex-col mb-6 px-2 -ml-2">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-6">
            </div>
            <div class="col-span-3 text-center">
                Presente
            </div>
            <div class="col-span-3 text-center">
                Passato
            </div>
        </div>
    </div>
    <div class="hidden md:block xl:w-2/6 lg:w-2/6 md:w-2/6 flex flex-col mb-6 px-2 -ml-2">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-6">
            </div>
            <div class="col-span-3 text-center">
                Presente
            </div>
            <div class="col-span-3 text-center">
                Passato
            </div>
        </div>
    </div>
    @foreach($medicalConditions as $name=>$displayName)
        <div class="xl:w-2/6 lg:w-2/6 md:w-2/6 flex flex-col mb-6 px-2 -ml-2">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-6">
                     {{$displayName}}
                </div>
                <div class="col-span-3 text-center">
                    <x-form.checkbox value="1" id="anamnesisData_{{$name}}_present" wire:model="state.anamnesisData.{{$name}}.present"/>
                </div>
                <div class="col-span-3 text-center">
                    <x-form.checkbox value="1" id="anamnesisData_{{$name}}_past"  wire:model="state.anamnesisData.{{$name}}.past"/>
                </div>
            </div>
        </div>
    @endforeach

    <div class="flex items-center mr-4 mb-4">
        <div >
            Pregresse cardio-vasculopatie?
        </div>
        <div>
            <input type="radio" id="yes" name="drone" value="yes"
                   >
            <label for="yes">Si</label>
        </div>
        <div>
            <input type="radio" id="no" name="drone" value="no"
            >
            <label for="no">No</label>
        </div>
    </div>
</x-form.card>





