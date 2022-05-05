<?php

namespace App\Providers;

use App\Models\AssignedUser;
use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use App\Policies\ProjectPolicy;
use App\Repository\AssignedUserRepository;
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

        Gate::define('configure-project', [ProjectPolicy::class, 'configure']);
        Gate::define('delete-comment', function (Comment $comment, User $user) {
            return $comment->user_id === $user->id;
        });
    }
}
