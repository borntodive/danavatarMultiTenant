<?php

namespace App\StaticData;

class Anamnesis
{
    private $medicalConditions = [
        'allergy' => [
            'name'=>'Allergia',
            'present'=>true,
            'past'=>true,
        ],
        'asthma' => [
            'name'=>'Asma',
            'present'=>true,
            'past'=>true,
        ],
        'backPain' => [
            'name'=>'Dolore alla schiena',
            'present'=>true,
            'past'=>true,
        ],
        'backSurgery' => [
            'name'=>'Disturbi alla colonna vertebrale',
            'present'=>true,
            'past'=>true,
        ],
        'smoker' => [
            'name'=>'Fumatore o inalo nicotina in altro modo',
            'present'=>true,
            'past'=>true,
        ],
        'diabetes1' => [
            'name'=>'Diabete tipo 1',
            'present'=>true,
            'past'=>false,
        ],
        'diabetes2' => [
            'name'=>'Diabete tipo 2',
            'present'=>true,
            'past'=>false,
        ],
        'ears' => [
            'name'=>'Patologie otorino laringoiatriche',
            'present'=>true,
            'past'=>true,
        ],
        'earsSurgery' => [
            'name'=>'Chirurgia otorino laringoiata',
            'present'=>true,
            'past'=>true,
        ],
        'covid' => [
            'name'=>'Pregresse positività al COVID 19',
            'present'=>false,
            'past'=>true,
        ],
        'heartProblems' => [
            'name'=>'Patologie cardiovascolari',
            'present'=>true,
            'past'=>true,
        ],
        'pressureProblems' => [
            'name'=>'Ipertensione arteriosa',
            'present'=>true,
            'past'=>true,
        ],
        'ematologico' => [
            'name'=>'Ematologico',
            'present'=>true,
            'past'=>true,
        ],
        'joinsPains' => [
            'name'=>'Artrite/artrosi',
            'present'=>true,
            'past'=>false,
        ],
        'nsd' => [
            'name'=>'Patologie neurologiche',
            'present'=>true,
            'past'=>true,
        ],
        'pregnancy' => [
            'name'=>'Gravidanza',
            'present'=>true,
            'past'=>true,
        ],
        'pulmonaryProblems' => [
            'name'=>'Patologie polmonari',
            'present'=>true,
            'past'=>true,
        ],
        'hypercolesterolomia' => [
            'name'=>'Ipercolesterolomia',
            'present'=>true,
            'past'=>true,
        ],
        'familyDiseases' => [
            'name'=>'Anamnesi familiare di diabete o cardiopatie',
            'present'=>true,
            'past'=>true,
        ],
        'other' => [
            'name'=>'Altro',
            'present'=>true,
            'past'=>true,
            'more'=>true,
        ],

    ];

    private $medications = [
        'antiAllergenic'=>'Anti Allergenici',
        'antiDepressants'=>'Anti Depressivi',
        'antiAsthmatics'=>'Anti Asmatici',
        'bloodPressure'=>'Anti Ipertensivi',
        'heart'=>'Sistema Cardiovascolare',
        'antiDiabetics'=>'Anti Diabetici',
        'antiflues'=>'Anti Influenzali',
        'antiEpileptics'=>'Anti Epilettici',
        'contraceptives'=>'Contraccettivi',
        'decongestants'=>'Decongestionanti',
        'antiFlue'=>'Anti Influenzali',
        'painKillers'=>'Anti Infiammatori Orali',
        'cortisone'=>'Cortisonici',
        'immunosuppressants'=>'Immunosoppressori',
        'other' => 'Altro',
    ];

    public static function medicalConditions()
    {
        $class = new self();

        return $class->medicalConditions;
    }

    public static function medications()
    {
        $class = new self();

        return $class->medications;
    }
}
