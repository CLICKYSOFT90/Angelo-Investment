@extends('welcome')

@section('title')
<title> Angele Investments | Past Investments</title>
@endsection

@section('styles')

@endsection

@section('content')
    <section class="banner-sec">
        <div class="banner-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="offering-head">
                        <h1>Past Investments</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the
                            industry's standard dummy text ever since the 1500s.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sort-projects-sec">
        <div class="container">
            <div class="sorting-filters position-relative" id="scroll-div">
                <div class="row">
                    <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                        <div class="sorting-fields">
                            <label for="sort-by">
                                Sort By:
                            </label>
                            <select name="" class="project-filter" id="sort_by">
                                <option value="">Select</option>
                                {{--                                <option value="Recently Added" selected>Recently Added</option>--}}
                                <option value="irr">IRR</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                        <div class="sorting-fields">
                            <label for="invest-by">
                                Investment type:
                            </label>
                            <select name="" class="project-filter" id="investment_type">
                                <option value="">Select</option>
                                <option value="Equity">Equity</option>
                                <option value="Fund">Fund</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                        <div class="sorting-fields m-0">
                            <label for="sort-by">
                                Project type:
                            </label>
                            <select name="" class="project-filter" id="project_type">
                                <option value="">Select</option>
                                <option value="Value- Add">Value- Add</option>
                                <option value="Development">Development</option>
                                <option value="REIT">REIT</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if($filter)
                    <div class="">
                        <a href="{{ route('past-investments') }}" class="clear-filter">
                            <i class="fa fa-times-circle"></i>
                        </a>
                    </div>
                @endif
            </div>
            <div class="projects-card">
                <div class="row">
                    @if(count($offerings) > 0)
                        @foreach($offerings as $offering)
                            <div class="col-md-6 col-lg-4 col-xl-4 col-sm-12 col-12">
                                <div class="project-card-main">
                                    <div class="project-thumb">
                                        <div class="project-cd-overlay"></div>
                                        <img src="{{ asset('offerings/banner/default-img.png') }}" alt=""
                                             class="img-fluid w-100">
                                        <div class="funding-bar">
                                            <h4>Past investments</h4>
                                        </div>
                                    </div>
                                    <div class="project-card-content">
                                        <h4 class="project-cost">{{ $offering->name }}
                                            <span>${{ number_format($offering->investment_required) }}</span></h4>

                                        <div class="equity-listing">
                                            <ul>
                                                <li>{{ $offering->investment_type }}</li>
                                                <li>{{ $offering->project_type }}</li>
                                            </ul>
                                        </div>
                                        <p class="project-description">{{ htmlentities($offering->short_desc) }}</p>

                                        <div class="address-content">
                                            <h6>Address:</h6>
                                            <h5>
                                                {{ $offering->address }}
                                            </h5>
                                        </div>
                                        <div class="project-details">
                                            <form action="">
                                                <div class="row justify-content-between">
                                                    <div class="col-md-6 col-sm-6 col-12">
                                                        <div class="project-details-listing">
                                                            <div class="details-content">
                                                                <h6>Minimum Investment:</h6>
                                                                <p>${{ number_format($offering->min_investments) }}</p>
                                                            </div>
                                                            <div class="details-content">
                                                                <h6>Estimated Construction Completion:</h6>
                                                                <p>{{ date('M, Y', strtotime($offering->est_construction_completion)) }}</p>
                                                            </div>
                                                            <div class="details-content">
                                                                <h6>Preferred Rate:</h6>
                                                                <p>{{ $offering->preferred_rate }}%</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-12">
                                                        <div class="project-details-listing pr-details-right">
                                                            <div class="details-content">
                                                                <h6>Number of units:</h6>
                                                                <p>#{{ $offering->no_of_units }}</p>
                                                            </div>
                                                            <div class="details-content">
                                                                <h6>Hold Period:</h6>
                                                                <p>{{ $offering->hold_period }}</p>
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
                                                                        <p>{{ $offering->percentage }}%</p>
                                                                    </div>
                                                                </div>
                                                                <div class="progress">

                                                                    <div class="progress-bar" role="progressbar"
                                                                         aria-label="Basic example" style="width: {{ $offering->percentage }}%"
                                                                         aria-valuenow="10" aria-valuemin="0"
                                                                         aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="sign-button pr-card">
                                                                <a href="{{ route('offering-details', $offering->of_id) }}"
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
                    @else
                        <div class="no-records">No Offerings to show</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="cs-pagination">
                    {{ $offerings->links('offerings.pagination')}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.project-filter').on('change', function () {
            let filter_type = $(this).attr('id');
            let selected_val = $(this).val();
            let url = '{{ url('offerings/past-investments').'/' }}' + filter_type + '/' + selected_val;
            {{--let url = '{{ route('open-investments').'?' }}' + filter_type + '=' + selected_val;--}}
                window.location.href = url;
        })
    </script>
@endsection
