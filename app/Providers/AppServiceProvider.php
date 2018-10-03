<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Property;
use App\Post;
use App\Tag;
use App\Category;

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


        // SHARE WITH SPECIFIC VIEW
        view()->composer('frontend.partials.footer', function($view) {
            $view->with('footerproperties', Property::latest()->take(2)->get());
        });

        view()->composer('pages.blog.index', function($view) {
            $view->with('archives', Post::archives());
            $view->with('categories', Category::all());
            $view->with('tags', Tag::all());
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
