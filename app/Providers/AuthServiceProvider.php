<?php

namespace App\Providers;

use App\Post;
use App\Profile;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('follow-profile',function(User $user, Profile $profile){
            return $user->id != $profile->user_id;
        });

        Gate::define('edit-post',function(User $user, Post $post){
            return $user->id === $post->user_id;
        });
    }
}
