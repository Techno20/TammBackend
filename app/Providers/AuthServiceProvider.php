<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::before(function($user, $ability) {
            $abilities = ['orders','services','financials','settings','users'];
            if(in_array($ability,$abilities) && auth()->user()->is_admin && isset(auth()->user()->is_admin_permissions->{$ability}) && auth()->user()->is_admin_permissions->{$ability}){
                return true;
            }else {
                return false;
            }
        });


        $this->registerPolicies();

        //
    }
}
