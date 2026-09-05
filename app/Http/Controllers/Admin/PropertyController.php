<?php

/*namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyFeature;
use App\Models\User;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with([
            'images',
            'category',
            'agent'
        ]);


        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'reference_no',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'location',
                    'like',
                    "%{$search}%"
                );

            });

        }


        $properties = $query
            ->latest()
            ->paginate(15);
            //->withQueryString();


        return view(
            'admin.properties.index',
            compact('properties')
        );
    }


    public function create()
    {
        $categories =
            PropertyCategory::where(
                'status',
                true
            )->get();


        $features =
            PropertyFeature::where(
                'status',
                true
            )->get();


        $agents =
            User::where(
                'role',
                'agent'
            )->get();


        return view(
            'admin.properties.create',
            compact(
                'categories',
                'features',
                'agents'
            )
        );
    }


    public function show(Property $property)
    {
        $property->load([
            'images',
            'category',
            'features',
            'agent',
            'bookings',
            'leads'
        ]);


        return view(
            'admin.properties.show',
            compact('property')
        );
    }
} */

    namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with([
            'images',
            'category',
            'agent'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'reference_no',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'location',
                    'like',
                    "%{$search}%"
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Listing type filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('listing_type')) {

            $query->where(
                'listing_type',
                $request->listing_type
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Status filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Category filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category_id')) {

            $query->where(
                'category_id',
                $request->category_id
            );
        }


        $properties = $query
            ->latest()
            ->paginate(15);
            // ->withQueryString();


        $categories = PropertyCategory::orderBy(
            'name'
        )->get();


        return view(
            'admin.properties.index',
            compact(
                'properties',
                'categories'
            )
        );
    }


    public function create()
    {
        $categories = PropertyCategory::where(
            'status',
            true
        )
        ->orderBy('name')
        ->get();


        $features = PropertyFeature::where(
            'status',
            true
        )
        ->orderBy('name')
        ->get();


        $agents = User::where(
            'role',
            'agent'
        )
        ->orderBy('name')
        ->get();


        return view(
            'admin.properties.create',
            compact(
                'categories',
                'features',
                'agents'
            )
        );
    }


    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate property
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'category_id' => [
                'required',
                'exists:property_categories,id'
            ],

            'listing_type' => [
                'required',
                'in:sale,rent,lease'
            ],

            'price' => [
                'required',
                'numeric',
                'min:0'
            ],

            'currency' => [
                'required',
                'string',
                'max:10'
            ],

            'location' => [
                'required',
                'string',
                'max:255'
            ],

            'address' => [
                'nullable',
                'string'
            ],

            'bedrooms' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'bathrooms' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'toilets' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'parking_spaces' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'property_size' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'land_size' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'size_unit' => [
                'required',
                'string',
                'max:20'
            ],

            'year_built' => [
                'nullable',
                'integer',
                'min:1800',
                'max:' . date('Y')
            ],

            'furnished' => [
                'nullable',
                'in:furnished,semi-furnished,unfurnished'
            ],

            'status' => [
                'required',
                'in:available,sold,rented,reserved'
            ],

            'video_url' => [
                'nullable',
                'url'
            ],

            'floor_plan' => [
                'nullable',
                'image',
                'max:5120'
            ],

            'latitude' => [
                'nullable',
                'numeric'
            ],

            'longitude' => [
                'nullable',
                'numeric'
            ],

            'agent_id' => [
                'nullable',
                'exists:users,id'
            ],

            'seo_title' => [
                'nullable',
                'string',
                'max:255'
            ],

            'seo_description' => [
                'nullable',
                'string'
            ],

            'features' => [
                'nullable',
                'array'
            ],

            'features.*' => [
                'exists:property_features,id'
            ],

            'images' => [
                'nullable',
                'array',
                'max:20'
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'featured' => [
                'nullable',
                'boolean'
            ],

            'verified' => [
                'nullable',
                'boolean'
            ],

        ]);


        DB::transaction(function () use (
            $request,
            $validated
        ) {

            /*
            |--------------------------------------------------------------------------
            | Create property
            |--------------------------------------------------------------------------
            */

            $property = Property::create([

                'title' =>
                    $validated['title'],

                'slug' =>
                    Str::slug(
                        $validated['title']
                    ) . '-' .
                    Str::lower(
                        Str::random(5)
                    ),

                'description' =>
                    $validated['description']
                    ?? null,

                'category_id' =>
                    $validated['category_id'],

                'listing_type' =>
                    $validated['listing_type'],

                'price' =>
                    $validated['price'],

                'currency' =>
                    $validated['currency'],

                'location' =>
                    $validated['location'],

                'address' =>
                    $validated['address']
                    ?? null,

                'bedrooms' =>
                    $validated['bedrooms']
                    ?? null,

                'bathrooms' =>
                    $validated['bathrooms']
                    ?? null,

                'toilets' =>
                    $validated['toilets']
                    ?? null,

                'parking_spaces' =>
                    $validated['parking_spaces']
                    ?? null,

                'property_size' =>
                    $validated['property_size']
                    ?? null,

                'land_size' =>
                    $validated['land_size']
                    ?? null,

                'size_unit' =>
                    $validated['size_unit'],

                'year_built' =>
                    $validated['year_built']
                    ?? null,

                'furnished' =>
                    $validated['furnished']
                    ?? null,

                'featured' =>
                    $request->boolean(
                        'featured'
                    ),

                'verified' =>
                    $request->boolean(
                        'verified'
                    ),

                'status' =>
                    $validated['status'],

                'video_url' =>
                    $validated['video_url']
                    ?? null,

                'latitude' =>
                    $validated['latitude']
                    ?? null,

                'longitude' =>
                    $validated['longitude']
                    ?? null,

                'agent_id' =>
                    $validated['agent_id']
                    ?? null,

                'seo_title' =>
                    $validated['seo_title']
                    ?? null,

                'seo_description' =>
                    $validated['seo_description']
                    ?? null,

            ]);


            /*
            |--------------------------------------------------------------------------
            | Features
            |--------------------------------------------------------------------------
            */

            $property->features()->sync(
                $validated['features']
                ?? []
            );


            /*
            |--------------------------------------------------------------------------
            | Floor plan
            |--------------------------------------------------------------------------
            */

            if (
                $request->hasFile(
                    'floor_plan'
                )
            ) {

                $path =
                    $request->file(
                        'floor_plan'
                    )->store(
                        'properties/floor-plans',
                        'public'
                    );


                $property->update([
                    'floor_plan' => $path
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Property images
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('images')) {

                foreach (
                    $request->file('images')
                    as $index => $image
                ) {

                    $path = $image->store(
                        'properties',
                        'public'
                    );


                    PropertyImage::create([

                        'property_id' =>
                            $property->id,

                        'image' =>
                            $path,

                        'is_primary' =>
                            $index === 0,

                        'sort_order' =>
                            $index,

                    ]);
                }
            }

        });


        return redirect()
            ->route(
                'admin.properties.index'
            )
            ->with(
                'success',
                'Property created successfully.'
            );
    }


    public function show(Property $property)
    {
        $property->load([
            'images',
            'category',
            'features',
            'agent',
            'bookings',
            'leads'
        ]);


        return view(
            'admin.properties.show',
            compact('property')
        );
    }


    public function edit(Property $property)
    {
        $property->load([
            'images',
            'features'
        ]);


        $categories = PropertyCategory::where(
            'status',
            true
        )
        ->orderBy('name')
        ->get();


        $features = PropertyFeature::where(
            'status',
            true
        )
        ->orderBy('name')
        ->get();


        $agents = User::where(
            'role',
            'agent'
        )
        ->orderBy('name')
        ->get();


        return view(
            'admin.properties.edit',
            compact(
                'property',
                'categories',
                'features',
                'agents'
            )
        );
    }


    public function update(
        Request $request,
        Property $property
    ) {

        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'category_id' => [
                'required',
                'exists:property_categories,id'
            ],

            'listing_type' => [
                'required',
                'in:sale,rent,lease'
            ],

            'price' => [
                'required',
                'numeric',
                'min:0'
            ],

            'currency' => [
                'required',
                'string',
                'max:10'
            ],

            'location' => [
                'required',
                'string',
                'max:255'
            ],

            'address' => [
                'nullable',
                'string'
            ],

            'bedrooms' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'bathrooms' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'toilets' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'parking_spaces' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'property_size' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'land_size' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'size_unit' => [
                'required',
                'string',
                'max:20'
            ],

            'year_built' => [
                'nullable',
                'integer',
                'min:1800',
                'max:' . date('Y')
            ],

            'furnished' => [
                'nullable',
                'in:furnished,semi-furnished,unfurnished'
            ],

            'status' => [
                'required',
                'in:available,sold,rented,reserved'
            ],

            'video_url' => [
                'nullable',
                'url'
            ],

            'floor_plan' => [
                'nullable',
                'image',
                'max:5120'
            ],

            'latitude' => [
                'nullable',
                'numeric'
            ],

            'longitude' => [
                'nullable',
                'numeric'
            ],

            'agent_id' => [
                'nullable',
                'exists:users,id'
            ],

            'seo_title' => [
                'nullable',
                'string',
                'max:255'
            ],

            'seo_description' => [
                'nullable',
                'string'
            ],

            'features' => [
                'nullable',
                'array'
            ],

            'features.*' => [
                'exists:property_features,id'
            ],

            'images' => [
                'nullable',
                'array',
                'max:20'
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'floor_plan' => [
                'nullable',
                'image',
                'max:5120'
            ],

        ]);


        DB::transaction(function () use (
            $request,
            $validated,
            $property
        ) {

            $property->update([

                'title' =>
                    $validated['title'],

                'description' =>
                    $validated['description']
                    ?? null,

                'category_id' =>
                    $validated['category_id'],

                'listing_type' =>
                    $validated['listing_type'],

                'price' =>
                    $validated['price'],

                'currency' =>
                    $validated['currency'],

                'location' =>
                    $validated['location'],

                'address' =>
                    $validated['address']
                    ?? null,

                'bedrooms' =>
                    $validated['bedrooms']
                    ?? null,

                'bathrooms' =>
                    $validated['bathrooms']
                    ?? null,

                'toilets' =>
                    $validated['toilets']
                    ?? null,

                'parking_spaces' =>
                    $validated['parking_spaces']
                    ?? null,

                'property_size' =>
                    $validated['property_size']
                    ?? null,

                'land_size' =>
                    $validated['land_size']
                    ?? null,

                'size_unit' =>
                    $validated['size_unit'],

                'year_built' =>
                    $validated['year_built']
                    ?? null,

                'furnished' =>
                    $validated['furnished']
                    ?? null,

                'featured' =>
                    $request->boolean(
                        'featured'
                    ),

                'verified' =>
                    $request->boolean(
                        'verified'
                    ),

                'status' =>
                    $validated['status'],

                'video_url' =>
                    $validated['video_url']
                    ?? null,

                'latitude' =>
                    $validated['latitude']
                    ?? null,

                'longitude' =>
                    $validated['longitude']
                    ?? null,

                'agent_id' =>
                    $validated['agent_id']
                    ?? null,

                'seo_title' =>
                    $validated['seo_title']
                    ?? null,

                'seo_description' =>
                    $validated['seo_description']
                    ?? null,

            ]);


            /*
            |--------------------------------------------------------------------------
            | Update features
            |--------------------------------------------------------------------------
            */

            $property->features()->sync(
                $validated['features']
                ?? []
            );


            /*
            |--------------------------------------------------------------------------
            | New floor plan
            |--------------------------------------------------------------------------
            */

            if (
                $request->hasFile(
                    'floor_plan'
                )
            ) {

                if (
                    $property->floor_plan
                ) {

                    Storage::disk('public')
                        ->delete(
                            $property->floor_plan
                        );
                }


                $path =
                    $request->file(
                        'floor_plan'
                    )->store(
                        'properties/floor-plans',
                        'public'
                    );


                $property->update([
                    'floor_plan' => $path
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Add new images
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('images')) {

                $currentCount =
                    $property->images()->count();


                foreach (
                    $request->file('images')
                    as $index => $image
                ) {

                    $path = $image->store(
                        'properties',
                        'public'
                    );


                    PropertyImage::create([

                        'property_id' =>
                            $property->id,

                        'image' =>
                            $path,

                        'is_primary' =>
                            $currentCount === 0 &&
                            $index === 0,

                        'sort_order' =>
                            $currentCount +
                            $index,

                    ]);
                }
            }

        });


        return redirect()
            ->route(
                'admin.properties.index'
            )
            ->with(
                'success',
                'Property updated successfully.'
            );
    }


    public function destroy(
        Property $property
    ) {

        /*
        |--------------------------------------------------------------------------
        | Delete images
        |--------------------------------------------------------------------------
        */

        foreach (
            $property->images
            as $image
        ) {

            Storage::disk('public')
                ->delete(
                    $image->image
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete floor plan
        |--------------------------------------------------------------------------
        */

        if ($property->floor_plan) {

            Storage::disk('public')
                ->delete(
                    $property->floor_plan
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete property
        |--------------------------------------------------------------------------
        */

        $property->delete();


        return redirect()
            ->route(
                'admin.properties.index'
            )
            ->with(
                'success',
                'Property deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete single image
    |--------------------------------------------------------------------------
    */

    public function destroyImage(
        PropertyImage $image
    ) {

        $property =
            $image->property;


        Storage::disk('public')
            ->delete(
                $image->image
            );


        $wasPrimary =
            $image->is_primary;


        $image->delete();


        /*
        |--------------------------------------------------------------------------
        | If primary image was deleted,
        | select another image.
        |--------------------------------------------------------------------------
        */

        if ($wasPrimary) {

            $newPrimary =
                $property
                    ->images()
                    ->orderBy('sort_order')
                    ->first();


            if ($newPrimary) {

                $newPrimary->update([
                    'is_primary' => true
                ]);
            }
        }


        return back()
            ->with(
                'success',
                'Image deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Set primary image
    |--------------------------------------------------------------------------
    */

    public function setPrimaryImage(
        PropertyImage $image
    ) {

        $property =
            $image->property;


        $property
            ->images()
            ->update([
                'is_primary' => false
            ]);


        $image->update([
            'is_primary' => true
        ]);


        return back()
            ->with(
                'success',
                'Primary image updated.'
            );
    }
}
