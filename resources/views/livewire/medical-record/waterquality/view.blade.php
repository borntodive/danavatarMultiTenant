<div class="w-full">

    <x-card title="{{ __('Osservazione') }}" class="mt-5">
        <div class="grid w-full grid-cols-1 gap-8 md:grid-cols-2">
            <div>
                <x-show.label>Nome del luogo</x-show.label>
                <x-show.value>{{data_get($medicalRecord->data,"misurazioni.luogo",'N/A')}}</x-show.value>
            </div>
            <div>
                <x-show.label>Nome del AMP</x-show.label>
                <x-show.value>{{data_get($medicalRecord->data,"misurazioni.amp",'N/A')}}</x-show.value>
            </div>
        </div>
        <div class="w-1/2 mt-5">
            <x-show.label>Nome del AMP</x-show.label>
            <x-show.value>{{data_get($medicalRecord->data,"misurazioni.date",'N/A')}}</x-show.value>
        </div>
        <div class="grid w-full grid-cols-4 gap-8 mt-10">
            <div></div>
            <div class="col-span-3 text-center">
                Rilevamento delle temperatura dell'acqua durante il campionamento in ºC e della visibilità in mt
            </div>
            <div></div>
            <div class="text-center">
                <x-show.label>Profondità Massima</x-show.label>
            </div>
            <div class="text-center">
                <x-show.label>Profondità Media</x-show.label>
            </div>
            <div class="text-center">
                <x-show.label>Superficie (0-5 mt)</x-show.label>
            </div>
            @foreach ($fields as $idx=>$field)
            <div>
                <x-show.label>{{$field['name']}}</x-show.label>
            </div>
                @foreach(['max','mean','min'] as $d)
                    @if($field['type']=='text')

                        <div class="text-center">
                            <x-show.value>{{data_get($medicalRecord->data,"misurazioni.".$idx.'.'.$d,'N/A')}}</x-show.value>

                        </div>
                    @else
                        <div class="text-center">
                            <x-show.value>{{data_get($field['options'],data_get($medicalRecord->data,"misurazioni.".$idx.'.'.$d,false),'N/A')}}</x-show.value>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
    </x-card>

</div>








