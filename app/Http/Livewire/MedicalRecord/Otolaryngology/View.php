<?php

namespace App\Http\Livewire\MedicalRecord\Otolaryngology;

use App\StaticData\Otolaryngology;
use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{
    use ViewMedicalRecord;

    public $externalEarObjective;

    public $tympanicMembraneObjective;

    public $tympanicMembraneMobilityObjective;

    public function mount()
    {
        $this->externalEarObjective = Otolaryngology::$externalEarObjective;
        $this->tympanicMembraneObjective = Otolaryngology::$tympanicMembraneObjective;
        $this->tympanicMembraneMobilityObjective = Otolaryngology::$tympanicMembraneMobilityObjective;
    }
}
