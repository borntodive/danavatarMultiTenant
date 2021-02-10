<?php

namespace App\Models;

use App\Traits\BelongsToMedicalCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invite extends Model
{
    use BelongsToMedicalCenter, Notifiable, HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    protected $appends = [
        'accept_url',
    ];

    public function getAcceptUrlAttribute() {
        return route('invite.accept',['token'=>$this->token]);
    }
}
