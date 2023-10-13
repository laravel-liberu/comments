<?php

use Illuminate\Support\Facades\Route;
use LaravelLiberu\Comments\Http\Controllers\Destroy;
use LaravelLiberu\Comments\Http\Controllers\Index;
use LaravelLiberu\Comments\Http\Controllers\Store;
use LaravelLiberu\Comments\Http\Controllers\Update;
use LaravelLiberu\Comments\Http\Controllers\Users;

Route::middleware(['api', 'auth', 'core'])
    ->prefix('api/core/comments')
    ->as('core.comments.')
    ->group(function () {
        Route::get('', Index::class)->name('index');
        Route::post('', Store::class)->name('store');
        Route::patch('{comment}', Update::class)->name('update');
        Route::delete('{comment}', Destroy::class)->name('destroy');

        Route::get('users', Users::class)->name('users');
    });
