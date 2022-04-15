<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\ProviderProfile;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderProfileController extends Controller
{
    public function index()
    {
        $providers = ProviderProfile::latest()->paginate(10);
        return view('s_provider.index', compact('providers'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('s_provider.create_profile', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|digits:11|unique:provider_profiles,phone',
            'profile_pic' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'address_line' => 'required',
            'address_line_2' => 'nullable',
        ]);

        $imageName = time() . "." . $request->profile_pic->getClientOriginalExtension();
        $request->profile_pic->move(public_path('images/s_provider'), $imageName);

        $profile = new ProviderProfile();
        $profile->user_id = Auth::user()->id;
        $profile->category_id = $request->category_id;
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->phone = $request->phone;
        $profile->profile_pic = $imageName;
        $profile->address_line = $request->address_line;
        $profile->address_line_2 = $request->address_line_2;

        if (!Auth::user()->providerProfile) {
            $profile->save();
            return back()->with('success', 'Profile created successfully');
        } else {
            return back()->with('success', 'A profile is already associated with this account');
        }
    }

    public function edit(ProviderProfile $profile)
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('s_provider.edit_profile', compact('profile', 'categories'));
    }

    public function update(Request $request, ProviderProfile $profile)
    {
        $request->validate([
            'category_id' => 'nullable',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => [
                'required',
                'digits:11',
                Rule::unique('provider_profiles')->ignore($profile),
            ],
            'profile_pic' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'address_line' => 'required',
            'address_line_2' => 'nullable',
        ]);

        $profile->category_id = $request->category_id;
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->phone = $request->phone;
        $profile->address_line = $request->address_line;
        $profile->address_line_2 = $request->address_line_2;
        $profile->save();

        if ($request->profile_pic) {
            $imageName = time() . "." . $request->profile_pic->getClientOriginalExtension();
            $request->profile_pic->move(public_path('images/s_provider'), $imageName);
            $profile->update(['profile_pic' => $imageName]);
        }

        return back()->with('success', 'Profile updated successfully');
    }

    public function destroy(ProviderProfile $profile)
    {
        $profile->delete();
        return redirect()->route('s_provider.create_profile')->with('success', 'Profile deleted successfully');
    }

    public function assignedTaskList()
    {
        $tasks = OrderItem::where('provider_id', Auth::user()->providerProfile->id)->get();
        return view('s_provider.tasks', compact('tasks'));
    }
}
