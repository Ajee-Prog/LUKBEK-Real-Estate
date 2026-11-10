<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display inspection form.
     */
    public function create()
    {
        $properties = Property::where('status', 'available')
            ->latest()
            ->get();

        return view(
            'frontend.inspections.create',
            compact('properties')
        );
    }

    /**
     * Store inspection request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'inspection_date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        Booking::create($validated);

        return redirect()
            ->route('booking.create')
            ->with(
                'success',
                'Your property inspection request has been submitted successfully.'
            );
    }
}
