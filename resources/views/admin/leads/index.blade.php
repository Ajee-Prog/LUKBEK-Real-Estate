@extends('layouts.admin')

@section('title', 'Leads')


@section('content')

<div class="container-fluid">

    <div class="d-flex
                justify-content-between
                align-items-center
                mb-4">

        <div>

            <h2 class="fw-bold">
                Property Leads
            </h2>

            <p class="text-muted">
                Manage customer enquiries.
            </p>

        </div>

    </div>


    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table
                              table-hover
                              align-middle">

                    <thead>

                        <tr>

                            <th>
                                Customer
                            </th>

                            <th>
                                Property
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Date
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse(
                            $leads
                            as $lead
                        )

                            <tr>

                                <td>

                                    <strong>
                                        {{ $lead->name }}
                                    </strong>

                                    <small
                                        class="d-block text-muted">

                                        {{ $lead->email }}

                                    </small>

                                </td>


                                <td>

                                    @if($lead->property)

                                        {{
                                            $lead
                                            ->property
                                            ->title
                                        }}

                                    @else

                                        General Enquiry

                                    @endif

                                </td>


                                <td>

                                    {{ $lead->phone }}

                                </td>


                                <td>

                                    <span
                                        class="badge
                                        @if(
                                            $lead->status
                                            === 'new'
                                        )
                                            bg-primary
                                        @elseif(
                                            $lead->status
                                            === 'converted'
                                        )
                                            bg-success
                                        @elseif(
                                            $lead->status
                                            === 'closed'
                                        )
                                            bg-secondary
                                        @else
                                            bg-warning
                                            text-dark
                                        @endif">

                                        {{
                                            ucfirst(
                                                $lead->status
                                            )
                                        }}

                                    </span>

                                </td>


                                <td>

                                    {{
                                        $lead
                                        ->created_at
                                        ->format(
                                            'd M Y'
                                        )
                                    }}

                                </td>


                                <td>

                                    <a
                                        href="{{ route(
                                            'admin.leads.show',
                                            $lead->id
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

                                    No leads yet.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{ $leads->links() }}

        </div>

    </div>

</div>

@endsection
