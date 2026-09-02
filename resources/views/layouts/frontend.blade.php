<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="@yield('meta_description',
          'LUKBEK Real Estate Homes and Property')">

    <title>
        @yield('title', 'LUKBEK Real Estate Homes & Property')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    <link rel="stylesheet"
          href="{{ asset('assets/css/frontend.css') }}">

    @stack('styles')

</head>

<body>

@include('frontend.partials.navbar')

<main>

    @yield('content')

</main>

@include('frontend.partials.footer')

<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

<script src="{{ asset('assets/js/frontend.js') }}"></script>

@stack('scripts')

</body>

</html>
