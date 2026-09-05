<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Lead;
use App\Models\Inspection;

class DashboardController extends Controller
{
    public function index(){
        $totalProperties = Property::count();

        $availableProperties = Property::where(
            'status',
            'available'
        )->count();

        $soldProperties = Property::where(
            'status',
            'sold'
        )->count();

        $rentProperties = Property::where(
            'listing_type',
            'rent'
        )
        ->where(
            'status',
            'available'
        )
        ->count();

        $totalLeads = Lead::count();

        $newLeads = Lead::where(
            'status',
            'new'
        )->count();

        $totalInspections = Inspection::count();

        $pendingInspections = Inspection::where(
            'status',
            'pending'
        )->count();


        return view(
            'admin.dashboard',
            compact(
                'totalProperties',
                'availableProperties',
                'soldProperties',
                'rentProperties',
                'totalLeads',
                'newLeads',
                'totalInspections',
                'pendingInspections'
            )
        );
    }
}
