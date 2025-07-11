<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;     


class AuthServiceProvider extends ServiceProvider
{
    /** 
    * The model to policy mappings for the application
    *
    * @/var array<class-string, class-string>
    */
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
    ];
    /**
    * Register any authentication / authorization services.
    */
    
    public function boot(): void
    {
        Gate::define('level', function (User $user){
            return $user->level == 'admin';
        });
    }
    
}

?>