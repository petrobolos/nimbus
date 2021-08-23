<head>
    @include('layouts.partials.comment')

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="application-name" content="{{ config('app.name', 'Nimbus') }}" />
    <meta name="author" content="Petrobolos Games" />
    <meta name="description" content="@yield('meta-description')" />
    <meta name="robots" content="@yield('meta-robots')" />

    {{-- TODO: Add favicon and social media images, icons, etc. --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Analytics -->
    <meta name="server-time" content="{{ ceil((microtime(true) - LARAVEL_START)) }}" />

    <title>@yield('title') | {{ config('app.name', 'Nimbus') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
