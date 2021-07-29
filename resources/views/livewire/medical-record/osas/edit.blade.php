<x-medical-record.common-edit>
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full">
            <div class="container grid grid-cols-1 gap-8 pt-6 mx-auto md:grid-cols-2">
                @foreach($anamnesis as $key=>$radio)
                    <div class="flex flex-col mb-6 md:w-full">
                        <x-form.label>{{ $radio['label'] }}</x-form.label>
                        <div class="flex flex-wrap mt-3 md:w-full">
                            @foreach ($radio['options'] as $idx => $option)
                                <div class="px-10 mt-2"><input wire:model="state.anamnesis.general.{{ $key }}.present"
                                        type="radio" value="{{ $idx }}" /> {{ $option }}</div>
                            @endforeach
                        </div>
                    </div>
                    @if (isset($radio['if_yes']) && data_get($this->state, 'anamnesis.general.' . $key.'.present', null) == 'si')
                        <div class="flex flex-col">
                            <x-form.text-input wire:model='state.anamnesis.general.{{ $key }}.more' :label="$radio['if_yes']"/>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @foreach ($checkboxs as $checkbox)
            <div class="w-full mt-10">
                <div class="flex flex-col place-content-center">
                    <x-form.label>{{$checkbox['label']}}</x-form.label>
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-4">
                        @foreach ($checkbox['options'] as $option)
                            <div class="flex flex-col content-center mt-4">
                                <x-form.label class="text-center" :sublabel="true">{{ $option }}</x-form.label>
                                <x-form.checkbox class="mt-2 text-center" value="1" id="sintomi_{{ Str::snake($option, '_') }}"
                                    wire:model="{{$checkbox['target']}}.{{ Str::snake($option, '_') }}" />

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </x-card>
    <x-card title="{{ __('Esami Obiettivi') }}" class="mt-5">
    </x-card>
</x-medical-record.common-edit>







