<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Iniciam as configurações necessárias para o uso do sdk
        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

        $categories = Category::all(['name', 'slug']);
        view()->share('categoriesMenu', $categories);

        $stores = Store::all(['name', 'slug']);
        view()->share('storesMenu', $stores);

        // view()->composer('*', function($view) use($categories) {
        //     $view->with('categories', $categories);
        // });
    }
}
