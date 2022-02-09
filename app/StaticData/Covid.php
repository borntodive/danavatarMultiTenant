<?php

namespace App\StaticData;

class Covid
{
    public static $exams = [
        'lungs' => [
            'name' => 'Polmonare',
            'fields' => [
                'feno' => [
                    'name' => 'FeNO',
                    'unit' => 'ppb',
                ],
                'comete' => [
                    'name' => 'Echo Comete',
                ],
            ],
        ],
        'blood_basic' => [
            'name' => 'Sangue (Basic)',
            'fields' => [
                'nox' => [
                    'name' => 'NOx',
                    'unit' => 'µmol NO3',
                ],
                'ros' => [
                    'name' => 'ROS',
                    'unit' => 'µmol/min',
                ],
                'tac' => [
                    'name' => 'TAC',
                    'unit' => 'µmol Trolox eq./l',
                ],
                'tbars' => [
                    'name' => 'TBARS',
                    'unit' => 'µmol MDA/l',
                ],
                'htc' => [
                    'name' => 'HTC',
                    'unit' => '%',
                ],
                'hb' => [
                    'name' => 'Hb',
                    'unit' => 'g/dL',
                ],
            ],
        ],
        'blood_extra' => [
            'name' => 'Sangue (Extra)',
            'fields' => [
                'pgf2' => [
                    'name' => '8-iso-PGF2α ',
                    'unit' => 'pg/mg CR',
                ],
                'ctni' => [
                    'name' => 'cTnI',
                    'unit' => '(ng/ml',
                ],
                'ck' => [
                    'name' => 'CK',
                    'unit' => 'U/l',
                ],
                'ckmbm ' => [
                    'name' => 'CK-MBm ',
                    'unit' => 'ng/ml',
                ],
                'ntprobnp ' => [
                    'name' => 'NT-proBNP ',
                    'unit' => 'pg/ml',
                ],
                'PCR' => [
                    'name' => 'pcr',
                    'unit' => 'mg/L',
                ],
                'ast' => [
                    'name' => 'AST',
                    'unit' => 'U/L',
                ],
                'alt' => [
                    'name' => 'ALT',
                    'unit' => 'U/L',
                ],
                'ldh' => [
                    'name' => 'LDH',
                    'unit' => 'U/L',
                ],
                'al' => [
                    'name' => 'AL',
                    'unit' => 'g/dL',
                ],
                'fer' => [
                    'name' => 'FER',
                    'unit' => 'ng/ml',
                ],
                'tf' => [
                    'name' => 'TF',
                    'unit' => 'ng/ml',
                ],
                'fe' => [
                    'name' => 'Fe',
                    'unit' => 'µg/dL',
                ],
                'cr' => [
                    'name' => 'CR',
                    'unit' => 'mg/dL',
                ],
                'f' => [
                    'name' => 'F',
                    'unit' => 'µg/dL',
                ],
                'sua' => [
                    'name' => 'SUA',
                    'unit' => 'mg/dL',
                ],
                'tbil' => [
                    'name' => 'TBIL',
                    'unit' => 'mg/dL',
                ],
                'urea' => [
                    'name' => 'Urea',
                    'unit' => 'mg/dL',
                ],
                'vit_d' => [
                    'name' => 'Vit. D',
                    'unit' => 'ng/ml',
                ],
                'na' => [
                    'name' => 'Na',
                    'unit' => 'mmol/L',
                ],
                'k' => [
                    'name' => 'K',
                    'unit' => 'mmol/L',
                ],
                'cl' => [
                    'name' => 'CL',
                    'unit' => 'mmol/L',
                ],
                'glc' => [
                    'name' => 'Glc',
                    'unit' => 'mg/dL',
                ],
                '3notyr' => [
                    'name' => '3-NO-Tyr',
                    'unit' => 'µg/L',
                ],

            ],
        ],
        'embolism' => [
            'name' => 'Embolia Gassosa Venosa',
            'fields' => [
                'echo_grade' => [
                    'name' => 'Echo Bolle (Grado)',
                ],
                'echo_number' => [
                    'name' => 'Echo Bolle (Numero)',
                ],
                'doppler_grade' => [
                    'name' => 'Doppler Bolle (Grado)',
                ],
            ],
        ],
        'hydration' => [
            'name' => 'Idradazione',
            'fields' => [
                'urin_density' => [
                    'name' => 'Densità Urinaria',
                    'unit' => 'g/ml',
                ],
                'urin_ph' => [
                    'name' => 'Ph Urina',
                ],
                'bioimpedancemetry' => [
                    'name' => 'Bioimpedenziometria',
                ],
            ],
        ],
        'extra' => [
            'name' => 'Extra',
            'fields' => [
                'fmd' => [
                    'name' => 'FMD',
                ],
                'thermal_camera' => [
                    'name' => 'Fotocamera Termica',
                ],
            ],
        ],
    ];

    public static $times = [
        'pre'=>[
            'name'=>'Pre',
            'color'=>'yellow',
        ],
        'post30'=>[
            'name'=>'Post 30 min',
            'color'=>'red',
        ],
        'post60'=>[
            'name'=>'Post 60 min',
            'color'=>'green',
        ],
    ];
}
