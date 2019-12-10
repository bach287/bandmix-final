<?php

namespace App\Providers;

use App\Entities\Slide;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $slides = Slide::all();
        View::composer('*', function ($view) use ($slides){
            $view->with('g_slides', $slides);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }


}
