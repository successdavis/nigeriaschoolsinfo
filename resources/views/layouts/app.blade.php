@include('layouts.header')
<body>
<div id="app">
    <dashboard title="NIGERIASCHOOLINFO">
        <template slot="navigation" >
            <div id="navbarBasicExample" class="navbar-menu">
              <div class="navbar-start ">
                {{-- <a class="navbar-item">
                  FIND OUT
              </a> --}}

              <a href="{{ route('news.education') }}" class="navbar-item">
                  NEWS
              </a>
              <a class="navbar-item">
                  STORE
              </a>
              <a class="navbar-item" href="/nigeria-education-project-topics-and-materials">
                  PROJECTS
              </a>

              <a href="/courses-offered-in-nigeria-institutions" class="navbar-item">
                  COURSES
              </a>

              <div class="navbar-item has-dropdown is-hoverable">
                  <a class="navbar-link" href="/schools">
                    SCHOOLS
                </a>
                <div class="navbar-dropdown">
                    @foreach ($programme as $programme)
                    <a href="{{$programme->path()}}" class="navbar-item">
                        {{$programme->name}}
                    </a>
                    @endforeach
                    <hr class="navbar-divider">
                    <a class="navbar-item">
                      Nursing Schools
                  </a>
              </div>
          </div>

          <div class="navbar-item has-dropdown is-hoverable">
              <a class="navbar-link" href="/exams">
                EXAMS
            </a>

            <div class="navbar-dropdown">
                <a class="navbar-item">
                  Post UTME
              </a>
              <a class="navbar-item">
                  JAMB
              </a>
              <a class="navbar-item">
                  NECO
              </a>
              <a class="navbar-item">
                  WAEC
              </a>
              <hr class="navbar-divider">
              <a class="navbar-item">
                  Other
              </a>
          </div>

      </div>

  </div>

  <div class="navbar-end">
    <div class="navbar-item">
      <div class="buttons">
          <!-- <ask-question style="margin-right: 1em"></ask-question> -->
          @auth
          <a class="button" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"

          >{{ __('Logout') }}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a class="button" href="{{ url('/home') }}">Home</a>

        @else 
        <a class="button" href="{{ route('login') }}">Login</a>
        @if (Route::has('register'))
        <a class="button" href="{{ route('register') }}">Register</a>
        @endif
        @endauth
    </div>
</div>
</div>
</div>
        </template>

        <template slot="drawermenu" slot-scope="props">
            <aside class="menu">
                <p class="menu-label">
                    General
                </p>

                <ul class="menu-list">
                    <li>
                        <a href="{{ route('news.education') }}">
                            <span class="icon"><i class="mdi mdi-newspaper-variant-multiple"></i></span>
                            <span class="menu-list-label ">Latest News</span>
                        </a>
                    </li>
                    <li>
                        <a href="/latest-job-opportunities-and-application">
                            <span class="icon"><i class="mdi mdi-warehouse"></i></span>
                            <span class="menu-list-label">Find a Job</span>
                        </a>
                    </li>
                    <li>
                        <a href="/courses-offered-in-nigeria-institutions">
                            <span class="icon"><i class="mdi mdi-bookshelf"></i></span>
                            <span class="menu-list-label">Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="/schools">
                            <span class="icon"><i class="mdi mdi-school"></i></span>
                            <span class="menu-list-label">Schools</span>
                        </a>
                    </li>
                    <li>
                        <a href="/exams">
                            <span class="icon"><i class="mdi mdi-chair-school"></i></span>
                            <span class="menu-list-label">Exams</span>
                        </a>
                    </li>
                    <li>
                        <a href="/latest-scholarships-opportunities-for-application">
                            <span class="icon"><i class="mdi mdi-chair-school"></i></span>
                            <span class="menu-list-label">Scholarships</span>
                        </a>
                    </li>
                </ul>

                <p class="menu-label">Session</p>
                <ul class="menu-list">
                    @auth
                        <li>
                            <a href="/home">
                                <span class="icon"><i class="mdi mdi-monitor-dashboard"></i></span>
                                <span class="menu-list-label">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <span class="icon"><i class="mdi mdi-account-arrow-left"></i></span>
                                <span class="menu-list-label">Logout</span>
                            </a>
                        </li>
                    @else
                    @if(Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}">
                            <span class="icon"><i class="mdi mdi-account-plus-outline"></i></span>
                            <span class="menu-list-label">Register</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('login') }}">
                            <span class="icon"><i class="mdi mdi-account-arrow-right"></i></span>
                            <span class="menu-list-label">Login</span>
                        </a>
                    </li>
                    @endauth
                    <li>
                        <a>
                            <span class="icon"><i class="mdi mdi-logout"></i></span>
                            <span class="menu-list-label">Help</span>
                        </a>
                    </li>
                </ul>
            </aside>
        </template>

        @yield('content')

    </dashboard>

    <flash message="{{ session('flash') }}"></flash>

    @include('layouts.footer')
</div>

<script src="{{ asset('js/app.js') }}"></script>
@yield('footer')

</body>
</html>


