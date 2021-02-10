<?php

namespace App\Observers;

use App\Models\Invite;
use App\Notifications\InviteCreated;
use Illuminate\Support\Str;

class InviteObserver
{
    /**
     * Handle the invite "created" event.
     *
     * @param Invite $invite
     */
    public function created(Invite $invite)
    {
        $invite->notify(new InviteCreated());
    }

    public function creating(Invite $invite)
    {
        $token=Str::random();
        while (Invite::where('token',$token)->first()) {
            $token = Str::random();
        }
        $invite->token=$token;
        $invite->expires_at = now()->addHours(config('invites.duration'));
    }

    /**
     * Handle the invite "updated" event.
     *
     * @param Invite $invite
     */
    public function updated(Invite $invite)
    {
        //
    }

    /**
     * Handle the invite "deleted" event.
     *
     * @param Invite $invite
     */
    public function deleted(Invite $invite)
    {
        //
    }

    /**
     * Handle the invite "restored" event.
     *
     * @param Invite $invite
     */
    public function restored(Invite $invite)
    {
        //
    }

    /**
     * Handle the invite "force deleted" event.
     *
     * @param Invite $invite
     */
    public function forceDeleted(Invite $invite)
    {
        //
    }
}
