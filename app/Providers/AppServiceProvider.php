<?php

namespace App\Providers;

use App\Projectcategory;
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
        // \View::composer('project.index', function ($view) {
        //     $projectcategories = \Cache::rememberForever('projectcategories', function() {
        //         return Projectcategory::all();
        //     });
        //     $view->with('projectcategories', $projectcategories);
        // });
    }
}
