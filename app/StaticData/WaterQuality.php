<?php


namespace App\StaticData;


class WaterQuality
{
    public static $fields = [
        'temperatura' => [
            "name" => 'Temperatura °C',
            "type"=>'text'
        ],
        'visibilita' => [
            "name" => 'Visibilità',
            "type"=>'multiple',
            'options'=> [
                '0'=>"meno di 3 mt",
                '3'=>'tra 3 e 10 mt',
                '10'=>'più di 10 mt'
            ]
        ],
        'ph' => [
            "name" => 'pH',
            "type"=>'text'
        ],
        'kh' => [
            "name" => 'KH (Durezza carbonica) [° tedeschi]',
            "type"=>'text'
        ],
        'nh4' => [
            "name" => 'NH4 (Ammoniaca) mg/l (ppm)',
            "type"=>'text'
        ],
        'no3' => [
            "name" => 'NO3 (Nitrati) mg/l (ppm)',
            "type"=>'text'
        ],
        'no2' => [
            "name" => 'NO2 (Nitriti) mg/l (ppm)',
            "type"=>'text'
        ],
        'densita' => [
            "name" => 'Densità (kg/m 3 )',
            "type"=>'text'
        ],
        'poseidonia' => [
            "name" => 'Poseidonia Oceanica',
            "type"=>'multiple',
            'options'=> [
                'scarsa'=>"Scarsa",
                'sdradicata'=>'Sdradicata',
                'abbondante'=>'Abbondante'
            ]
        ],
        'dinofalgellati' => [
            "name" => 'Dinofalgellati',
            "type"=>'multiple',
            'options'=> [
                'presenti'=>"Presenti",
                'assenti'=>'Assenti',
            ]
        ],
        'diamotee' => [
            "name" => 'Diamotee',
            "type"=>'multiple',
            'options'=> [
                'presenti'=>"Presenti",
                'assenti'=>'Assenti',
            ]
        ],
        'mucillagine_bentonica' => [
            "name" => 'Mucillagine Bentonica',
            "type"=>'multiple',
            'options'=> [
                'assente'=>'Assente',
                'scarsa'=>"Scarsa",
                'abbondante'=>'Abbondante'
            ]
        ],
        'mucillagine_pelagica' => [
            "name" => 'Mucillagine Pelagica',
            "type"=>'multiple',
            'options'=> [
                'assente'=>'Assente',
                'scarsa'=>"Scarsa",
                'abbondante'=>'Abbondante'
            ]
        ],


    ];


}
