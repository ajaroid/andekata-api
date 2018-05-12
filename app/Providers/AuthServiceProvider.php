<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use App\Modules\Core\Models\Privilege;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (Schema::hasTable('privileges')) {

            $privileges = Cache::remember('privileges', 120, function () {
                return Privilege::all();
            });

            foreach ($privileges as $privilege) {

                Gate::define($privilege->name, function ($user) use($privilege) {

                    if ($user->isSuperAdmin()) return true;

                    $access = false;

                    foreach ($user->groups as $group) {

                        foreach ($group->privileges as $userPrivilege) {

                            if ($privilege->name === $userPrivilege->name) $access = true;
                        }

                    }

                    return $access;

                });
            }

        }
    }
}
