<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="register-form" enctype="multipart/form-data">
        @csrf
        <section class="sign-in-sec">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-md-5 col-sm-5 col-12 sign-in-left">
                        <div class="register-viewport">
                            <div class="sign-left-main">
                                <div class="sign-thumb">
                                    <img src="{{asset('images/nav-logo.png')}}" alt="" class="img-fluid">
                                    </a>
                                </div>
                                <div class="new-text">
                                    <h6>Looks like you're new here!</h6>
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
                                <p>Have an account? <a href="{{ route('login') }}">SIGNIN</a></p>
                            </div>
                            <div class="signin-form-main">
                                <div class="sign-form-head">
                                    <h6>Sign up to</h6>
                                    <h5>
                                        Angelo Investment
                                    </h5>
                                </div>
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                                <div class="row">

                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="signin-field">
                                            <input type="text" placeholder="{{ __('First Name') }}" name="first_name"
                                                   value="{{ old('first_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="signin-field">
                                            <input type="text" placeholder="{{ __('Last Name') }}" name="last_name"
                                                   value="{{ old('last_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="signin-field">
                                            <input type="number" placeholder="{{ __('Phone Number') }}" name="phone"
                                                   value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="signin-field">
                                            <input type="email" placeholder="{{ __('Email') }}" name="email"
                                                   value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="signin-field">
                                            <input type="text" placeholder="{{ __('Create a username') }}"
                                                   name="username"
                                                   value="{{ old('username') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="signin-field">
                                            <input type="password" placeholder="{{ __('Password') }}" id="password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="signin-field">
                                            <input type="password" placeholder="{{ __('Confirm Password') }}"
                                                   name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="investor-check-main">
                                        <div class="row m-0">
                                            <div class="col-md-5 col-lg-7 col-sm-7 col-12">
                                                <div class="credited-investor">
                                                    <p>Are you an accredited investor? <a href="" data-bs-toggle="modal"
                                                                                          data-bs-target="#quote-popup"><i
                                                                class="fa-sharp fa-solid fa-circle-info"></i></a></p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-12">
                                                <div class="checkbox-main">
                                                    <div class="check-1">
                                                        <input type="radio" class="check-with-label" id="Yes"
                                                               data-bs-toggle="modal" data-bs-target="#hire-popup"
                                                               name="accredited_investor" value="yes"
                                                               data-error="#errNm1">
                                                        <label class="ch-lab" for="Yes">Yes</label>
                                                    </div>
                                                    <div class="check-1">
                                                        <input type="radio" class="check-with-label" id="No" value="no"
                                                               name="accredited_investor" data-error="#errNm1">
                                                        <label for="No" class="ch-lab">No</label>
                                                    </div>
                                                </div>
                                                <span id="errNm1"></span>
                                            </div>
                                            <div class="col-12">
                                                <div class="digital-updates">
                                                    <div class="checkbox-main">
                                                        <div class="check-1"><input type="checkbox"
                                                                                    class="check-with-label"
                                                                                    id="Receive"
                                                                                    name="recieve_digi_updates"
                                                                                    data-error="#errNm2"><label
                                                                class="ch-lab" for="Receive">Receive and digital updates
                                                                about investments, offerings, and Angelo Investments
                                                                news.</label></div>
                                                    </div>
                                                    <span id="errNm2"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sign-in-button">
                                        <x-button>
                                            {{ __('Sign UP') }}
                                        </x-button>
                                    </div>
                                    <div class="account-signin-text member-mobile">
                                        <p>Have an account? <a href="{{ route('login') }}">SIGNIN</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade wdraw-modal" id="hire-popup" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-modal="true" data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-slideout modal-wd" role="document">
                <div class="modal-content news-modal-content">
                    <div class="modal-body" id="msform">
                        <fieldset>
                            <div class="close-button cs-button">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="investor-head-main">
                                        <div class="investor-content-head">
                                            <h4>*Please click on the file name to upload the respective file. (Atleast one document required)
                                            </h4>
                                        </div>
                                        <div class="investor-content-head">
                                            <h4>You can demonstrate that you have an income that satisfies the
                                                requirements
                                                of being
                                                an Accredited Investor,
                                                by submitting to Angelo Investments, LLC any of the following
                                                documents;
                                            </h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="attatchment-listing">
                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="credit">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[credit_report]"
                                                                       data-doc-type="credit">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon>
                                                                </span>
                                                                <span class="file-upload-text">Credit report</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="IRS">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[irs]"
                                                                       data-doc-type="IRS">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon></span>
                                                                <span
                                                                    class="file-upload-text">IRS form or tax return</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="deeds">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[deeds]"
                                                                       data-doc-type="deeds">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon></span>
                                                                <span class="file-upload-text">Deeds or other evidence of ownership for real estate holdings</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="attatchment-listing">
                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="values-private">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[values_privates]"
                                                                       data-doc-type="values-private">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon></span>
                                                                <span class="file-upload-text">Value of private company securities holdings</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="proof-vehicle-ownership">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[proof_vehicle_ownership]"
                                                                       data-doc-type="proof-vehicle-ownership">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon></span>
                                                                <span class="file-upload-text">Proof of vehicle ownership</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="third-party">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[third_party]"
                                                                       data-doc-type="third-party">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon></span>
                                                                <span class="file-upload-text">Third-party valuation of property holdings</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="investor-head-main">
                                        <div class="investor-content-head">
                                            <h4>You can demonstrate that you have a net worth that qualifies you as
                                                an
                                                Accredited Investor by submitting to
                                                Angelo Investments, LLC by submitting any of the following
                                                documents;
                                            </h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="attatchment-listing">
                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="net-credit-report">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[net_credit_report]"
                                                                       data-doc-type="net-credit-report">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon></span>
                                                                <span class="file-upload-text">Credit report</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="investor-head-main">
                                        <div class="investor-content-head">
                                            <h4>As an alternative, persons can acquire and submit a letter from a
                                                third-party attesting as to the investor’s accreditation status
                                                so long as the grantor of the letter is one of the following:
                                            </h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="attatchment-listing">
                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="registered-broker">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[registered_broker]"
                                                                       data-doc-type="registered-broker">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon></span>
                                                                <span class="file-upload-text">A registered broker dealer</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="registered-investment">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[registered_investment]"
                                                                       data-doc-type="registered-investment">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon></span>
                                                                <span class="file-upload-text">A registered investment advisor</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="attatchment-listing">

                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="an-attorney">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[an_attorney]"
                                                                       data-doc-type="an-attorney">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon></span>
                                                                <span
                                                                    class="file-upload-text">An attorney; or</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="main-wrapper">
                                                        <div class="upload-main-wrapper" id="certified-accountant">
                                                            <div class="upload-wrapper">
                                                                <input type="file" class="upload-file"
                                                                       name="user_docs[certified_accountant]"
                                                                       data-doc-type="certified-accountant">
                                                                <span class="icon-hide">
                                                                    <ion-icon name="attach-outline"></ion-icon></span>
                                                                <span class="file-upload-text">A certified public accountant</span>
                                                                <div class="file-success-text">
                                                                    <svg version="1.1" id="check"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         x="0px" y="0px" viewBox="0 0 100 100"
                                                                         xml:space="preserve">
                                                                        <circle
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-miterlimit:10;"
                                                                            cx="49.799" cy="49.746" r="44.757"/>
                                                                        <polyline
                                                                            style="fill:rgba(0,0,0,0);stroke:#000;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                                                            points="
                                                                    27.114,51 41.402,65.288 72.485,34.205 "/>
                                                                    </svg>
                                                                    <span>
                                                                        <p class="file-upload-name"></p>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="next-button">
                                        <input type="button" name="next" class="next action-button attach-btn"
                                               value="ATTACH"/>
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        <fieldset>
                            <div class="col-md-8 offset-md-2 col-sm-8 col-12">
                                <div class="thanks-head">
                                    <h3>Thank You</h3>
                                    <p>Please review the attached files and confirm</p>
                                </div>
                                <div class="attached-files-main">

                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="prev-button sign-button">
                                            <a href="#" class="action-button previous">Back</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="next-button">
                                            <a href="#" class="action-button close-button">CONFIRM</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="quote-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-modal="true">
        <div class="modal-dialog modal-dialog-slideout modal-wd" role="document">
            <div class="modal-content help-modal-content">
                <div class="cancel-button cs-button">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div class="modal-body help-popup">
                    <div class="scrollbar" id="style-8">
                        <div class="force-overflow">
                            <div class="accredited-head">
                                <h4>An Accredited Investor is defined by the Securities and Exchange Commission to
                                    include a natural person with:</h4>
                                <p>1. A net worth or joint net worth with the persons spouse exceeding $1 million, not
                                    including the value of the primary residence, and/ or</p>
                                <p>2. An annual income of $200,000 in each of the two most recent years, or joint income
                                    with a spouse exceeding $300,000 for those years and a reasonable expectation of the
                                    same income in the current year.</p>
                                <p>Verification of net worth and/ or annual income is necessary for accreditation.</p>
                                <p>You can demonstrate that you have an income that satisfies the requirements of being
                                    an Accredited Investor, by submitting to Angelo Investments, LLC any of the
                                    following documents;
                                </p>
                                <ul class="accredited-md-listing">
                                    <li>-Credit report</li>
                                    <li>-IRS form or tax return</li>
                                    <li>-Deeds or other evidence of ownership for real estate holdings</li>
                                    <li>-Value of private company securities holdings</li>
                                    <li>-Proof of vehicle ownership</li>
                                    <li>-Third-party valuation of property holdings</li>
                                </ul>
                                <p>You can demonstrate that you have a net worth that qualifies you as an Accredited
                                    Investor by submitting to Angelo Investments, LLC by submitting any of the following
                                    documents;</p>
                                <ul class="accredited-md-listing">
                                    <li>-Credit report</li>
                                </ul>
                                <p>As an alternative, persons can acquire and submit a letter from a third-party
                                    attesting as to the investor’s accreditation status so long
                                    as the grantor of the letter is one of the following:</p>
                                <ul class="accredited-md-listing">
                                    <li>-A registered broker dealer;</li>
                                    <li>-A registered investment advisor;</li>
                                    <li>-An attorney; or</li>
                                    <li>-A certified public accountant</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
