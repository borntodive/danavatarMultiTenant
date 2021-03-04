<?php

namespace App\Dto\Anamnesis;

use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Integer;
use Spatie\DataTransferObject\DataTransferObject;

final class UserAnamnesisData extends DataTransferObject
{
    private $baseArray = ['present'=>null,'past'=>null];
    public function __construct($data=null)
    {
        $this->nothingSignificant = array_merge($this->baseArray,Arr::get($data, 'nothingSignificant', $this->baseArray));
        $this->allergy = Arr::get($data, 'allergy', $this->baseArray);
        $this->asthma = Arr::get($data, 'asthma', $this->baseArray);
        $this->backPain = Arr::get($data, 'backPain', $this->baseArray);
        $this->backSurgery = Arr::get($data, 'backSurgery', $this->baseArray);
        $this->smoker= Arr::get($data, 'smoker', $this->baseArray);
        $this->diabetes= Arr::get($data, 'diabetes', $this->baseArray);
        $this->ears= Arr::get($data, 'ears', $this->baseArray);
        $this->earsSurgery= Arr::get($data, 'earsSurgery', $this->baseArray);
        $this->flue= Arr::get($data, 'flue', $this->baseArray);
        $this->heartProblems= Arr::get($data, 'heartProblems', $this->baseArray);
        $this->joinsPains= Arr::get($data, 'joinsPains', $this->baseArray);
        $this->nsd= Arr::get($data, 'nsd', $this->baseArray);
        $this->peripheralVascular= Arr::get($data, 'peripheralVascular', $this->baseArray);
        $this->pregnancy= Arr::get($data, 'pregnancy', $this->baseArray);
        $this->dcs= Arr::get($data, 'dcs', $this->baseArray);
        $this->pulmonaryProblems= Arr::get($data, 'pulmonaryProblems', $this->baseArray);
        $this->seaSickness= Arr::get($data, 'seaSickness', $this->baseArray);
        $this->hyperfolesterolemia= Arr::get($data, 'hyperfolesterolemia', $this->baseArray);
        $this->familyDiseases= Arr::get($data, 'familyDiseases', $this->baseArray);
        $this->other= Arr::get($data, 'other', $this->baseArray);
    }

    public function getConditions() {
        $conditions=get_object_vars($this);
        unset($conditions['exceptKeys']);
        unset($conditions['onlyKeys']);
        unset($conditions['ignoreMissing']);
        unset($conditions['baseArray']);
        return collect($conditions);
    }

    public array $nothingSignificant;

    public array $allergy;

    public array $asthma;

    public array $backPain;

    public array $backSurgery;

    public array $smoker;

    public array $diabetes;

    public array $ears;

    public array $earsSurgery;

    public array $flue;

    public array $heartProblems;

    public array $joinsPains;

    public array $nsd;

    public array $peripheralVascular;

    public array $pregnancy;

    public array $dcs;

    public array $pulmonaryProblems;

    public array $seaSickness;

    public array $hyperfolesterolemia;

    public array $familyDiseases;

    public array $other;


}
