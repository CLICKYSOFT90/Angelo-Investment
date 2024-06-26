<aside id="layout-menu" class="layout-menu menu-vertical menu side-nav">
    <div class="app-brand aside-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">

            <img src="{{ asset('images/nav-logo.png') }}" alt="" class="img-fluid aside-logo">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto vs-md">

            <i class="bx bx-x d-block d-xl-none bx-sm align-middle "></i>
        </a>
    </div>

    <ul class="menu-inner py-1 menu-listing-main">
        <li class="menu-item">
            <a href="{{ route('investor.dashboard') }}" class="menu-link {{ \Route::is('investor.dashboard') ? 'menu-active' : '' }}">
                Dashboard
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ route('investor.transactions') }}" class="menu-link {{ \Route::is('investor.transactions') ? 'menu-active' : '' }}">
                Transaction
            </a>
        </li>
        <li class="menu-item {{ \Route::is('investor.fund.deposits') || \Route::is('investor.fund.withdrawals') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                Funds
                <span class="material-icons">expand_more</span>
            </a>
            <ul class="menu-sub">
                <li class="">
                    <a href="{{ route('investor.fund.deposits') }}" class="d-item {{ \Route::is('investor.fund.deposits') ? 'menu-active' : '' }}">
                        Funds Deposit
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('investor.fund.withdrawals') }}" class="d-item {{ \Route::is('investor.fund.withdrawals') ? 'menu-active' : '' }}">
                        Funds Withdrawal
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="{{ route('investor.portfolio') }}" class="menu-link {{ \Route::is('investor.portfolio') ? 'menu-active' : '' }}">
                Portfolio
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('investor.bank.accounts') }}" class="menu-link {{ \Route::is('investor.bank.accounts') ? 'menu-active' : '' }}">
                Bank Account
            </a>
        </li>
        @if(auth()->user()->accredited_investor == 0)
        <li class="menu-item">
            <a href="{{ route('investor.upgrade.accredited') }}" class="menu-link {{ \Route::is('investor.upgrade.accredited') ? 'menu-active' : '' }}">
                Upgrade To Accredited
            </a>
        </li>
        @endif
        <li class="menu-item">
            <a href="{{ route('investor.settings') }}" class="menu-link {{ \Route::is('investor.settings') ? 'menu-active' : '' }}">
                Account setting
            </a>
        </li>
        <li class="menu-item">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <a href="javascript:void(0);" class="menu-link" onclick="event.preventDefault(); this.closest('form').submit();" >
                    Logout
                </a>
            </form>
        </li>
    </ul>
</aside>
