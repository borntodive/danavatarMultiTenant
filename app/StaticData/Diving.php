<?php


namespace App\StaticData;

class Diving
{
    public static $radios = [
        'fatica_esecizio' => [
            'label' => "Fatico a svolgere esercizio fisico moderato (ad esempio, camminare 1,6 km in 14 minuti o nuotare per 200 metri senza riposare), OPPURE non sono stato in grado di prendere parte a una normale attività fisica per ragioni di forma fisica o salute negli ultimi 12 mesi",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ]
        ],
        'seni_paranasali' => [
            'label' => "Ho avuto problemi agli occhi, alle orecchie o ai seni paranasali.",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ],
            'if_yes' => [
                'intervento_seni' => [
                    'label' => "Ho avuto un intervento chirurgico ai seni paranasali negli ultimi 6 mesi.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'patologia_auricolare' => [
                    'label' => "Ho una patologia auricolare o un’operazione chirurgica all’orecchio, perdita di udito o problemi di equilibrio.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'sinusite_ricorrente' => [
                    'label' => "Ho avuto una sinusite ricorrente negli ultimi 12 mesi.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'intervento_oculare' => [
                    'label' => "Ho avuto un intervento di chirurgia a livello oculare negli ultimi 3 mesi.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],

            ]
        ],
        'operazione_12mesi' => [
            'label' => "Ho subito un’operazione negli ultimi 12 mesi, OPPURE ho tuttora problemi dovuti a un passato  intervento chirurgico.",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ]
        ],
        'perso_conoscenza' => [
            'label' => "Ho perso conoscenza, avuto emicranie, crisi epilettiche, ictus, traumi cranici importanti, o ho una malattia a decorso cronico a livello neurologico.",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ],
            'if_yes' => [
                'trauma_cranico' => [
                    'label' => "Ho avuto un trauma cranico con perdita di coscienza negli ultimi 5 anni.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'patologia_neurologica' => [
                    'label' => "Ho una patologia neurologica cronica",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'emicrania_ricorrente' => [
                    'label' => "Ho avuto un'emicrania ricorrente negli ultimi 12 mesi o assumo farmaci per prevenirla.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'perdita_sensi' => [
                    'label' => "Ho avuto una perdita di sensi o svenimenti (totale/parziale perdita di coscienza) negli ultimi 5 anni.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'epilessia' => [
                    'label' => "Ho avuto epilessia, uno o più episodi di crisi convulsive, OPPURE assumo farmaci per prevenirli.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],

            ]
        ],
        'terapia_psicologica' => [
            'label' => "Sono attualmente in terapia (o ho avuto bisogno di una terapia negli ultimi 5 anni) per problemi psicologici, disturbi della personalità, attacchi di panico, o per una dipendenza da droghe o alcol; o mi è stato diagnosticato un disturbo dell’apprendimento.",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ],
            'if_yes' => [
                'problemi_comportamentali' => [
                    'label' => "Ho avuto problemi comportamentali, mentali o psicologici che richiedono terapia medica/psichiatrica",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'depressione' => [
                    'label' => "Ho avuto forte depressione, idee suicidarie, attacchi di panico, disturbo bipolare non controllato che richiede terapia farmacologica/psichiatrica",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'malattia_mentale' => [
                    'label' => "Ho una diagnosi di malattia mentale o di disturbo dell’apprendimento/sviluppo che richiede attenzione continua.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'droghe' => [
                    'label' => "Ho una dipendenza da droghe o alcol che richiede terapia negli ultimi 5 anni.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],

            ]
        ],
        'schiena' => [
            'label' => "Ho avuto problemi di schiena, ernie, ulcere o diabete.",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ],
            'if_yes' => [
                'schiena_6mesi' => [
                    'label' => "Ho avuto problemi di schiena ricorrenti negli ultimi 6 mesi che limitano la mia vita quotidiana.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'intervento_schiena' => [
                    'label' => "Ho avuto un intervento chirurgico alla schiena o alla colonna vertebrale negli ultimi 12 mesi.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'diabete_12mesi' => [
                    'label' => "Ho avuto diabete, controllato mediante farmaci o dieta, OPPURE diabete gestazionale negli ultimi 12 mesi.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'ernia' => [
                    'label' => "Ho un’ernia non corretta che limita le mie abilità fisiche.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'ulcere' => [
                    'label' => "Ho avuto ulcere attive o non trattate, problematiche di cicatrizzazione o un’operazione per ulcera negli ultimi 6 mesi.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
            ]
        ],
        'diarrea' => [
            'label' => "Ho avuto problemi gastrici o intestinali, compresa recente diarrea.",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ],
            'if_yes' => [
                'stomia' => [
                    'label' => "Ho avuto un intervento di stomia e non ho l’autorizzazione medica per nuotare o praticare attività fisica.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'disidratazione' => [
                    'label' => "Ho avuto disidratazione tale da richiedere intervento medico negli ultimi 7 giorni.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'ulcere_gastriche' => [
                    'label' => "Ho avuto ulcere gastriche o intestinali attive non curate o un’operazione per ulcera negli ultimi 6 mesi.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'bruciore_stomaco' => [
                    'label' => "Ho frequente bruciore di stomaco, rigurgito o malattia da reflusso gastroesofageo (MRGE).",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'rettocolite' => [
                    'label' => "Ho una patologia quale Rettocolite ulcerosa o morbo di Crohn attiva o non controllata.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
                'chirurgia_bariatrica' => [
                    'label' => "Ho avuto un intervento di chirurgia bariatrica negli ultimi 12 mesi.",
                    'options' => [
                        'si' => 'Si',
                        'no' => 'No',
                    ],
                ],
            ]
        ],
        'farmaci_prescrizione' => [
            'label' => "Sto assumendo medicinali soggetti a prescrizione medica (esclusi farmaci anticoncezionali o antimalarici diversi dalla meflochina (Lariam).",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ]
        ],
    ];

    public static $sintomi = ["Prurito", "Stanchezza o Malessere", "Stanchezza estrema", "Problemi respiratori", "Debolezza muscolare", "Paraestesia arti superiori", "Paraestesia arti inferiori", "Paralisi arti superiori", "Paralisi arti inferiori", "Disturbi dello sfintere", "Segni cerebrali", "Vertigini", "Disturbi visivi", "Disturbi uditivi", "Dolore", "Segni cutanei", "Arresto cardio-respiratorio", "Incidente respiratorio", "Quasi annegamento", "Segni cardiovascolari", "Segni metabolici", "Cosciente", "Semicosciente", "Confuso Incosciente", "Stabile", "Miglioramento", "Peggioramento", "Guarigione spontanea", "Trauma", "Trauma marino"];

    public static $scuba=["Prima immersione del giorno", "Immersione ripetitiva", "Più giorni di immersioni", "Risalita rapida", "Deco stop omessi", "Panico", "Stress pre o post immersione", "Assunzione di alcool prima dell'immersione", "Immersione con dive computer", "Immersione a tabella", "Problemi con l'attrezzatura", "Hai preso un aereo dopo l’immersione", "Immersione con Aria", "Immersione con Nitrox", "Immersione con Trimix", "Immersione con Eliox", "Subacqueo principiante", "Subacqueo esperto", "Istruttore o guida"];

    public static $apnea=["Prima serie di tuffi del giorno", "Serie ripetitiva di tuffi del giorno", "Più giorni di tuffi", "Panico", "Stress pre o post immersione", "Assunzione di alcool prima dell'immersione", "Immersione con dive computer", "Problemi con l'attrezzatura", "Hai preso un aereo dopo la serie di tuffi", "Apneista principiante", "Apneista esperto", "Istruttore o guida"];

    public static $dcs = [
        'tipo_dcs' => [
            'label' => "Tipo di DCS",
            'options' => [
                "dolore" => "Solo dolore",
                "neurosensoriale"=> "Neurosensoriale",
                "otovestibolare"=> "Otovestibolare",
                "cutanea"=> "Cutanea",
                "neuromotoria"=> "Neuromotoria",
                "polmonare"=> "Polmonare-polmoni",
                "cerebrale"=> "Cerebrale",
            ]
        ],
        'ossigeno' => [
            'label' => "Hai assunto ossigeno subito dopo l’incidente?",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ]
        ],
        'ossigeno_trasporto' => [
            'label' => "Hai assunto ossigeno durante il trasporto in ospedale?",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ]
        ],
        'camera_iperbarica' => [
            'label' => "Hai fatto trattamento in camera iperbarica?",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ]
        ],


    ];
}

/*
[
    "label"=>'Vertigini',
    "target"=>'anamnesis.general.disorders.vertigo',
    "options"=>[1],
],
 */
