<x-guest-layout>
    <section class="sign-in-sec">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-md-5 col-sm-5 col-12 sign-in-left sign-viewport">
                    <div class="register-viewport">
                        <div class="sign-left-main">
                            <div class="sign-thumb">
                                <a href="{{ url('/') }}">
                                    <img src="{{asset('images/nav-logo.png')}}" alt="" class="img-fluid">
                                </a>
                            </div>

                            <div class="new-text">
                                <h6>We are glad to see you again!</h6>
                                <h5>Join the largest Investment
                                    Company in the world.</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-7 col-xl-7 col-sm-12 col-12 sign-in-right">
                    <div class="sign-right-main">
                        <div class="sign-thumb mob-login">
                            <a href="{{ url('/') }}">
                                <img src="{{asset('images/nav-logo.png')}}" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="account-signin-text member-desktop">
                            <p>Never a member? <a href="{{ route('register') }}">SIGNUP</a></p>
                        </div>
                        <div class="signin-form-main">
                            <div class="sign-form-head">
                                <h6>Sign in to</h6>
                                <h5>
                                    Angelo Investment
                                </h5>
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')"/>

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-xl-8 col-sm-12 col-12">
                                        <div class="signin-field">
                                            <input type="email" id="email" placeholder="{{ __('Email Address') }}"
                                                   name="email" value="{{old('email')}}">
                                        </div>
                                        <div class="signin-field">
                                            <input type="password" placeholder="{{ __('Password') }}" name="password">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}"
                                                   class="forgot-pass-link">{{ __('Forgot your password?') }}</a>
                                            @endif
                                        </div>

                                        <div class="sign-in-button">
                                            <x-button>
                                                {{ __('Sign in') }}
                                            </x-button>
                                        </div>
                                        <div class="account-signin-text member-mobile">
                                            <p>Never a member? <a href="{{ route('register') }}">SIGNUP</a></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
