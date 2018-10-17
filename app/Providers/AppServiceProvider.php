<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Property;
use App\Post;
use App\Tag;
use App\Category;
use App\Setting;

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

        $cities   = Property::select('city')->distinct()->get();
        $citylist = array();
        foreach($cities as $city){
            $citylist[$city['city']] = NULL;
        }
        view()->share('citylist', $citylist);


        // SHARE WITH SPECIFIC VIEW
        view()->composer('pages.search', function($view) {
            $view->with('bathroomdistinct', Property::select('bathroom')->distinct()->get());
        });

        view()->composer('frontend.partials.footer', function($view) {
            $view->with('footerproperties', Property::latest()->take(3)->get());
            $view->with('footersettings', Setting::select('footer','aboutus','facebook','twitter','linkedin')->get());
        });

        view()->composer('frontend.partials.navbar', function($view) {
            $view->with('navbarsettings', Setting::select('name')->get());
        });

        view()->composer('pages.contact', function($view) {
            $view->with('contactsettings', Setting::select('phone','email','address')->get());
        });

        view()->composer('pages.blog.sidebar', function($view) {

            $archives   = Post::archives();
            $categories = Category::has('posts')->withCount('posts')->get();
            $tags       = Tag::has('posts')->get();

            $view->with(compact('archives','categories','tags'));
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
