@include('layouts.header')
<body>
    <div id="app">
        <dashboard title="NIGERIASCHOOLINFO"  mode="push" :desktop="true">
            
            <template slot="navigation">
                <div class="navbar-start">
                  <a class="navbar-item">
                    Home
                  </a>

                  <a class="navbar-item">
                    Documentation
                  </a>

                  <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                      More
                    </a>

                    <div class="navbar-dropdown">
                      <a class="navbar-item">
                        About
                      </a>
                      <a class="navbar-item">
                        Jobs
                      </a>
                      <a class="navbar-item">
                        Contact
                      </a>
                      <hr class="navbar-divider">
                      <a class="navbar-item">
                        Report an issue
                      </a>
                    </div>
                  </div>
                </div>

                <div class="navbar-end">
                  <div class="navbar-item">
                    <div class="buttons">
                      <a class="button is-primary">
                        <strong>Sign up</strong>
                      </a>
                      <a class="button is-light">
                        Log in
                      </a>
                    </div>
                  </div>
                </div>                
            </template>

            <template slot="drawermenu" slot-scope="props">
                <drawer-item type="menu-label">GENERAL</drawer-item>
                
                <drawer-item :props="props" icon="mdi-desktop-mac" link="/">Dashboard</drawer-item>
            </template>

            <template slot="dashboardcontent">
                <router-view></router-view>
            </template>

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