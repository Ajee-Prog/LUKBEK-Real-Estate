@extends('admin.layouts.app')

@section('title', 'Add Property | LUKBEK')

@section('content')

<div class="page-header">

    <div>

        <h1>
            Add Property
        </h1>

        <p>
            Create a new LUKBEK property listing.
        </p>

    </div>

    <a
        href="{{ route('admin.properties.index') }}"
        class="btn btn-light">

        <i class="bi bi-arrow-left"></i>

        Back

    </a>

</div>


<form
    method="POST"
    action="{{ route('admin.properties.store') }}"
    enctype="multipart/form-data">

    @csrf


    <div class="row g-4">


        {{-- LEFT SIDE --}}

        <div class="col-lg-8">


            {{-- BASIC INFORMATION --}}

            <div class="dashboard-card mb-4">

                <h5 class="mb-4">
                    Property Information
                </h5>


                <div class="mb-3">

                    <label class="form-label">
                        Property Title *
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title') }}"
                        placeholder="Luxury 5 Bedroom Detached Duplex">

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="7"
                        class="form-control"
                        placeholder="Describe the property...">{{ old('description') }}</textarea>

                </div>


                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Category *
                        </label>

                        <select
                            name="category_id"
                            class="form-select">

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(
                                        old('category_id')
                                        == $category->id
                                    )>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Listing Type *
                        </label>

                        <select
                            name="listing_type"
                            class="form-select">

                            <option value="sale">
                                For Sale
                            </option>

                            <option value="rent">
                                For Rent
                            </option>

                            <option value="lease">
                                For Lease
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- PRICE --}}

            <div class="dashboard-card mb-4">

                <h5 class="mb-4">
                    Price & Location
                </h5>


                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label">
                            Currency
                        </label>

                        <select
                            name="currency"
                            class="form-select">

                            <option value="NGN">
                                NGN ₦
                            </option>

                            <option value="USD">
                                USD $
                            </option>

                            <option value="GBP">
                                GBP £
                            </option>

                            <option value="EUR">
                                EUR €
                            </option>

                        </select>

                    </div>


                    <div class="col-md-8">

                        <label class="form-label">
                            Price *
                        </label>

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            value="{{ old('price') }}"
                            min="0">

                    </div>


                    <div class="col-md-12">

                        <label class="form-label">
                            Location *
                        </label>

                        <input
                            type="text"
                            name="location"
                            class="form-control"
                            value="{{ old('location') }}"
                            placeholder="Lekki Phase 1, Lagos">

                    </div>


                    <div class="col-md-12">

                        <label class="form-label">
                            Full Address
                        </label>

                        <textarea
                            name="address"
                            rows="3"
                            class="form-control">{{ old('address') }}</textarea>

                    </div>

                </div>

            </div>


            {{-- PROPERTY DETAILS --}}

            <div class="dashboard-card mb-4">

                <h5 class="mb-4">
                    Property Details
                </h5>


                <div class="row g-3">


                    <div class="col-md-3">

                        <label class="form-label">
                            Bedrooms
                        </label>

                        <input
                            type="number"
                            name="bedrooms"
                            class="form-control"
                            min="0"
                            value="{{ old('bedrooms') }}">

                    </div>


                    <div class="col-md-3">

                        <label class="form-label">
                            Bathrooms
                        </label>

                        <input
                            type="number"
                            name="bathrooms"
                            class="form-control"
                            min="0"
                            value="{{ old('bathrooms') }}">

                    </div>


                    <div class="col-md-3">

                        <label class="form-label">
                            Toilets
                        </label>

                        <input
                            type="number"
                            name="toilets"
                            class="form-control"
                            min="0"
                            value="{{ old('toilets') }}">

                    </div>


                    <div class="col-md-3">

                        <label class="form-label">
                            Parking
                        </label>

                        <input
                            type="number"
                            name="parking_spaces"
                            class="form-control"
                            min="0"
                            value="{{ old('parking_spaces') }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Property Size
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="property_size"
                            class="form-control"
                            value="{{ old('property_size') }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Land Size
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="land_size"
                            class="form-control"
                            value="{{ old('land_size') }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Size Unit
                        </label>

                        <select
                            name="size_unit"
                            class="form-select">

                            <option value="sqm">
                                Square Metres (sqm)
                            </option>

                            <option value="sqft">
                                Square Feet (sqft)
                            </option>

                            <option value="acre">
                                Acre
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Year Built
                        </label>

                        <input
                            type="number"
                            name="year_built"
                            class="form-control"
                            value="{{ old('year_built') }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Furnishing
                        </label>

                        <select
                            name="furnished"
                            class="form-select">

                            <option value="">
                                Select
                            </option>

                            <option value="furnished">
                                Furnished
                            </option>

                            <option value="semi-furnished">
                                Semi-Furnished
                            </option>

                            <option value="unfurnished">
                                Unfurnished
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

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

                </div>

            </div>


            {{-- FEATURES --}}

            <div class="dashboard-card mb-4">

                <h5 class="mb-4">
                    Property Features
                </h5>


                <div class="row">

                    @foreach($features as $feature)

                        <div class="col-md-4 mb-3">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="features[]"
                                    value="{{ $feature->id }}"
                                    id="feature{{ $feature->id }}"
                                    @checked(
                                        in_array(
                                            $feature->id,
                                            old('features', [])
                                        )
                                    )>

                                <label
                                    class="form-check-label"
                                    for="feature{{ $feature->id }}">

                                    {{ $feature->name }}

                                </label>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- IMAGES --}}

            <div class="dashboard-card mb-4">

                <h5 class="mb-2">
                    Property Images
                </h5>

                <p class="text-muted small">
                    You can select multiple images.
                    The first image will initially become
                    the primary image.
                </p>


                <input
                    type="file"
                    name="images[]"
                    class="form-control"
                    id="propertyImages"
                    accept="image/*"
                    multiple>


                <div
                    id="imagePreview"
                    class="row g-3 mt-2">
                </div>

            </div>


            {{-- FLOOR PLAN --}}

            <div class="dashboard-card mb-4">

                <h5 class="mb-3">
                    Floor Plan
                </h5>

                <input
                    type="file"
                    name="floor_plan"
                    class="form-control"
                    accept="image/*">

            </div>


            {{-- SEO --}}

            <div class="dashboard-card">

                <h5 class="mb-4">
                    SEO Information
                </h5>


                <div class="mb-3">

                    <label class="form-label">
                        SEO Title
                    </label>

                    <input
                        type="text"
                        name="seo_title"
                        class="form-control"
                        value="{{ old('seo_title') }}">

                </div>


                <div>

                    <label class="form-label">
                        SEO Description
                    </label>

                    <textarea
                        name="seo_description"
                        rows="4"
                        class="form-control">{{ old('seo_description') }}</textarea>

                </div>

            </div>

        </div>


        {{-- RIGHT SIDE --}}

        <div class="col-lg-4">


            {{-- AGENT --}}

            <div class="dashboard-card mb-4">

                <h5 class="mb-4">
                    Assign Agent
                </h5>

                <select
                    name="agent_id"
                    class="form-select">

                    <option value="">
                        No Agent
                    </option>

                    @foreach($agents as $agent)

                        <option
                            value="{{ $agent->id }}"
                            @selected(
                                old('agent_id')
                                == $agent->id
                            )>

                            {{ $agent->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- FLAGS --}}

            <div class="dashboard-card mb-4">

                <h5 class="mb-4">
                    Listing Options
                </h5>


                <div class="form-check form-switch mb-3">

                    <input
                        type="checkbox"
                        name="featured"
                        value="1"
                        class="form-check-input"
                        id="featured">

                    <label
                        class="form-check-label"
                        for="featured">

                        Featured Property

                    </label>

                </div>


                <div class="form-check form-switch">

                    <input
                        type="checkbox"
                        name="verified"
                        value="1"
                        class="form-check-input"
                        id="verified">

                    <label
                        class="form-check-label"
                        for="verified">

                        Verified Property

                    </label>

                </div>

            </div>


            {{-- VIDEO --}}

            <div class="dashboard-card mb-4">

                <h5 class="mb-3">
                    Property Video
                </h5>

                <input
                    type="url"
                    name="video_url"
                    class="form-control"
                    value="{{ old('video_url') }}"
                    placeholder="https://youtube.com/...">

            </div>


            {{-- MAP --}}

            <div class="dashboard-card mb-4">

                <h5 class="mb-3">
                    Map Coordinates
                </h5>


                <label class="form-label">
                    Latitude
                </label>

                <input
                    type="text"
                    name="latitude"
                    class="form-control mb-3"
                    value="{{ old('latitude') }}">


                <label class="form-label">
                    Longitude
                </label>

                <input
                    type="text"
                    name="longitude"
                    class="form-control"
                    value="{{ old('longitude') }}">

            </div>


            <button
                type="submit"
                class="btn btn-warning w-100 py-3">

                <i class="bi bi-check-lg"></i>

                Publish Property

            </button>

        </div>

    </div>

</form>

@endsection


@push('scripts')

<script>

const propertyImages =
    document.getElementById('propertyImages');

const imagePreview =
    document.getElementById('imagePreview');


propertyImages.addEventListener(
    'change',
    function () {

        imagePreview.innerHTML = '';


        [...this.files].forEach(
            function (file) {

                const reader =
                    new FileReader();


                reader.onload =
                    function (event) {

                        imagePreview.innerHTML += `

                            <div class="col-md-4">

                                <img
                                    src="${event.target.result}"
                                    class="img-fluid rounded"
                                    style="
                                        height:140px;
                                        width:100%;
                                        object-fit:cover;
                                    "
                                >

                            </div>

                        `;

                    };


                reader.readAsDataURL(file);

            }
        );

    }
);

</script>

@endpush
