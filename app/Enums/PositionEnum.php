<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
/**
 * @method static static LEFTSIDE()
 * @method static static RIGHTSIDE()
 * @method static static UPSIDEDOWN()
 * @method static static STANDING()
 * @method static static PRONE()
 * @method static static SUPINE()
 */
final class PositionEnum extends Enum
{

    const LEFTSIDE =   1;
    const RIGHTSIDE =   2;
    const UPSIDEDOWN = 4;
    const STANDING =   8;
    const PRONE =   16;
    const SUPINE = 32;

}
