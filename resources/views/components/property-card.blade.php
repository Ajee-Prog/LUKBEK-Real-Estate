<div class="col-md-6 col-lg-4">

    <div class="property-card">

        <div class="property-image">

            @php
                $image = $property->images
                    ->firstWhere('is_primary', true)
                    ?? $property->images->first();
            @endphp

            @if($image)

                <img
                    src="{{ asset(
                        'storage/' . $image->image
                    ) }}"
                    alt="{{ $property->title }}">

            @else

                <img
                    src="{{ asset(
                        'assets/images/property-placeholder.jpg'
                    ) }}"
                    alt="Property">

            @endif


            @if($property->featured)

                <span class="property-badge">
                    Featured
                </span>

            @endif


            @if($property->verified)

                <span class="verified-badge">

                    <i class="bi bi-patch-check-fill"></i>

                    Verified

                </span>

            @endif

        </div>


        <div class="property-body">

            <small class="text-muted">

                {{ $property->category->name ?? 'Property' }}

            </small>


            <h5 class="mt-2">

                {{ $property->title }}

            </h5>


            <p class="text-muted">

                <i class="bi bi-geo-alt"></i>

                {{ $property->location }}

            </p>


            <div class="property-price">

                @if($property->currency === 'NGN')
                    ₦
                @elseif($property->currency === 'USD')
                    $
                @elseif($property->currency === 'GBP')
                    £
                @endif

                {{ number_format($property->price) }}

            </div>


            <div class="property-meta">

                <span>
                    <i class="bi bi-door-open"></i>
                    {{ $property->bedrooms ?? 0 }}
                    Beds
                </span>

                <span>
                    <i class="bi bi-droplet"></i>
                    {{ $property->bathrooms ?? 0 }}
                    Baths
                </span>

                <span>
                    <i class="bi bi-car-front"></i>
                    {{ $property->parking_spaces ?? 0 }}
                </span>

            </div>


            <a
                href="{{ route(
                    'properties.show',
                    $property->slug
                ) }}"
                class="btn btn-dark w-100 mt-3">

                View Property

            </a>

        </div>

    </div>

</div>
{{-- NEW PROPERTY CARD aPPEARS AT COMPONENT PROPERTY TO REPLACE OLD TOP ONES --}}
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

<h1>NEW PROPERTY CARD aPPEARS AT COMPONENT PROPERTY TO REPLACE OLD</h1>
<div class="property-card">

    <div class="property-image">

        @if($primaryImage)

            <img
                src="{{ asset(
                    'storage/' .
                    $primaryImage->image
                ) }}"
                alt="{{ $property->title }}">

        @else

            <div class="property-placeholder">

                <i class="bi bi-house"></i>

            </div>

        @endif


        <div class="property-badges">

            <span class="badge bg-dark">

                {{ strtoupper(
                    $property->listing_type
                ) }}

            </span>


            @if($property->featured)

                <span class="badge bg-warning text-dark">

                    Featured

                </span>

            @endif

        </div>


        @if($property->verified)

            <div class="verified-badge">

                <i class="bi bi-patch-check-fill"></i>

                Verified

            </div>

        @endif

    </div>


    <div class="property-content">

        <div class="property-price">

            {{ $property->currency }}

            {{ number_format(
                $property->price
            ) }}

        </div>


        <h5>

            <a
                href="{{ route(
                    'properties.show',
                    $property->slug
                ) }}">

                {{ $property->title }}

            </a>

        </h5>


        <p class="property-location">

            <i class="bi bi-geo-alt"></i>

            {{ $property->location }}

        </p>


        <div class="property-meta">

            <span>

                <i class="bi bi-door-open"></i>

                {{ $property->bedrooms ?? 0 }}
                Beds

            </span>


            <span>

                <i class="bi bi-droplet"></i>

                {{ $property->bathrooms ?? 0 }}
                Baths

            </span>


            <span>

                <i class="bi bi-aspect-ratio"></i>

                {{ $property->property_size ?? 0 }}
                {{ $property->size_unit }}

            </span>

        </div>

    </div>

</div>
