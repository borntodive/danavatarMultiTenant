<?php

namespace App\Models;

use Illuminate\Support\Arr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Eloquence\Behaviours\CamelCasing;

class Dive extends Model
{
    use HasFactory;
    use CamelCasing;

    //DESATURATION TIME IN HOURS

    private $desaturationTime=48;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
        'end_date' => 'datetime',
        'profile'=>'array',
        'gf'=>'array',
        'gf_computer'=>'array',
        'mini_chart'=>'array',
        'reb_data'=>'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /* public function profile()
    {
        return $this->hasMany(Profile::class, 'dive_id')->orderBy('timesec');;
    } */

    public function lastProfilePoint()
    {
        return Arr::last($this->profile, function ($value, $key) {
            return $key >= 0;
        });
        //return $this->hasOne(Profile::class)->orderBy('timesec', 'desc')->limit(1);
    }

    public function previousDive()
    {
        $actualDesatTime=$this->date->clone()->subHours($this->desaturationTime);
        return Dive::where('user_id',$this->user_id)->whereBetween('end_date',[$actualDesatTime,$this->date])->orderBy('date','desc')->first();

    }
    public function nextDive()
    {
        $actualDesatTime=$this->date->clone()->addHours($this->desaturationTime);
        return Dive::where('user_id',$this->user_id)->where('date','>',$this->date)->where('date','<=',$actualDesatTime)->orderBy('date','asc')->first();

    }

}
