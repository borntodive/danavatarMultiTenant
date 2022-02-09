<?php

namespace App\Observers;

use App\Models\Invite;
use App\Models\User;
use App\Notifications\InviteCreated;
use App\Notifications\UserInviteCreated;
use App\Scopes\TenantScope;
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
        $user = User::withoutGlobalScope(TenantScope::class)->whereCodiceFiscale($invite->codice_fiscale)->first();
        $invite->notify(new InviteCreated());
        if ($user) {
            $user->notify(new UserInviteCreated($invite));
        }
    }

    public function creating(Invite $invite)
    {
        $token = Str::random();
        while (Invite::where('token', $token)->first()) {
            $token = Str::random();
        }
        $invite->token = $token;
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
