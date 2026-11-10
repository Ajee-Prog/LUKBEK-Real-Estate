@extends('layouts.public')

@section(
    'title',
    'Property Enquiry | LUKBEK Real Estate'
)


@section('content')

<section class="inner-hero">

    <div class="container">

        <span>
            LUKBEK REAL ESTATE
        </span>

        <h1>
            Property Enquiry
        </h1>

        <p>
            Tell us what you're looking for
            and a LUKBEK consultant will contact you.
        </p>

    </div>

    {{-- THis is to replaced the contact Buttons  --}}
<a
    href="{{ route(
        'properties.interest',
        $property->slug
    ) }}"
    class="btn btn-warning w-100 mb-3">

    <i class="bi bi-chat-dots"></i>

    I'm Interested

</a>


<a
    href="{{ route(
        'inspections.create',
        $property->slug
    ) }}"
    class="btn btn-dark w-100 mb-3">

    <i class="bi bi-calendar-check"></i>

    Schedule Inspection

</a>


<a
    href="https://wa.me/2348000000000"
    class="btn btn-success w-100 mb-3">

    <i class="bi bi-whatsapp"></i>

    WhatsApp Agent

</a>


<a
    href="tel:+2348000000000"
    class="btn btn-outline-dark w-100">

    <i class="bi bi-telephone"></i>

    Call Agent

</a>
{{-- THese above are to replaced the contact Buttons ends here  --}}

<h1> -------The Above Buttons are to replaced Cantact Buttons-----</h1>

</section>


<section class="section-padding">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="property-search-card">

                    @if(session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif


                    <h3 class="mb-4">
                        I'm Interested
                    </h3>


                    <form
                        method="POST"
                        action="{{ route(
                            'leads.store'
                        ) }}">

                        @csrf


                        <input
                            type="hidden"
                            name="property_id"
                            value="{{ $property->id }}">


                        <div class="mb-3">

                            <label class="form-label">
                                Property
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $property->title }}"
                                readonly>

                        </div>


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
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="form-control"
                                    required>

                                @error('phone')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control"
                                required>

                            @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>


                        <div class="mb-4">

                            <label class="form-label">
                                Message
                            </label>

                            <textarea
                                name="message"
                                rows="5"
                                class="form-control"
                                placeholder="Tell us how we can help...">{{ old('message') }}</textarea>

                        </div>


                        <button
                            class="btn btn-dark btn-lg w-100">

                            <i class="bi bi-send"></i>

                            Submit Enquiry

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
