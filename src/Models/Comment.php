<?php

namespace LaravelLiberu\Comments\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use LaravelLiberu\Comments\Notifications\CommentTagNotification;
use LaravelLiberu\Helpers\Traits\UpdatesOnTouch;
use LaravelLiberu\TrackWho\Traits\CreatedBy;
use LaravelLiberu\TrackWho\Traits\UpdatedBy;
use LaravelLiberu\Users\Models\User;

class Comment extends Model
{
    use CreatedBy, HasFactory, UpdatedBy, UpdatesOnTouch;

    protected $guarded = ['id'];

    protected $touches = ['commentable'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function taggedUsers()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeFor(Builder $query, array $params): Builder
    {
        return $query->whereCommentableId($params['commentable_id'])
            ->whereCommentableType($params['commentable_type']);
    }

    public function syncTags(array $taggedUsers)
    {
        $this->taggedUsers()->sync(
            Collection::wrap($taggedUsers)->pluck('id')
        );

        return $this;
    }

    public function notify(string $path)
    {
        $this->taggedUsers->each
            ->notify((new CommentTagNotification($this->body, $path))
                ->onQueue('notifications'));
    }

    public function getLoggableMorph()
    {
        return config('enso.comments.loggableMorph');
    }
}
