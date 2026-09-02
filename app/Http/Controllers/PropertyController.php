<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()->get();

        return view('properties.index', compact('properties'));
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('properties.show', compact('property'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'location' => 'required',
            'image' => 'required|image'
        ]);

        $image = $request->file('image')->store('properties', 'public');

        Property::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'type' => $request->type,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'image' => $image
        ]);

        return redirect()->back()->with('success', 'Property Added');
    }
}
