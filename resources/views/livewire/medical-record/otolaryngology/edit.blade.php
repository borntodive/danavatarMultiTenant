<x-medical-record.common-edit>
    <x-card title="{{ __('Anamnesi') }}" class="mt-5">
        <div class="w-full">
            <x-form.label>Problemi Orl nella vita quotidiana</x-form.label>
            <div class="grid grid-cols-12 gap-8 mt-5">
                <div class="col-span-4 md:col-span-2">
                </div>
                <div class="col-span-2 md:col-span-1 text-center">
                    {{ __('Si') }}
                </div>
                <div class="col-span-2 md:col-span-1 text-center">
                    {{ __('No') }}
                </div>
                <div class="col-span-4 md:col-span-2 text-center">
                    {{ __('Specificare') }}
                </div>
                <div class="hidden md:block col-span-4 md:col-span-2">
                </div>
                <div class="hidden md:block col-span-2 md:col-span-1 text-center">
                    {{ __('Si') }}
                </div>
                <div class="hidden md:block col-span-2 md:col-span-1 text-center">
                    {{ __('No') }}
                </div>
                <div class="hidden md:block col-span-4 md:col-span-2 text-center">
                    {{ __('Specificare') }}
                </div>
                <div class="col-span-4 md:col-span-2">
                    <span class="text-sm font-medium text-gray-900">Orecchio</span>
                </div>
                <div class="col-span-2 md:col-span-1 text-center">
                    <input wire:model="state.anamnesis.general.orlProblems.ear" name="earProblems" type="radio"
                           value="1"/>

                </div>
                <div class="col-span-2 md:col-span-1 text-center">
                    <input wire:model="state.anamnesis.general.orlProblems.ear" name="earProblems" type="radio"
                           value="0"/>
                </div>
                <div class="col-span-4 md:col-span-2 text-center">
                    <x-form.text-input wire:model="state.anamnesis.general.orlProblems.ear.more"/>
                </div>
                <div class="col-span-4 md:col-span-2">
                    <span class="text-sm font-medium text-gray-900">Naso</span>
                </div>
                <div class="col-span-2 md:col-span-1 text-center">
                    <input wire:model="state.anamnesis.general.orlProblems.nose" name="noseProblems" type="radio"
                           value="1"/>

                </div>
                <div class="col-span-2 md:col-span-1 text-center">
                    <input wire:model="state.anamnesis.general.orlProblems.nose" name="noseProblems" type="radio"
                           value="0"/>
                </div>
                <div class="col-span-4 md:col-span-2 text-center">
                    <x-form.text-input wire:model="state.anamnesis.general.orlProblems.nose.more"/>
                </div>
                <div class="col-span-4 md:col-span-2">
                    <span class="text-sm font-medium text-gray-900">Gola</span>
                </div>
                <div class="col-span-2 md:col-span-1 text-center">
                    <input wire:model="state.anamnesis.general.orlProblems.throat" name="throatProblems" type="radio"
                           value="1"/>

                </div>
                <div class="col-span-2 md:col-span-1 text-center">
                    <input wire:model="state.anamnesis.general.orlProblems.throat" name="throatProblems" type="radio"
                           value="0"/>
                </div>
                <div class="col-span-4 md:col-span-2 text-center">
                    <x-form.text-input wire:model="state.anamnesis.general.orlProblems.throat.more"/>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 mt-5">
            <x-form.label>Problemi a carico dell’Orecchio Esterno</x-form.label>
            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-span-6">

                </div>
                <div class="col-span-3 text-center">
                    {{ __('Sx') }}
                </div>
                <div class="col-span-3 text-center">
                    {{ __('Dx') }}
                </div>
                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Otiti ricorrenti (batteriche/fungine)</span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="externalEar_otiti_sx"
                                     wire:model.lazy="state.anamnesis.general.externalEar.otiti.sx"/>
                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="externalEar_otiti_dx"
                                     wire:model.lazy="state.anamnesis.general.externalEar.otiti.dx"/>
                </div>

                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Eczema  dei cc.uu.ee.</span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="externalEar_eczema_sx"
                                     wire:model.lazy="state.anamnesis.general.externalEar.eczema.sx"/>
                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="externalEar_eczema_dx"
                                     wire:model.lazy="state.anamnesis.general.externalEar.eczema.dx"/>
                </div>
                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Tappi di cerume</span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="externalEar_wax_sx"
                                     wire:model.lazy="state.anamnesis.general.externalEar.wax.sx"/>
                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="externalEar_wax_dx"
                                     wire:model.lazy="state.anamnesis.general.externalEar.wax.dx"/>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 mt-5">
            <x-form.label>Problemi a carico dell’Orecchio Medio</x-form.label>
            <div class="grid grid-cols-12 gap-4 mt-5">
                <div class="col-span-6">

                </div>
                <div class="col-span-3 text-center">
                    {{ __('Sx') }}
                </div>
                <div class="col-span-3 text-center">
                    {{ __('Dx') }}
                </div>
                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Otiti catarrali</span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="midEar_otitiCatar_sx"
                                     wire:model.lazy="state.anamnesis.general.midEar.otitiCatar.sx"/>
                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="midEar_otitiCatar_dx"
                                     wire:model.lazy="state.anamnesis.general.midEar.otitiCatar.dx"/>
                </div>

                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Otosalpingiti</span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="midEar_otosalpingiti_sx"
                                     wire:model.lazy="state.anamnesis.general.midEar.otosalpingiti.sx"/>
                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="midEar_otosalpingiti_dx"
                                     wire:model.lazy="state.anamnesis.general.midEar.otosalpingiti.dx"/>
                </div>
                <div class="col-span-6 flex flex-col">
                    <span class="text-sm font-medium text-gray-900">Otosclerosi  </span>


                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="midEar_otosclerosi_sx"
                                     wire:model.lazy="state.anamnesis.general.midEar.otosclerosi.sx"/>
                </div>
                <div class="col-span-3 text-center flex flex-wrap content-center">
                    <x-form.checkbox value="1" id="midEar_otosclerosi_dx"
                                     wire:model.lazy="state.anamnesis.general.midEar.otosclerosi.dx"/>
                </div>
            </div>
        </div>

        @if(session()->get('tenant')->hasMedicalSpecilities('diving'))
            <div class="w-full md:w-1/2 mt-5">
                <x-form.label>Problemi a carico dell’Orecchio Interno</x-form.label>
                <div class="grid grid-cols-12 gap-4 mt-5">
                    <div class="col-span-6">

                    </div>
                    <div class="col-span-3 text-center">
                        {{ __('Sx') }}
                    </div>
                    <div class="col-span-3 text-center">
                        {{ __('Dx') }}
                    </div>

                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Sordità congenite</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_congenitalDeafness_sx"
                                         wire:model.lazy="state.anamnesis.general.innerEar.congenitalDeafness.sx"/>
                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_congenitalDeafness_dx"
                                         wire:model.lazy="state.anamnesis.general.innerEar.congenitalDeafness.dx"/>
                    </div>
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
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Ipoacusia da rumore</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_ipoacusia_sx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.ipoacusia.sx"/>
                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_ipoacusia_dx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.ipoacusia.dx"/>
                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Presbiacusia</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_presbiacusia_sx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.presbiacusia.sx"/>
                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_presbiacusia_dx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.presbiacusia.dx"/>
                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Barotrauma</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_barotrauma_sx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.barotrauma.sx"/>
                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_barotrauma_dx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.barotrauma.dx"/>
                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Acufeni</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_acufeni_sx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.acufeni.sx"/>
                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_acufeni_dx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.acufeni.dx"/>
                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">MDD labirintica</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_mdd_sx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.mdd.sx"/>
                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_mdd_dx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.mdd.dx"/>
                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Malattia di Ménière</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_meniere_sx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.meniere.sx"/>
                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_meniere_dx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.meniere.dx"/>
                    </div>
                    <div class="col-span-6 flex flex-col">
                        <span class="text-sm font-medium text-gray-900">Disturbi di equilibrio (VPPB, labirintite….)</span>

                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_vppb_sx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.vppb.sx"/>
                    </div>
                    <div class="col-span-3 text-center flex flex-wrap content-center">
                        <x-form.checkbox value="1" id="innerEar_vppb_dx"
                                         wire:model.lazy="state.anamnesis.diving.innerEar.vppb.dx"/>
                    </div>
                </div>
            </div>
        @endif
        <div class="w-full mt-5">
            <div class="grid grid-cols-12 gap-8">
                <div class="col-span-12 md:col-span-6">
                    <x-form.label>Problemi a carico del naso e dei seni paranasali</x-form.label>
                    <div class="flex flex-col mt-3">
                        <div><input wire:model="state.anamnesis.general.sinus"  type="checkbox" value="riniti" /> Riniti croniche</div>
                        <div><input wire:model="state.anamnesis.general.sinus"  type="checkbox" value="sinusiti" /> Sinusiti croniche</div>
                        <div><input wire:model="state.anamnesis.general.sinus"  type="checkbox" value="poliposi" /> Poliposi nasale</div>
                        <div><input wire:model="state.anamnesis.general.sinus"  type="checkbox" value="allergie" /> Allergie respiratorie</div>
                        <div><input wire:model="state.anamnesis.general.sinus"  type="checkbox" value="deviazoni" /> Deviazione del setto nasale</div>
                        <div><input wire:model="state.anamnesis.general.sinus"  type="checkbox" value="ipertrofia" /> Ipertrofia dei turbinati</div>
                        <div><input wire:model="state.anamnesis.general.sinus"  type="checkbox" value="altro" /> Altro</div>
                    </div>
                    @if(in_array('altro',data_get($state,'anamnesis.general.sinus',[]))=='altro')
                        <x-form.text-input class="mt-3" wire:model="state.anamnesis.general.sinus.altro" label="Specificare"/>
                    @endif
                </div>
                <div class="col-span-12 md:col-span-6">
                    <x-form.label>Problemi a carico di faringe/laringe</x-form.label>
                    <div class="flex flex-col mt-3">
                        <div><input wire:model="state.anamnesis.general.faringe"  type="checkbox" value="tonsilliti" /> Tonsilliti croniche</div>
                        <div><input wire:model="state.anamnesis.general.faringe"  type="checkbox" value="faringiti" /> Faringiti croniche</div>
                        <div><input wire:model="state.anamnesis.general.faringe"  type="checkbox" value="osas" /> OSAS</div>
                        <div><input wire:model="state.anamnesis.general.faringe"  type="checkbox" value="laringiti" /> Laringiti</div>
                        <div><input wire:model="state.anamnesis.general.faringe"  type="checkbox" value="altro" /> Altro</div>
                    </div>
                    @if(in_array('altro',data_get($state,'anamnesis.general.faringe',[]))=='altro')
                        <x-form.text-input class="mt-3" wire:model="state.anamnesis.general.faringe.altro" label="Specificare"/>
                    @endif
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-form.label>Problemi a carico di cavo orale e apparato masticatorio</x-form.label>
                    <div class="flex flex-col mt-3">
                        <div><input wire:model="state.anamnesis.general.cavoOrale"  type="checkbox" value="lingua" /> Lingua/pavimento orale</div>
                        <div><input wire:model="state.anamnesis.general.cavoOrale"  type="checkbox" value="ghiandole" /> Ghiandole salivari</div>
                        <div><input wire:model="state.anamnesis.general.cavoOrale"  type="checkbox" value="scheletrica" /> Classe scheletrica</div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-form.label>Tumori ORL</x-form.label>
                    <x-form.text-area wire:model="state.anamnesis.general.tumori"></x-form.text-area>
                </div>
            </div>
        </div>
        @if(session()->get('tenant')->hasMedicalSpecilities('diving'))
            <div class="grid grid-cols-12 gap-8 mt-5 w-full">
                <div class="col-span-12 sm:col-span-6">
                    <x-form.label>Difficoltà di compensazione dell’orecchio</x-form.label>
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
                                <x-form.checkbox value="1" id="equalizationProblem_constant_sx"
                                                 wire:model.lazy="state.anamnesis.diving.equalizationProblem.constant.sx"/>
                            </div>
                            <div class="col-span-2 md:col-span-1 text-center">
                                <x-form.checkbox value="1" id="equalizationProblem_constant_dx"
                                                 wire:model.lazy="state.anamnesis.diving.equalizationProblem.constant.dx"/>
                            </div>
                            <div class="col-span-8 md:col-span-4">
                                Saltuari
                            </div>
                            <div class="col-span-2 md:col-span-1 text-center">
                                <x-form.checkbox value="1" id="equalizationProblem_sometimes_sx"
                                                 wire:model.lazy="state.anamnesis.diving.equalizationProblem.sometimes.sx"/>
                            </div>
                            <div class="col-span-2 md:col-span-1 text-center">
                                <x-form.checkbox value="1" id="equalizationProblems_sometimes_dx"
                                                 wire:model.lazy="state.anamnesis.diving.equalizationProblem.sometimes.dx"/>
                            </div>
                        </div>
                </div>
                <div class="col-span-12 sm:col-span-6 gap-5">
                        <x-form.label>Difficoltà di compensazione dei seni paranasali</x-form.label>
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
                                <x-form.checkbox value="1" id="sinusEqaulization_constant_sx"
                                                 wire:model.lazy="state.anamnesis.diving.sinusEqaulization.constant.sx"/>
                            </div>
                            <div class="col-span-2 md:col-span-1 text-center">
                                <x-form.checkbox value="1" id="sinusEqaulization_constant_dx"
                                                 wire:model.lazy="state.anamnesis.diving.sinusEqaulization.constant.dx"/>
                            </div>
                            <div class="col-span-8 md:col-span-4">
                                Saltuari
                            </div>
                            <div class="col-span-2 md:col-span-1 text-center">
                                <x-form.checkbox value="1" id="sinusEqaulization_sometimes_sx"
                                                 wire:model.lazy="state.anamnesis.diving.sinusEqaulization.sometimes.sx"/>
                            </div>
                            <div class="col-span-2 md:col-span-1 text-center">
                                <x-form.checkbox value="1" id="sinusEqaulization_sometimes_dx"
                                                 wire:model.lazy="state.anamnesis.diving.sinusEqaulization.sometimes.dx"/>
                            </div>

                            @if(in_array("1",data_get($state,'anamnesis.diving.sinusEqaulization.*.*',[]),true))
                                <div class="col-span-12">
                                    <x-form.label>Quali?</x-form.label>
                                    <div class="md:w-full flex flex-row mt-3">
                                        <div class="w-1/3"><input wire:model="state.anamnesis.diving.sinusEqaulization.location"  type="checkbox" value="frontale" /> Frontale</div>
                                        <div class="w-1/3"><input wire:model="state.anamnesis.diving.sinusEqaulization.location"  type="checkbox" value="mascellare" /> Mascellare</div>
                                        <div class="w-1/3"><input wire:model="state.anamnesis.diving.sinusEqaulization.location"  type="checkbox" value="altri" /> Altri</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>
        @endif
    </x-card>

    <x-card title="{{ __('Esami Obiettivi') }}" class="mt-5">
    </x-card>
    <x-card title="{{ __('Esami Strumentali') }}" class="mt-5">
    </x-card>

</x-medical-record.common-edit>








