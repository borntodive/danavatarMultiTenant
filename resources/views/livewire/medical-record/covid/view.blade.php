<x-medical-record.common-view :medicalRecord="$medicalRecord">

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
                        <x-show.label>{{ $field['name'] }}</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,'exams.instrumental.'.$sectionCode.'.'.$code,'N/A')}}{{isset($field['unit']) ? " ".$field['unit'] : null}}</x-show.value>
                    </div>
                @endforeach
            </div>
        @endforeach
    </x-card>

</x-medical-record.common-view>








