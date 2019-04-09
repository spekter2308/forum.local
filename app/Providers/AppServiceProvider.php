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
        /*if(config('database.default') == 'sqlite'){
            $db = app()->make('db');
            $db->connection()->getPdo()->exec("pragma foreign_keys=1");
        }*/

        //View::share('channels', Channel::all());

        View::composer('*', function($view)
        {
            $channels = \Cache::rememberForever('channels', function() {
                return Channel::all();
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

    }
}
