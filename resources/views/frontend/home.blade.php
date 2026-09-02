@extends('layouts.frontend')

@section('title', 'LUKBEK Real Estate Homes & Property')

@section('content')


<!-- HERO -->

<section class="hero-section">

    <div class="container">

        <div class="row align-items-center min-vh-75">

            <div class="col-lg-7">

                <span class="hero-badge">
                    LUKBEK REAL ESTATE
                </span>

                <h1 class="hero-title">

                    Find A Place
                    <br>

                    You'll Love To
                    <span>Call Home.</span>

                </h1>

                <p class="hero-text">

                    Professional real estate consultants
                    helping you buy, sell, rent and manage
                    exceptional properties.

                </p>

                <div class="d-flex gap-3">

                    <a href="{{ route('properties.index') }}"
                       class="btn btn-warning btn-lg">

                        Explore Properties

                    </a>

                    <a href="{{ route('contact') }}"
                       class="btn btn-outline-light btn-lg">

                        Talk To Us

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- SEARCH -->

<section class="search-section">

    <div class="container">

        <div class="search-box">

            <h4 class="mb-4">
                Find Your Perfect Property
            </h4>

            <form
                action="{{ route('properties.index') }}"
                method="GET">

                <div class="row g-3">

                    <div class="col-lg-3">

                        <input
                            type="text"
                            name="location"
                            class="form-control"
                            placeholder="Location">

                    </div>


                    <div class="col-lg-3">

                        <select
                            name="category_id"
                            class="form-select">

                            <option value="">
                                Property Type
                            </option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-lg-3">

                        <select
                            name="listing_type"
                            class="form-select">

                            <option value="">
                                Buy or Rent
                            </option>

                            <option value="sale">
                                Buy
                            </option>

                            <option value="rent">
                                Rent
                            </option>

                            <option value="lease">
                                Lease
                            </option>

                        </select>

                    </div>


                    <div class="col-lg-3">

                        <button
                            class="btn btn-dark w-100">

                            <i class="bi bi-search"></i>

                            Search Properties

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</section>


<!-- FEATURED -->

<section class="py-5">

    <div class="container">

        <div class="section-heading">

            <span>OUR PROPERTIES</span>

            <h2>
                Featured Properties
            </h2>

            <p>
                Discover carefully selected properties
                from LUKBEK Real Estate.
            </p>

        </div>


        <div class="row g-4">

            @foreach($featuredProperties as $property)

                @include(
                    'components.property-card',
                    ['property' => $property]
                )

            @endforeach

        </div>


        <div class="text-center mt-5">

            <a
                href="{{ route('properties.index') }}"
                class="btn btn-outline-dark">

                View All Properties

            </a>

        </div>

    </div>

</section>


<!-- SERVICES -->

<section class="services-section py-5">

    <div class="container">

        <div class="section-heading text-center">

            <span>WHAT WE DO</span>

            <h2>
                Our Real Estate Services
            </h2>

        </div>


        <div class="row g-4">

            @foreach($services as $service)

                <div class="col-md-6 col-lg-3">

                    <div class="service-card">

                        <div class="service-icon">

                            <i class="{{ $service->icon }}"></i>

                        </div>

                        <h5>
                            {{ $service->name }}
                        </h5>

                        <p>
                            {{ Str::limit(
                                $service->description,
                                120
                            ) }}
                        </p>

                        <a href="#"
                           class="text-dark">

                            Learn More
                            <i class="bi bi-arrow-right"></i>

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>


<!-- WHY LUKBEK -->

<section class="py-5">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <span class="section-label">
                    WHY CHOOSE LUKBEK
                </span>

                <h2 class="display-6 fw-bold mt-2">

                    Your Property.
                    <br>
                    Our Expertise.

                </h2>

                <p class="text-muted">

                    We provide professional real estate
                    solutions designed around your needs.

                </p>

                <div class="row mt-4">

                    <div class="col-6 mb-4">

                        <h5>
                            <i class="bi bi-shield-check text-warning"></i>
                            Trusted
                        </h5>

                        <p class="text-muted">
                            Professional property services.
                        </p>

                    </div>


                    <div class="col-6 mb-4">

                        <h5>
                            <i class="bi bi-patch-check text-warning"></i>
                            Verified
                        </h5>

                        <p class="text-muted">
                            Carefully reviewed listings.
                        </p>

                    </div>


                    <div class="col-6">

                        <h5>
                            <i class="bi bi-people text-warning"></i>
                            Expert Team
                        </h5>

                        <p class="text-muted">
                            Experienced consultants.
                        </p>

                    </div>


                    <div class="col-6">

                        <h5>
                            <i class="bi bi-headset text-warning"></i>
                            Support
                        </h5>

                        <p class="text-muted">
                            Dedicated customer service.
                        </p>

                    </div>

                </div>

            </div>


            <div class="col-lg-6">

                <div class="about-image">

                    <div class="experience-box">

                        <strong>10+</strong>

                        <span>
                            Years of
                            Experience
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- CTA -->

<section class="cta-section">

    <div class="container text-center">

        <h2>
            Ready To Find Your Next Property?
        </h2>

        <p>
            Let LUKBEK help you make the right
            property decision.
        </p>

        <a
            href="{{ route('contact') }}"
            class="btn btn-warning btn-lg">

            Contact LUKBEK

        </a>

    </div>

</section>


@endsection
