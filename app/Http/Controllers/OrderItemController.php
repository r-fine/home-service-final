<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\ProviderProfile;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    public function addToOrder(Request $request, Service $service)
    {
        $order_item = OrderItem::where([
            ['user_id', Auth::user()->id],
            ['service_id', $service->id],
            ['is_ordered', 0]
        ])->first();

        if (!$order_item) {
            OrderItem::create([
                'user_id' => Auth::user()->id,
                'service_id' => $service->id,
            ]);
            return back()->with('success', 'Added to order list');
        } else {
            return back()->with('success', 'Already added to order list');
        }
    }

    public function removeFromOrder(OrderItem $order_item)
    {
        $order_item->delete();
        return back()->with('success', 'Removed from list');
    }

    public function orderCancel(OrderItem $item)
    {
        if ($item->status == 'Preparing') {
            return back()->with('success', 'You cannot cancel this order. Its already on progress');
        } else {
            $item->status = 'Cancelled';
            $item->update();
            return back()->with('success', 'This order has been cancelled');
        }
    }

    public function orderStatusAccepted(OrderItem $item)
    {
        $item->status = 'Accepted';
        $item->update();
        return back();
    }

    public function orderStatusPreparing(OrderItem $item)
    {
        $item->status = 'Preparing';
        $item->update();
        return back();
    }

    public function orderStatusCompleted(OrderItem $item)
    {
        $item->status = 'Completed';
        $item->is_reviewable = true;
        $item->update();
        return back();
    }

    public function edit(OrderItem $item)
    {
        $providers = ProviderProfile::where('category_id', $item->service->category->parent->id)
            ->whereIn('user_id', User::where('is_verified', 1)->get('id'))
            ->get();
        return view('order_item.edit', compact('item', 'providers'));
    }

    public function assignProvider(Request $request, OrderItem $item)
    {
        $request->validate([
            'provider_id' => 'required'
        ]);

        $item->update($request->all());

        return back()->with('success', 'Provider assigned successfully');
    }
}
