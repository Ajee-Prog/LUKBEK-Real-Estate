@extends('admin.layouts.app')

@section('title', 'Edit Property | LUKBEK')

@section('content')

<div class="page-header">

    <div>

        <h1>
            Edit Property
        </h1>

        <p>
            Update:
            {{ $property->title }}
        </p>

    </div>


    <a
        href="{{ route(
            'admin.properties.show',
            $property
        ) }}"
        class="btn btn-light">

        <i class="bi bi-eye"></i>

        View Property

    </a>

</div>


@include(
    'admin.properties._form',
    [
        'formAction' =>
            route(
                'admin.properties.update',
                $property
            ),

        'formMethod' => 'PUT'
    ]
)

<h2>IMAGE MANAGEMENT SECTION</h2>
{{-- <div class="dashboard-card mt-4">

    <h5 class="mb-4">
        Existing Property Images
    </h5>


    <div class="row g-4">

        @forelse($property->images as $image)

            <div class="col-md-4">

                <div class="border rounded p-2">

                    <img
                        src="{{ asset(
                            'storage/' . $image->image
                        ) }}"
                        class="img-fluid rounded mb-3"
                        style="
                            width:100%;
                            height:180px;
                            object-fit:cover;
                        ">


                    @if($image->is_primary)

                        <span
                            class="badge text-bg-success mb-2">

                            <i class="bi bi-star-fill"></i>

                            Primary Image

                        </span>

                    @else

                        <form
                            method="POST"
                            action="{{ route(
                                'admin.property-images.primary',
                                $image
                            ) }}"
                            class="mb-2">

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-warning w-100">

                                <i class="bi bi-star"></i>

                                Set Primary

                            </button>

                        </form>

                    @endif


                    <form
                        method="POST"
                        action="{{ route(
                            'admin.property-images.destroy',
                            $image
                        ) }}">

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-sm btn-outline-danger w-100"
                            onclick="return confirm(
                                'Delete this image?'
                            )">

                            <i class="bi bi-trash"></i>

                            Delete Image

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="text-center py-4">

                    <i class="bi bi-images fs-1 text-muted"></i>

                    <p class="text-muted">
                        No images uploaded.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div> --}}

@endsection
