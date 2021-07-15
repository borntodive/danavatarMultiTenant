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
                <div class="grid w-full grid-cols-12 gap-8">
                    @foreach($section['fields'] as $code=>$field)
                        <div class="col-span-12 sm:col-span-4 ">
                            <div>
                                <label for="{{$time_id}}_{{$sectionCode}}_{{$code}}" class="block text-sm font-medium text-gray-700">{{ $field['name'] }}</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <input type="text" name="{{$time_id}}_{{$sectionCode}}_{{$code}}" id="{{$time_id}}_{{$sectionCode}}_{{$code}}"
                                           wire:model="state.exams.instrumental.{{$time_id}}.{{$sectionCode}}.{{$code}}"
                                           class="block w-full pr-12 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 pl-7 sm:text-sm"
                                           aria-describedby="price-currency">
                                    @if (isset($field['unit']))
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
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








