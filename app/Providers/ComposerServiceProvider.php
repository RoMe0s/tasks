<?php

namespace App\Providers;

use App\Http\ViewComposers\UserComposer;
use App\Http\ViewComposers\ProjectComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', UserComposer::class);
        View::composer('project.list', ProjectComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
