@extends('welcome')

@section('title')
    <title> Angele Investments | Offering Invest</title>
@endsection

@section('styles')
@endsection

@section('content')
    <section class="banner-sec detail-banner detail-2"
             style="background-image: url({{ asset('offerings/banner/') }}/{{ !empty($offering->offering_bg) ? $offering->offering_bg : 'default-img.png' }})">
        <div class="banner-overlay detail-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-12">
                    <div class="offering-head project-name-head detail-project-2">
                        <h1>{{ $offering->name }}</h1>
                        <p>{{ $offering->address }}</p>
                        <div class="ec-listing">
                            <ul>
                                <li>{{ $offering->target_irr }}%</li>
                                <li>{{ $offering->investment_type }}</li>
                                <li>{{ $offering->project_type }}</li>
                            </ul>
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
                        <h4>Investment Info</h4>
                        <h3>
                            Offer to Invest in {{ $offering->name }}
                        </h3>

                    </div>
                    <form action="{{ route('investor.invest') }}" method="post" id="invest-form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="offering_id" value="{{ $offering->id }}">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="shares-fields">
                                    <label for="no_of_shares">No of Shares</label>
                                    <input type="text" placeholder="1" id="no_of_shares" name="no_of_shares">
                                    <p class="shares-bottom">Share Value: 1 share =
                                        ${{ number_format($offering->price_per_share) }}</p>
                                    @if ($errors->has('no_of_shares'))
                                        <span class="text-danger">{{ $errors->first('no_of_shares') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="shares-fields">
                                    <label for="investment_amount">Investment Amount</label>
                                    <input type="number" placeholder="{{ number_format($offering->price_per_share) }}"
                                           id="investment_amount" name="investment_amount" readonly>
                                    <p class="shares-bottom">${{ number_format($offering->min_investments) }} Minimum
                                        investment commitment</p>
                                    @if ($errors->has('investment_amount'))
                                        <span class="text-danger">{{ $errors->first('investment_amount') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($offering->offeringRequiredDocuments) > 0)
                            <div class="agree-terms">
                                <p class="agree-txt">Before invest please sign below documents</p>
                                @foreach($offering->offeringRequiredDocuments as $key => $docs)
                                    <a href="{{ asset('offerings/docs'.'/'.$docs->documents) }}" target="_blank">{{ $docs->document_name }}</a>
                                    <br>
                                @endforeach
                            </div>
                        @endif
                        <div class="agree-terms">
                            <p class="agree-txt">By Clicking the Submit Button you are agreeing to the following:
                            </p>
                            <div class="checkbox-main dfr-column">
                                <div class="check-1 d-gap">
                                    <input type="checkbox" class="check-with-label" id="Receive">
                                    <label class="ch-lab" for="Receive">
                                        Lorem ipsum is simply a dummy text of the printing and the typesetting industry.
                                    </label>
                                </div>
                                <div class="check-1 d-gap">
                                    <input type="checkbox" class="check-with-label" id="agree">
                                    <label class="ch-lab" for="agree">
                                        Lorem ipsum is simply a dummy text of the printing and the typesetting industry.
                                    </label>
                                </div>
                            </div>
                            <div class="cancel-invest sign-button">
                                <a href="{{ route('offering-details',$offering->id) }}" class="sign-btn sme-width">Cancel</a>
                                @auth()
                                    <button type="submit" class="invest-btn sme-width">Submit</button>
                                @else
                                    <a href="javascriptvoid:(0)" class="invest-btn sme-width">Sign UP</a>
                                @endauth
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 col-lg-5 col-xl-5 col-sm-12 col-12">
                    <div class="funding-listing-details fd-listing-2">
                        <ul>

                            <li>Number of units:<span>#{{ $offering->no_of_units }}</span></li>
                            <li>Preferred Rate:<span>{{ $offering->preferred_rate }}%</span></li>
                            <li>Total Investment
                                Required:<span>${{ number_format($offering->investment_required) }}</span></li>
                            <li>Minimum Investment:<span>${{ number_format($offering->min_investments) }}</span></li>
                            <li>Estimated Construction
                                Completion:<span>{{ date('M, Y',strtotime($offering->est_construction_completion)) }}</span>
                            <li>Hold Period:<span>{{ $offering->hold_period }}</span></li>


                        </ul>
                        <div class="range-slider-main rs-2-slider">
                            <div class="funds-main">
                                <div class="funding-received fd-2-received">
                                    <h4>Funding Received:</h4>
                                    <p>${{ $fund_recieved }}</p>
                                </div>
                                <div class="funding-received fd-2-received">
                                    <h4>Funding Remaining:</h4>
                                    <p>${{ $fund_remaining }}</p>
                                </div>
                            </div>

                            <div class="range-slider">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                         style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                         aria-valuemin="0" aria-valuemax="{{ $percentage }}">
                                        <div id="tooltip">
                                            <span>{{ $percentage }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('#no_of_shares').on('keyup', function () {
            let value = $(this).val();
            let amount = value * {{ $offering->price_per_share }};
            $('#investment_amount').val(amount);
        })
        $.validator.addMethod("min_investments", function (value, element) {
            let min_investment = {{ $offering->min_investments }};
            let amount = value * {{ $offering->price_per_share }};
            return this.optional(element) || (min_investment <= amount);
        }, "You cannot invest lesser than minimum investment");

        $.validator.addMethod("check_total_shares", function (value, element) {
            let max_shares = {{ $offering->no_of_shares }} - {{ $invested_shares }};
            return this.optional(element) || (value <= max_shares);
        }, "You cannot purchase more than remaining shares");

        $.validator.addMethod("check_wallet", function (value, element) {
            let wallet_amount = {{ getUserWallet(auth()->user()->id) }};
            return this.optional(element) || (value <= wallet_amount);
        }, "You dont have enough balance in your wallet");

        $.validator.addMethod("check_investment_limit", function (value, element) {
            let limit = {{ $investment_limit->limit }};
            let amount = value * {{ $offering->price_per_share }};
            let total_invested = {{ $user_all_transactions }};
            let total_amount = amount + total_invested;
            if ({{ auth()->user()->accredited_investor }} !== 1) {
                return this.optional(element) || (total_amount <= limit);
            } else {
                return true;
            }
        }, "You cannot invest more than your limit, Please upgrade your account.");

        $.validator.addMethod("check_is_taxed", function (value, element) {
            return this.optional(element) || ({{ auth()->user()->is_tax_form }} == 1);
        }, "Please upload your tax form before investing.");

        $('#invest-form').validate({
            rules: {
                no_of_shares: {
                    required: true,
                    digits: true,
                    min_investments: true,
                    check_total_shares: true,
                    check_investment_limit: true,
                    // check_is_taxed: true,
                },
                investment_amount: {
                    required: true,
                    check_wallet: true
                }
            },
            messages: {
                no_of_shares: {
                    required: "This field is required",
                    digits: "Please enter positive number"
                },
            },
            // errorElement : 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    </script>
@endsection
