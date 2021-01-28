@include('layouts.header')
<body>
    <div id="app">
        <dashboard title="NIGERIASCHOOLINFO"  mode="push" :desktop="true">
            
            <template slot="navigation">
                <!-- <div class="navbar-start">
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
                </div> -->

                <!-- <div class="navbar-end">
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
                </div>  -->               
            </template>

            <template slot="drawermenu" slot-scope="props">
                <drawer-menu>
                    <menu-item :props="props" icon="mdi-desktop-mac" link="/">Dashboard</menu-item>
                    <menu-item :props="props" icon="mdi-account-settings" link="/Profile">Profile</menu-item>
                    <!-- <menu-item :props="props" icon="mdi-account-settings" link="/">Blog</menu-item> -->
                    <li>
                        <a href="{{ route('application.index') }}">
                            <span class="icon"><i class="mdi mdi-newspaper-variant-multiple"></i></span>
                            <span class="menu-list-label ">Blog</span>
                        </a>
                    </li>
                    <menu-item :props="props" icon="mdi-link" link="/following">Following</menu-item>
                    @role('writer')
                        <menu-item type="menu-label">Admin Control</menu-item>
                        <menu-item 
                            icon="mdi-grease-pencil"
                            :props="props" 
                            type="dropdown"
                            :items="[
                                {
                                    link: '/posts',
                                    label: 'All Posts'
                                },
                                {
                                    link: '/addpost',
                                    label: 'Add New'
                                },
                                {
                                    link: '/category',
                                    label: 'Category'
                                },
                            ]"
                        >Posts</menu-item>
                        <menu-item 
                            icon="mdi-school"
                            :props="props" 
                            type="dropdown"
                            :items="[
                                {
                                    link: '/schools',
                                    label: 'All Schools'
                                },
                                {
                                    link: '/addschool',
                                    label: 'Create School'
                                },
                            ]"
                        >Schools</menu-item>
                        <menu-item 
                            icon="mdi-book-open-variant"
                            :props="props" 
                            type="dropdown"
                            :items="[
                                {
                                    link: '/courses-offered-in-nigeria-institutions',
                                    label: 'All Courses'
                                },
                                {
                                    link: '/addcourse',
                                    label: 'Add Course'
                                },
                            ]"
                        >Courses</menu-item>
                    @endrole
                </drawer-menu>
            </template>

            
            <router-view></router-view>
        </dashboard>

        <flash message="{{ session('flash') }}"></flash>

        @include('layouts.footer')
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    @yield('footer')
</body>
</html>



<!-- Documentation  -->

<!-- 
    You can pass either push or overlay to mode
    Push set the drawer to push the content while overlay causes it to float ontop




 -->