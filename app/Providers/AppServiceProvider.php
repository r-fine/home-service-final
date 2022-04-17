<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        $categories = Category::all();
        $item_count = 0;

        if (Auth::check()) {
            $item_count = OrderItem::where([
                ['user_id', Auth::user()->id],
                ['is_ordered', 0]
            ])->count();
        }


        view()->share(compact('categories', 'item_count'));

        Paginator::useBootstrapFive();
    }
}
