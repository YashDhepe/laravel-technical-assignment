<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - {{ config('global.project_name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/timespro-logo.svg') }}">

    {{-- Include Styles --}}
    @include('includes/styles')

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    {{-- Include Navbar --}}
    @include('includes/navbar')

    {{-- Include Content --}}
    @yield('content')

    {{-- Include Footer --}}
    @include('includes/footer')

</body>

{{-- Include Default Scripts --}}
@include('includes/scripts')

</html>
