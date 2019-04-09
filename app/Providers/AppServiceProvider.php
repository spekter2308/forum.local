<?php

namespace App\Providers;

use App\Channel;
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
        //View::share('channels', Channel::all());
        //Для homestead не працює кешування
        /*\View::composer('*', function ($view) {
            $channels = \Cache::rememberForever('channels', function () {
                return Channel::get();
            });
            $view->with('channels', $channels);
        });*/
        View::composer('*', function ($view) {
            $channels = \Session('channels', function () {
                return Channel::get();
            });
            $view->with('channels', $channels);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
