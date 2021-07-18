<?php


namespace App\StaticData;

class Cardio
{

    public static $patologie = ["Angina", "Infarto", "Pregresse procedure di angioplastica", "Pregresso CABG (by-pass aortocoronarico)", "Sincopi o svenimenti", "Arteriopatia obliterante degli arti inferiori", "Stenosi dei trochi sovraortici", "Ictus Cerebri", "TIA (Attacco Ischemico Transitorio)", "Amnesie"];

    public static $terapie = ["Antipertensivi", "Antiaritmici", "Antiaggreganti in singola", "Antiaggreganti doppia antiaggregazione", "Anticoagulanti TAO", "Anticoagulanti NAO", "Digitale", "Anti-anginosi", "Diuretici"];


    public static $ecg = [
        'aritmie' => [
            'label' => "Aritmie",
            'options' => [
                "si" => "Si",
                "no"=> "No",
            ]
        ],
        'pacemaker' => [
            'label' => "Pacemaker",
            'options' => [
                "si" => "Si",
                "no"=> "No",
            ]
        ],
        'defibrillatore' => [
            'label' => "Defibrillatore  Impiantato",
            'options' => [
                "si" => "Si",
                "no"=> "No",
            ]
        ],

    ];

    private static $therapy_options= [
        "usntt5"=>"USN TT5",
        "usntt6"=>"USN TT6",
        "usntt6ext"=>"USN TT6Ext",
        "cx30n"=>"CX30N",
        "cx30he"=>"CX30He",
        "altro"=>"Altro"
    ];

    private static $patient_state =[
        "asintomatico"=>"Asintomatico",
        "miglioramento"=>"Miglioramento",
        "stabile"=>"Stabile",
        "peggioramento"=>"Peggioramento",
        "decesso"=>"Decesso"
    ];

    public static $first_treatment = [
        'state_upon_arrival' => [
            'label'=> "Stato del paziente all'arrivo presso la struttura di cura",
            'options' => [
                "asintomatico"=>"Asintomatico",
                "miglioramento"=>"Miglioramento",
                "stabile"=>"Stabile",
                "peggioramento"=>"Peggioramento",
                "decesso"=>"Decesso"
            ],
        ],
        'intial protocol' =>[
            'label'=>'Protocollo iniziale di terapia iperbarica',
            'options' => [
                "usntt5"=>"USN TT5",
                "usntt6"=>"USN TT6",
                "usntt6ext"=>"USN TT6Ext",
                "cx30n"=>"CX30N",
                "cx30he"=>"CX30He",
                "altro"=>"Altro"
            ]
        ],
        'clinical_result' => [
            'label'=>"Risultato clinico dopo trattamento iperbarico iniziale",
            'options' => [
                "asintomatico"=>"Asintomatico",
                "miglioramento"=>"Miglioramento",
                "stabile"=>"Stabile",
                "peggioramento"=>"Peggioramento",
                "decesso"=>"Decesso"
            ]
        ],
    ];

    public static $others_treatment = [
        'intial protocol' =>[
            'label'=>'Protocollo iniziale di terapia iperbarica',
            'options' => [
                "usntt5"=>"USN TT5",
                "usntt6"=>"USN TT6",
                "usntt6ext"=>"USN TT6Ext",
                "cx30n"=>"CX30N",
                "cx30he"=>"CX30He",
                "altro"=>"Altro"
            ]
        ],
        'clinical_result' => [
            'label'=>"Risultato clinico dopo trattamento iperbarico iniziale",
            'options' => [
                "asintomatico"=>"Asintomatico",
                "miglioramento"=>"Miglioramento",
                "stabile"=>"Stabile",
                "peggioramento"=>"Peggioramento",
                "decesso"=>"Decesso"
            ]
        ],
        'follow_up' => [
            'label' => "Follow up trattamento iperbarico?",
            'options' => [
                'si' => 'Si',
                'no' => 'No',
            ]
        ],
    ];
}
