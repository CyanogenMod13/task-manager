<?php

namespace App\Providers;

use App\Models\AssignedUser;
use App\Models\Project;
use App\Models\User;
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

        Gate::define('configure-project', function (User $user, int $project_id) {
            $assignedUser = AssignedUser::where(['user_id' => $user->id, 'project_id' => $project_id])->first();
            return $assignedUser->isAdmin();
        });
    }
}
