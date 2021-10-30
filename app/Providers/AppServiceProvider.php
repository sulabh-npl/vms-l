<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use stdClass;

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
                if (DB::table('vendors')->where('id', Session::get('uid'))) {
                    // Session::forget('uid');
                    $sec = DB::table(Session::get('uid') . "_sections")->select("*")->where('id', ">", 1)->get();
                    $sec_per = DB::table(Session::get('uid') . "_sections")->select("*")->where('id', "=", Session::get('section_id'))->first();
                    $sec_new = array();
                    foreach ($sec as $s) {
                        $s = (array)$s;
                        // SELECT * FROM
                        // table-name WHERE your date-column >= '2013-12-12'
                        // dd();
                        $s['tV'] = DB::table(Session::get('uid') . '_visitors')->where('section_name', "=", $s['name'])->where('date', ">=", date("Y-n-j"))->count();
                        $s = (object)$s;
                        array_push($sec_new, $s);
                        // dd($s);
                    }
                    view()->share('sections', $sec_new);
                    view()->share('sec_per', $sec_per->name);
                    redirect('/');
                }
            }
        });
    }
}
