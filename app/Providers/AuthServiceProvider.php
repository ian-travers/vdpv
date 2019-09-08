<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Wagon' => 'App\Policies\WagonPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-wagons', function (User $user) {
            return $user->isLocalWagonsManager() || $user->isWagonsManager() || $user->isStationAdmin() || $user->isAdmin();
        });

        Gate::define('manage-station', function (User $user) {
            return $user->isStationAdmin() || $user->isAdmin();
        });
    }
}
