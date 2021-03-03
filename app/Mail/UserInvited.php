<?php

namespace App\Mail;

use App\Models\Invite;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class UserInvited extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected  $invite;

    public function __construct(Invite $invite)
    {
        $this->invite=$invite;
    }

    public function build()
    {
        return $this->view('emails.user-invited')->with([
            'invite'=>$this->invite
        ]);
    }
}
