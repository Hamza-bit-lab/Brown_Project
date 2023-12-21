<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Support\Facades\View;
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
        $categories = Category::all();
        View::share('categories' , $categories);
        $sizes = Size::all();
        View::share('sizes', $sizes);
        $colors = Color::all();
        View::share('colors', $colors);
        $brands = Brand::all();
        View::share('brands', $brands);
        $coupons = Coupon::all();
        View::share('coupons', $coupons);
        $customers = Customer::all();
        View::share('customers', $customers);
        $products = Product::all();
        View::share('products', $products);
    }
}
