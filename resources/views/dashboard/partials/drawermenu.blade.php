<div>
  <aside class="menu">
      <p class="menu-label">
        General
      </p>

      <ul class="menu-list">
        <li>
          <router-link to="/">
            <span class="icon"><i class="mdi mdi-desktop-mac default"></i></span>
            <span :class="props.drIsOpen ? 'is-visible' : '' " class="dashboardlabel Label">Dashboard</span>
          </router-link> 
        </li>
        <!-- <li><a>Customers</a></li> -->
      </ul>


<!--       <p class="menu-label">
        Administration
      </p>
      <ul class="menu-list">
        <li><a>Team Settings</a></li>
        <li>
          <a class="is-active">Manage Your Team</a>
          <ul>
            <li><a>Members</a></li>
            <li><a>Plugins</a></li>
            <li><a>Add a member</a></li>
          </ul>
        </li>
        <li><a>Invitations</a></li>
        <li><a>Cloud Storage Environment Settings</a></li>
        <li><a>Authentication</a></li>
      </ul>
      <p class="menu-label">
        Transactions
      </p>
      <ul class="menu-list">
        <li><a>Payments</a></li>
        <li><a>Transfers</a></li>
        <li><a>Balance</a></li>
      </ul> -->
  </aside>
  <!-- <router-link to="/">Dashboard</router-link>  -->
  <!-- <router-link to="/courses">Courses</router-link>  -->
</div>

