<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MenuGuest;
use App\Models\FooterPage;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\View;

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
        View::composer(['front.*'],function($view){
            $menus = MenuGuest::with('category')->where('is_active',1)->orderBy('menu_order','ASC')->get();
            $footer = FooterPage::where('is_active',1)->orderBy('menu_order','ASC')->get();
            
            $social_media = SocialMedia::all();
            $args = ['menus' => $menus,'social_media' => $social_media,'footer' => $footer];
            $view->with($args);
        });
    }
}
