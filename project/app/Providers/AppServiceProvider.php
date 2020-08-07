<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Generalsetting;
use App\Blog;
use App\Sociallink;
use App\Seotool;
use App\Pagesetting;
use App\Language;
use App\Advertise;
use App\Category;
use App\Video;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*',function($settings){
            $settings->with('cats', Category::all());           
            $settings->with('gs', Generalsetting::find(1));
            $settings->with('sl', Sociallink::find(1));
            $settings->with('seo', Seotool::find(1));
            $settings->with('ps', Pagesetting::find(1));
            $settings->with('lang', Language::find(1));
            $settings->with('lvids', Video::where('is_top','=',0)->where('is_slider','=',0)->orderBy('created_at', 'desc')->limit(4)->get());
            $settings->with('ad728x90', Advertise::inRandomOrder()->where('size','728x90')->where('status',1)->first());
            $settings->with('ad300x250', Advertise::inRandomOrder()->where('size','300x250')->where('status',1)->first());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
