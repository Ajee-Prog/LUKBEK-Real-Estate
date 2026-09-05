@extends('layouts.public')

@section(
    'title',
    $property->title . ' | LUKBEK'
)

@section(
    'meta_description',
    $property->seo_description
    ?? $property->description
)


@section('content')

<section class="property-detail-section">

    <div class="container">


        {{-- BREADCRUMB --}}

        <div class="mb-4">

            <a
                href="{{ route('properties.index') }}"
                class="text-muted">

                Properties

            </a>

            <span class="mx-2">
                /
            </span>

            {{ $property->title }}

        </div>


        {{-- GALLERY --}}

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


        <div class="property-gallery mb-5">

            <div class="row g-2">

                <div class="col-lg-8">

                    @if($primaryImage)

                        <img
                            src="{{ asset(
                                'storage/' .
                                $primaryImage->image
                            ) }}"
                            class="gallery-main-image"
                            alt="{{ $property->title }}">

                    @else

                        <div class="gallery-placeholder">

                            <i class="bi bi-house"></i>

                        </div>

                    @endif

                </div>


                <div class="col-lg-4">

                    <div class="row g-2">

                        @foreach(
                            $property->images
                            ->take(4)
                            as $image
                        )

                            <div class="col-6">

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $image->image
                                    ) }}"
                                    class="gallery-small-image"
                                    alt="{{ $property->title }}">

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>


        <div class="row g-5">


            {{-- MAIN CONTENT --}}

            <div class="col-lg-8">

                <div class="d-flex
                            justify-content-between
                            align-items-start">

                    <div>

                        <span class="badge bg-dark">

                            {{
                                strtoupper(
                                    $property->listing_type
                                )
                            }}

                        </span>


                        @if($property->verified)

                            <span
                                class="badge bg-success">

                                <i class="bi bi-patch-check"></i>

                                Verified

                            </span>

                        @endif


                        <h1 class="mt-3">

                            {{ $property->title }}

                        </h1>


                        <p class="text-muted">

                            <i class="bi bi-geo-alt"></i>

                            {{ $property->location }}

                        </p>

                    </div>

                </div>


                <div class="property-detail-price">

                    {{ $property->currency }}

                    {{ number_format(
                        $property->price
                    ) }}

                </div>


                {{-- PROPERTY STATS --}}

                <div class="property-stat-box">

                    <div>

                        <i class="bi bi-door-open"></i>

                        <strong>
                            {{ $property->bedrooms ?? 0 }}
                        </strong>

                        <span>
                            Bedrooms
                        </span>

                    </div>


                    <div>

                        <i class="bi bi-droplet"></i>

                        <strong>
                            {{ $property->bathrooms ?? 0 }}
                        </strong>

                        <span>
                            Bathrooms
                        </span>

                    </div>


                    <div>

                        <i class="bi bi-car-front"></i>

                        <strong>
                            {{ $property->parking_spaces ?? 0 }}
                        </strong>

                        <span>
                            Parking
                        </span>

                    </div>


                    <div>

                        <i class="bi bi-aspect-ratio"></i>

                        <strong>
                            {{ $property->property_size ?? 0 }}
                        </strong>

                        <span>
                            {{ $property->size_unit }}
                        </span>

                    </div>

                </div>


                {{-- DESCRIPTION --}}

                <div class="property-description mt-5">

                    <h3>
                        Property Description
                    </h3>

                    <p>
                        {!! nl2br(
                            e($property->description)
                        ) !!}
                    </p>

                </div>


                {{-- FEATURES --}}

                <div class="mt-5">

                    <h3>
                        Property Features
                    </h3>


                    <div class="row mt-3">

                        @foreach(
                            $property->features
                            as $feature
                        )

                            <div class="col-md-6 mb-3">

                                <div class="feature-item">

                                    <i class="bi bi-check-circle-fill"></i>

                                    {{ $feature->name }}

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- MAP --}}

                @if(
                    $property->latitude &&
                    $property->longitude
                )

                    <div class="mt-5">

                        <h3>
                            Property Location
                        </h3>

                        <div
                            class="map-placeholder">

                            <i class="bi bi-geo-alt"></i>

                            <p>
                                {{ $property->location }}
                            </p>

                        </div>

                    </div>

                @endif

            </div>


            {{-- SIDEBAR --}}

            <div class="col-lg-4">

                <div class="agent-contact-card">

                    <h4>
                        Interested in this property?
                    </h4>

                    <p>
                        Speak with a LUKBEK
                        property consultant.
                    </p>


                    @if($property->agent)

                        <div class="agent-info mb-4">

                            <div class="agent-avatar">

                                {{
                                    strtoupper(
                                        substr(
                                            $property
                                                ->agent
                                                ->name,
                                            0,
                                            1
                                        )
                                    )
                                }}

                            </div>


                            <div>

                                <strong>

                                    {{
                                        $property
                                            ->agent
                                            ->name
                                    }}

                                </strong>

                                <small>
                                    Property Consultant
                                </small>

                            </div>

                        </div>

                    @endif


                    <a
                        href="https://wa.me/2348000000000"
                        class="btn btn-success w-100 mb-3">

                        <i class="bi bi-whatsapp"></i>

                        WhatsApp Agent

                    </a>


                    <a
                        href="tel:+2348000000000"
                        class="btn btn-dark w-100 mb-3">

                        <i class="bi bi-telephone"></i>

                        Call Agent

                    </a>


                    <a
                        href="{{ route(
                            'contact'
                        ) }}"
                        class="btn btn-outline-dark w-100">

                        Schedule Inspection

                    </a>

                </div>

            </div>

        </div>


        {{-- RELATED --}}

        @if(
            $relatedProperties->count()
        )

            <section class="mt-5 pt-5">

                <h2 class="mb-4">
                    Similar Properties
                </h2>


                <div class="row g-4">

                    @foreach(
                        $relatedProperties
                        as $related
                    )

                        <div
                            class="col-md-6 col-lg-3">

                            <x-property-card
                                :property="$related"
                            />

                        </div>

                    @endforeach

                </div>

            </section>

        @endif

    </div>

</section>

@endsection
