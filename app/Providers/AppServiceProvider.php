<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        view()->composer('*', function ($view) {
            if (Session::has('uid')) {
                $sec = DB::table(Session::get('uid') . "_sections")->select("*")->where('id', ">", 1)->get();
                $sec_per = DB::table(Session::get('uid') . "_sections")->select("*")->where('id', "=", Session::get('section_id'))->first();
                view()->share('sections', $sec);
                view()->share('sec_per', $sec_per->name);
            }
        });
    }
}
