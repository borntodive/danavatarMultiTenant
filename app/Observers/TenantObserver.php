<?php

namespace App\Observers;

use App\Models\Club;
use App\Models\Tenant;
use App\Models\Team;

class TenantObserver
{
    /**
     * Handle the club "created" event.
     *
     * @param Tenant $tenant
     */
    public function created(Tenant $tenant)
    {

        Team::firstOrCreate([
            'name' => $tenant->slug,
            'display_name' => $tenant->name,
        ]);
        //$center->users()->attach(auth()->user());
        //dd($center->users[0]);
    }

    /**
     * Handle the club "creating" event.
     *
     * @param Tenant $tenant
     */
    public function creating(Tenant $tenant)
    {
        $slug = \Str::slug($tenant->name);

        // check to see if any other slugs exist that are the same & count them
        $count = Team::whereRaw("name RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        // if other slugs exist that are the same, append the count to the slug
        $tenant->slug = $count ? "{$slug}-{$count}" : $slug;
    }
    /**
     * Handle the club "updated" event.
     *
     * @param Tenant $center
     */
    public function updated(Tenant $tenant)
    {
        //
    }

    /**
     * Handle the club "deleted" event.
     *
     * @param Tenant $center
     */
    public function deleted(Tenant $tenant)
    {
        $team=Team::where(['name'=>$tenant->slug])->first();
        $team->delete();
    }

    /**
     * Handle the club "restored" event.
     *
     * @param Tenant $tenant
     */
    public function restored(Tenant $tenant)
    {
        //
    }

    /**
     * Handle the club "force deleted" event.
     *
     * @param Tenant $tenant
     */
    public function forceDeleted(Tenant $tenant)
    {
        //
    }
}
