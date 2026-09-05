@extends('admin.layouts.app')

@section('title', $property->title . ' | LUKBEK')

@section('content')

<div class="page-header">

    <div>

        <h1>
            {{ $property->title }}
        </h1>

        <p>
            {{ $property->reference_no }}
        </p>

    </div>


    <div class="d-flex gap-2">

        <a
            href="{{ route(
                'admin.properties.edit',
                $property
            ) }}"
            class="btn btn-warning">

            <i class="bi bi-pencil"></i>

            Edit

        </a>


        <form
            method="POST"
            action="{{ route(
                'admin.properties.destroy',
                $property
            ) }}">

            @csrf

            @method('DELETE')

            <button
                class="btn btn-outline-danger"
                onclick="return confirm(
                    'Delete this property?'
                )">

                <i class="bi bi-trash"></i>

                Delete

            </button>

        </form>

    </div>

</div>


<div class="row g-4">


    {{-- PROPERTY IMAGES --}}

    <div class="col-lg-8">

        <div class="dashboard-card">

            @php

                $primaryImage =
                    $property->images
                    ->firstWhere(
                        'is_primary',
                        true
                    )
                    ??
                    $property->images->first();

            @endphp


            @if($primaryImage)

                <img
                    src="{{ asset(
                        'storage/' .
                        $primaryImage->image
                    ) }}"
                    class="img-fluid rounded mb-4"
                    style="
                        width:100%;
                        max-height:500px;
                        object-fit:cover;
                    ">

            @else

                <div
                    class="bg-light rounded d-flex align-items-center justify-content-center"
                    style="height:400px">

                    <div class="text-center">

                        <i class="bi bi-image fs-1 text-muted"></i>

                        <p class="text-muted">
                            No property image
                        </p>

                    </div>

                </div>

            @endif


            {{-- THUMBNAILS --}}

            <div class="row g-2">

                @foreach($property->images as $image)

                    <div class="col-3 col-md-2">

                        <img
                            src="{{ asset(
                                'storage/' .
                                $image->image
                            ) }}"
                            class="img-fluid rounded"
                            style="
                                width:100%;
                                height:80px;
                                object-fit:cover;
                            ">

                    </div>

                @endforeach

            </div>

        </div>

    </div>


    {{-- SUMMARY --}}

    <div class="col-lg-4">

        <div class="dashboard-card mb-4">

            <span class="text-muted">
                Price
            </span>

            <h2 class="mt-2">

                {{ $property->currency }}

                {{ number_format(
                    $property->price
                ) }}

            </h2>


            <hr>


            <p>

                <strong>
                    Listing:
                </strong>

                {{ ucfirst(
                    $property->listing_type
                ) }}

            </p>


            <p>

                <strong>
                    Status:
                </strong>

                <span class="badge text-bg-success">

                    {{ ucfirst(
                        $property->status
                    ) }}

                </span>

            </p>


            <p>

                <strong>
                    Category:
                </strong>

                {{ $property->category->name
                    ?? 'N/A' }}

            </p>


            <p>

                <strong>
                    Location:
                </strong>

                {{ $property->location }}

            </p>


            @if($property->agent)

                <p>

                    <strong>
                        Agent:
                    </strong>

                    {{ $property->agent->name }}

                </p>

            @endif


            @if($property->featured)

                <span class="badge text-bg-warning">
                    Featured
                </span>

            @endif


            @if($property->verified)

                <span class="badge text-bg-primary">
                    Verified
                </span>

            @endif

        </div>


        {{-- QUICK STATS --}}

        <div class="dashboard-card">

            <h5 class="mb-4">
                Property Details
            </h5>


            <div class="row g-3">

                <div class="col-6">

                    <div class="border rounded p-3">

                        <i class="bi bi-door-open"></i>

                        <strong class="d-block">

                            {{ $property->bedrooms ?? 0 }}

                        </strong>

                        <small>
                            Bedrooms
                        </small>

                    </div>

                </div>


                <div class="col-6">

                    <div class="border rounded p-3">

                        <i class="bi bi-droplet"></i>

                        <strong class="d-block">

                            {{ $property->bathrooms ?? 0 }}

                        </strong>

                        <small>
                            Bathrooms
                        </small>

                    </div>

                </div>


                <div class="col-6">

                    <div class="border rounded p-3">

                        <i class="bi bi-car-front"></i>

                        <strong class="d-block">

                            {{ $property->parking_spaces ?? 0 }}

                        </strong>

                        <small>
                            Parking
                        </small>

                    </div>

                </div>


                <div class="col-6">

                    <div class="border rounded p-3">

                        <i class="bi bi-aspect-ratio"></i>

                        <strong class="d-block">

                            {{ $property->property_size ?? 0 }}

                        </strong>

                        <small>
                            {{ $property->size_unit }}
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DESCRIPTION --}}

    <div class="col-lg-8">

        <div class="dashboard-card">

            <h5 class="mb-3">
                Description
            </h5>

            <div>

                {!! nl2br(
                    e($property->description)
                ) !!}

            </div>

        </div>

    </div>


    {{-- FEATURES --}}

    <div class="col-lg-4">

        <div class="dashboard-card">

            <h5 class="mb-3">
                Features
            </h5>


            @forelse(
                $property->features
                as $feature
            )

                <span
                    class="badge bg-light text-dark border mb-2">

                    <i class="bi bi-check-circle"></i>

                    {{ $feature->name }}

                </span>

            @empty

                <p class="text-muted">
                    No features added.
                </p>

            @endforelse

        </div>

    </div>


    {{-- BOOKINGS --}}

    <div class="col-lg-6">

        <div class="dashboard-card">

            <div class="d-flex justify-content-between">

                <h5>
                    Inspection Requests
                </h5>

                <span class="badge text-bg-warning">

                    {{ $property->bookings->count() }}

                </span>

            </div>


            @forelse(
                $property->bookings->take(5)
                as $booking
            )

                <div
                    class="border-bottom py-3">

                    <strong>
                        {{ $booking->name }}
                    </strong>

                    <small class="d-block text-muted">

                        {{ $booking->inspection_date }}

                    </small>

                </div>

            @empty

                <p class="text-muted mt-3">
                    No inspection requests yet.
                </p>

            @endforelse

        </div>

    </div>


    {{-- LEADS --}}

    <div class="col-lg-6">

        <div class="dashboard-card">

            <div class="d-flex justify-content-between">

                <h5>
                    Leads
                </h5>

                <span class="badge text-bg-primary">

                    {{ $property->leads->count() }}

                </span>

            </div>


            @forelse(
                $property->leads->take(5)
                as $lead
            )

                <div
                    class="border-bottom py-3">

                    <strong>
                        {{ $lead->name }}
                    </strong>

                    <small class="d-block text-muted">

                        {{ $lead->phone }}

                    </small>

                </div>

            @empty

                <p class="text-muted mt-3">
                    No leads yet.
                </p>

            @endforelse

        </div>

    </div>

</div>

@endsection
