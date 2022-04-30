<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'nullable',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        // Category::create($request->all());
        $category = new Category();
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->save();

        if ($request->image) {
            $imageName = time() . "." . $request->slug . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/category'), $imageName);
            $category->image = $imageName;
            $category->save();
        }

        return back()->with('success', 'Category added successfully');
    }

    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('category.edit', compact('categories', 'category'));
    }

    public function update(Request $request, Category $category)
    {
        // $imageName = $category->title;
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->save();

        if ($request->image) {
            $imageName = time() . "." . $request->slug . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/category'), $imageName);
            $category->update(['image' => $imageName]);
        }

        return back()->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
