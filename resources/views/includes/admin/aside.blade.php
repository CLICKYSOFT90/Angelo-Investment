<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme light-style">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
              <img src="{{ asset('images/nav-logo.png') }}" class="img-fluid">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ \Route::is('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>


        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Apps &amp; Pages</span></li>
        <li class="menu-item {{ \Route::is('admin.users') ? 'active' : '' }}">
            <a href="{{ route('admin.users') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('admin.offerings') || \Route::is('admin.offerings.create') || \Route::is('admin.offerings.view')  || \Route::is('admin.offerings.edit') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div data-i18n="Offerings">Offerings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ \Route::is('admin.offerings') ? 'active' : '' }}">
                    <a href="{{ route('admin.offerings') }}" class="menu-link">
                        <div data-i18n="List">List</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('admin.offerings.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.offerings.create') }}" class="menu-link">
                        <div data-i18n="Create Offering">Create Offering</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{\Route::is('admin.offerings.type') || \Route::is('admin.offerings.type.create') ? 'open active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div data-i18n="Offering Types">Offerings Types</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ \Route::is('admin.offerings.type') ? 'active' : '' }}">
                    <a href="{{ route('admin.offerings.type') }}" class="menu-link">
                        <div data-i18n="List">List</div>
                    </a>
                </li>
                <li class="menu-item {{ \Route::is('admin.offerings.type.create') ? 'active' : '' }}">
                    <a href="{{route('admin.offerings.type.create')}}" class="menu-link">
                        <div data-i18n="Create Offering Type">Create</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ \Route::is('admin.transactions') ? 'active' : '' }}">
            <a href="{{route('admin.transactions')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dollar me-2"></i>
                <div data-i18n="Transaction">Transaction</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('admin.newsletter') ? 'active' : '' }}">
            <a href="{{ route('admin.newsletter') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                <div data-i18n="Newsletter Subscription">Newsletter Subscription</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('admin.accredited.index') ? 'active' : '' }}">
            <a href="{{ route('admin.accredited.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Accredited Investor Request">Accredited Investor Request</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('admin.withdrawal.requests') ? 'active' : '' }}">
            <a href="{{ route('admin.withdrawal.requests') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-money-withdraw"></i>
                <div data-i18n="Withdrawal Request">Withdrawal Request</div>
            </a>
        </li>
        <li class="menu-item {{ \Route::is('admin.user.settings') ? 'active' : '' }}">
            <a href="{{ route('admin.user.settings') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog me-2"></i>
                <div data-i18n="Settings">Settings</div>
            </a>
        </li>
    </ul>
</aside>
