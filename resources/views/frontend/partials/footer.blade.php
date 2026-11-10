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

                    <a href="https://wa.me/2347039564104" target="_blank" rel="noopener noreferrer">
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
                        <a href="{{ route('services.index') }}">
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
                    +234 703 956 4104
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
                    <a href="" style="border-right: 2px solid white; padding-right:10px; margin-right: 13px;"> Powered by YusTech</a>
                     &copy; 2015 - {{ date('Y') }}
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
