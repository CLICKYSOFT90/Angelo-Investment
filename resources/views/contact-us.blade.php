@extends('welcome')
@section('title')
    <title> Angele Investments | Contact Us</title>
@endsection
@section('styles')

@endsection

@section('content')
    <section class="banner-sec contact-banner">
        <div class="banner-overlay contact-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="offering-head contact-us-head">
                        <h1>Contact Us</h1>
                        <p>Design under process, and awaiting finalized content.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="get-in-touch-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="get-in-head">
                        <h2>
                            Get in Touch
                        </h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley
                            of type and scrambled it to make a type specimen book. </p>
                    </div>
                </div>
            </div>
            <div class="get-in-cards-main">
                <div class="row custom-gutter">
                    <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                        <div class="get-in-card">
                            <div class="get-in-thumb">
                                <img src="{{asset('images/location.png')}}" alt="" class="img-fluid">
                            </div>
                            <div class="get-in-content">
                                <h4>Address</h4>
                                <p>Angelo Investments 545 Shoup Ave, Ste. 244 Idaho Falls, ID 83402</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                        <div class="get-in-card">
                            <div class="get-in-thumb">
                                <img src="{{asset('images/envelope.png')}}" alt="" class="img-fluid">
                            </div>
                            <div class="get-in-content">
                                <h4>Email</h4>
                                <p>info@angelodevco.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                        <div class="get-in-card">
                            <div class="get-in-thumb">
                                <img src="{{asset('images/phone.png')}}" alt="" class="img-fluid">
                            </div>
                            <div class="get-in-content">
                                <h4>Phone</h4>
                                <p>(208) 408-0121</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="g-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2894.4277688399743!2d-112.04143062370072!3d43.49341106275075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5354594e32881709%3A0x92b662be9b4ba7c4!2sGolden%20Crown%20Lounge!5e0!3m2!1sen!2sus!4v1672582394109!5m2!1sen!2sus"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <div class="contact-us-form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="get-in-head">
                            <h2>
                                Have any Question?
                            </h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has
                                been
                                the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                                galley
                                of type and scrambled it to make a type specimen book. </p>
                        </div>
                    </div>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="contact-field">
                                <input type="text" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="contact-field">
                                <input type="text" placeholder="Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="contact-field">
                                <input type="number" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="contact-field">
                                <input type="email" placeholder="Email Address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-field">
                                <textarea name="" id="" cols="12" rows="8" placeholder="Your Message"></textarea>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="sign-button send-button">
                                <button type="submit" class="sign-btn">Send</button>
                            </div>

                        </div>
                    </div>
                </form>

            </div>

        </div>

    </section>
@endsection

@section('scripts')

@endsection
