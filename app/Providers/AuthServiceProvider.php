<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


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
        $this->registerPolicies();

        // return true;
        Gate::define('show_admin', function (User $users) {
            foreach($users->roles as $role){     
                if($role->role_name == 'admin'){
                    return true;
                } 

            }
            return false;
        });
        Gate::define('show_manager_main', function (User $users) {
            foreach($users->roles as $role){     
                if($role->role_name == 'manager_main'){
                    return true;
                }  
            }
            return false;
        });
    }
}
