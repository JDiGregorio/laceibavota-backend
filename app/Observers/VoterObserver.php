<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

use App\Models\Voter;

class VoterObserver
{
    /**
     * Handle the Voter "creating" event.
     */
    public function creating(Voter $voter): void
    {
        $user = Auth::user();

        $voter->mobilizer_id = $user->id;
    }

    /**
     * Handle the Voter "created" event.
     */
    public function created(Voter $voter): void
    {
        //
    }

    /**
     * Handle the Voter "updated" event.
     */
    public function updated(Voter $voter): void
    {
        //
    }

    /**
     * Handle the Voter "deleted" event.
     */
    public function deleted(Voter $voter): void
    {
        //
    }

    /**
     * Handle the Voter "restored" event.
     */
    public function restored(Voter $voter): void
    {
        //
    }

    /**
     * Handle the Voter "force deleted" event.
     */
    public function forceDeleted(Voter $voter): void
    {
        //
    }
}
