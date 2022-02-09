<?php

namespace App\Dto\Anamnesis;

use phpDocumentor\Reflection\Types\Integer;
use Spatie\DataTransferObject\DataTransferObject;

final class UserAnamnesis extends DataTransferObject
{
    public ?string $height;

    public ?string $weight;

    public ?string $bmi;

    public UserAnamnesisData $anamnesisData;

    public Medications $medications;

    public ?string $sport;

    public ?string $sportName;
}
