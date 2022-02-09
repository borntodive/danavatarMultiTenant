<?php

namespace App\StaticData;

class Nutritionist
{
    public static $medicalConditions = [
        'diabetes' => [
            'name'=>'Diabete',
            'present'=>true,
            'past'=>false,
        ],
        'obesity' => [
            'name'=>'Obesità',
            'present'=>true,
            'past'=>true,
        ],

        'heartProblems' => [
            'name'=>'Patologie cardiovascolari',
            'present'=>true,
            'past'=>true,
        ],
        'celiac' => [
            'name'=>'Celiachia',
            'present'=>true,
            'past'=>false,
        ],
        'hypothyroidism' => [
            'name'=>'Ipotiroidismo',
            'present'=>true,
            'past'=>true,
        ],
        'lactose' => [
            'name'=>'Intolleranza al lattosio',
            'present'=>true,
            'past'=>true,
        ],
        'Hypertension' => [
            'name'=>'Ipertensione',
            'present'=>true,
            'past'=>true,
        ],
        'Dyslipidemia' => [
            'name'=>'Dislipidemie',
            'present'=>true,
            'past'=>true,
        ],
        'neplasia' => [
            'name'=>'Neoplasie',
            'present'=>true,
            'past'=>true,
        ],
        'mici' => [
            'name'=>'MICI (malattie croniche intestinali)',
            'present'=>true,
            'past'=>true,
        ],
        'hypertiroidism' => [
            'name'=>'Ipertiroidismo',
            'present'=>true,
            'past'=>true,
        ],
        'nikel' => [
            'name'=>'Allerigia al nikel',
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

    public static $medications = [
        'statine'=>'Statine',
        'antiDepressants'=>'Anti Depressivi',
        'eutirox'=>'Eutirox',
        'bloodPressure'=>'Anti Ipertensivi',
        'antacid'=>'Antiacidi',
        'metformin'=>'Metformina',
        'painKillers'=>'Anti Dolorifici',
        'other' => 'Altro',
    ];
}
