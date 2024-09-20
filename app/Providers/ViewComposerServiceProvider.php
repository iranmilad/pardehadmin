<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\OrderController;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {

        View::composer('partials.header', function ($view) {

            $setting = Setting::where('group', "general")->first();

            $view->with('setting', $setting);
        });
        View::composer('layouts*', function ($view) {

            $setting = Setting::where('group', "general")->first();

            $view->with('setting', $setting);
        });


    }
}
