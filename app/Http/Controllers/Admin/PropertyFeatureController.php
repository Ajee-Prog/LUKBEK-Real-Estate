<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyFeatureController extends Controller
{
    public function index()
    {
        $features = PropertyFeature::latest()
            ->paginate(20);

        return view(
            'admin.features.index',
            compact('features')
        );
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:property_features,slug',
        ]);

        $validated['slug'] = $validated['slug']
            ?? Str::slug($validated['name']);

        PropertyFeature::create($validated);

        return redirect()
            ->route('admin.features.index')
            ->with(
                'success',
                'Property feature created successfully.'
            );
    }

    public function show(PropertyFeature $feature)
    {
        return view(
            'admin.features.show',
            compact('feature')
        );
    }

    public function edit(PropertyFeature $feature)
    {
        return view(
            'admin.features.edit',
            compact('feature')
        );
    }

    public function update(
        Request $request,
        PropertyFeature $feature
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:property_features,slug,' . $feature->id,
        ]);

        $validated['slug'] = $validated['slug']
            ?? Str::slug($validated['name']);

        $feature->update($validated);

        return redirect()
            ->route('admin.features.index')
            ->with(
                'success',
                'Property feature updated successfully.'
            );
    }

    public function destroy(PropertyFeature $feature)
    {
        $feature->delete();

        return redirect()
            ->route('admin.features.index')
            ->with(
                'success',
                'Property feature deleted successfully.'
            );
    }
}
