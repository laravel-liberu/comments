<?php

namespace LaravelLiberu\Comments\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use LaravelLiberu\Comments\Http\Requests\ValidateCommentFetch;
use LaravelLiberu\Comments\Http\Resources\Comment as Resource;
use LaravelLiberu\Comments\Models\Comment;

class Index extends Controller
{
    public function __invoke(ValidateCommentFetch $request)
    {
        $comments = Comment::latest()->for($request->validated())
            ->with('createdBy.person', 'createdBy.avatar', 'updatedBy', 'taggedUsers')
            ->get();

        return Resource::collection($comments)->additional([
            'humanReadableDates' => Config::get('enso.comments.humanReadableDates'),
        ]);
    }
}
