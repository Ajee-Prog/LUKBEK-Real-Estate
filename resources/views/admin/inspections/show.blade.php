@extends('layouts.admin')

@section('title', 'Inspection Details')


@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <a
            href="{{ route(
                'admin.inspections.index'
            ) }}"
            class="text-muted">

            ← Back to Inspections

        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <div class="row g-4">


        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Inspection Request
                    </h4>


                    <div class="row g-4">

                        <div class="col-md-6">

                            <small class="text-muted">
                                Customer
                            </small>

                            <h6>
                                {{ $inspection->name }}
                            </h6>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Phone
                            </small>

                            <h6>
                                {{ $inspection->phone }}
                            </h6>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Email
                            </small>

                            <h6>
                                {{ $inspection->email }}
                            </h6>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Property
                            </small>

                            <h6>

                                {{
                                    $inspection
                                    ->property
                                    ->title
                                }}

                            </h6>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Inspection Date
                            </small>

                            <h6>

                                {{
                                    $inspection
                                    ->inspection_date
                                    ->format(
                                        'd M Y'
                                    )
                                }}

                            </h6>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Inspection Time
                            </small>

                            <h6>

                                {{
                                    \Carbon\Carbon::parse(
                                        $inspection
                                        ->inspection_time
                                    )->format(
                                        'h:i A'
                                    )
                                }}

                            </h6>

                        </div>

                    </div>


                    <hr>


                    <h5>
                        Customer Message
                    </h5>

                    <p>

                        {{
                            $inspection->message
                            ?? 'No message provided.'
                        }}

                    </p>

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h5 class="fw-bold">
                        Manage Inspection
                    </h5>


                    <form
                        method="POST"
                        action="{{ route(
                            'admin.inspections.update',
                            $inspection->id
                        ) }}">

                        @csrf

                        @method('PUT')


                        <div class="mb-3">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select">

                                @foreach([
                                    'pending',
                                    'approved',
                                    'rejected',
                                    'completed',
                                    'cancelled'
                                ] as $status)

                                    <option
                                        value="{{ $status }}"
                                        @selected(
                                            $inspection->status
                                            === $status
                                        )>

                                        {{
                                            ucfirst(
                                                $status
                                            )
                                        }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Admin Notes
                            </label>

                            <textarea
                                name="admin_notes"
                                rows="5"
                                class="form-control">{{ $inspection->admin_notes }}</textarea>

                        </div>


                        <button
                            class="btn btn-dark w-100">

                            Update Inspection

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
