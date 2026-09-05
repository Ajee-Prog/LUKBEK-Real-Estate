<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'LUKBEK Real Estate')
    </title>

    <meta
        name="description"
        content="@yield(
            'meta_description',
            'LUKBEK Real Estate Homes and Property'
        )">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="{{ asset('css/lukbek.css') }}">

    @stack('styles')

</head>


<body>


{{-- NAVBAR --}}

<nav
    class="navbar navbar-expand-lg navbar-dark fixed-top lukbek-navbar">

    <div class="container">

        <a
            class="navbar-brand fw-bold"
            href="{{ route('home') }}">

            <span class="brand-mark">
                L
            </span>

            LUKBEK

        </a>


        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div
            class="collapse navbar-collapse"
            id="mainNavbar">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('home') }}">

                        Home

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route(
                            'properties.index'
                        ) }}">

                        Properties

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('services') }}">

                        Services

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('about') }}">

                        About

                    </a>

                </li>


                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="{{ route('contact') }}">

                        Contact

                    </a>

                </li>


                <li class="nav-item ms-lg-3">

                    <a
                        href="{{ route('contact') }}"
                        class="btn btn-warning px-4">

                        Talk to an Agent

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>


<main>

    @yield('content')

</main>


{{-- FOOTER --}}

<footer class="lukbek-footer">

    <div class="container py-5">

        <div class="row g-5">

            <div class="col-lg-4">

                <h4 class="fw-bold">

                    LUKBEK

                </h4>

                <p class="mt-3">

                    Real estate homes and property
                    solutions designed around your
                    needs.

                </p>


                <div class="social-links">

                    <a href="#">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="#">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="#">
                        <i class="bi bi-linkedin"></i>
                    </a>

                    <a href="#">
                        <i class="bi bi-whatsapp"></i>
                    </a>

                </div>

            </div>


            <div class="col-lg-2">

                <h6>
                    Company
                </h6>

                <ul class="footer-links">

                    <li>
                        <a href="{{ route('about') }}">
                            About
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('services') }}">
                            Services
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}">
                            Contact
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-lg-3">

                <h6>
                    Properties
                </h6>

                <ul class="footer-links">

                    <li>
                        <a href="{{ route(
                            'properties.index',
                            ['listing_type' => 'sale']
                        ) }}">
                            Properties for Sale
                        </a>
                    </li>

                    <li>
                        <a href="{{ route(
                            'properties.index',
                            ['listing_type' => 'rent']
                        ) }}">
                            Properties for Rent
                        </a>
                    </li>

                    <li>
                        <a href="{{ route(
                            'properties.index'
                        ) }}">
                            All Properties
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-lg-3">

                <h6>
                    Contact
                </h6>

                <p>
                    <i class="bi bi-geo-alt"></i>
                    Lagos, Nigeria
                </p>

                <p>
                    <i class="bi bi-telephone"></i>
                    +234 800 000 0000
                </p>

                <p>
                    <i class="bi bi-envelope"></i>
                    info@lukbek.com
                </p>

            </div>

        </div>

    </div>


    <div class="footer-bottom">

        <div class="container">

            <div class="d-flex
                        justify-content-between
                        flex-wrap
                        gap-2">

                <span>
                    © {{ date('Y') }}
                    LUKBEK Real Estate.
                    All rights reserved.
                </span>

                <span>
                    Homes • Property • Advisory
                </span>

            </div>

        </div>

    </div>

</footer>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


@stack('scripts')

</body>

</html>
