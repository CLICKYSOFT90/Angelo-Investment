@extends('welcome')

@section('title')
    <title> Angele Investments | Offering Details</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.fancybox.min.css')}}">
@endsection

@section('content')
    <section class="banner-sec detail-banner"
             style="background-image: url({{ asset('offerings/banner/') }}/{{ !empty($offering->offering_bg) ? $offering->offering_bg : 'default-img.png' }})">
        <div class="banner-overlay detail-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="offering-head project-name-head">
                        <h5>Open for investment</h5>
                        <h1>{{ $offering->name }}</h1>
                        <p>*Please carefully review the Disclaimers section below, including regarding Sponsor’s
                            assumptions and target returns</p>
                        <div class="sign-button detail-button">
                            <a href="{{ route('offering-details.invest',$offering->id) }}" class="sign-btn">INVEST</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="offering-detail-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7 col-xl-7 col-sm-12 col-12">
                    <div class="detail-head">
                        <h3>
                            {{ $offering->name }}
                        </h3>
                        <p>
                            {{ htmlentities($offering->short_desc) }}
                        </p>
                    </div>
                    <div class="address-txt">
                        <h4>Address</h4>
                        <p>{{ $offering->address }}</p>
                    </div>

                    <div class="range-slider-main">
                        <div class="funds-main">
                            <div class="funding-received">
                                <h4>Funding Received:</h4>
                                <p>${{ $fund_recieved }}</p>
                            </div>
                            <div class="funding-received">
                                <h4>Funding Remaining:</h4>
                                <p>${{ $fund_remaining }}</p>
                            </div>
                        </div>

                        <div class="range-slider">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                     style="width: {{ $percentage }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div id="tooltip">
                                        <span>{{ $percentage }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sign-button progress-invest">
                        <a href="{{ route('offering-details.invest',$offering->id) }}" class="sign-btn">INVEST</a>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-xl-5 col-sm-12 col-12">
                    <div class="funding-listing-details">
                        <ul>
                            <li>Target IRR:<span>{{ $offering->target_irr }}%</span></li>
                            <li>Investment Type:<span>{{ $offering->investment_type }}</span></li>
                            <li>Project Type:<span>{{ $offering->project_type }}</span></li>
                            <li>Number of units:<span>#{{ $offering->no_of_units }}</span></li>
                            <li>Preferred Rate:<span>{{ $offering->preferred_rate }}%</span></li>
                            <li>Total Investment
                                Required:<span>${{ number_format($offering->investment_required) }}</span></li>
                            <li>Minimum Investment:<span>${{ number_format($offering->min_investments) }}</span></li>
                            <li>Estimated Construction
                                Completion:<span>{{ date('M, Y',strtotime($offering->est_construction_completion)) }}</span>
                            </li>
                            <li>Hold Period:<span>{{ $offering->hold_period }}</span></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="gallery-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="gallery-slider">
                        @foreach($offering->offeringImages as $images)
                            <div class="gallery-thumb">
                                <img src="{{ asset('offerings/gallery'.'/'.$images->image) }}" alt="" class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                    <div class="gallery-description">
                        <p>{{ htmlentities($offering->long_desc) }}</p>
                    </div>
                </div>
            </div>
            <div class="gallery-grid">
                <div class="row">
                    @foreach($offering->offeringVideos as $key => $video)
                        @if($key == 0)
                            <div class="col-md-9 col-sm-12 col-12">
                                <div class="gallery-grid-thumb">
                                    <img src="{{ asset('images/gallery-grid.png') }}" alt=""
                                         class="img-fluid grd-thumb">
                                    <div class="fold-video">
                                        <a href="{{ asset('offerings/videos'.'/'.$video->video) }}"
                                           data-fancybox="iframe"
                                           class="fold-vd-btn"><img src="{{ asset('images/play-btn.png') }}" alt=""
                                                                    class="img-fluid"></a>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if($key == 1)
                                <div class="col-md-3 col-sm-12 col-12">
                                    @endif
                                    <div class="gallery-right">
                                        <img src="{{ asset('images/gallery-grid.png') }}" alt="" class="img-fluid">
                                        <div class="fold-video">
                                            <a href="{{ asset('offerings/videos'.'/'.$video->video) }}"
                                               data-fancybox="iframe"
                                               class="fold-vd-btn"><img src="{{asset('images/play-btn.png')}}" alt=""
                                                                        class="img-fluid"></a>
                                        </div>
                                    </div>
                                    @if($key == 3)
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="disclaimers-content dis-content">
                <h4>Disclaimers</h4>
                <p>
                    {{ htmlentities($offering->disclaimer) }}
                </p>
            </div>
            <div class="documents-main">
                <div class="disclaimers-content doc-content">
                    <h4>Documents</h4>
                </div>
                <div class="row">
                    @foreach($offering->offeringDocuments as $doc)
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="document-card">
                                <div class="document-thumb">
                                    <a href="{{ asset('offerings/docs'.'/'.$doc->documents) }}" target="_blank"><img
                                            src="{{asset('images/download-thumb.png')}}" alt="" class="img-fluid"></a>
                                </div>
                                <div class="document-content">
                                    <p>{{ $doc->document_name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="doc-bottom">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sign-button d-center">
                                <a href="{{ route('offering-details.invest',$offering->id) }}" class="sign-btn">INVEST</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="other-offer-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="related-head">
                        <h3>Other Related Offers</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($related_offerings as $related_offering)
                    <div class="col-md-6 col-lg-4 col-xl-4 col-sm-12 col-12">
                        <div class="project-card-main">
                            <div class="project-thumb">
                                <div class="project-cd-overlay"></div>
                                <img src="{{ asset('offerings/banner/default-img.png') }}" alt=""
                                     class="img-fluid w-100">
                                <div class="funding-bar">
                                    <h4>Open for investment</h4>
                                </div>
                            </div>
                            <div class="project-card-content">
                                <h4 class="project-cost">{{ $related_offering->name }}
                                    <span>${{ number_format($related_offering->investment_required) }}</span></h4>

                                <div class="equity-listing">
                                    <ul>
                                        <li>{{ $related_offering->investment_type }}</li>
                                        <li>{{ $related_offering->project_type }}</li>
                                    </ul>
                                </div>
                                <p class="project-description">{{ htmlentities($related_offering->short_desc) }}</p>

                                <div class="address-content">
                                    <h6>Address:</h6>
                                    <h5>
                                        {{ $related_offering->address }}
                                    </h5>
                                </div>
                                <div class="project-details">
                                    <form action="">
                                        <div class="row justify-content-between">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="project-details-listing">
                                                    <div class="details-content">
                                                        <h6>Minimum Investment:</h6>
                                                        <p>${{ number_format($related_offering->min_investments) }}</p>
                                                    </div>
                                                    <div class="details-content">
                                                        <h6>Estimated Construction Completion:</h6>
                                                        <p>{{ date('M, Y', strtotime($related_offering->est_construction_completion)) }}</p>
                                                    </div>
                                                    <div class="details-content">
                                                        <h6>Preferred Rate:</h6>
                                                        <p>{{ $related_offering->preferred_rate }}%</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="project-details-listing pr-details-right">
                                                    <div class="details-content">
                                                        <h6>Number of units:</h6>
                                                        <p>#{{ $related_offering->no_of_units }}</p>
                                                    </div>
                                                    <div class="details-content">
                                                        <h6>Hold Period:</h6>
                                                        <p>{{ $related_offering->hold_period }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @auth
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="progres-bar-main">
                                                        <div class="progress-details">
                                                            <div class="progress-fund"><p>Funded:</p></div>
                                                            <div class="progress-percent">
                                                                <p>{{ $related_offering->percentage }}%</p>
                                                            </div>
                                                        </div>
                                                        <div class="progress">

                                                            <div class="progress-bar" role="progressbar"
                                                                 aria-label="Basic example" style="width: {{ $related_offering->percentage }}%"
                                                                 aria-valuenow="25" aria-valuemin="0"
                                                                 aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="sign-button pr-card">
                                                        <a href="{{ route('offering-details', $related_offering->of_id) }}"
                                                           class="sign-btn">View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="sign-button pr-card">
                                                        <a href="{{ route('register') }}" class="sign-btn">Sign
                                                            Up</a>
                                                        <p>"To view Target IRR and other details, please
                                                            signup."</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endauth
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="sign-button d-center view-all">
                        <a href="{{ route('open-investments') }}" class="sign-btn">VIEW ALL</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('js/slick.min.js')}}"></script>
    <script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
    <script>
        $('.gallery-slider').slick({
            dots: false,
            infinite: true,
            arrows: true,
            autoplay: true,
            speed: 800,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        arrows: false,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 790,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,

                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick "
                // instead of a settings object
            ]
        });

    </script>
@endsection
