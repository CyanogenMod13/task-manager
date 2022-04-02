<?php

namespace App\Providers;

use App\Models\AssignedUser;
use App\Models\UserPermission;
use App\Models\Project;
use App\Models\User;
use App\Models\UserRole;
use Couchbase\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        foreach (UserPermission::cases() as $permission)
        {
            $this->defineGate($permission);
        }
    }

    private function defineGate(UserPermission $permission)
    {
        Gate::define($permission->name, function (User $user, Project $project) use ($permission) {
            $assignedUser = AssignedUser::where([
                'project_id' => $project->id,
                'user_id' => $user->id
            ])->first();

            return $assignedUser->getRole()->containsPermission($permission);
        });
    }
}
