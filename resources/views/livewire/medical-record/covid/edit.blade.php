<x-medical-record.common-edit>

    <x-card title="{{ __('Esami Strumentali') }}" class="mt-5">
        <div class="flex ">
        @foreach($times as $time_id=>$time)
            <button type="button"
                    wire:click="$set('selectedTime', '{{$time_id}}')"
                    class="flex-grow inline-flex items-center mx-4 px-6 py-3 {{$selectedTime==$time_id ? 'border-2 border-'.$time['color'].'-500' : 'border border-transparent'}} text-base font-medium rounded-md text-{{$time['color']}}-700 bg-{{$time['color']}}-100 hover:bg-{{$time['color']}}-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{$time['color']}}-500">
                {{$time['name']}}
            </button>
        @endforeach
        </div>
        @foreach($times as $time_id=>$time)
        <div class="{{$selectedTime==$time_id ? 'block' : 'hidden'}} bg-{{$time['color']}}-50 border-l-4 border-{{$time['color']}}-400 p-4 w-full mt-5">
            @foreach($exams as $sectionCode=>$section)
                <div class="w-full {{$loop->first ? "-mt-5" : "mt-5"}}">
                    <x-section-heading bg="bg-{{$time['color']}}-50">
                        {{$section['name']}}
                    </x-section-heading>
                </div>
                <div class="grid grid-cols-12 gap-8 w-full">
                    @foreach($section['fields'] as $code=>$field)
                        <div class="col-span-12 sm:col-span-4 ">
                            <div>
                                <label for="{{$time_id}}_{{$sectionCode}}_{{$code}}" class="block text-sm font-medium text-gray-700">{{ $field['name'] }}</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="{{$time_id}}_{{$sectionCode}}_{{$code}}" id="{{$time_id}}_{{$sectionCode}}_{{$code}}"
                                           wire:model="state.exams.instrumental.{{$time_id}}.{{$sectionCode}}.{{$code}}"
                                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                           placeholder="0.00" aria-describedby="price-currency">
                                    @if (isset($field['unit']))
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                      <span class="text-gray-500 sm:text-sm">
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
        </div>
        @endforeach
    </x-card>

</x-medical-record.common-edit>








