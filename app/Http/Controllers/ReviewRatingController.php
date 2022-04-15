<?php

namespace App\Http\Controllers;

use App\Models\ReviewRating;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewRatingController extends Controller
{

    public function store(Request $request, Service $service)
    {
        $request->validate([
            'rating' =>  'required|digits:1',
            'title' => 'required',
            'description' => 'nullable',
        ]);

        ReviewRating::create([
            'user_id' => Auth::user()->id,
            'service_id' => $service->id,
            'rating' =>  $request->rating,
            'title' => $request->title,
            'description' => $request->description
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted');
    }

    public function destroy(ReviewRating $reviewRating)
    {
        $reviewRating->delete();
        return back()->with('success', 'Review deleted');
    }
}
