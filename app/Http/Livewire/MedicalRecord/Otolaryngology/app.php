<div class="grid grid-cols-12 gap-4 mt-5">
    <div class="col-span-12">
        <div class="relative my-5">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-start">
                                <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                                   {{__('Sordità congenite')}}
                                </span>
            </div>
        </div>
    </div>
    <div class="col-span-6">

    </div>
    <div class="col-span-3">
        {{ __('Sx') }}
    </div>
    <div class="col-span-3">
        {{ __('Dx') }}
    </div>
    <div class="col-span-6 flex flex-col">
        <span class="text-sm font-medium text-gray-900">Ipoacusia da rumore</span>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.ipoacusia.sx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.ipoacusia.dx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-6 flex flex-col">
        <span class="text-sm font-medium text-gray-900">Presbiacusia</span>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.presbiacusia.sx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.presbiacusia.dx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-6 flex flex-col">
        <span class="text-sm font-medium text-gray-900">Barotrauma</span>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.barotrauma.sx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.barotrauma.dx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-6 flex flex-col">
        <span class="text-sm font-medium text-gray-900">Acufeni</span>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.acufeni.sx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.acufeni.dx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-6 flex flex-col">
        <span class="text-sm font-medium text-gray-900">MDD labirintica</span>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.mdd.sx',false)==1 ? true : false"/>
    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.mdd.dx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-6 flex flex-col">
        <span class="text-sm font-medium text-gray-900">Malattia di Ménière</span>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.meniere.sx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.meniere.dx',false)==1 ? true : false"/>
    </div>
    <div class="col-span-6 flex flex-col">
        <span class="text-sm font-medium text-gray-900">Disturbi di equilibrio (VPPB, labirintite….)</span>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.vppb.sx',false)==1 ? true : false"/>

    </div>
    <div class="col-span-3 text-center flex flex-wrap content-center">
        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.congenital.vppb.dx',false)==1 ? true : false"/>
    </div>
</div>
