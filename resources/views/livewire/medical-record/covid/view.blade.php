<x-medical-record.common-view :medicalRecord="$medicalRecord">

    <x-card title="{{ __('Esami Strumentali') }}" class="mt-5">
        @foreach($times as $time_id=>$time)
            <div class="bg-{{$time['color']}}-50 border-l-4 border-{{$time['color']}}-400 p-4 mt-5 w-full text-center text-xl">
                <div class="ml-3">
                    {{$time['name']}}
                </div>
            </div>
            <div class="bg-{{$time['color']}}-50 border-l-4 border-{{$time['color']}}-400 p-4 w-full mt-3">
                @foreach($exams as $sectionCode=>$section)
                    <div class="w-full {{$loop->first ? "-mt-5" : "mt-5"}}">
                        <x-section-heading bg="bg-{{$time['color']}}-50">
                            {{$section['name']}}
                        </x-section-heading>
                    </div>
                    <div class="grid w-full grid-cols-12 gap-8">
                        @foreach($section['fields'] as $code=>$field)
                            <div class="col-span-12 sm:col-span-4 ">
                                <x-show.label>{{ $field['name'] }}</x-show.label>
                                <x-show.value>{{data_get($medicalRecord->data,'exams.instrumental.'.$time_id.'.'.$sectionCode.'.'.$code,'N/A')}}{{isset($field['unit']) && data_get($medicalRecord->data,'exams.instrumental.'.$time_id.'.'.$sectionCode.'.'.$code,false) ? " ".$field['unit'] : null}}</x-show.value>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endforeach
    </x-card>

</x-medical-record.common-view>








