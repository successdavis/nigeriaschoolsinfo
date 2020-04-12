<nav-bar inline-template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand is-flex-touch justify-content-touch">
      <a @click.prevent="drIsOpen = !drIsOpen" role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
      <a class="navbar-item" href="/">
        {{-- <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28"> --}}
        <h3>NIGERIASCHOOLINFO</h3>
      </a>
      <a class="navbar-item is-hidden-desktop">
          <ask-question :name="'ASK'" style="margin-right: 1em"></ask-question> 
      </a>
    </div>

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
        <a href="/courses" class="navbar-item">
          COURSES
        </a>

        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link" href="/schools">
            SCHOOLS
          </a>
          <div class="navbar-dropdown">
            @foreach ($schooltype as $type)
              <a href="{{$type->path()}}" class="navbar-item">
                {{$type->name}}
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

          {{-- <div class="control navbar-item ps-full-width" >
            <input class="input ps-full-width" type="text" placeholder="Text input">
          </div> --}}
        </div>
        
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
              <ask-question style="margin-right: 1em"></ask-question> 
            <a class="button is-light">
              CONTACT
            </a>
          </div>
        </div>
      </div>
    </div>

    <div v-if="drIsOpen" @click.prevent="drIsOpen = false" class="dr_overlay" v-cloak></div>

    <div :class="drIsOpen ? 'is-open' : 'not-open'" class="n_drawer open-left">
      <i @click.prevent="drIsOpen = false" class="fas fa-times n_drawer_close"></i>
      <div class="n_drawer-title">
          SITE FUNCTIONS
      </div>
        <ul class="n_drawer_items">
          @if (Route::has('login'))
                <div class="mt-small">
                    @auth
                        <a class="button is-fullwidth mt-small" href="{{ url('/home') }}">Home</a>
                    @else
                        <a class="button is-fullwidth mt-small" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a class="button is-fullwidth mt-small" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <li class="n_drawer_items--child">
                <span><i class="fas fa-store-alt"></i></span>
                <a href="">Store</a>
            </li>
            <li class="n_drawer_items--child">
              <span><i class="fas fa-pen"></i></span>
              <a href="/exams">Exams</a></li>

            <li class="n_drawer_items--child">
                <span><i class="fas fa-book"></i></span>
                <a href="/courses">Courses</a>
            </li>
            <li class="n_drawer_items--child">
                <span><i class="fas fa-graduation-cap"></i></span>
                <a href="/schools">Schools</a>
            </li>
        </ul>
        {{-- <ask-question style="width: 100%"></ask-question> --}}
        @auth
          <a class="button is-light is-fullwidth mt-small" href="">CONTACT</a>
        <a class="button is-fullwidth mt-small" href="{{ route('logout') }}" 
          onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"

        >{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endauth
    </div>
  </nav>
</nav-bar>