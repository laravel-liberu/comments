<?php

namespace LaravelLiberu\Comments\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelLiberu\Comments\Models\Comment;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'commentable_id' => $this->faker->randomKey,
            'commentable_type' => $this->faker->word,
            'body' => $this->faker->sentence,
        ];
    }
}
