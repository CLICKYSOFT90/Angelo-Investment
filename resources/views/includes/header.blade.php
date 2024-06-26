<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand nav-logo" href="{{ route('home') }}"><img
                            src="{{asset('images/nav-logo.png')}}" alt=""
                            class="img-fluid"></a>
                    <div class="gtc-menu-icon collapsed" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                         aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                        <div class="d-flex align-items-center">

                            <div class="gtc-icon">
                                <div class="line line-1"></div>
                                <div class="line line-2"></div>
                                <div class="line line-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse nav-v-center" id="navbarHeader">
                        <ul class="navbar-nav m mb-2 mb-lg-0 nav-parent">
                            <li class="nav-item">
                                <a class="nav-link {{ \Route::is('home') ? 'active pseudo-none' : '' }}"
                                   aria-current="page" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ \Route::is('about-us') ? 'active pseudo-none' : '' }}"
                                   href="{{ route('about-us') }}">About Us</a>
                            </li>
                            <li class="nav-item btn-group">

                                <button type="button"
                                        class="cs-drop btn-group align-items-center dropdown-toggle dropdown-toggle"
                                        id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false"
                                        data-bs-reference="parent">
                                    <a href="javascript:;" class="nav-link">Offerings</a>
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu c-menu animate slideIn"
                                    aria-labelledby="dropdownMenuReference">
                                    <li><a class="dropdown-item" href="{{ route('open-investments') }}">Open
                                            Investment</a></li>
                                    <li><a class="dropdown-item" href="{{ route('fully-funded') }}">Fully Funded</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('past-investments') }}">Past
                                            Investments</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ \Route::is('contact-us') ? 'active pseudo-none' : '' }}"
                                   aria-current="page" href="{{ route('contact-us') }}">Contact
                                    Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('login') }}">Investor Portal</a>
                            </li>
                            <li>
                                <div class="sign-button mobile-sign">
                                    @auth
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <div class="sign-button">

                                                <button type="submit" class="sign-btn">
                                                    {{ __('Log Out') }}
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                    <a href="{{ route('register') }}" class="sign-btn">Sign Up</a>
                                    @endauth
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="sign-button desktop-sign">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <div class="sign-button">

                                    <button type="submit" class="sign-btn">
                                        {{ __('Log Out') }}
                                    </button>
                                </div>
                            </form>
                        @else
                            <a href="{{ route('register') }}" class="sign-btn">Sign Up</a>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
