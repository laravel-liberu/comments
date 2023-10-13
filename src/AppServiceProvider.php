<?php

namespace LaravelLiberu\Comments;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->publish();
    }

    private function load()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/comments.php', 'enso.comments');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'liberu.co.ukments');

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/../config' => config_path('enso'),
        ], ['comments-config', 'enso-config']);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/liberu.co.ukments'),
        ], ['comments-mail', 'enso-mail']);

        $this->publishes([
            __DIR__.'/../database/factories' => database_path('factories'),
        ], ['comments-factory', 'enso-factories']);
    }
}
