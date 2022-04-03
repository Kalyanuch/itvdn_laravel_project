<?php

namespace App\Providers;

use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use App\Product;
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
        User::class => UserPolicy::class,
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('can-destroy', function(User $user) {
            return $user->is_admin;
        });

        Gate::define('can-restore', function(User $user) {
            return $user->is_admin;
        });
    }
}
