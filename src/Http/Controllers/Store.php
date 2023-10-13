<?php

namespace LaravelLiberu\Comments\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\Comments\Http\Requests\ValidateCommentStore;
use LaravelLiberu\Comments\Http\Resources;
use LaravelLiberu\Comments\Models\Comment;

class Store extends Controller
{
    public function __invoke(ValidateCommentStore $request, Comment $comment)
    {
        $comment->fill($request->validatedExcept('taggedUsers', 'path'));

        tap($comment)->save()
            ->syncTags($request->get('taggedUsers'))
            ->notify($request->get('path'));

        return new Resources\Comment($comment->load([
            'createdBy.person', 'createdBy.avatar', 'taggedUsers.person',
        ]));
    }
}
