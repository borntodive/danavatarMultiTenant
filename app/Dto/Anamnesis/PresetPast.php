<?php

namespace App\Dto\Anamnesis;

use phpDocumentor\Reflection\Types\Integer;
use Spatie\DataTransferObject\DataTransferObject;
use function strtolower;

final class PresetPast extends DataTransferObject
{


    public ?integer $present;

    public ?integer $past;

}
