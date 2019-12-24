<?php

namespace App\Providers;

use App\SchoolType;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer(['*'], function ($view) {
            $schooltype = \Cache::rememberForever('schooltype', function() {
                return SchoolType::all();
            });
            $view->with('schooltype', $schooltype);
        });
    }
}
