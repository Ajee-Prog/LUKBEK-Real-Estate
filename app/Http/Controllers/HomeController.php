<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Service;
use App\Models\PropertyCategory;

class HomeController extends Controller
{
     public function index()
    {
        $featuredProperties = Property::with([
            'images',
            'category'
        ])
        ->where('featured', true)
        ->where('status', 'available')
        ->latest()
        ->take(6)
        ->get();

        $categories = PropertyCategory::where(
            'status',
            true
        )->get();

        $services = Service::where(
            'status',
            true
        )->latest()->take(4)->get();

        return view(
            'frontend.home',
            compact(
                'featuredProperties',
                'categories',
                'services'
            )
        );
    }
}
