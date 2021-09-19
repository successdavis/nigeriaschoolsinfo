<?php

namespace App\Providers;

use App\Projectcategory;
use App\Programme;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer(['*'], function ($view) {
            $programmes = \Cache::rememberForever('programme', function() {
                return Programme::all();
            });
            $view->with('programme', $programmes);
        });
        // \View::composer('project.index', function ($view) {
        //     $projectcategories = \Cache::rememberForever('projectcategories', function() {
        //         return Projectcategory::all();
        //     });
        //     $view->with('projectcategories', $projectcategories);
        // });
    }
}
