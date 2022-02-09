<?php

namespace App\StaticData;

class Neuro
{
    public static $disorders = [
        [
            'label'=>'Difficoltà di concentrazione/attenzione',
            'target'=>'anamnesis.general.disorders.attention',
            'options'=>[1],
        ],
        [
            'label'=>'Cefalea',
            'target'=>'anamnesis.general.disorders.cefalea',
            'options'=>[1],
        ], [
            'label'=>'Vertigini',
            'target'=>'anamnesis.general.disorders.vertigo',
            'options'=>[1],
        ],
        [
            'label'=>'Alterazioni del gusto e/o dell’olfatto',
            'target'=>'anamnesis.general.disorders.taste',
            'options'=>[1],
        ], [
            'label'=>'Visione alterata',
            'target'=>'anamnesis.general.disorders.vision',
            'options'=>[1],
        ], [
            'label'=>'Disturbi dell’udito',
            'target'=>'anamnesis.general.disorders.hearing',
            'options'=>[1],
        ], [
            'label'=>'Dolori arti superioni',
            'target'=>'anamnesis.general.disorders.dolors.limbs.upper',
            'options'=>['Sx', 'Dx'],
        ],
        [
            'label'=>'Dolori arti inferiori',
            'target'=>'anamnesis.general.disorders.dolors.limbs.lower',
            'options'=>['Sx', 'Dx'],
        ], [
            'label'=>'Dolori colonna vertebrale',
            'target'=>'anamnesis.general.disorders.dolors.column',
            'options'=>['Cervicale', 'Dorsale', 'Lombare'],
        ], [
            'label'=>'Dolori tronco',
            'target'=>'anamnesis.general.disorders.dolors.tronco',
            'options'=>[1],
        ], [
            'label'=>'Disturbi della sensibilità viso',
            'target'=>'anamnesis.general.disorders.sensibilita.viso',
            'options'=>['Sx', 'Dx'],
        ], [
            'label'=>'Disturbi della sensibilità arti superiori',
            'target'=>'anamnesis.general.disorders.sensibilita.limbs.upper',
            'options'=>['Sx', 'Dx'],
        ],
        [
            'label'=>'Disturbi della sensibilità arti inferiori',
            'target'=>'anamnesis.general.disorders.sensibilita.limbs.lower',
            'options'=>['Sx', 'Dx'],
        ],
        [
            'label'=>'Disturbi della forza e/o della motilità vso',
            'target'=>'anamnesis.general.disorders.motilita.viso',
            'options'=>['Sx', 'Dx'],
        ],
        [
            'label'=>'Disturbi della forza e/o della motilità arti superiori',
            'target'=>'anamnesis.general.disorders.motilita.limbs.upper',
            'options'=>['Sx', 'Dx'],
        ],
        [
            'label'=>'Disturbi della forza e/o della motilità arti inferiori',
            'target'=>'anamnesis.general.disorders.motilita.limbs.lower',
            'options'=>['Sx', 'Dx'],
        ],
        [
            'label'=>'Altro',
            'target'=>'anamnesis.general.disorders.altro',
            'options'=>0,
        ],
    ];

    public static $mobilita = [
        'artiSuperiori' => [
            [
                'label'=>'Flessori di gomito (C5) Sinistra',
                'target'=>'anamnesis.general.mobilita.upper.flessorigomito.left',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Flessori di gomito (C5) Destra',
                'target'=>'anamnesis.general.mobilita.upper.flessorigomito.right',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Flessori di polso (C6) Sinistra',
                'target'=>'anamnesis.general.mobilita.upper.flessoripolso.left',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Flessori di polso (C6) Destra',
                'target'=>'anamnesis.general.mobilita.upper.flessoripolso.right',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Estensori di gomito (C7) Sinistra',
                'target'=>'anamnesis.general.mobilita.upper.estensorigomito.left',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Estensori di gomito (C7) Destra',
                'target'=>'anamnesis.general.mobilita.upper.estensorigomito.right',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Flessori delle dita (C8) Sinistra',
                'target'=>'anamnesis.general.mobilita.upper.flessoridita.left',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Flessori delle dita (C8) Destra',
                'target'=>'anamnesis.general.mobilita.upper.flessoridita.right',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Abduttori delle dita (D1) Sinistra',
                'target'=>'anamnesis.general.mobilita.upper.abduttoridita.left',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Abduttori delle dita (D1) Destra',
                'target'=>'anamnesis.general.mobilita.upper.abduttoridita.right',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
        ],
        'artiInferiori' => [
            [
                'label'=>'Flessori di anca (L2) Sinistra',
                'target'=>'anamnesis.general.mobilita.lower.flessorianca.left',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Flessori di anca (L2) Destra',
                'target'=>'anamnesis.general.mobilita.lower.flessorianca.right',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Estensori di ginocchio (L3) Sinistra',
                'target'=>'anamnesis.general.mobilita.lower.estensoriginocchio.left',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Estensori di ginocchio (L3) Destra',
                'target'=>'anamnesis.general.mobilita.lower.estensoriginocchio.right',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Flessori dorsali di caviglia (L4) Sinistra',
                'target'=>'anamnesis.general.mobilita.lower.flessoridorsalicaviglia.left',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Flessori dorsali di caviglia (L4) Destra',
                'target'=>'anamnesis.general.mobilita.lower.flessoridorsalicaviglia.right',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Estensori dell’alluce (L5) Sinistra',
                'target'=>'anamnesis.general.mobilita.lower.estensorialluce.left',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Estensori dell’alluce (L5) Destra',
                'target'=>'anamnesis.general.mobilita.lower.estensorialluce.right',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Flessori plantari della caviglia (S1) Sinistra',
                'target'=>'anamnesis.general.mobilita.lower.flessoriplantaricaviglia.left',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Flessori plantari della caviglia (S1) Destra',
                'target'=>'anamnesis.general.mobilita.lower.flessoriplantaricaviglia.right',
                'options'=>['M5', 'M4', 'M3', 'M2', 'M1', 'M0'],
            ],
            [
                'label'=>'Note',
                'target'=>'anamnesis.general.mobilita.note',
                'options'=>0,
            ],
        ],
    ];

    public static $tono = [
        [
            'label'=>'Arti superiori Destra',
            'target'=>'anamnesis.general.tono.upper.right',
            'options'=>['Normale', 'Aumentato', 'Diminuito'],
            'radio'=>999,
        ], [
            'label'=>'Arti superiori Sinistra',
            'target'=>'anamnesis.general.tono.upper.left',
            'options'=>['Normale', 'Aumentato', 'Diminuito'],
            'radio'=>999,
        ], [
            'label'=>'Arti inferiori Destra',
            'target'=>'anamnesis.general.tono.lower.right',
            'options'=>['Normale', 'Aumentato', 'Diminuito'],
            'radio'=>999,
        ], [
            'label'=>'Arti inferiori Sinistra',
            'target'=>'anamnesis.general.tono.lower.left',
            'options'=>['Normale', 'Aumentato', 'Diminuito'],
            'radio'=>999,
        ],
    ];

    public static $sensibilita = [
        [
            'label'=>'Tattile',
            'target'=>'anamnesis.general.sensibilita.tattile',
            'options'=>['Normale', 'Alterata', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Termo dolorifica',
            'target'=>'anamnesis.general.sensibilita.termo',
            'options'=>['Normale', 'Alterata', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Vidratoria',
            'target'=>'anamnesis.general.sensibilita.vibratoria',
            'options'=>['Normale', 'Alterata', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Note',
            'target'=>'anamnesis.general.sensibilita.note',
            'options'=>0,
        ],
    ];

    public static $riflessi = [
        [
            'label'=>'Bicipitale Destra',
            'target'=>'anamnesis.general.riflesso.bicipitale.right',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Bicipitale Sinistra',
            'target'=>'anamnesis.general.riflesso.bicipitale.left',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Tricipitale Destra',
            'target'=>'anamnesis.general.riflesso.tricipitale.right',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Tricipitale Sinistra',
            'target'=>'anamnesis.general.riflesso.tricipitale.left',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Stilo radiale Destra',
            'target'=>'anamnesis.general.riflesso.radiale.right',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Stilo radiale Sinistra',
            'target'=>'anamnesis.general.riflesso.radiale.left',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Rotuleo Destra',
            'target'=>'anamnesis.general.riflesso.rotuleo.right',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Rotuleo Sinistra',
            'target'=>'anamnesis.general.riflesso.rotuleo.left',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Achilleo Destra',
            'target'=>'anamnesis.general.riflesso.achilleo.right',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Achilleo Sinistra',
            'target'=>'anamnesis.general.riflesso.achilleo.left',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Medio plantare Destra',
            'target'=>'anamnesis.general.riflesso.medio.right',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Medio plantare Sinistra',
            'target'=>'anamnesis.general.riflesso.medio.left',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Cutaneo plantare Destra',
            'target'=>'anamnesis.general.riflesso.cutaneo.right',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ], [
            'label'=>'Cutaneo plantare Sinistra',
            'target'=>'anamnesis.general.riflesso.cutaneo.left',
            'options'=>['Normale', 'Debole', 'Vivace', 'Assente'],
            'radio'=>999,
        ],
    ];

    public static $coordinazione = [
        [
            'label'=>'Indice naso Destra',
            'target'=>'anamnesis.general.coordinazione.indice.right',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
        ], [
            'label'=>'Indice naso Sinistra',
            'target'=>'anamnesis.general.coordinazione.indice.left',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
        ], [
            'label'=>'Calcagno ginocchio Destra',
            'target'=>'anamnesis.general.coordinazione.calcagno.right',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
        ], [
            'label'=>'Calcagno ginocchio Sinistra',
            'target'=>'anamnesis.general.coordinazione.calcagno.left',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
        ], [
            'label'=>'Note',
            'target'=>'anamnesis.general.coordinazione.note',
            'options'=>0,
        ],
    ];

    public static $antigravitarie = [
        [
            'label'=>'Mingazzini I Destra',
            'target'=>'anamnesis.general.antigravitarie.mingazziniI.right',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
        ], [
            'label'=>'Mingazzini I Sinistra',
            'target'=>'anamnesis.general.antigravitarie.mingazziniI.left',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
        ], [
            'label'=>'Mingazzini II Destra',
            'target'=>'anamnesis.general.antigravitarie.mingazziniII.right',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
        ], [
            'label'=>'Mingazzini II Sinistra',
            'target'=>'anamnesis.general.antigravitarie.mingazziniII.left',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
        ], [
            'label'=>'Note',
            'target'=>'anamnesis.general.antigravitarie.note',
            'options'=>0,
        ],
    ];

    public static $deambulazione = [
        [
            'label'=>'Romberg',
            'target'=>'anamnesis.general.deambulazione.romberg',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
            'more'=>'text',
        ], [
            'label'=>'Deambulazione',
            'target'=>'anamnesis.general.deambulazione.deambulazione',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
            'more'=>'text',
        ], [
            'label'=>'Cammino a stella',
            'target'=>'anamnesis.general.deambulazione.stella',
            'options'=>['Corretto', 'Alterato'],
            'radio'=>999,
            'more'=>'text',
        ],
    ];

    public static function nervi()
    {
        $nervi = [];
        for ($i = 1; $i <= 12; $i++) {
            $nervi[] = [
                'label'=> self::numberToRoman($i),
                'target'=>'nervi.'.$i,
                'options'=>['Normale', 'Sx', 'Dx'],
                'radio'=>1,
                'more'=>'text',
            ];
        }

        return $nervi;
    }

    private static function numberToRoman($num)
    {
        // Be sure to convert the given parameter into an integer
        $n = intval($num);
        $result = '';

        // Declare a lookup array that we will use to traverse the number:
        $lookup = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1,
        ];

        foreach ($lookup as $roman => $value) {
            // Look for number of matches
            $matches = intval($n / $value);

            // Concatenate characters
            $result .= str_repeat($roman, $matches);

            // Substract that from the number
            $n = $n % $value;
        }

        return $result;
    }
}

/*
[
    "label"=>'Vertigini',
    "target"=>'anamnesis.general.disorders.vertigo',
    "options"=>[1],
],
 */
