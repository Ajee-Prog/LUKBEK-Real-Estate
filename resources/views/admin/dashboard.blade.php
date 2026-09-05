@extends('admin.layouts.app')

@section('title', 'Dashboard | LUKBEK')

@section('content')

<div class="page-header">

    <div>

        <h1>
            Dashboard
        </h1>

        <p>
            Welcome back,
            {{ auth()->user()->name }}.
        </p>

    </div>

    <a
        href="{{ route('admin.properties.create') }}"
        class="btn btn-warning">

        <i class="bi bi-plus-lg"></i>

        Add Property

    </a>

</div>


<!-- STATISTICS -->

<div class="row g-4 mb-4">


    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-buildings"></i>

            </div>

            <div>

                <span>
                    Total Properties
                </span>

                <h2>
                    {{ $totalProperties }}
                </h2>

                <small>
                    All listings
                </small>

            </div>

        </div>

    </div>


    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-house-check"></i>

            </div>

            <div>

                <span>
                    Available
                </span>

                <h2>
                    {{ $availableProperties }}
                </h2>

                <small>
                    Active properties
                </small>

            </div>

        </div>

    </div>


    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-person-badge"></i>

            </div>

            <div>

                <span>
                    Agents
                </span>

                <h2>
                    {{ $totalAgents }}
                </h2>

                <small>
                    Registered agents
                </small>

            </div>

        </div>

    </div>


    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon">

                <i class="bi bi-people"></i>

            </div>

            <div>

                <span>
                    Customers
                </span>

                <h2>
                    {{ $totalCustomers }}
                </h2>

                <small>
                    Registered customers
                </small>

            </div>

        </div>

    </div>

</div>


<!-- SECOND ROW -->

<div class="row g-4 mb-4">


    <div class="col-md-4">

        <div class="dashboard-card">

            <div class="card-heading">

                <div>

                    <h5>
                        Inspection Requests
                    </h5>

                    <small>
                        Awaiting attention
                    </small>

                </div>

                <i class="bi bi-calendar-event"></i>

            </div>

            <h2>
                {{ $pendingBookings }}
            </h2>

            <a
                href="{{ route(
                    'admin.bookings.index'
                ) }}">

                View inspections
                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

    </div>


    <div class="col-md-4">

        <div class="dashboard-card">

            <div class="card-heading">

                <div>

                    <h5>
                        New Leads
                    </h5>

                    <small>
                        Require follow-up
                    </small>

                </div>

                <i class="bi bi-person-plus"></i>

            </div>

            <h2>
                {{ $newLeads }}
            </h2>

            <a
                href="{{ route(
                    'admin.leads.index'
                ) }}">

                View leads
                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

    </div>


    <div class="col-md-4">

        <div class="dashboard-card">

            <div class="card-heading">

                <div>

                    <h5>
                        Messages
                    </h5>

                    <small>
                        Unread enquiries
                    </small>

                </div>

                <i class="bi bi-envelope"></i>

            </div>

            <h2>
                {{ $unreadMessages }}
            </h2>

            <a
                href="{{ route(
                    'admin.messages.index'
                ) }}">

                View messages
                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

    </div>

</div>


<!-- QUICK ACTIONS -->

<div class="dashboard-card">

    <div class="card-heading mb-4">

        <div>

            <h5>
                Quick Actions
            </h5>

            <small>
                Manage your LUKBEK platform
            </small>

        </div>

    </div>


    <div class="row g-3">

        <div class="col-md-3">

            <a
                href="{{ route(
                    'admin.properties.create'
                ) }}"
                class="quick-action">

                <i class="bi bi-plus-circle"></i>

                <span>
                    Add Property
                </span>

            </a>

        </div>


        <div class="col-md-3">

            <a
                href="{{ route(
                    'admin.agents.create'
                ) }}"
                class="quick-action">

                <i class="bi bi-person-plus"></i>

                <span>
                    Add Agent
                </span>

            </a>

        </div>


        <div class="col-md-3">

            <a
                href="{{ route(
                    'admin.services.create'
                ) }}"
                class="quick-action">

                <i class="bi bi-briefcase"></i>

                <span>
                    Add Service
                </span>

            </a>

        </div>


        <div class="col-md-3">

            <a
                href="{{ route(
                    'admin.categories.create'
                ) }}"
                class="quick-action">

                <i class="bi bi-tag"></i>

                <span>
                    Add Category
                </span>

            </a>

        </div>

    </div>

</div>

@endsection
