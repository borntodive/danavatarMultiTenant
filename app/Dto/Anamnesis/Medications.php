<?php

namespace App\Dto\Anamnesis;

use Spatie\DataTransferObject\DataTransferObject;

final class Medications extends DataTransferObject
{
    public function getMedications()
    {
        $conditions = get_object_vars($this);
        unset($conditions['exceptKeys']);
        unset($conditions['onlyKeys']);
        unset($conditions['ignoreMissing']);

        return collect($conditions);
    }

    public ?string $antiAllergenic;

    public ?string $antiDepressants;

    public ?string $antiAsthmatics;

    public ?string $bloodPressure;

    public ?string $antiDiarrheal;

    public ?string $heart;

    public ?string $oralDiabetics;

    public ?string $antibiotics;

    public ?string $antiEpileptics;

    public ?string $contraceptives;

    public ?string $decongestants;

    public ?string $antiFlue;

    public ?string $insulin;

    public ?string $painKillers;
}
