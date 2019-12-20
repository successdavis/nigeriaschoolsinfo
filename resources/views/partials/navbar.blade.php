<nav-bar inline-template>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="/">
        {{-- <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28"> --}}
        <h3>NGSCHOOLINFO</h3>
      </a>

      <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start ">
        {{-- <a class="navbar-item">
          FIND OUT
        </a> --}}

        <a class="navbar-item">
          STORE
        </a>

        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">
            SCHOOLS
          </a>

          <div class="navbar-dropdown">
            <a class="navbar-item">
              Universities
            </a>
            <a class="navbar-item">
              Polytechnics
            </a>
            <a class="navbar-item">
              Colleges
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item">
              Nursing Schools
            </a>
          </div>
        </div>

        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">
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
          <div class="control navbar-item ps-full-width" >
            <input class="input ps-full-width" type="text" placeholder="Text input">
          </div>
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
  </nav>
</nav-bar>