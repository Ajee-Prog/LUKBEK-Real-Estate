<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Service;
use App\Models\PropertyCategory;
use App\Models\Testimonial;

class HomeController extends Controller
{
    //  public function index()
    // {
    //     $featuredProperties = Property::with([
    //         'images',
    //         'category'
    //     ])
    //     ->where('featured', true)
    //     ->where('status', 'available')
    //     ->latest()
    //     ->take(6)
    //     ->get();

    //     $categories = PropertyCategory::where(
    //         'status',
    //         true
    //     )->get();

    //     $services = Service::where(
    //         'status',
    //         true
    //     )->latest()->take(4)->get();

    //     return view(
    //         'frontend.home',
    //         compact(
    //             'featuredProperties',
    //             'categories',
    //             'services'
    //         )
    //     );
    // }

    public function index()
    {
        $featuredProperties = Property::with([
            'images',
            'category',
            'agent'
        ])
        ->where('status', 'available')
        ->where('featured', true)
        ->latest()
        ->take(6)
        ->get();

        $latestProperties = Property::with([
            'images',
            'category',
            'agent'
        ])
        ->where('status', 'available')
        ->latest()
        ->take(8)
        ->get();

        $categories = PropertyCategory::where(
            'status',
            true
        )
        ->withCount('properties')
        ->orderBy('name')
        ->get();

        // Services managed from admin
        $services = Service::where('status', true)
            ->latest()
            ->take(4)
            ->get();

            $testimonials = Testimonial::where('status', true)
            ->latest()
            ->take(6)
            ->get();

        return view(
            'frontend.home',
            compact(
                'featuredProperties',
                'latestProperties',
                'categories',
                'services',
                'testimonials'
            )
        );
    }


    public function properties(Request $request)
    {
        $query = Property::with([
            'images',
            'category',
            'agent'
        ])
        ->where(
            'status',
            'available'
        );


        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'location',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'address',
                    'like',
                    "%{$search}%"
                );

            });
        }


        if ($request->filled('listing_type')) {

            $query->where(
                'listing_type',
                $request->listing_type
            );
        }


        if ($request->filled('category_id')) {

            $query->where(
                'category_id',
                $request->category_id
            );
        }


        if ($request->filled('min_price')) {

            $query->where(
                'price',
                '>=',
                $request->min_price
            );
        }


        if ($request->filled('max_price')) {

            $query->where(
                'price',
                '<=',
                $request->max_price
            );
        }


        if ($request->filled('bedrooms')) {

            $query->where(
                'bedrooms',
                '>=',
                $request->bedrooms
            );
        }


        $properties = $query
            ->latest()
            ->paginate(12);
            // ->withQueryString();


        $categories = PropertyCategory::where(
            'status',
            true
        )
        ->orderBy('name')
        ->get();


        return view(
            'frontend.properties.index',
            compact(
                'properties',
                'categories'
            )
        );
    }


    public function property(
        Property $property
    ) {

        abort_if(
            $property->status !== 'available',
            404
        );


        $property->load([
            'images',
            'category',
            'features',
            'agent'
        ]);


        $relatedProperties = Property::with([
            'images',
            'category'
        ])
        ->where(
            'status',
            'available'
        )
        ->where(
            'id',
            '!=',
            $property->id
        )
        ->where(
            'category_id',
            $property->category_id
        )
        ->latest()
        ->take(4)
        ->get();


        return view(
            'frontend.properties.show',
            compact(
                'property',
                'relatedProperties'
            )
        );
    }


    public function about()
    {
        return view(
            'frontend.about'
        );
    }


    public function services()
    {
        return view(
            'frontend.services'
        );
    }


    public function contact()
    {
        return view(
            'frontend.contact'
        );
    }
}
