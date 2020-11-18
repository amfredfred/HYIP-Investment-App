<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use App\Models\Admin\Setting;
use Illuminate\Support\Facades\View;
use App\social;
use App\HomePageText;
use Illuminate\Support\Facades\Cookie;
class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);
        date_default_timezone_set('Africa/Lagos');
        $setting = Setting::whereId(1)->first();
        View::share('settings', $setting);
        $socials = social::whereStatus(true)->orderBy('created_at', 'desc')->get();
        View::share('socials', $socials);
        $homepage = HomePageText::whereId(1)->first();
        View::share('homepage', $homepage);
		  if (!empty(Cookie::get('white'))) {
           $color = 'white';
           
            View::share('color', $color);
        }
        if (!empty(Cookie::get('dark'))) {
            $color = 'dark';
           
            View::share('color', $color);
        }
		else {
		$color = 'white';
		 View::share('color', $color);
		}
    }

}
