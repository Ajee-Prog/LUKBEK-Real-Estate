<aside class="admin-sidebar">

    <div class="sidebar-brand">

        <a href="{{ route('admin.dashboard') }}">

            <div class="brand-name">
                LUKBEK
            </div>

            <small>
                REAL ESTATE
            </small>

        </a>

    </div>


    <div class="sidebar-user">

        <div class="user-avatar">

            {{ strtoupper(
                substr(auth()->user()->name, 0, 1)
            ) }}

        </div>

        <div>

            <strong>
                {{ auth()->user()->name }}
            </strong>

            <small>
                {{ ucwords(
                    str_replace(
                        '_',
                        ' ',
                        auth()->user()->role
                    )
                ) }}
            </small>

        </div>

    </div>


    <nav class="sidebar-nav">

        <div class="nav-section">
            MAIN
        </div>

        <a
            href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs(
                'admin.dashboard'
            ) ? 'active' : '' }}">

            <i class="bi bi-grid"></i>

            Dashboard

        </a>


        <div class="nav-section">
            PROPERTY MANAGEMENT
        </div>


        <a
            href="{{ route('admin.properties.index') }}"
            class="{{ request()->routeIs(
                'admin.properties.*'
            ) ? 'active' : '' }}">

            <i class="bi bi-buildings"></i>

            Properties

        </a>


        <a
            href="{{ route('admin.categories.index') }}"
            class="{{ request()->routeIs(
                'admin.categories.*'
            ) ? 'active' : '' }}">

            <i class="bi bi-tags"></i>

            Categories

        </a>


        <a
            href="{{ route('admin.features.index') }}"
            class="{{ request()->routeIs(
                'admin.features.*'
            ) ? 'active' : '' }}">

            <i class="bi bi-list-check"></i>

            Features

        </a>


        <div class="nav-section">
            BUSINESS
        </div>


        <a
            href="{{ route('admin.agents.index') }}"
            class="{{ request()->routeIs(
                'admin.agents.*'
            ) ? 'active' : '' }}">

            <i class="bi bi-person-badge"></i>

            Agents

        </a>


        <a
            href="{{ route('admin.leads.index') }}"
            class="{{ request()->routeIs(
                'admin.leads.*'
            ) ? 'active' : '' }}">

            <i class="bi bi-person-lines-fill"></i>

            Leads

        </a>


        <a
            href="{{ route('admin.bookings.index') }}"
            class="{{ request()->routeIs(
                'admin.bookings.*'
            ) ? 'active' : '' }}">

            <i class="bi bi-calendar-check"></i>

            Inspections

        </a>


        <a
            href="{{ route('admin.messages.index') }}"
            class="{{ request()->routeIs(
                'admin.messages.*'
            ) ? 'active' : '' }}">

            <i class="bi bi-envelope"></i>

            Messages

        </a>


        <div class="nav-section">
            WEBSITE
        </div>


        <a
            href="{{ route('admin.services.index') }}">

            <i class="bi bi-briefcase"></i>

            Services

        </a>


        <a
            href="{{ route('admin.testimonials.index') }}">

            <i class="bi bi-chat-quote"></i>

            Testimonials

        </a>


        <div class="nav-section">
            SYSTEM
        </div>


        <a
            href="{{ route('admin.users.index') }}">

            <i class="bi bi-people"></i>

            Users

        </a>


        <a
            href="{{ route('admin.settings.index') }}">

            <i class="bi bi-gear"></i>

            Settings

        </a>


        <a
            href="{{ route('home') }}"
            target="_blank">

            <i class="bi bi-globe"></i>

            View Website

        </a>


        <form
            method="POST"
            action="{{ route('logout') }}"
            class="logout-form">

            @csrf

            <button type="submit">

                <i class="bi bi-box-arrow-right"></i>

                Logout

            </button>

        </form>

        {{-- New add side bar --}}
        <li class="nav-item">

    <a
        href="{{ route(
            'admin.leads.index'
        ) }}"
        class="nav-link">

        <i class="bi bi-person-lines-fill"></i>

        <span>
            Leads
        </span>

    </a>

</li>


<li class="nav-item">

    <a
        href="{{ route(
            'admin.inspections.index'
        ) }}"
        class="nav-link">

        <i class="bi bi-calendar-check"></i>

        <span>
            Inspections
        </span>

    </a>

</li>

    </nav>

</aside>
