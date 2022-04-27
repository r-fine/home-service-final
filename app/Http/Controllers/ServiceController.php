<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::latest()->paginate(5);
        return view('service.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::whereNotNull('parent_id')->get();
        return view('service.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'pricing' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);


        $service = new Service();
        $service->title = $request->title;
        $service->slug = Str::slug($request->title);
        $service->description = $request->description;
        $service->pricing = $request->pricing;
        $service->category_id = $request->category_id;
        $service->save();

        if ($request->image) {
            $imageName = time() . "." . $request->slug . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/service'), $imageName);
            $service->image = $imageName;
            $service->save();
        }

        return redirect()->route('admin.services.index')->with('success', 'Service added successfully');
    }

    public function edit(Service $service)
    {
        $categories = Category::whereNotNull('parent_id')->get();
        return view('service.edit', compact('categories', 'service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'pricing' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $service->title = $request->title;
        $service->slug = Str::slug($request->title);
        $service->description = $request->description;
        $service->pricing = $request->pricing;
        $service->category_id = $request->category_id;
        $service->save();

        if ($request->image) {
            $imageName = time() . "." . $request->slug . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/service'), $imageName);
            $service->update(['image' => $imageName]);
        }

        return back()->with('success', 'Service updated successfully');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully');
    }
}
