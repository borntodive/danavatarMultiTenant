<x-medical-record.common-view :medicalRecord="$medicalRecord">
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full">
            <x-show.label>Problemi ORL nella vita quotidiana</x-show.label>
            <div class="grid grid-cols-12 gap-12 mt-5">
                <div class="col-span-4 md:col-span-2">
                    <span class="text-sm font-medium text-gray-900">Orecchio</span>
                </div>
                <div class="col-span-4 md:col-span-2 text-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.orlProblems.ear',false)==1 ? true : false"/>
                </div>
                <div class="col-span-4 md:col-span-2 text-center">
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.orlProblems.ear.more','')}}</x-show.value>
                </div>
                <div class="col-span-4 md:col-span-2">
                    <span class="text-sm font-medium text-gray-900">Naso</span>
                </div>
                <div class="col-span-4 md:col-span-2 text-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.orlProblems.nose',false)==1 ? true : false"/>
                </div>
                <div class="col-span-4 md:col-span-2 text-center">
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.orlProblems.nose.more','')}}</x-show.value>
                </div>

                <div class="col-span-4 md:col-span-2">
                    <span class="text-sm font-medium text-gray-900">Gola</span>
                </div>
                <div class="col-span-4 md:col-span-2 text-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.orlProblems.throat',false)==1 ? true : false"/>
                </div>
                <div class="col-span-4 md:col-span-2 text-center">
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.orlProblems.throat.more','')}}</x-show.value>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 mt-5">
            <x-show.label>Problemi a carico dell’Orecchio Esterno</x-show.label>
            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-span-6">

                </div>
                <div class="col-span-3">
                    {{ __('Sx') }}
                </div>
                <div class="col-span-3">
                    {{ __('Dx') }}
                </div>
                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Otiti ricorrenti (batteriche/fungine)</span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.externalEar.otiti.sx',false)==1 ? true : false"/>

                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.externalEar.otiti.dx',false)==1 ? true : false"/>

                </div>

                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Eczema  dei cc.uu.ee.</span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.externalEar.eczema.sx',false)==1 ? true : false"/>

                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.externalEar.eczema.dx',false)==1 ? true : false"/>

                </div>
                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Tappi di cerume</span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.externalEar.wax.sx',false)==1 ? true : false"/>

                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.externalEar.wax.dx',false)==1 ? true : false"/>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 mt-5">
            <x-show.label>Problemi a carico dell’Orecchio Medio</x-show.label>
            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-span-6">

                </div>
                <div class="col-span-3">
                    {{ __('Sx') }}
                </div>
                <div class="col-span-3">
                    {{ __('Dx') }}
                </div>
                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Otiti catarrali</span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.midEar.otitiCatar.sx',false)==1 ? true : false"/>

                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.midEar.otitiCatar.dx',false)==1 ? true : false"/>
                 </div>

                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Otosalpingiti</span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.midEar.otosalpingiti.sx',false)==1 ? true : false"/>

                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.midEar.otosalpingiti.dx',false)==1 ? true : false"/>
                </div>
                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Otosclerosi  </span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.midEar.otosclerosi.sx',false)==1 ? true : false"/>

                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.general.midEar.otosclerosi.dx',false)==1 ? true : false"/>
                 </div>
            </div>
        </div>

        @if(session()->get('tenant')->hasMedicalSpecilities('diving'))
            <div class="w-full md:w-1/2 mt-5">
                <x-show.label>Problemi a carico dell’Orecchio Interno</x-show.label>
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2 md:col-span-1">
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
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <div class="grid grid-cols-12 gap-4 mt-5">
                    <div class="col-span-12">
                        <div class="relative my-5">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-start">
                                <span class="pr-3 bg-white text-sm font-medium text-gray-900">
                                   {{__('Sordità acquisite')}}
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
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.ipoacusia.sx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.ipoacusia.dx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Presbiacusia</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.presbiacusia.sx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.presbiacusia.dx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Barotrauma</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.barotrauma.sx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.barotrauma.dx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Acufeni</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.acufeni.sx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.acufeni.dx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">MDD labirintica</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.mdd.sx',false)==1 ? true : false"/>
                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.mdd.dx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Malattia di Ménière</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.meniere.sx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.meniere.dx',false)==1 ? true : false"/>
                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Disturbi di equilibrio (VPPB, labirintite….)</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.vppb.sx',false)==1 ? true : false"/>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-check-or-cross :condition="data_get($medicalRecord->data,'anamnesis.diving.innerEar.acquired.vppb.dx',false)==1 ? true : false"/>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="w-full mt-5">
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 md:col-span-6">
                    <x-show.label>Problemi a carico del naso e dei seni paranasali</x-show.label>
                    <div class="flex flex-col mt-3">

                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('riniti',data_get($medicalRecord->data,'anamnesis.general.sinus',[])) ? true : false"/> Riniti croniche</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('sinusiti',data_get($medicalRecord->data,'anamnesis.general.sinus',[])) ? true : false"/> Sinusiti croniche</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('poliposi',data_get($medicalRecord->data,'anamnesis.general.sinus',[])) ? true : false"/> Poliposi nasale</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('allergie',data_get($medicalRecord->data,'anamnesis.general.sinus',[])) ? true : false"/> Allergie respiratorie</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('deviazoni',data_get($medicalRecord->data,'anamnesis.general.sinus',[])) ? true : false"/> Deviazione del setto nasale</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('ipertrofia',data_get($medicalRecord->data,'anamnesis.general.sinus',[])) ? true : false"/> Ipertrofia dei turbinati</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('altro',data_get($medicalRecord->data,'anamnesis.general.sinus',[])) ? true : false"/> Altro</div>
                    </div>
                    @if(in_array('altro',data_get($medicalRecord->data,'anamnesis.general.sinus',[]))=='altro')
                        <x-show.label>Specificare</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.sinus.altro','')}}</x-show.value>
                    @endif
                </div>
                <div class="col-span-12 md:col-span-6">
                    <x-show.label>Problemi a carico di faringe/laringe</x-show.label>
                    <div class="flex flex-col mt-3">
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('tonsilliti',data_get($medicalRecord->data,'anamnesis.general.faringe',[])) ? true : false"/> Tonsilliti croniche</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('faringiti',data_get($medicalRecord->data,'anamnesis.general.faringe',[])) ? true : false"/> Faringiti croniche</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('osas',data_get($medicalRecord->data,'anamnesis.general.faringe',[])) ? true : false"/> OSAS</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('laringiti',data_get($medicalRecord->data,'anamnesis.general.faringe',[])) ? true : false"/> Laringiti</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('altro',data_get($medicalRecord->data,'anamnesis.general.faringe',[])) ? true : false"/> Altro</div>
                        <div><input wire:model="state.anamnesis.general.faringe"  type="checkbox" value="altro" /> Altro</div>
                    </div>
                    @if(in_array('altro',data_get($medicalRecord->data,'anamnesis.general.faringe',[]))=='altro')
                        <x-show.label>Specificare</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.faringe.altro','')}}</x-show.value>
                    @endif
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-show.label>Problemi a carico di cavo orale e apparato masticatorio</x-show.label>
                    <div class="flex flex-col mt-3">
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('lingua',data_get($medicalRecord->data,'anamnesis.general.cavoOrale',[])) ? true : false"/> Lingua/pavimento orale croniche</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('ghiandole',data_get($medicalRecord->data,'anamnesis.general.cavoOrale',[])) ? true : false"/> Ghiandole salivari</div>
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('scheletrica',data_get($medicalRecord->data,'anamnesis.general.cavoOrale',[])) ? true : false"/> Classe scheletrica</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-show.label>Tumori ORL</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'anamnesis.general.tumori','')}}</x-show.value>

                </div>
            </div>
        </div>
        @if(session()->get('tenant')->hasMedicalSpecilities('diving'))
            <div class="grid grid-cols-12 gap-8 mt-5 w-full">
                <div class="col-span-12 sm:col-span-6">
                    <x-show.label>Difficoltà di compensazione dell’orecchio</x-show.label>
                    <div class="grid grid-cols-12 gap-8 mt-5">
                        <div class="col-span-8 md:col-span-4">
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            {{ __('Sx') }}
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            {{ __('Dx') }}
                        </div>
                        <div class="hidden md:block col-span-8 md:col-span-4">
                        </div>
                        <div class="hidden md:block col-span-2 md:col-span-1">
                            {{ __('Sx') }}
                        </div>
                        <div class="hidden md:block col-span-2 md:col-span-1">
                            {{ __('Dx') }}
                        </div>
                        <div class="col-span-8 md:col-span-4">
                            Costanti
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <x-check-or-cross :condition="data_get($medicalRecord->data,'diving.equalizationProblem.constant.sx',false)==1 ? true : false"/>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <x-check-or-cross :condition="data_get($medicalRecord->data,'diving.equalizationProblem.constant.dx',false)==1 ? true : false"/>

                        </div>
                        <div class="col-span-8 md:col-span-4">
                            Saltuari
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <x-check-or-cross :condition="data_get($medicalRecord->data,'diving.equalizationProblem.sometimes.sx',false)==1 ? true : false"/>

                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <x-check-or-cross :condition="data_get($medicalRecord->data,'diving.equalizationProblem.sometimes.dx',false)==1 ? true : false"/>

                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 gap-5">
                    <x-show.label>Difficoltà di compensazione dei seni paranasali</x-show.label>
                    <div class="grid grid-cols-12 gap-8 mt-5">
                        <div class="col-span-8 md:col-span-4">
                        </div>
                        <div class="col-span-2 md:col-span-1 text-center">
                            {{ __('Sx') }}
                        </div>
                        <div class="col-span-2 md:col-span-1 text-center">
                            {{ __('Dx') }}
                        </div>
                        <div class="hidden md:block col-span-8 md:col-span-4">
                        </div>
                        <div class="hidden md:block col-span-2 md:col-span-1 text-center">
                            {{ __('Sx') }}
                        </div>
                        <div class="hidden md:block col-span-2 md:col-span-1 text-center">
                            {{ __('Dx') }}
                        </div>
                        <div class="col-span-8 md:col-span-4">
                            Costanti
                        </div>
                        <div class="col-span-2 md:col-span-1 text-center">
                            <x-check-or-cross :condition="data_get($medicalRecord->data,'diving.sinusEqaulization.constant.sx',false)==1 ? true : false"/>

                        </div>
                        <div class="col-span-2 md:col-span-1 text-center">
                            <x-check-or-cross :condition="data_get($medicalRecord->data,'diving.sinusEqaulization.constant.dx',false)==1 ? true : false"/>

                        </div>
                        <div class="col-span-8 md:col-span-4">
                            Saltuari
                        </div>
                        <div class="col-span-2 md:col-span-1 text-center">
                            <x-check-or-cross :condition="data_get($medicalRecord->data,'diving.sinusEqaulization.sometimes.sx',false)==1 ? true : false"/>
                        </div>
                        <div class="col-span-2 md:col-span-1 text-center">
                            <x-check-or-cross :condition="data_get($medicalRecord->data,'diving.sinusEqaulization.sometimes.dx',false)==1 ? true : false"/>
                        </div>

                        @if(in_array("1",data_get($medicalRecord->data,'anamnesis.diving.sinusEqaulization.*.*',[]),true))
                            <div class="col-span-12">
                                <x-show.label>Quali?</x-show.label>
                                <div class="md:w-full flex flex-row mt-3">
                                    <div class="flex w-1/3"><x-check-or-cross class="inline" :condition="in_array('frontale',data_get($medicalRecord->data,'anamnesis.diving.sinusEqaulization.location',[])) ? true : false"/> Frontale</div>
                                    <div class="flex w-1/3"><x-check-or-cross class="inline" :condition="in_array('mascellare',data_get($medicalRecord->data,'anamnesis.diving.sinusEqaulization.location',[])) ? true : false"/> Mascellare</div>
                                    <div class="flex w-1/3"><x-check-or-cross class="inline" :condition="in_array('altri',data_get($medicalRecord->data,'anamnesis.diving.sinusEqaulization.location',[])) ? true : false"/> Altri</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </x-card>

    <x-card title="{{ __('Esami Obiettivi') }}" class="mt-5">
        <div class="grid grid-cols-12 gap-8 mt-5 w-full">
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Orecchio esterno DX</x-show.label>
                <div class="flex flex-col mt-3">
                    @foreach($externalEarObjective as $value=>$label)
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array($value,data_get($medicalRecord->data,'anamnesis.general.externalEar.dx',[])) ? true : false"/> {{$label}}</div>
                    @endforeach
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Orecchio esterno SX</x-show.label>
                <div class="flex flex-col mt-3">
                    @foreach($externalEarObjective as $value=>$label)
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array($value,data_get($medicalRecord->data,'anamnesis.general.externalEar.sx',[])) ? true : false"/> {{$label}}</div>
                    @endforeach
                </div>
            </div>
            <div class="col-span-12">
                <x-show.label>Membrana timpanica DX</x-show.label>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Aspetto</x-show.label>
                <x-show.value>{{data_get($tympanicMembraneObjective,data_get($medicalRecord->data,'objectives.general.tympanicMembran.aspect.dx',null),null)}}</x-show.value>
            </div>

            @if(session()->get('tenant')->hasMedicalSpecilities('diving'))

                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>Mobilità sotto stimolo compensatorio</x-show.label>
                    <x-show.value>{{data_get($tympanicMembraneMobilityObjective,data_get($medicalRecord->data,'objectives.diving.tympanicMembran.mobility.dx',0),null)}}</x-show.value>

                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>Manovra di Toynbee</x-show.label>
                    <x-show.value>{{data_get([1=>'Positiva',2=>'Negativa'],data_get($medicalRecord->data,'objectives.diving.tympanicMembran.toynbee.dx',0),null)}}</x-show.value>

                </div>
            @endif

            <div class="col-span-12">
                <x-show.label>Membrana timpanica SX</x-show.label>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Aspetto</x-show.label>
                <x-show.value>{{data_get($tympanicMembraneObjective,data_get($medicalRecord->data,'objectives.general.tympanicMembran.aspect.sx',null),null)}}</x-show.value>
            </div>

            @if(session()->get('tenant')->hasMedicalSpecilities('diving'))

                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>Mobilità sotto stimolo compensatorio</x-show.label>
                    <x-show.value>{{data_get($tympanicMembraneMobilityObjective,data_get($medicalRecord->data,'objectives.diving.tympanicMembran.mobility.sx',0),null)}}</x-show.value>

                </div>
                <div class="col-span-12 sm:col-span-6 ">
                    <x-show.label>Manovra di Toynbee</x-show.label>
                    <x-show.value>{{data_get([1=>'Positiva',2=>'Negativa'],data_get($medicalRecord->data,'objectives.diving.tympanicMembran.toynbee.sx',0),null)}}</x-show.value>

                </div>
            @endif
            <div class="col-span-12">
                <x-show.label>Naso e seni paranasali</x-show.label>
            </div>
            <div class="col-span-12 sm:col-span-6 ">
                <x-show.label>Tecnica</x-show.label>
                <x-show.value>{{data_get([1=>'Tradizionale',2=>'Endoscopica'],data_get($medicalRecord->data,'objectives.diving.general.node.tecnique',0),null)}}</x-show.value>
            </div>
            <div class="col-span-12">
                <x-show.label>Anomalie</x-show.label>
                <div class="flex flex-col mt-3">
                    <div class="flex"><x-check-or-cross class="inline" :condition="in_array('deviazione',data_get($medicalRecord->data,'objectives.general.nose.anomalies',[])) ? true : false"/> Deviazione del setto nasale</div>
                    <div class="flex"><x-check-or-cross class="inline" :condition="in_array('ipertrofia',data_get($medicalRecord->data,'objectives.general.nose.anomalies',[])) ? true : false"/> Ipertrofia dei turbinati</div>

                    <div class="flex flex-col">
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('rinite',data_get($medicalRecord->data,'objectives.general.nose.anomalies',[])) ? true : false"/> Riniti</div>
                        @if(in_array('rinite',data_get($medicalRecord->data,'objectives.general.nose.anomalies',[])))
                            <div class="flex flex-row ml-10">
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('acuta',data_get($medicalRecord->data,'objectives.general.nose.rinite',[])) ? true : false"/> Acuta</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('allergica',data_get($medicalRecord->data,'objectives.general.nose.rinite',[])) ? true : false"/> Allergica</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('crostosa',data_get($medicalRecord->data,'objectives.general.nose.rinite',[])) ? true : false"/> Crostosa</div>

                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('varianti',data_get($medicalRecord->data,'objectives.general.nose.anomalies',[])) ? true : false"/> Varianti anatomiche</div>
                        @if(in_array('varianti',data_get($medicalRecord->data,'objectives.general.nose.anomalies',[])))
                            <div class="flex flex-row ml-10">
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('concha',data_get($medicalRecord->data,'objectives.general.nose.varianti',[])) ? true : false"/> Concha bullosa</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('curvatura',data_get($medicalRecord->data,'objectives.general.nose.varianti',[])) ? true : false"/> Curvatura paradossa del turbinato medio</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('duplicatura',data_get($medicalRecord->data,'objectives.general.nose.varianti',[])) ? true : false"/> Duplicatura del processo uncinato</div>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('poliposi',data_get($medicalRecord->data,'objectives.general.nose.anomalies',[])) ? true : false"/> Poliposi nasale</div>
                        @if(in_array('varianti',data_get($medicalRecord->data,'objectives.general.nose.anomalies',[])))
                            <div class="flex flex-row ml-10">
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('lieve',data_get($medicalRecord->data,'objectives.general.nose.poliposi',[])) ? true : false"/> Lieve</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('moderata',data_get($medicalRecord->data,'objectives.general.nose.poliposi',[])) ? true : false"/> Moderata</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('massiva',data_get($medicalRecord->data,'objectives.general.nose.poliposi',[])) ? true : false"/> Massiva</div>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <div class="flex"><x-check-or-cross class="inline" :condition="in_array('valutazione',data_get($medicalRecord->data,'objectives.general.nose.anomalies',[])) ? true : false"/> Valutazione cavo rinofaringeo</div>
                        @if(in_array('varianti',data_get($medicalRecord->data,'objectives.general.nose.anomalies',[])))
                            <div class="flex flex-row ml-10">
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('residui',data_get($medicalRecord->data,'objectives.general.nose.valutazione',[])) ? true : false"/> Residui adenoidei</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('cicatrici',data_get($medicalRecord->data,'objectives.general.nose.valutazione',[])) ? true : false"/> Cicatrici</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('Muco',data_get($medicalRecord->data,'objectives.general.nose.valutazione',[])) ? true : false"/> Muco</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('Altro',data_get($medicalRecord->data,'objectives.general.nose.valutazione',[])) ? true : false"/> Altro</div>
                                @if(data_get($medicalRecord->data,'objectives.general.nose.valutazione',null)=="altro")
                                    <x-show.value>{{data_get($medicalRecord->data,'objectives.general.nose.valutazione.altro',null)}}</x-show.value>
                                @endif
                            </div>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-span-12">
                <x-show.label>Aspetto dell’ostio tubarico</x-show.label>
                <div class="grid grid-cols-2 mt-5 gap-8">
                    <div class="col-span-2 md:col-span-1 text-center">
                        <x-show.label>SX</x-show.label>
                        <div class="grid grid-cols-2 gap-5 mt-5">
                            <div class="col-span-2 md:col-span-1 text-center">
                                <x-show.label>Ampiezza</x-show.label>
                                <x-show.value>{{data_get([
                                                   1=>'Ristretto',
                                                   2=>'Normale',
                                                   3=>'Ampio',
                                                   4=>'Molto Ampio',
                                               ],data_get($medicalRecord->data,'objectives.general.ostio.sx.aspect',0),null)}}</x-show.value>

                            </div>
                            <div class="col-span-2 md:col-span-1 text-center">
                                <x-show.label>Motilità sotto stimolo compensatorio</x-show.label>
                                <x-show.value>{{data_get([
                                                   1=>'Nulla',
                                                   2=>'Scarsa',
                                                   3=>'Buona',
                                                   4=>'Eccellente',
                                               ],data_get($medicalRecord->data,'objectives.general.ostio.sx.mobility',0),null)}}</x-show.value>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 md:col-span-1 text-center">
                        <x-show.label>DX</x-show.label>
                        <div class="grid grid-cols-2 gap-5 mt-5">
                            <div class="col-span-2 md:col-span-1 text-center">
                                <x-show.label>Ampiezza</x-show.label>
                                <x-show.value>{{data_get([
                                                   1=>'Ristretto',
                                                   2=>'Normale',
                                                   3=>'Ampio',
                                                   4=>'Molto Ampio',
                                               ],data_get($medicalRecord->data,'objectives.general.ostio.sx.aspect',0),null)}}</x-show.value>
                            </div>
                            <div class="col-span-2 md:col-span-1 text-center">
                                <x-show.label>Motilità sotto stimolo compensatorio</x-show.label>
                                <x-show.value>{{data_get([
                                                   1=>'Nulla',
                                                   2=>'Scarsa',
                                                   3=>'Buona',
                                                   4=>'Eccellente',
                                               ],data_get($medicalRecord->data,'objectives.general.ostio.dx.mobility',0),null)}}</x-show.value>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12">
                <x-show.label>Cavo orale e dell'orofaringe</x-show.label>
                <div class="grid grid-cols-2 mt-5 gap-8">
                    <div class="col-span-2 md:col-span-1 text-center">
                        <x-show.label>Motilità velare</x-show.label>
                        <x-show.value>{{data_get([
                                                   1=>'Buona',
                                                   2=>'Scarsa',
                                                   3=>'Nulla',
                                               ],data_get($medicalRecord->data,'objectives.general.orofaringe.velare',0),null)}}</x-show.value>
                    </div>
                    <div class="col-span-2 md:col-span-1 text-center">
                        <x-show.label>Altro</x-show.label>
                        <x-show.value>{{data_get($medicalRecord->data,'objectives.general.orofaringe.altro',null)}}</x-show.value>
                    </div>
                </div>
            </div>
        </div>
    </x-card>
    <x-card title="{{ __('Esami Strumentali') }}" class="mt-5">

        <div class="w-full mt-5">
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12">
                    <x-show.label>Esame audiometrico</x-show.label>
                    <div class="grid grid-cols-2 gap-8 mt-5">
                        <div class="col-span-2 md:col-span-1 text-center">
                            <x-show.label>Sx</x-show.label>
                            <div class="flex flex-row mt-5">
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('normacusia',[data_get($medicalRecord->data,'instrumental.general.audiometrico.sx.tipo',[])]) ? true : false"/> Normacusia</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('ipoacusia',[data_get($medicalRecord->data,'instrumental.general.audiometrico.sx.tipo',[])]) ? true : false"/> Ipoacusia</div>
                            </div>
                            @if (data_get($medicalRecord->data,'instrumental.general.audiometrico.sx.tipo',null) =="ipoacusia")
                                <x-show.value>{{data_get([
                                                    1=>'Neurosensoriale',
                                                    2=>'Trasmissiva',
                                                    3=>'Mista',
                                               ],data_get($medicalRecord->data,'instrumental.general.audiometrico.sx.ipoacusia',0),null)}}</x-show.value>
                                @if (data_get($medicalRecord->data,'instrumental.general.audiometrico.sx.ipoacusia',null) == "1")
                                    <div class="flex flex-row mt-5 mt-3">
                                        <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('acuti',[data_get($medicalRecord->data,'instrumental.general.audiometrico.sx.neurosensoriale',[])]) ? true : false"/> Toni acuti</div>
                                        <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('pantonale',[data_get($medicalRecord->data,'instrumental.general.audiometrico.sx.neurosensoriale',[])]) ? true : false"/> Pantonale</div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="col-span-2 md:col-span-1 text-center">
                            <x-show.label>Dx</x-show.label>
                            <div class="flex flex-row mt-5">
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('normacusia',[data_get($medicalRecord->data,'instrumental.general.audiometrico.dx.tipo',[])]) ? true : false"/> Normacusia</div>
                                <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('ipoacusia',[data_get($medicalRecord->data,'instrumental.general.audiometrico.dx.tipo',[])]) ? true : false"/> Ipoacusia</div>
                            </div>
                            @if (data_get($medicalRecord->data,'instrumental.general.audiometrico.dx.tipo',null) =="ipoacusia")
                                <x-show.value>{{data_get([
                                                   1=>'Neurosensoriale',
                                                    2=>'Trasmissiva',
                                                    3=>'Mista',
                                               ],data_get($medicalRecord->data,'instrumental.general.audiometrico.dx.ipoacusia',0),null)}}</x-show.value>

                                @if (data_get($medicalRecord->data,'instrumental.general.audiometrico.dx.ipoacusia',null) == "1")
                                    <div class="flex flex-row mt-5 mt-3">
                                        <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('acuti',[data_get($medicalRecord->data,'instrumental.general.audiometrico.dx.neurosensoriale',[])]) ? true : false"/> Toni acuti</div>
                                        <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('pantonale',[data_get($medicalRecord->data,'instrumental.general.audiometrico.dx.neurosensoriale',[])]) ? true : false"/> Pantonale</div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <x-show.label>Timpanogramma</x-show.label>
                    <x-show.value>{{data_get([
                                        1=>'Tipo A (normale)',
                                        2=>'Tipo B (piatto)',
                                        3=>'Tipo C (alterato)',
                                               ],data_get($medicalRecord->data,'instrumental.general.timpanogramma',0),null)}}</x-show.value>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-show.label>Prove di funzionalità tubarica - ETF</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'.instrumental.general.etf',null)}}</x-show.value>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-show.label>Prove vestibolari</x-show.label>
                    <x-show.value>{{data_get($medicalRecord->data,'instrumental.general.vestibolari',null)}}</x-show.value>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-show.label>TAC rocche e mastoidi</x-show.label>
                    @if(data_get($medicalRecord->data,'instrumental.general.tac.rocche',false))
                        <x-show.value>{{data_get($medicalRecord->data,'instrumental.general.tac.rocche.specificare',null)}}</x-show.value>
                    @endif
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-show.label>TAC seni paranasali</x-show.label>
                    @if(data_get($medicalRecord->data,'instrumental.general.tac.seni',false))
                        <x-show.value>{{data_get($medicalRecord->data,'instrumental.general.tac.seni.specificare',null)}}</x-show.value>
                    @endif
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-show.label>Prove allergiche</x-show.label>
                    @if(data_get($medicalRecord->data,'instrumental.general.allergie.exam',false))
                        <div class="flex flex-row mt-5">
                            <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('positive',[data_get($medicalRecord->data,'instrumental.general.allergie.result',[])]) ? true : false"/> Positive</div>
                            <div class="ml-3 flex"><x-check-or-cross class="inline" :condition="in_array('negative',[data_get($medicalRecord->data,'instrumental.general.allergie.result',[])]) ? true : false"/> Negative</div>
                        </div>
                        @if(data_get($medicalRecord->data,'instrumental.general.allergie.result','')=='positive')
                            <div class="flex flex-col mt-5">
                                <div class="flex"><x-check-or-cross class="inline" :condition="in_array('pollini',data_get($medicalRecord->data,'instrumental.general.allergie.positive_at',[])) ? true : false"/> Pollini</div>
                                <div class="flex"><x-check-or-cross class="inline" :condition="in_array('polveri',data_get($medicalRecord->data,'instrumental.general.allergie.positive_at',[])) ? true : false"/> Polveri (acari, forfore di animali ecc)</div>
                                <div>
                                    <div class="flex"><x-check-or-cross class="inline" :condition="in_array('alimenti',data_get($medicalRecord->data,'instrumental.general.allergie.positive_at',[])) ? true : false"/> Alimenti</div>
                                    @if(in_array('alimenti',data_get($medicalRecord->data,'instrumental.general.allergie.positive_at',[])))
                                        <x-show.value>{{data_get($medicalRecord->data,'instrumental.general.allergie.alimenti',null)}}</x-show.value>
                                    @endif
                                </div>
                                <div>
                                    <div class="flex"><x-check-or-cross class="inline" :condition="in_array('altro',data_get($medicalRecord->data,'instrumental.general.allergie.positive_at',[])) ? true : false"/> Altro</div>

                                    @if(in_array('altro',data_get($medicalRecord->data,'instrumental.general.allergie.positive_at',[])))
                                        <x-show.value>{{data_get($medicalRecord->data,'instrumental.general.allergie.altro',null)}}</x-show.value>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

    </x-card>
</x-medical-record.common-view>
