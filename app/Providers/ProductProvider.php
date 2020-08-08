<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Category;
use App\Brand;
use App\Product;

class ProductProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        View::composer(['admin.product.add-product', 'admin.product.edit-product'], function ($view) {
            $view->categories = Category::where('publication_status', 1)->orderBy('category_name')->get();
        });

        View::composer(['admin.product.add-product', 'admin.product.edit-product'], function ($view) {
            $view->brands = Brand::where('publication_status', 1)->orderBy('brand_name')->get();
        });

        View::composer(['admin.product.manage-product'], function ($view) {
            $view->products = Product::all();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
