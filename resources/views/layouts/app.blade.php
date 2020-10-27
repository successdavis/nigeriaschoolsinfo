@include('layouts.header')
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
