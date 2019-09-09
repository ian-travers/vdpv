<?php

namespace App\Policies;

use App\User;
use App\Wagon;
use Illuminate\Auth\Access\HandlesAuthorization;

class WagonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view, update, delete any wagon.
     *
     * @param  \App\User  $user
     * @param  \App\Wagon  $wagon
     * @return mixed
     */
    public function manage(User $user, Wagon $wagon)
    {

        return $wagon->isLocal()
            ? $user->isAdmin() || $user->isStationAdmin() || $user->isWagonsManager() || $user->isLocalWagonsManager()
            : $user->isAdmin() || $user->isStationAdmin() || $user->isWagonsManager();

    }
}
