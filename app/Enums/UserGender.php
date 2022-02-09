<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Uomo()
 * @method static static Donna()
 * @method static static Altro()
 */
final class UserGender extends Enum
{
    const Uomo = 1;

    const Donna = 2;

    const Altro = 3;
}
