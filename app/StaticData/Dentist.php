<?php


namespace App\StaticData;


class Dentist
{
    public static $equalizationLevel=[
        1 => 'Sempre senza problemi' ,
        2 => "Leggera sporadica difficoltà" ,
        3 => "Difficoltà molto frequenti ",
        4 => "Difficoltà costanti con rari episodi di buona compensazione" ,
        5 => "Non riesco mai a compensazione",

    ];

    public static $equalizationTecnique=[
        1 => 'Valsalva' ,
        2 => "Frenzel" ,
        3 => "Mount-field",
        4 => "Altro" ,
    ];


}
