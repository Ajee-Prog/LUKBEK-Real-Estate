@extends('layouts.admin')

@section('title', 'Property Inspections')


@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h2 class="fw-bold">
            Property Inspections
        </h2>

        <p class="text-muted">
            Manage customer property viewing requests.
        </p>

    </div>


    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>

                        <tr>

                            <th>
                                Customer
                            </th>

                            <th>
                                Property
                            </th>

                            <th>
                                Date
                            </th>

                            <th>
                                Time
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

                        @forelse(
                            $inspections
                            as $inspection
                        )

                            <tr>

                                <td>

                                    <strong>
                                        {{
                                            $inspection->name
                                        }}
                                    </strong>

                                    <small
                                        class="d-block text-muted">

                                        {{
                                            $inspection->phone
                                        }}

                                    </small>

                                </td>


                                <td>

                                    {{
                                        $inspection
                                        ->property
                                        ->title
                                    }}

                                </td>


                                <td>

                                    {{
                                        $inspection
                                        ->inspection_date
                                        ->format(
                                            'd M Y'
                                        )
                                    }}

                                </td>


                                <td>

                                    {{
                                        \Carbon\Carbon::parse(
                                            $inspection
                                            ->inspection_time
                                        )->format(
                                            'h:i A'
                                        )
                                    }}

                                </td>


                                <td>

                                    <span
                                        class="badge
                                        @if(
                                            $inspection->status
                                            === 'approved'
                                        )
                                            bg-success
                                        @elseif(
                                            $inspection->status
                                            === 'rejected'
                                        )
                                            bg-danger
                                        @elseif(
                                            $inspection->status
                                            === 'completed'
                                        )
                                            bg-primary
                                        @else
                                            bg-warning
                                            text-dark
                                        @endif">

                                        {{
                                            ucfirst(
                                                $inspection->status
                                            )
                                        }}

                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="{{ route(
                                            'admin.inspections.show',
                                            $inspection->id
                                        ) }}"
                                        class="btn
                                               btn-sm
                                               btn-dark">

                                        View

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5">

                                    No inspection requests.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{ $inspections->links() }}

        </div>

    </div>

</div>

@endsection
