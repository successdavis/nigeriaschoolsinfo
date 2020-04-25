<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- <script data-ad-client="ca-pub-3146034280624513" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('head')
    <script>
        window.App = {!! json_encode([
            'user' => Auth::user(),
            'signedIn'  => Auth::check()      
        ]) !!};
    </script>
</head>
<body>    
    <div id="app">
        @include('layouts.navbar')

        <main class="py-4">
            @yield('content')
        </main>
        
        <flash message="{{ session('flash') }}"></flash>

        @include('layouts.footer')
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('footer')
</body>
</html>
