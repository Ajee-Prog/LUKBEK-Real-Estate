@extends('layouts.public')

@section(
    'title',
    'Properties | LUKBEK Real Estate'
)


@section('content')

<section class="inner-hero">

    <div class="container">

        <span>
            LUKBEK REAL ESTATE
        </span>

        <h1>
            Find Your Property
        </h1>

        <p>
            Explore homes, land and investment
            properties available through LUKBEK.
        </p>

    </div>

</section>


<section class="section-padding">

    <div class="container">


        {{-- FILTER --}}

        <div class="property-search-card mb-5">

            <form method="GET">

                <div class="row g-3">

                    <div class="col-lg-4">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Search property...">

                    </div>


                    <div class="col-lg-2">

                        <select
                            name="listing_type"
                            class="form-select">

                            <option value="">
                                Buy / Rent
                            </option>

                            <option
                                value="sale"
                                @selected(
                                    request(
                                        'listing_type'
                                    ) === 'sale'
                                )>

                                Sale

                            </option>

                            <option
                                value="rent"
                                @selected(
                                    request(
                                        'listing_type'
                                    ) === 'rent'
                                )>

                                Rent

                            </option>

                            <option
                                value="lease"
                                @selected(
                                    request(
                                        'listing_type'
                                    ) === 'lease'
                                )>

                                Lease

                            </option>

                        </select>

                    </div>


                    <div class="col-lg-2">

                        <select
                            name="category_id"
                            class="form-select">

                            <option value="">
                                Property Type
                            </option>

                            @foreach(
                                $categories
                                as $category
                            )

                                <option
                                    value="{{ $category->id }}"
                                    @selected(
                                        request(
                                            'category_id'
                                        ) == $category->id
                                    )>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-lg-2">

                        <input
                            type="number"
                            name="min_price"
                            value="{{ request(
                                'min_price'
                            ) }}"
                            class="form-control"
                            placeholder="Min price">

                    </div>


                    <div class="col-lg-2">

                        <input
                            type="number"
                            name="max_price"
                            value="{{ request(
                                'max_price'
                            ) }}"
                            class="form-control"
                            placeholder="Max price">

                    </div>


                    <div class="col-12">

                        <button
                            class="btn btn-dark">

                            <i class="bi bi-search"></i>

                            Search Properties

                        </button>


                        <a
                            href="{{ route(
                                'properties.index'
                            ) }}"
                            class="btn btn-light">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>


        {{-- RESULTS --}}

        <div class="d-flex
                    justify-content-between
                    align-items-center
                    mb-4">

            <h4>
                {{ $properties->total() }}
                Properties Found
            </h4>

        </div>


        <div class="row g-4">

            @forelse(
                $properties
                as $property
            )

                <div class="col-md-6 col-lg-4">

                    <x-property-card
                        :property="$property"
                    />

                </div>

            @empty

                <div class="col-12">

                    <div class="empty-state">

                        <i class="bi bi-house-x"></i>

                        <h4>
                            No properties found
                        </h4>

                        <p>
                            Try changing your
                            search filters.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>


        <div class="mt-5">

            {{ $properties->links() }}

        </div>

    </div>

</section>

@endsection
