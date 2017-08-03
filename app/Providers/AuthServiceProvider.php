<?php

namespace App\Providers;

use App\DiscussionForumDetails;
use App\DiscussionForumTopic;
use App\Policies\TopicDetailsPolicy;
use App\Policies\TopicPolicy;
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
        DiscussionForumTopic::class => TopicPolicy::class,
        DiscussionForumDetails::class => TopicDetailsPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
