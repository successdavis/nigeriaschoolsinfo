@include('layouts.header')
<body>
    <div id="app">
        <dashboard inline-template mode="push" :desktop="true">
            <div class="dashboard-wrapper" :class="drIsOpen ? modeclass : 'drIsClose' ">
                <div :class="desktop == true ? 'is-desktop' : '' " class="n_drawer navbar-wrapper__child left">
                    Draw content goes here
                </div>
                <div class="drawer_overlay is-hidden-tablet" v-if="drIsOpen" @click="drIsOpen = false" v-cloak></div>

                <nav :class="desktop == true ? 'is-desktop' : '' " class="navbar navbar-wrapper__child" role="navigation" aria-label="main navigation">
                    <div class="navbar-brand is-flex-touch justify-content-touch">
                        <a :class="desktop == true ? 'is-desktop' : '' "   @click.prevent="drIsOpen = !drIsOpen" role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false">
                            <span aria-hidden="true"></span>
                            <span aria-hidden="true"></span>
                            <span aria-hidden="true"></span>
                        </a>
                        <a class="navbar-item" href="/">
                            <h3>NIGERIASCHOOLINFO</h3>
                        </a>
                        
                        <a class="navbar-item is-hidden-desktop">
                            (?)
                        </a>
                    </div>
                </nav>

                <div :class="desktop == true ? 'is-desktop' : '' " class="dashboard_content section">
                    Here goes the ultimate site contents
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                    signature
                </div>



            </div>
        </dashboard>

        <flash message="{{ session('flash') }}"></flash>

        @include('layouts.footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('footer')
</body>
</html>

<!-- Documentation  -->

<!-- 
    You can pass either push or overlay to mode
    Push set the drawer to push the content while overlay causes it to float ontop




 -->