<?php

namespace App\Providers;

use App\Entity\User;
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
        $this->registerPermissions();
        //
    }

    public function registerPermissions()
    {
        Gate::define('admin-panel', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });

        Gate::define('manage-pages', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });

        Gate::define('manage-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-settings', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-menu', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-templates', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-widgets', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-category', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-tags', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-posts', function (User $user) {
            return $user->isAdmin() || $user->isModerator();
        });
    }
}
