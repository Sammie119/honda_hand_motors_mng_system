<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('public/assets/images/honda.logo.png') }}" height="30px" width="35px" alt="logo"></a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('service_transactions') ? 'active' : '' }}" href="{{ route('service_transactions') }}">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('rents') ? 'active' : '' }}" href="{{ route('rents') }}">Rents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('expenditures') ? 'active' : '' }}" href="{{ route('expenditures') }}">Expenditures</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('customers') ? 'active' : '' }}" href="{{ route('customers') }}">Customers</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle 
                        {{ request()->is('accounts_reports') ? 'active' : '' }}
                        {{ request()->is('income_statement') ? 'active' : '' }}
                        {{ request()->is('debtors') ? 'active' : '' }}
                        {{ request()->is('specific_car') ? 'active' : '' }}
                    " href="#" data-bs-toggle="dropdown" aria-expanded="false">Accounts</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('accounts_reports') }}">Accounts Report</a></li>
                        <li><a class="dropdown-item" href="{{ route('income_statement') }}">Income Statement</a></li>
                        <li><a class="dropdown-item" href="{{ route('debtors') }}">Debtors List</a></li>
                        <li><a class="dropdown-item" href="{{ route('specific_car') }}">Specific Car Report</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex" role="search">
                {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> --}}
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item profile" href="#getProfile" data-bs-toggle="modal">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
