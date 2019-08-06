<?php

namespace App\Policies;

use App\User;
use App\Wagon;
use Illuminate\Auth\Access\HandlesAuthorization;

class WagonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view, update, delete the wagon.
     *
     * @param  \App\User  $user
     * @param  \App\Wagon  $wagon
     * @return mixed
     */
    public function manage(User $user, Wagon $wagon)
    {
        return $user->is($wagon->creator);
    }
}
