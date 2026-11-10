<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyCategory;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class PropertyCategoryController extends Controller
{
    public function index()
    {
        $categories = PropertyCategory::latest()
            ->paginate(15);

        return view(
            'admin.categories.index',
            compact('categories')
        );
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:property_categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);

        $validated['slug'] = $validated['slug']
            ?? Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('categories', 'public');
        }

        PropertyCategory::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Property category created successfully.'
            );
    }

    public function show(PropertyCategory $category)
    {
        $category->load('properties');

        return view(
            'admin.categories.show',
            compact('category')
        );
    }

    public function edit(PropertyCategory $category)
    {
        return view(
            'admin.categories.edit',
            compact('category')
        );
    }

    public function update(
        Request $request,
        PropertyCategory $category
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:property_categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|boolean',
        ]);

        $validated['slug'] = $validated['slug']
            ?? Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Property category updated successfully.'
            );
    }

    public function destroy(PropertyCategory $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Property category deleted successfully.'
            );
    }
}
