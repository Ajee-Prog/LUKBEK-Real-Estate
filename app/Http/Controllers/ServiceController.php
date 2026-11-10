<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display all active services.
     */
    public function index()
    {
        $services = Service::where('status', true)
            ->latest()
            ->paginate(12);

        return view('frontend.services.index', compact('services'));
    }

    /**
     * Display one service.
     */
    public function show($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $services = Service::where('status', true)
            ->where('id', '!=', $service->id)
            ->latest()
            ->take(4)
            ->get();

        return view(
            'frontend.services.show',
            compact('service', 'services')
        );
    }
}
