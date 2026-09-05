@extends('admin.layouts.app')

@section('title', 'Properties | LUKBEK')

@section('content')

<div class="page-header">

    <div>

        <h1>
            Properties
        </h1>

        <p>
            Manage LUKBEK property listings.
        </p>

    </div>

    <a
        href="{{ route('admin.properties.create') }}"
        class="btn btn-warning">

        <i class="bi bi-plus-lg"></i>

        Add Property

    </a>

</div>


<div class="dashboard-card">


    <div class="row mb-4">

        <div class="col-md-6">

            <form
                method="GET"
                action="{{ route(
                    'admin.properties.index'
                ) }}">

                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search property..."
                        value="{{ request('search') }}">

                    <button
                        class="btn btn-dark">

                        <i class="bi bi-search"></i>

                    </button>

                </div>

            </form>

        </div>

    </div>


    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>

                    <th>
                        Property
                    </th>

                    <th>
                        Reference
                    </th>

                    <th>
                        Type
                    </th>

                    <th>
                        Price
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Action
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($properties as $property)

                    <tr>

                        <td>

                            <div class="d-flex align-items-center gap-3">

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
                                        width="60"
                                        height="50"
                                        style="
                                        object-fit:cover;
                                        border-radius:8px;
                                        ">

                                @endif


                                <div>

                                    <strong>
                                        {{ $property->title }}
                                    </strong>

                                    <small class="d-block text-muted">

                                        {{ $property->location }}

                                    </small>

                                </div>

                            </div>

                        </td>


                        <td>

                            {{ $property->reference_no }}

                        </td>


                        <td>

                            {{ $property->category->name
                                ?? 'N/A' }}

                        </td>


                        <td>

                            {{ $property->currency }}

                            {{ number_format(
                                $property->price
                            ) }}

                        </td>


                        <td>

                            @if(
                                $property->status
                                === 'available'
                            )

                                <span
                                    class="badge text-bg-success">

                                    Available

                                </span>

                            @elseif(
                                $property->status
                                === 'sold'
                            )

                                <span
                                    class="badge text-bg-danger">

                                    Sold

                                </span>

                            @elseif(
                                $property->status
                                === 'reserved'
                            )

                                <span
                                    class="badge text-bg-warning">

                                    Reserved

                                </span>

                            @else

                                <span
                                    class="badge text-bg-secondary">

                                    {{ ucfirst(
                                        $property->status
                                    ) }}

                                </span>

                            @endif

                        </td>


                        <td>

                            <div class="dropdown">

                                <button
                                    class="btn btn-sm btn-light"
                                    data-bs-toggle="dropdown">

                                    <i class="bi bi-three-dots"></i>

                                </button>


                                <ul class="dropdown-menu">

                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="{{ route(
                                                'admin.properties.show',
                                                $property
                                            ) }}">

                                            <i class="bi bi-eye"></i>

                                            View

                                        </a>

                                    </li>


                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="{{ route(
                                                'admin.properties.edit',
                                                $property
                                            ) }}">

                                            <i class="bi bi-pencil"></i>

                                            Edit

                                        </a>

                                    </li>


                                    <li>

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.properties.destroy',
                                                $property
                                            ) }}">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                class="dropdown-item text-danger"
                                                onclick="return confirm(
                                                    'Delete this property?'
                                                )">

                                                <i class="bi bi-trash"></i>

                                                Delete

                                            </button>

                                        </form>

                                    </li>

                                </ul>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5">

                            <i
                                class="bi bi-buildings fs-1 text-muted">
                            </i>

                            <p class="mt-3">
                                No properties found.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <div class="mt-3">

        {{ $properties->links() }}

    </div>

</div>

{{-- TOp Search to use later for upgade   <div class="dashboard-card mb-4">

    <form
        method="GET"
        action="{{ route(
            'admin.properties.index'
        ) }}">

        <div class="row g-3">


            <div class="col-lg-4">

                <label class="form-label">
                    Search
                </label>

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Property title, location, reference..."
                    value="{{ request('search') }}">

            </div>


            <div class="col-lg-2">

                <label class="form-label">
                    Category
                </label>

                <select
                    name="category_id"
                    class="form-select">

                    <option value="">
                        All Categories
                    </option>

                    @foreach($categories as $category)

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

                <label class="form-label">
                    Listing
                </label>

                <select
                    name="listing_type"
                    class="form-select">

                    <option value="">
                        All
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

                <label class="form-label">
                    Status
                </label>

                <select
                    name="status"
                    class="form-select">

                    <option value="">
                        All
                    </option>

                    <option value="available">
                        Available
                    </option>

                    <option value="reserved">
                        Reserved
                    </option>

                    <option value="sold">
                        Sold
                    </option>

                    <option value="rented">
                        Rented
                    </option>

                </select>

            </div>


            <div class="col-lg-2 d-flex align-items-end">

                <button
                    type="submit"
                    class="btn btn-dark w-100">

                    <i class="bi bi-search"></i>

                    Search

                </button>

            </div>

        </div>

    </form>

</div> --}}

@endsection
