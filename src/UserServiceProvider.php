<?php

namespace LaravelLiberu\Comments;

use Illuminate\Support\ServiceProvider;
use LaravelLiberu\Comments\DynamicRelations\Comments;
use LaravelLiberu\Comments\DynamicRelations\CommentTags;
use LaravelLiberu\DynamicMethods\Services\Methods;
use LaravelLiberu\Users\Models\User;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Methods::bind(User::class, [Comments::class, CommentTags::class]);
    }
}
