<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Property;

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

        // SHARE TO ALL ROUTES
        $bedroomdistinct  = Property::select('bedroom')->distinct()->get();
        view()->share('bedroomdistinct', $bedroomdistinct);

        $properties  = Property::latest()->take(2)->get();
        view()->share('footerproperties', $properties);
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
