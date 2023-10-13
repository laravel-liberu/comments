<?php

namespace LaravelLiberu\Comments;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelLiberu\Comments\Models\Comment;
use LaravelLiberu\Comments\Policies\Comment as Policy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Comment::class => Policy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
