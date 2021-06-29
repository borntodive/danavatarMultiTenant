@props([
    'target' => null,
    'label'=>null,
    'options'=>false,
    'more'=>null
    ])

<div class="col-span-2 flex flex-col place-content-center">
    <x-form.label>{{$label}}</x-form.label>
</div>

@if (!$options)
    <div class="col-span-3 text-center flex flex-row place-content-center">
        <div class="flex-grow text-center flex flex-wrap content-center">
            <x-form.text-area class="w-full" id="disorders_{{$target}}"
                             wire:model.lazy="state.anamnesis.general.{{$target}}"/>
        </div>
    </div>
@else
    <div class="col-span-{{$more ? '2' : '3'}} text-center flex flex-row place-content-center">
        @if (count($options)==1)
        <div class="flex-grow text-center flex flex-wrap content-center">
            <x-form.checkbox value="1" id="disorders_{{$target}}"
                             wire:model.lazy="state.anamnesis.general.{{$target}}.present"/>
        </div>

        @else
            @foreach($options as $option)
                <div class="flex-grow text-center flex flex-col content-center">
                    <x-form.label>{{$option}}</x-form.label>
                    <x-form.checkbox value="1" id="disorders_{{$target}}_sx"
                                     wire:model.lazy="state.anamnesis.general.{{$target}}.{{strtolower($option)}}.present"/>

                </div>
            @endforeach
        @endif
    </div>
    @if($more=='date')
        <div class="col-span-1 text-center flex flex-wrap content-center">
            <x-form.masked-date-input
                wire:model.lazy="state.anamnesis.general.{{$target}}.date"
                :min="1900-01-01"
                :max="now()->format('Y-m-d')"
            />
        </div>
    @elseif($more=='text')
        <div class="col-span-1 text-center flex flex-wrap content-center">
            <x-form.text-input
                label="Note"
                wire:model="state.anamnesis.general.{{$target}}.more">
            </x-form.text-input>
        </div>
    @endif
@endif
