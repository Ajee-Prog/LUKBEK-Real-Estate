<nav class="navbar navbar-expand-lg navbar-light bg-white
            sticky-top shadow-sm">

    <div class="container">

        <a class="navbar-brand fw-bold"
           href="{{ route('home') }}">

            <span class="brand-main">
                <img src="{{ asset('images/lukbek-logo1.png') }}" alt="LukBek Logo" class="-100 rounded" style=" width: 60px; height: 40px; margin-left:65px;">
            </span>

            <small class="d-block brand-sub">
                REAL ESTATE HOMES & PROPERTY
            </small>

        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div class="collapse navbar-collapse"
             id="mainNavbar">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">

                    <a class="nav-link"
                       href="{{ route('home') }}">

                        Home

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link"
                       href="{{ route('properties.index') }}">

                        Properties

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link"
                       href="{{ route('services.index') }}">

                        Services

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link"
                       href="{{ route('about') }}">

                        About Us

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link"
                       href="{{ route('agents.index') }}">

                        Agents

                    </a>

                </li>


                <li class="nav-item">

                    <a class="nav-link"
                       href="{{ route('contact') }}">

                        Contact

                    </a>

                </li>


                <li class="nav-item ms-lg-3">

                    <a href="{{ route('booking.create') }}"
                       class="btn btn-warning">

                        Book Inspection

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>
