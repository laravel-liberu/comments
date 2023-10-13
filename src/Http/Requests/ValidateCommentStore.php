<?php

namespace LaravelLiberu\Comments\Http\Requests;

use LaravelLiberu\Helpers\Traits\FiltersRequest;

class ValidateCommentStore extends ValidateCommentFetch
{
    use FiltersRequest;

    public function rules()
    {
        return parent::rules() + [
            'body' => 'required',
            'path' => 'required',
            'taggedUsers' => 'array',
        ];
    }
}
