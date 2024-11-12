<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can edit the event.
     */
    public function edit(User $logged, Event $event): bool
    {
        if ($event->belongsToUser($logged)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can store the event.
     */
    public function store(User $logged): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the event.
     */
    public function update(User $logged, Event $event): Response
    {
        if ($event->belongsToUser($logged)) {
            return Response::allow();
        }

        return Response::deny(__('general.policies.deny.general'));
    }
}
