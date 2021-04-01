<?php

namespace App\Http\Livewire\Weareble;

use App\Models\Sensor;
use App\Models\SensorsPerDay;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Faker\Factory as Faker;

class Calendar extends Component
{

    public $users;
    public User $user;
    public $events=[];

    public $targetDate;


    public function mount() {
        $this->targetDate=now()->format('Y-m-d');
        $this->getEvents();
    }

    public function updatedTargetDate($value)
    {
        if ($this->targetDate) {
            try {
                $searchDate= new Carbon("01-".$this->targetDate);
            } catch (\Exception $e) {
                return;
            }
            $this->emit('gotoDate', $searchDate);
            $this->getEvents();
        }
    }


    public function getEvents() {
        try {
            $searchDate= new Carbon("01-".$this->targetDate);
        } catch (\Exception $e) {
            return;
        }
        $sensorsPerDay=SensorsPerDay::query()
            ->whereRaw("EXTRACT(MONTH FROM date) = {$searchDate->month} AND EXTRACT(YEAR FROM date) = {$searchDate->year}  AND user_id = {$this->user->id}")
            ->get();
        $sensors=Sensor::all();
        $events=[];
        foreach ($sensorsPerDay as $s){

            $currDate=new Carbon($s->date);
            foreach ($s->sensors as $sensor) {
                $events[]=[
                    "title"=>$sensors->find($sensor)->name,
                    "start"=>$currDate->toDateString(),
                    "color"=>$sensors->find($sensor)->color,
                ];
            }
        }

        $this->events=json_encode($events);
        $this->emit('eventsUpdated', json_encode($events));
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
