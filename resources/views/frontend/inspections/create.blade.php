@extends('layouts.public')

@section(
    'title',
    'Schedule Property Inspection | LUKBEK'
)


@section('content')

<section class="inner-hero">

    <div class="container">

        <span>
            PROPERTY INSPECTION
        </span>

        <h1>
            Schedule a Viewing
        </h1>

        <p>
            Choose your preferred date and time
            and our consultant will confirm your visit.
        </p>

    </div>

</section>


<section class="section-padding">

    <div class="container">

        <div class="row g-5">


            <div class="col-lg-5">

                <div class="property-card">

                    @php

                        $image =
                            $property->images
                            ->firstWhere(
                                'is_primary',
                                true
                            )
                            ??
                            $property->images->first();

                    @endphp


                    @if($image)

                        <img
                            src="{{ asset(
                                'storage/' .
                                $image->image
                            ) }}"
                            style="
                                width:100%;
                                height:300px;
                                object-fit:cover;
                            "
                            alt="{{ $property->title }}">

                    @endif


                    <div class="property-content">

                        <span class="badge bg-dark">

                            {{
                                strtoupper(
                                    $property
                                    ->listing_type
                                )
                            }}

                        </span>


                        <h4 class="mt-3">

                            {{ $property->title }}

                        </h4>


                        <p class="property-location">

                            <i class="bi bi-geo-alt"></i>

                            {{ $property->location }}

                        </p>


                        <div class="property-price">

                            {{ $property->currency }}

                            {{ number_format(
                                $property->price
                            ) }}

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-7">

                <div class="property-search-card">

                    @if(session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif


                    <h3 class="mb-4">
                        Inspection Details
                    </h3>


                    <form
                        method="POST"
                        action="{{ route(
                            'inspections.store',
                            $property->slug
                        ) }}">

                        @csrf


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control"
                                    required>

                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="form-control"
                                    required>

                            </div>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control"
                                required>

                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Preferred Date
                                </label>

                                <input
                                    type="date"
                                    name="inspection_date"
                                    min="{{ date('Y-m-d') }}"
                                    value="{{ old(
                                        'inspection_date'
                                    ) }}"
                                    class="form-control"
                                    required>

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Preferred Time
                                </label>

                                <input
                                    type="time"
                                    name="inspection_time"
                                    value="{{ old(
                                        'inspection_time'
                                    ) }}"
                                    class="form-control"
                                    required>

                            </div>

                        </div>


                        <div class="mb-4">

                            <label class="form-label">
                                Additional Message
                            </label>

                            <textarea
                                name="message"
                                rows="5"
                                class="form-control"
                                placeholder="Anything our consultant should know?">{{ old('message') }}</textarea>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-warning btn-lg w-100">

                            <i class="bi bi-calendar-check"></i>

                            Request Inspection

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
