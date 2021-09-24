<?php


namespace App\StaticData;

class Osas
{


    public static $anamnesis = [
        'contazione_superiore' => [
            'label' => "Contrazione mascellare superiore",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ]
        ],
        'rinite' => [
            'label' => "Rinite allergica",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ]
        ],
        'cambio_peso' => [
            'label' => "Il peso è cambiato negli ultimi 10 anni",
            'options' => [
                'si_more' => 'Si, con incremento',
                'si_less' => 'Si, con decremento',
                'no' => 'No',
            ]
        ],
        'chirurgia_nasale' => [
            'label' => "Precedenti interventi chirurgici nasali",
            'options' => [
                   "nessuno"=> "Nessuno",
                   "turbinoplastica"=> "Turbinoplastica",
                   "settoturbinoplastica"=> "Settoturbinoplastica",
                   "fess"=> "Fess",
            ]
        ],
        'chirurgia_russamento' => [
            'label' => "Precedenti interventi chirurgici per russamento/apnee",
            'options' => [
                   "si"=> "Si",
                   "no"=> "No",
            ],
            "if_yes"=> 'Quale intervento?'
        ],
    ];

    public static $checkboxs = [
        [
            "label"=>'Altri interventi chirurgici eseguiti',
            "target"=>'state.anamnesis.general.altri_interventi',
            "options"=>["Adenotonsillectomia", "Chirurgia per labiopalatoschisi", "Chirurgia ortognatica", "Chirurgia bariatrica", "Chirurgia rachide cervicale", "Nessuno dei precedenti"],
        ],
        [
            "label"=>"Ci sono stati precedenti percorsi terapeutici per l'osas?",
            "target"=>'state.anamnesis.general.percorsi_osas',
            "options"=>["Nessuno", "Wait and see", "Dimagramento", "CPAP", "MAD", "Chirurgia", "Terapia posizionale"],
        ],
        [
            "label"=>"In caso di precedenti trattamenti cosa ti ha portato a fare questa valutazione",
            "target"=>'state.anamnesis.general.motivo_valutazione',
            "options"=>["Nessun beneficio dal trattamento in essere", "Scarsa compliance anche se efficace", "Altro parere", "Controllo"],
        ],
        [
            "label"=>"Polisonnografia - Tipo di esame",
            "target"=>'state.anamnesis.general.polisonnografia',
            "options"=>["Monitoraggio-cardiorespiratorio", "Polisonnografia tipo I", "Polisonnografia tipo II", "Pulsossimetria"],
        ],
        [
            "label"=>"Sintomi riferiti",
            "target"=>'state.anamnesis.general.sintomi',
            "options"=>["Viene lamentato russamento abituale", "Sono riferite verosimili apnee notturne", "Si verifica no anche episodi ci fenomeni di risveglio con soffocamento", "Si registrano risvegli notturni per mingere.", "Il sonno viene descritto come agitato, talvolta con incubi", "In alcune fasi della notte vengono avvertiti movimenti ripetuti delle gambe", "E' frequentemente riferita significativa sudorazione notturna e bocca secca", "Si associano con variabile frequenza momenti di insonnia", "Talvolta si percepiscono rigurgiti acidi in gola o addirittura in bocca", "Viene descritto un rumore notturno come raglio di asino"],
        ],
        [
            "label"=>"Altri sintomi associati",
            "target"=>'state.anamnesis.general.altri_sintomi',
            "options"=>["La qualità del sonno viene percepita come non riposante, con sonnolenza diurna conseguente", "La sonnolenza talvolta impone di dormire senza riuscire a rimanere svegli.", "Si associano difficoltà a concentrarsi ed a memorizzare", "La energia nel lavoro e nelle altre attività sembra ridotta", "Sono riportate inspiegabili cadute a terra, gambe che cedono, talvolta in rapporto a particolari stati emotivi", "E‘ talvolta presente mal di testa al mattino dopo il risveglio", "Vengono riferite difficoltà della sfera sessuale , come ridotta libido e/ o turbe della erezione", "La respirazione nasale viene giudicata inefficiente/scarsa"],
        ],
        [
            "label"=>"Si registra familiarità per apnee?",
            "target"=>'state.anamnesis.general.familiarita',
            "options"=>["Si","No"],
        ],
        [
            "label"=>"Comorbidità",
            "target"=>'state.anamnesis.general.comorbidita',
            "options"=>["Pressione alta", "Diabete", "Ipercolesterolemia", "Aritmie Cardiache", "Bronchite cronica/asma", "Tendenza ad essere ansiosi senza apparente motivo", "Tendenza alla depressione", "Pregresso infarto cardiaco", "Pregresso ictus", "Ipotiroidismo", "Sindrome di Down", "Dismorfismo facciale di tipo sindromico", "Allergie respiratorie a sostanze", "Allergie a farmaci", "Pregressi tumori maligni", "Pregressi incidenti stradali", "Problemi neurologici di varia natura", "Problemi vescicali ed urinari", "Bassa pressione arteriosa, specie alzandosi bruscamente", "Nessuna delle precedenti"],
        ],
        [
            "label"=>"Tipo di cpap (unica)",
            "target"=>'state.anamnesis.general.tipo_cpap',
            "options"=>["Autocpap", "Pressione fissa", "Dato non disponibile"],
        ],
        [
            "label"=>"Pressione di efficacia della cpap",
            "target"=>'state.anamnesis.general.pressione_cpap',
            "options"=>["> 8 cm/h2o", "< 8 cm/h2o", "Dato non disponibile"],
        ],
        [
            "label"=>"AHI con cpap",
            "target"=>'state.anamnesis.general.ahi_cpap',
            "options"=>["AHI < 5", "AHI tra 5 e 15", "AHI > 15", "Dato non disponibile"],
        ],
    ];

    public static $numbers = [
        [
            'label'=>'Collasso valvola interna',
            'max'=>3
        ],
        [
            'label'=>'Collasso valvola esterna',
            'max'=>3
        ],
        [
            'label'=>'Ipertrofiaturbinati inferiori',
            'max'=>4
        ],
        [
            'label'=>'Ipertrofia adenoidea',
            'max'=>4
        ]
        ,
        [
            'label'=>'Grading tonsillare Friedman',
            'max'=>4
        ]
        ,
        [
            'label'=>'Mallampati Score',
            'max'=>4
        ],
        [
            'label'=>'Friedman Palate Score',
            'max'=>4
        ],
        [
            'label'=>'Palate Phenotype secondo Tucker Woodson',
            'options'=>[
                'Orizzontale',
                'Intermedio',
                'Verticale'
            ]
        ],
        [
            'label'=>'Grading tonsilla linguale Score Friedman',
            'max'=>4
        ],
        [
            'label'=>'Manova di Muller retropalatale',
            'max'=>4
        ],
        [
            'label'=>'Manova di Muller retrolinguale',
            'max'=>4
        ],
        [
            'label'=>'Panting test',
            'options'=>[
                'Non Eseguito',
                'Positivo',
                'Negativo'
            ]
        ],
        [
            'label'=>'Micro Retrognazia',
            'options'=>[
                'Si',
                'No'
            ]
        ],

    ];

    public static $sums = [
        [
            'label' => 'Seduto mentre leggo',
            'index' => 'A'
        ],
        [
            'label' => 'Guardando la TV',
            'index' => 'B'
        ],
        [
            'label' => 'Seduto, inattivo in un luogo pubblico (a teatro, ad una conferenza)',
            'index' => 'C'
        ],
        [
            'label' => 'Passeggero in automobile, per un’ora senza sosta',
            'index' => 'D'
        ],
        [
            'label' => "Sdraiato per riposare nel pomeriggio, quando ne ho l'occasione",
            'index' => 'E'
        ],
        [
            'label' => 'Seduto mentre parlo con qualcuno',
            'index' => 'F'
        ],
        [
            'label' => 'Seduto tranquillamente dopo pranzo, senza avere bevuto alcolici',
            'index' => 'G'
        ],
        [
            'label' => 'Alla guida fermo per pochi minuti nel traffico (es. rallentamenti, semaforo)',
            'index' => 'H'
        ],
    ];

    public static $radios =[
        'deviazione_setto_nasale' => [
            'label' => "Grado deviazione del setto nasale",
            'max'=>4
        ],
        'deviazione_piramide_nasale' => [
            'label' => "Grado deviazione della piramide nasale",
            'max'=>4
        ],
    ];

    public static $examsCheckboxs = [
        [
            "label"=>'Facies di rilievo clinico',
            "target"=>'state.exams.objectives.general.facies',
            "options"=>["Non eseguita", "PAS retrovelare ridotta <10 mm",
                        "PAS retrolinguale ridotta <10 mm",
                        "Lingua fortemente verticalizzata", "Ridotta distanza loide-Mandibola",
                        "Ipertrofia base lingua","Vegetazioni adenoidi","Ipetrofia Tonsille Palatine"],
        ],
    ];

    public static $instrumentCheckboxs = [
        [
            "label"=>'Rx telecefalo di profilo',
            "target"=>'state.exams.objectives.general.rx_telecefalo',
            "options"=>["Non eseguita", "PAS retrovelare ridotta <10 mm",
                        "PAS retrolinguale ridotta <10 mm",
                        "Lingua fortemente verticalizzata", "Ridotta distanza loide-Mandibola",
                        "Ipertrofia base lingua","Vegetazioni adenoidi","Ipetrofia Tonsille Palatine"],
        ],
        [
            "label"=>'TC del massiccio facciale',
            "target"=>'state.exams.objectives.general.tc_massiccio',
            "options"=>["Non eseguita", "Deviazione del setto nasale",
                        "Conca Bullosa",
                        "Ipertrofia dei turbinati inferiori", "Poliposinaso-sinusale",
                        "Sinusite cronica"],
        ],
        [
            "label"=>'RMN testa collo',
            "target"=>'state.exams.objectives.general.rmn',
            "options"=>["Non eseguita", "Ipertrofia della base lingua",
                        "Ipertrofia delle tonsille palatine","Ipertrofia adenoidea",],
        ],
        [
            "label"=>'PSG',
            "target"=>'state.exams.objectives.general.psg',
            "options"=>["Non eseguita", "Eseguita in assenza di terapia"],
        ],
        [
            "label"=>'RX panoramica dentaria',
            "target"=>'state.exams.objectives.general.rx_dentaria',
            "options"=>["Non eseguita", "Nessuna alterazione significativa",
                        "Ipodentulia e/o paradontosi","Alterazioni funzionali e strutturali ATM"],
        ],
    ];

}
