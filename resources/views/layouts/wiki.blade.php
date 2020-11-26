<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/toastify-js.js') }}"></script>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://rawgit.com/google/code-prettify/master/src/prettify.css"/>
    <script type="text/javascript" src="https://rawgit.com/google/code-prettify/master/src/prettify.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/highlight.css') }}" rel="stylesheet">
    <link href="{{ asset('css/wiki.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <main class="py-0">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
