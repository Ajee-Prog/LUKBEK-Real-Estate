<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Lead;
use App\Models\Message;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalProperties =
            Property::count();

        $availableProperties =
            Property::where(
                'status',
                'available'
            )->count();

        $totalAgents =
            User::where(
                'role',
                'agent'
            )->count();

        $totalCustomers =
            User::where(
                'role',
                'customer'
            )->count();

        $pendingBookings =
            Booking::where(
                'status',
                'pending'
            )->count();

        $newLeads =
            Lead::where(
                'status',
                'new'
            )->count();

        $unreadMessages =
            Message::where(
                'is_read',
                false
            )->count();


        return view(
            'admin.dashboard',
            compact(
                'totalProperties',
                'availableProperties',
                'totalAgents',
                'totalCustomers',
                'pendingBookings',
                'newLeads',
                'unreadMessages'
            )
        );
    }
}
