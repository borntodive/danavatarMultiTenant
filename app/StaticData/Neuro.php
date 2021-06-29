<?php


namespace App\StaticData;


class Neuro
{
    public static $disorders=[
        [
            "label"=>'Difficoltà di concentrazione/attenzione',
            "target"=>'disorders.attention',
            "options"=>[1],
        ],
        [
            "label"=>'Cefalea',
            "target"=>'disorders.cefalea',
            "options"=>[1],
        ],[
            "label"=>'Vertigini',
            "target"=>'disorders.vertigo',
            "options"=>[1],
        ],
        [
            "label"=>'Alterazioni del gusto e/o dell’olfatto',
            "target"=>'disorders.taste',
            "options"=>[1],
        ],[
            "label"=>'Visione alterata',
            "target"=>'disorders.vision',
            "options"=>[1],
        ],[
            "label"=>'Disturbi dell’udito',
            "target"=>'disorders.hearing',
            "options"=>[1],
        ],[
            "label"=>'Dolori arti superioni',
            "target"=>'disorders.dolors.limbs.upper',
            "options"=>['Sx',"Dx"],
        ],
        [
            "label"=>'Dolori arti inferiori',
            "target"=>'disorders.dolors.limbs.lower',
            "options"=>['Sx',"Dx"],
        ],[
            "label"=>'Dolori colonna vertebrale',
            "target"=>'disorders.dolors.column',
            "options"=>['Cervicale',"Dorsale","Lombare"],
        ],[
            "label"=>'Dolori tronco',
            "target"=>'disorders.dolors.tronco',
            "options"=>[1],
        ],[
            "label"=>'Disturbi della sensibilità viso',
            "target"=>'disorders.sensibilita.viso',
            "options"=>['Sx',"Dx"],
        ],[
            "label"=>'Disturbi della sensibilità arti superiori',
            "target"=>'disorders.sensibilita.limbs.upper',
            "options"=>['Sx',"Dx"],
        ],
        [
            "label"=>'Disturbi della sensibilità arti inferiori',
            "target"=>'disorders.sensibilita.limbs.lower',
            "options"=>['Sx',"Dx"],
        ],
        [
            "label"=>'Disturbi della forza e/o della motilità vso',
            "target"=>'disorders.motilita.viso',
            "options"=>['Sx',"Dx"],
        ],
        [
            "label"=>'Disturbi della forza e/o della motilità arti superiori',
            "target"=>'disorders.motilita.limbs.upper',
            "options"=>['Sx',"Dx"],
        ],
        [
            "label"=>'Disturbi della forza e/o della motilità arti inferiori',
            "target"=>'disorders.motilita.limbs.lower',
            "options"=>['Sx',"Dx"],
        ],
        [
            "label"=>'Altro',
            "target"=>'disorders.altro',
            "options"=>0,
        ],
    ];

    public static $mobilita=[
        "artiSuperiori" => [
            [
                "label"=>'Flessori di gomito (C5) Sinistra',
                "target"=>'mobilita.upper.flessorigomito.left',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Flessori di gomito (C5) Destra',
                "target"=>'mobilita.upper.flessorigomito.right',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Flessori di polso (C6) Sinistra',
                "target"=>'mobilita.upper.flessoripolso.left',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Flessori di polso (C6) Destra',
                "target"=>'mobilita.upper.flessoripolso.right',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Estensori di gomito (C7) Sinistra',
                "target"=>'mobilita.upper.estensorigomito.left',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Estensori di gomito (C7) Destra',
                "target"=>'mobilita.upper.estensorigomito.right',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Flessori delle dita (C8) Sinistra',
                "target"=>'mobilita.upper.flessoridita.left',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Flessori delle dita (C8) Destra',
                "target"=>'mobilita.upper.flessoridita.right',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Abduttori delle dita (D1) Sinistra',
                "target"=>'mobilita.upper.abduttoridita.left',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Abduttori delle dita (D1) Destra',
                "target"=>'mobilita.upper.abduttoridita.right',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
        ],
        "artiInferiori" => [
            [
                "label"=>'Flessori di anca (L2) Sinistra',
                "target"=>'mobilita.lower.flessorianca.left',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Flessori di anca (L2) Destra',
                "target"=>'mobilita.lower.flessorianca.right',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Estensori di ginocchio (L3) Sinistra',
                "target"=>'mobilita.lower.estensoriginocchio.left',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Estensori di ginocchio (L3) Destra',
                "target"=>'mobilita.lower.estensoriginocchio.right',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Flessori dorsali di caviglia (L4) Sinistra',
                "target"=>'mobilita.lower.flessoridorsalicaviglia.left',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Flessori dorsali di caviglia (L4) Destra',
                "target"=>'mobilita.lower.flessoridorsalicaviglia.right',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Estensori dell’alluce (L5) Sinistra',
                "target"=>'mobilita.lower.estensorialluce.left',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Estensori dell’alluce (L5) Destra',
                "target"=>'mobilita.lower.estensorialluce.right',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Flessori plantari della caviglia (S1) Sinistra',
                "target"=>'mobilita.lower.flessoriplantaricaviglia.left',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Flessori plantari della caviglia (S1) Destra',
                "target"=>'mobilita.lower.flessoriplantaricaviglia.right',
                "options"=>["M5","M4","M3","M2","M1","M0"],
            ],
            [
                "label"=>'Note',
                "target"=>'mobilita.note',
                "options"=>0,
            ],
        ]
    ];

    public static $tono=[
        [
            "label"=>'Arti superiori Destra',
            "target"=>'tono.upper.right',
            "options"=>["Normale","Aumentato","Diminuito"],
        ],[
            "label"=>'Arti superiori Sinistra',
            "target"=>'tono.upper.left',
            "options"=>["Normale","Aumentato","Diminuito"],
        ],[
            "label"=>'Arti inferiori Destra',
            "target"=>'tono.lower.right',
            "options"=>["Normale","Aumentato","Diminuito"],
        ],[
            "label"=>'Arti inferiori Sinistra',
            "target"=>'tono.lower.left',
            "options"=>["Normale","Aumentato","Diminuito"],
        ],
    ];

    public static $sensibilita=[
        [
            "label"=>'Tattile',
            "target"=>'sensibilita.tattile',
            "options"=>["Normale","Alterata","Assente"],
        ],[
            "label"=>'Termo dolorifica',
            "target"=>'sensibilita.termo',
            "options"=>["Normale","Alterata","Assente"],
        ],[
            "label"=>'Vidratoria',
            "target"=>'sensibilita.vibratoria',
            "options"=>["Normale","Alterata","Assente"],
        ],[
            "label"=>'Note',
            "target"=>'sensibilita.note',
            "options"=>0,
        ],
    ];

    public static $riflessi=[
        [
            "label"=>'Bicipitale Destra',
            "target"=>'riflesso.bicipitale.right',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Bicipitale Sinistra',
            "target"=>'riflesso.bicipitale.left',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Tricipitale Destra',
            "target"=>'riflesso.tricipitale.right',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Tricipitale Sinistra',
            "target"=>'riflesso.tricipitale.left',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Stilo radiale Destra',
            "target"=>'riflesso.radiale.right',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Stilo radiale Sinistra',
            "target"=>'riflesso.radiale.left',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Rotuleo Destra',
            "target"=>'riflesso.rotuleo.right',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Rotuleo Sinistra',
            "target"=>'riflesso.rotuleo.left',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Achilleo Destra',
            "target"=>'riflesso.achilleo.right',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Achilleo Sinistra',
            "target"=>'riflesso.achilleo.left',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Medio plantare Destra',
            "target"=>'riflesso.medio.right',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Medio plantare Sinistra',
            "target"=>'riflesso.medio.left',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Cutaneo plantare Destra',
            "target"=>'riflesso.cutaneo .right',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ],[
            "label"=>'Cutaneo plantare Sinistra',
            "target"=>'riflesso.cutaneo .left',
            "options"=>["Normale","Debole","Vivace","Assente"],
        ]
    ];

    public static $coordinazione=[
        [
            "label"=>'Indice naso Destra',
            "target"=>'coordinazione.indice.right',
            "options"=>["Corretto","Alterato"],
        ],[
            "label"=>'Indice naso Sinistra',
            "target"=>'coordinazione.indice.left',
            "options"=>["Corretto","Alterato"],
        ],[
            "label"=>'Calcagno ginocchio Destra',
            "target"=>'coordinazione.calcagno.right',
            "options"=>["Corretto","Alterato"],
        ],[
            "label"=>'Calcagno ginocchio Sinistra',
            "target"=>'coordinazione.calcagno.left',
            "options"=>["Corretto","Alterato"],
        ],[
            "label"=>'Note',
            "target"=>'coordinazione.note',
            "options"=>0,
        ],
    ];

    public static $antigravitarie=[
        [
            "label"=>'Mingazzini I Destra',
            "target"=>'antigravitarie.mingazziniI.right',
            "options"=>["Corretto","Alterato"],
        ],[
            "label"=>'Mingazzini I Sinistra',
            "target"=>'antigravitarie.mingazziniI.left',
            "options"=>["Corretto","Alterato"],
        ],[
            "label"=>'Mingazzini II Destra',
            "target"=>'antigravitarie.mingazziniII.right',
            "options"=>["Corretto","Alterato"],
        ],[
            "label"=>'Mingazzini II Sinistra',
            "target"=>'antigravitarie.mingazziniII.left',
            "options"=>["Corretto","Alterato"],
        ],[
            "label"=>'Note',
            "target"=>'antigravitarie.note',
            "options"=>0,
        ],
    ];

    public static $deambulazione=[
        [
            "label"=>'Romberg',
            "target"=>'deambulazione.romberg',
            "options"=>["Corretto","Alterato"],
            "more"=>'text'
        ],[
            "label"=>'Deambulazione',
            "target"=>'deambulazione.deambulazione',
            "options"=>["Corretto","Alterato"],
            "more"=>'text'
        ],[
            "label"=>'Cammino a stella',
            "target"=>'deambulazione.stella',
            "options"=>["Corretto","Alterato"],
            "more"=>'text'
        ]
    ];
}

/*
[
    "label"=>'Vertigini',
    "target"=>'disorders.vertigo',
    "options"=>[1],
],
 */
