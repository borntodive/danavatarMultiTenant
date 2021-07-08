@props([
    'target' => null,
    'label'=>null,
    'options'=>false,
    'more'=>null,
    'medicalRecord'
    ])

<div class="col-span-2 flex flex-col place-content-center">
    <x-show.label>{{$label}}</x-show.label>
</div>

@if (!$options)
    <div class="col-span-3 text-center flex flex-row place-content-center">
        <div class="flex-grow text-center flex flex-wrap content-center place-content-center">
            <x-show.textarea>{{data_get($medicalRecord->data,$target,'N/A')}}</x-show.textarea>
        </div>
    </div>
@else
    <div class="col-span-{{$more ? '2' : '3'}} text-center flex flex-row place-content-center">
        @if (count($options)==1)
        <div class="flex-grow text-center flex flex-wrap content-center place-content-center">
            <x-check-or-cross
                :condition="data_get($medicalRecord->data,$target.'.present',false)"/>

        </div>

        @else
            @foreach($options as $option)
                <div class="flex-grow text-center flex flex-col content-center place-content-center">
                    <x-show.label>{{$option}}</x-show.label>
                    <div class="flex place-content-center">
                        <x-check-or-cross
                            :condition="data_get($medicalRecord->data,$target.'.'.strtolower($option).'.present',false)"/>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @if($more=='date')
        <div class="col-span-1 text-center flex flex-wrap content-center place-content-center">
            <x-show.value>{{data_get($medicalRecord->data,$target.'.date','')}}</x-show.value>
        </div>
    @elseif($more=='text')
        <div class="col-span-1 text-center flex flex-col content-center place-content-center">
            <x-show.label>Note</x-show.label>
            <x-show.value>{{data_get($medicalRecord->data,$target.'.more','')}}</x-show.value>
        </div>
    @endif
@endif
