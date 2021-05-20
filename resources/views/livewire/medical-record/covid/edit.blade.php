<x-medical-record.common-edit>

    <x-card title="{{ __('Esami Strumentali') }}" class="mt-5">
        @foreach($exams as $sectionCode=>$section)
            <div class="w-full {{$loop->first ? "-mt-5" : "mt-5"}}">
                <x-section-heading>
                    {{$section['name']}}
                </x-section-heading>
            </div>
            <div class="grid grid-cols-12 gap-8 w-full">
                @foreach($section['fields'] as $code=>$field)
                    <div class="col-span-12 sm:col-span-4 ">
                        <div>
                            <label for="{{$sectionCode}}_{{$code}}" class="block text-sm font-medium text-gray-700">{{ $field['name'] }}</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="{{$sectionCode}}_{{$code}}" id="{{$sectionCode}}_{{$code}}"
                                       wire:model="state.exams.instrumental.{{$sectionCode}}.{{$code}}"
                                       class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                       placeholder="0.00" aria-describedby="price-currency">
                                @if (isset($field['unit']))
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                      <span class="text-gray-500 sm:text-sm" id="price-currency">
                                        {{$field['unit']}}
                                      </span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </x-card>

</x-medical-record.common-edit>








