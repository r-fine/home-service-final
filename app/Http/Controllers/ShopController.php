<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\ReviewRating;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $services = Service::latest()->simplePaginate(8);
        return view('shop.index', compact('services'));
    }

    public function showService(Service $service)
    {
        $title = $service->title;
        $my_review = null;

        if (Auth::check()) {
            $my_review = ReviewRating::where([
                ['user_id', Auth::user()->id],
                ['service_id', $service->id],
            ])->first();
        }

        if (Auth::check()) {
            $all_reviews = ReviewRating::where([
                ['service_id', $service->id],
                ['user_id', '!=', Auth::user()->id]
            ])->get();
        } else {
            $all_reviews = ReviewRating::where('service_id', $service->id)->get();
        }

        $reviewable = null;
        if (Auth::check()) {
            $reviewable = OrderItem::where([
                ['user_id', Auth::user()->id],
                ['service_id', $service->id],
                ['is_ordered', true],
                ['is_reviewable', true],
            ])->exists();;
        }

        return view('shop.show_service', compact('title', 'service', 'my_review', 'all_reviews', 'reviewable'));
    }

    // Show list of services under a specific category
    public function categoryList(Category $category)
    {
        $title = $category->title;
        $services = Service::where('category_id', $category->id)->simplePaginate(4);
        return view('shop.category_list', compact('title', 'category', 'services'));
    }
}
