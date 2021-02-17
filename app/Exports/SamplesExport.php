<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class SamplesExport implements FromArray, WithStrictNullComparison
{
    protected $samples;

    public function __construct(array $samples)
    {
        $this->samples = $samples;
    }

    public function array(): array
    {
        return $this->samples;
    }
}
