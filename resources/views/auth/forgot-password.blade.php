<x-guest-layout>
    <section class="sign-in-sec">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-md-5 col-sm-5 col-12 sign-in-left sign-viewport">
                    <div class="register-viewport">
                        <div class="sign-left-main">
                            <div class="sign-thumb">
                                <img src="{{asset('images/nav-logo.png')}}" alt="" class="img-fluid">
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
                            <img src="{{asset('images/nav-logo.png')}}" alt="" class="img-fluid">
                        </div>
                        <div class="account-signin-text member-desktop">
                            <p>Never a member? <a href="{{ route('register') }}">SIGNUP</a></p>
                        </div>
                        <div class="signin-form-main">
                            <div class="sign-form-head">

                                <h5>
                                    Forget Password
                                </h5>
                            </div>
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')"/>

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-xl-8 col-sm-12 col-12">
                                        <div class="signin-field">
                                            <input type="email" placeholder="Enter Email" name="email">
                                        </div>

                                        <div class="sign-in-button">
                                            <x-button>
                                                {{ __('Email Password Reset Link') }}
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
    {{--    <x-auth-card>--}}
    {{--        <x-slot name="logo">--}}
    {{--            <a href="/">--}}
    {{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
    {{--            </a>--}}
    {{--        </x-slot>--}}

    {{--        <div class="mb-4 text-sm text-gray-600">--}}
    {{--            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}--}}
    {{--        </div>--}}



    {{--        <form method="POST" action="{{ route('password.email') }}">--}}
    {{--            @csrf--}}

    {{--            <!-- Email Address -->--}}
    {{--            <div>--}}
    {{--                <x-label for="email" :value="__('Email')" />--}}

    {{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
    {{--            </div>--}}

    {{--            <div class="flex items-center justify-end mt-4">--}}
    {{--                <x-button>--}}
    {{--                    {{ __('Email Password Reset Link') }}--}}
    {{--                </x-button>--}}
    {{--            </div>--}}
    {{--        </form>--}}
    {{--    </x-auth-card>--}}
</x-guest-layout>
