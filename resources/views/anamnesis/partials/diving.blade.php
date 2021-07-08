@php
    $radios=[
        'allenamento' => [
            'label'=>"Ti alleni regolarmente per l'apnea?",
            'options'=>[
                'mare'=>'Si, solo al mare',
                'mare_piscina'=>'Si, sia al mare che in piscina',
                'no'=>'No',
            ]
        ],
        'massimale_costante' => [
            'label'=>"Qual è il tuo massimale in costante?",
            'options'=>[
                '25'=>'25-30 m',
                '31'=>'31-40 m',
                '41'=>'41-50 m',
                '51'=>'51-60 m',
                '61'=>'61-70 m',
                '71'=>'71-80 m',
                '81'=>'80+ m',
            ]
        ],
        'difficolta_compensare' => [
            'label'=>"Hai difficolta a compensare?",
            'options'=>[
                'mai'=>'Mai',
                'qualchevolta'=>'Qualche volta',
                'spesso'=>'Spesso',
                'sempre'=>'Sempre',
            ]
        ],
        'contrazioni' => [
            'label'=>"Hai di solito contrazioni diaframmatiche intense?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'fastidio_pressione' => [
            'label'=>"Avverti senso di fastidio provocato dalla pressione?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'fastidio_pressione' => [
            'label'=>"Avverti senso di fastidio provocato dalla pressione?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'grado_edema' => [
            'label'=>"Identifica il grado di Edema che hai avuto",
            'options'=>[
                '1'=>'Grado 1: Se hai avuto il problema solo poche volte di grado lieve ma sei sicuro che si tratta di emottisi (Ricorda il classico quadro sensazione di difficoltà  a fare un respiro profondo, tosetta, sangue nella saliva)',
                '2'=>'Grado 2: Se il problema è frequente',
                '3'=>"Grado 3: Se il problema è grave l'emottisi è copiosa e ti limita nell'attività (problema serio)",
            ]
        ],
        'esecrato' => [
            'label'=>"Quanti episodi di Escreato rosa, Edema polmonare ti sono capitati?",
            'options'=>[
                'uno'=>'Uno',
                'pochi'=>'pochi',
                'tanti'=>'tanti',
                'sempre'=>'sempre',
            ]
        ],
        'esecrato_quote' => [
            'label'=>"Indica le quote?",
            'options'=>[
                '5'=>'5-10 m',
                '11'=>'11-20 m',
                '21'=>'21-30 m',
                '31'=>'31-40 m',
                '41'=>'41-50 m',
                '51'=>'50+ m',
            ]
        ],
    ];

    $episodio=[
        'scopo' => [
            'label'=>"Scopo dell'immersione",
            'options'=>[
                'apnea'=>'Apnea',
                'pesca'=>'Pesca',
            ]
        ],
        'attrezzature' => [
            'label'=>"Quale attrezzatura avevi",
            'options'=>[
                'pinne'=>'Pinne',
                'monopinna'=>'Monopinna',
            ]
        ],
        'tempo' => [
            'label'=>"Da quanto tempo dall'inizio dell'immersione è accaduto",
            'options'=>[
                '30'=>'< 30 minuti>',
                '60'=>'1 Ora',
                '120'=>'2 Ora',
            ]
        ],
        'stagione' => [
            'label'=>"In quale stagione è avvenuto",
            'options'=>[
                'primavera'=>'Primavera',
                'estate'=>'Estate',
                'autunno'=>'Autunno',
                'inverno'=>'Inverno',
            ]
        ],
        'compensazione' => [
            'label'=>"Avevi difficoltà nella compensazione?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'risalita' => [
            'label'=>"Avevi difficoltà nella risalita?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'contrazioni' => [
            'label'=>"Avevi forti contrazioni diaframmatiche?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'freddo' => [
            'label'=>"Avevi freddo durante l'immersione?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'farmaco' => [
            'label'=>"Avevi assunto qualche farmaco?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'stress' => [
            'label'=>"Eri in una condizione particolare di stress?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ],
            'if_yes'=> [
                'stress_condition' => [
                'label'=>"Identifica la condizione di stress?",
                'options'=>[
                        'gara'=>'Gara',
                        'meteo'=>'Cattive condizioni meteo',
                        'nervosismo'=>'Nervosismo',
                        'concentrazione'=>'Poca concentrazione',
                        'allenamento'=>'Poco allenamento',
                    ],
                ]
            ]
        ],
        'dispnea' => [
            'label'=>"Hai notato la presenza di dispnea (difficoltà respiratoria) a riposo o sotto sforzo, con caratteri di anomalia rispetto al normale sforzo da immersione?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'tachicardia' => [
            'label'=>"Hai notato la presenza di tachipnea (anomale aumento della frequenza respiratoria)?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'emottisi' => [
            'label'=>"Hai avuto emottisi (espettorazione più o meno abbondante di sangue rosso vivo)?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'profondita' => [
            'label'=>"L'episodio è capitato dopo un immersione ad una  profondità",
            'options'=>[
                'stesso_giorno'=>'Già raggiunta quel giorno',
                'altre_occasioni'=>'Raggiunta in altre occasioni',
                'prima_volta'=>'Raggiunta per la prima volta quel giorno',
                'mai'=>'Mai raggiunta prima',
            ]
        ],
        'prime_immersioni' => [
            'label'=>"Era una delle prime immersioni della giornata?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'sensazione_momento' => [
            'label'=>"Hai avuto la chiara sensazione del momento in cui è avvenuto l'episodio di edema?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ],
            'if_yes'=> [
                'chiara_sensazione' => [
                'label'=>"In quale momento dell'immersione hai avuto la chiara sensazione dell'episodio di edema?",
                'options'=>[
                        'discesa'=>'A fine discesa',
                        'profondita'=>'Alla massima profondità',
                        'risalita'=>'Durante la risalita',
                    ],
                ]
            ]
        ],
        'sintomi' => [
            'label'=>"Identifica le sensazioni/sintomi che hai avuto",
            'options'=>[
                'improvviso'=>'Improvviso dolore/bruciore al torace',
                'graduale'=>'Graduale fastidio ingravescente al torace',
                'nessuno'=>'Niente di preciso fino alla comparsa del fenomeno',
            ]
        ],
        'sequenza' => [
            'label'=>"Quale è stata la sequenza dei fatti?",
            'options'=>[
                'ventilazione'=>'Iniziale difficoltà a ventilare, poi escreato rosato/rosso',
                'escreato'=>'Presenza immediata di escreato rosato/rosso',
                'tosse'=>'Tosse, dolore toracico e difficoltà respiratorie',
            ]
        ],
        'espettorare' => [
            'label'=>"Hai continuato ad espettorare una volta uscito dall'acqua?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ],
            'if_yes'=> [
                'tempo_espettorare' => [
                'label'=>"Per quanto tempo hai continuato ad espettorare??",
                'options'=>[
                        '1'=>'1 ora',
                        '2'=>'2 ore',
                        '24'=>'Fino al giorno successivo',
                    ],
                ]
            ]
        ],
        'sdraiato' => [
            'label'=>"La posizione sdraiata peggiorava il fastidio?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'farmaci_post' => [
            'label'=>"Hai assunto Farmaci per alleviare i sintomi?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'normalita_giorno_successivo' => [
            'label'=>"Il giorno seguente sei tornato in una condizione di normalità?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ]
        ],
        'riscaldamento' => [
            'label'=>"Hai mai provato ad osservare un attento riscaldamento prima dei tuffi profondi?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ],
            'if_yes'=> [
                'benefici_riscaldamento' => [
                'label'=>"Hai avuti dei benefici dal riscaldamento prima dei tuffi profondi?",
                'options'=>[
                        'si'=>'Si',
                        'no'=>'No',
                    ],
                ]
            ]
        ],
        'sforzi_fondo' => [
            'label'=>"Hai provato ad evitare sforzi sul fondo?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ],
            'if_yes'=> [
                'benefici_sforzo' => [
                'label'=>"Hai avuto benefici evitando sforzi sul fondo?",
                'options'=>[
                        'si'=>'Si',
                        'no'=>'No',
                    ],
                ]
            ]
        ],
        'contrazioni_fondo' => [
            'label'=>"Hai provato ad evitare contrazioni sul fondo?",
            'options'=>[
                'si'=>'Si',
                'no'=>'No',
            ],
            'if_yes'=> [
                'benefici_contrazioni' => [
                'label'=>"Hai avuto dei benefici evitando le contrazioni sul fondo?",
                'options'=>[
                        'si'=>'Si',
                        'no'=>'No',
                    ],
                ]
            ]
        ]
    ];




@endphp
<x-card class="mt-3" title="{{ __('Dati attività subacquee') }}">
    <div
        class="xl:w-1/2 lg:w-1/2 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class=" flex flex-col text-center">
            <span>Scuba</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-show.label>Ricreativa</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'diving.scuba.recreative',false)"/>
                <x-show.label>Tecnica</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'diving.scuba.tecnical',false)"/>
            </div>
        </div>
    </div>
    <div
        class="xl:w-1/2 lg:w-1/2 w-full flex flex-col mb-6 lg:border-r-2 lg:border-b-0 border-b-2 border-gray-100 pb-5">
        <div class="flex flex-col text-center">
            <span>Apnea</span>
            <div class="w-full flex justify-between px-5 mt-5">
                <x-show.label>Freedive</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'diving.apnea.freedive',false)"/>
                <x-show.label>Pesca</x-show.label>
                <x-check-or-cross :condition="data_get($anamnesis->data,'diving.apnea.phishing',false)"/>
            </div>
        </div>
    </div>
    @if(data_get($anamnesis->data,'diving.scuba.recreative',false))
        <x-anamnesis.diving-view-section label="Scuba Ricreativa" :anamnesis="$anamnesis" section="scuba.recreative"
                                         :divingLevel="data_get($anamnesis->data,'diving.scuba.recreative.divingLevel',null)"/>
    @endif
    @if(data_get($anamnesis->data,'diving.scuba.tecnical',false))
        <x-anamnesis.diving-view-section label="Scuba Tecnica" :anamnesis="$anamnesis" section="scuba.tecnical"
                                         :divingLevel="data_get($anamnesis->data,'diving.scuba.tecnical.divingLevel',null)"/>
    @endif
    @if(data_get($anamnesis->data,'diving.apnea.freedive',false) )
        <x-anamnesis.diving-view-section label="Apnea Freedive" :anamnesis="$anamnesis" section="apnea.freedive"
                                         :divingLevel="data_get($anamnesis->data,'diving.apnea.freedive.divingLevel',null)"/>

    @endif
    @if(data_get($anamnesis->data,'diving.apnea.phishing',false) )
        <x-anamnesis.diving-view-section label="Apnea Pesca" :anamnesis="$anamnesis" section="apnea.phishing"
                                         :divingLevel="data_get($anamnesis->data,'diving.apnea.phishing.divingLevel',null)"/>

    @endif

</x-card>
@if(data_get($anamnesis->data,'diving.scuba.recreative',false) || data_get($anamnesis->data,'diving.scuba.tecnical',false) || data_get($anamnesis->data,'diving.apnea.freedive',false) || data_get($anamnesis->data,'diving.apnea.phishing',false))
    <x-card class="mt-3" title="{{ __('Dati anamnestici subacquei') }}">
        <div class="grid grid-cols-2 gap-6 w-full">
            @if(data_get($anamnesis->data,'diving.scuba.recreative',false))
                <div class="col-span-2 md:col-span-1">
                    <div class="relative mt-5 mb-5">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-start">
                        <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                          {{__('Scuba Ricreativa')}}
                        </span>
                        </div>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Barotrauma?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.recreative.barotrauma',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un episodio da Narcosi da azoto?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.recreative.narcosi',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una MDD?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.recreative.dcs',false)"/>
                    </div>
                </div>
            @endif
            @if(data_get($anamnesis->data,'diving.scuba.tecnical',false))
                <div class="col-span-2 md:col-span-1">

                    <div class="relative mt-5 mb-5">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-start">
                    <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                      {{__('Scuba Tecnica')}}
                    </span>
                        </div>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Barotrauma?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.tecnical.barotrauma',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un episodio da Narcosi da azoto?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.tecnical.narcosi',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una MDD?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.scuba.tecnical.dcs',false)"/>
                    </div>
                </div>
            @endif
            @if(data_get($anamnesis->data,'diving.apnea.freedive',false))
                <div class="col-span-2 md:col-span-1">

                    <div class="w-full mt-5">
                        <div class="relative mb-5">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-start">
            <span class="pr-3 bg-white text-lg font-medium text-gray-900">
              {{__('Apnea Freedive')}}
            </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Taravana?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.freedive.taravana',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Edema/Squize/Emottisi?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.freedive.edema',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una Sincope?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.freedive.sincope',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una SAMBA?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.freedive.samba',false)"/>
                    </div>
                </div>
            @endif
            @if(data_get($anamnesis->data,'diving.apnea.phishing',false))
                <div class="col-span-2 md:col-span-1">

                    <div class="w-full mt-5">
                        <div class="relative mb-5">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-start">
            <span class="pr-3 bg-white text-lg font-medium text-gray-900">
              {{__('Apnea Pesca')}}
            </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Taravana?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.phishing.taravana',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto un Edema/Squize/Emottisi?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.phishing.edema',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una Sincope?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.phishing.sincope',false)"/>
                    </div>
                    <div class="flex flex-row  mb-6">
                        <x-show.label class="mr-4 w-2/3">Hai mai avuto una SAMBA?</x-show.label>
                        <x-check-or-cross
                            :condition="data_get($anamnesis->data,'diving.anamnesis.apnea.phishing.samba',false)"/>
                    </div>
                </div>
            @endif
        </div>
        @if(data_get($anamnesis->data,'diving.anamnesis.apnea.phishing.edema',false)  || data_get($anamnesis->data,'diving.anamnesis.apnea.freedive.edema',false))

            <div class="w-full mt-5">
                <div class="relative mt-5 mb-5">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-start">
                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                  {{__('Approfondimento Edema')}}
                </span>
                    </div>
                </div>
            </div>
            <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-1 pt-6 gap-8">
                @foreach($radios as $key=>$radio)
                    <div class="md:w-full flex flex-col mb-6">
                        <x-show.label>{{$radio['label']}}</x-show.label>
                        <x-show.value>{{data_get($radio['options'],data_get($anamnesis->data,"diving.anamnesis.apnea.extra.edema.$key",false),'N/A')}}</x-show.value>
                    </div>
                @endforeach
            </div>
            <div class="w-full mt-5">
                <div class="relative mt-5 mb-5">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-start">
                <span class="pr-3 bg-white font-medium text-gray-900">
                  {{__('Descrivi un episodio di Edema')}}
                </span>
                    </div>
                </div>
            </div>
            <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 pt-6 gap-8">
                @foreach($episodio as $key=>$radio)
                    <div class="md:w-full flex flex-col mb-6">
                        <x-show.label>{{$radio['label']}}</x-show.label>

                        <x-show.value>{{data_get($radio['options'],data_get($anamnesis->data,"diving.anamnesis.apnea.extra.edema.episodio.$key",false),'N/A')}}</x-show.value>
                    </div>
                    @if(isset($radio['if_yes']) && data_get($anamnesis->data,'diving.anamnesis.apnea.extra.edema.episodio.'.$key,null) == 'si')
                        @foreach($radio['if_yes'] as $yes_key=>$yes_radio)
                            <div class="md:w-full flex flex-col mb-6">
                                <x-show.label>{{$yes_radio['label']}}</x-show.label>
                                <x-show.value>{{data_get($yes_radio['options'],data_get($anamnesis->data,"diving.anamnesis.apnea.extra.edema.episodio.$yes_key",false),'N/A')}}</x-show.value>

                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        @endif
    </x-card>
@endif
