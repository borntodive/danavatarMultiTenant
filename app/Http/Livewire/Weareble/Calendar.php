<?php

namespace App\Http\Livewire\Weareble;

use App\Models\Sensor;
use App\Models\SensorsPerDay;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Faker\Factory as Faker;
use PhpOffice\PhpSpreadsheet\Chart\Title;

class Calendar extends Component
{

    public $users;
    public User $user;
    public $events;
    public $yearEvents;
    public $targetDate;
    public $targetYear;
    public $viewYear = true;


    public function mount()
    {
        $this->targetDate = now()->format('m-Y');
        $this->targetYear= now()->format('Y');
        $this->events = json_encode([]);
        //$this->getEvents();
        $this->getYearEvents();
    }

    public function updatedTargetDate($value)
    {
        if ($this->targetDate) {
            try {
                $searchDate = new Carbon("01-" . $this->targetDate);
                $this->targetYear= $searchDate->year;
            } catch (\Exception $e) {
                return;
            }
            if (!$this->viewYear) {
                $this->emit('gotoDate', $searchDate);
                $this->getEvents();
            } else
                $this->getYearEvents();
        }
    }

    public function showYearView($show)
    {
        $this->viewYear = $show;
        if (!$show)
        {
            $this->targetDate = now()->format('m-Y');
            $this->targetYear= now()->format('Y');
            try {
                $searchDate = new Carbon("01-" . $this->targetDate);
            } catch (\Exception $e) {
                return;
            }
            $this->getEvents(false);
        }
        else {
            $this->getYearEvents();
        }
    }

    public function goToMonth($m) {
        $d=new Carbon("01-" . $m."-".$this->targetYear);
        $this->targetDate=$d->format('m-Y');
        try {
            $searchDate = new Carbon("01-" . $this->targetDate);
        } catch (\Exception $e) {
            return;
        }

        $this->getEvents(false);


    }

    public function getEvents($update=true)
    {
        try {
            $searchDate = new Carbon("01-" . $this->targetDate);
        } catch (\Exception $e) {
            return;
        }

        $sensorsPerDay = SensorsPerDay::query()
            ->whereRaw("EXTRACT(MONTH FROM date) = {$searchDate->month} AND EXTRACT(YEAR FROM date) = {$searchDate->year}  AND user_id = {$this->user->id}")
            ->get();
        $sensors = Sensor::all();
        $events = [];
        foreach ($sensorsPerDay as $s) {

            $currDate = new Carbon($s->date);
            foreach ($s->sensors as $sensor) {
                $events[] = [
                    "title" => $sensors->find($sensor)->name,
                    "start" => $currDate->toDateString(),
                    "color" => $sensors->find($sensor)->color,
                ];
            }
        }

        $this->events = json_encode($events);
        if (!$update) {
            $this->emit('showFullCalendar',$searchDate->format('Y-m-d'),$this->events);
            $this->viewYear=false;
        }

            $this->emit('eventsUpdated', json_encode($events));
    }

    public function getYearEvents()
    {
        try {
            $searchDate = new Carbon("01-" . $this->targetDate);
        } catch (\Exception $e) {
            return;
        }
        $sensorsPerDay = SensorsPerDay::query()
            ->whereRaw("EXTRACT(YEAR FROM date) = {$searchDate->year}  AND user_id = {$this->user->id}")
            ->get();
        $sensors = Sensor::all();
        $events = [];
        foreach ($sensorsPerDay as $s) {

            $currDate = new Carbon($s->date);
            foreach ($sensors as $sensor) {
                if (isset($events[$currDate->month])) {
                    $c = false;
                    foreach ($events[$currDate->month] as $e) {
                        if ($e['title'] == $sensor->name) {
                            $c = true;
                            break;
                        }
                    }
                    if ($c)
                        continue;
                }
                if (is_array($s->sensors) && in_array($sensor->id, $s->sensors)) {
                    $events[$currDate->month][] = [
                        "title" => $sensor->name,
                        "start" => $currDate->toDateString(),
                        "color" => $sensor->color,
                    ];
                } else if ($sensor->id == $s->sensors) {
                    $events[$$currDate->month][] = [
                        "title" => $sensor->name,
                        "start" => $currDate->toDateString(),
                        "color" => $sensor->color,
                    ];
                }
            }
        }

        $this->yearEvents = $events;
        //$this->emit('eventsUpdated', json_encode($events));
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.weareble.calendar');
    }
}
