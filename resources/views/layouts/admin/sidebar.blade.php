<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('user_list') ? 'active' : '' }}" href="{{ route('user_list') }}">
            <span data-feather="file" class="align-text-bottom"></span>
            Users
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('staffs') ? 'active' : '' }}" href="{{ route('staffs') }}">
            <span data-feather="file" class="align-text-bottom"></span>
            Staffs
          </a>
        </li>
        
      </ul>

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
        <span>System Settings</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle" class="align-text-bottom"></span>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('custom_setups') ? 'active' : '' }}" href="{{ route('custom_setups') }}">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Custom Setups
          </a>
        </li>
        
      </ul>

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
        <span>Reports</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle" class="align-text-bottom"></span>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('custom_') ? 'active' : '' }}" href="#">
            <span data-feather="file-text" class="align-text-bottom"></span>
            Custom report
          </a>
        </li>
        
      </ul>
    </div>
</nav>
