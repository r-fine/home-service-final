<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProviderProfile;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function sProvider()
    {
        if (Auth::user()->is_verified == 1) {
            $upcoming = OrderItem::where([
                ['provider_id', Auth::user()->providerProfile->id],
                ['status', 'Accepted'],
            ])->count();
            $ongoing = OrderItem::where([
                ['provider_id', Auth::user()->providerProfile->id],
                ['status', 'Preparing'],
            ])->count();
            $completed = OrderItem::where([
                ['provider_id', Auth::user()->providerProfile->id],
                ['status', 'Completed'],
            ])->count();
            return view('s_provider.s_provider_homepage', compact('upcoming', 'ongoing', 'completed'));
        } else {
            $categories = Category::whereNull('parent_id')->get();
            if (!Auth::user()->providerProfile) {
                return view('s_provider.create_profile', compact('categories'));
            } else {
                $profile = ProviderProfile::where('user_id', Auth::user()->id)->first();
                return view('s_provider.account_inactive', compact('categories', 'profile'));
            }
        }
    }

    public function admin()
    {
        $order_count = OrderItem::count();
        $order_completed = OrderItem::where('status', 'Completed')->count();
        $order_pending = OrderItem::where('status', 'Pending')->count();
        $service_count = Service::count();
        $provider_count = User::whereRoleIs('s_provider')->count();
        $unverified_providers = User::whereRoleIs('s_provider')->where('is_verified', 0)->count();

        return view('admin.admin_homepage', compact('order_count', 'order_completed', 'order_pending', 'service_count', 'provider_count', 'unverified_providers'));
    }
}
