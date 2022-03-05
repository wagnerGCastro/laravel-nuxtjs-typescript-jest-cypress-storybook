<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use App\Models\User;
use App\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Post' => 'App\Policies\PostPolicy',
        \App\Models\Post::class => \App\Policies\PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $permissions = Permission::with('roles')->get();

        foreach( $permissions as $permission ):
            $gate->define($permission->name, function(User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        endforeach;

        $gate->before(function(User $user, $ability) {
            if($user->hasAnyRoles('admin')) {
                return true;
            }
        });
    }
}
