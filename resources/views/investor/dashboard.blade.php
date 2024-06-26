@extends('layouts.investor.layout')

@section('title')
    <title>Angelo Investments | Investor Dashboard</title>
@endsection

@section('styles')

@endsection

@section('content')
    <section class="wallet-distributions-sec">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                @if(auth()->user()->is_tax_form == 0)
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            Please upload your tax form by clicking <a href="{{ route('investor.settings') }}"
                                                                       class="link-primary">here</a>.
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="dashbard-head">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="wallet-boxes">
                <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 col-sm-12">
                        <div class="wallet-box">
                            <div class="wallet-content">
                                <h6>MY WALLET</h6>
                                <h5>${{ number_format(getUserWallet(auth()->user()->id), 2) }}</h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3 col-sm-12">
                        <div class="wallet-box">
                            <div class="wallet-content">
                                <h6>WITHDRAWAL</h6>
                                <h5>${{ number_format(getUserWithdrawls(auth()->user()->id), 2) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3 col-sm-12">
                        <div class="wallet-box">
                            <div class="wallet-content">
                                <h6>TOTAL INVESTED</h6>
                                <h5>${{ number_format(getUserInvestments(auth()->user()->id), 2) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3 col-sm-12">
                        <div class="wallet-box">
                            <div class="wallet-content">
                                <h6>TOTAL DISTRIBUTIONS</h6>
                                <h5>${{ number_format(getUserProfit(auth()->user()->id), 2) }}</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="transaction-sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-8 col-sm-12 col-12">
                    <div class="table-main">

                        <div class="table-header">
                            <div class="table-head">
                                <h4>Transaction</h4>
                            </div>
                            <div class="view-table-button">
                                <button class="view-all-table"
                                        onclick="window.location='{{ route('investor.transactions') }}'">View All
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table transaction">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Transaction Type</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-4 col-lg-4 col-sm-4 col-12">
                    <div class="recent-invested-card">
                        <div class="recent-invested-head">
                            <h4>Recent Invested</h4>
                        </div>
                        <div class="recent-invested-scroll">
                            @foreach($recent_investments as $recent_investment)
                                <div class="recent-invested-project">
                                    <div class="recent-thumb">
                                        <img src="{{ asset('offerings/banner').'/' }}{{ !empty($recent_investment->offering->offering_bg) ? $recent_investment->offering->offering_bg : 'default-img.png' }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="recent-project-content">
                                        <div class="recent-project-header">
                                            <div class="project-name">
                                                <h5 class="recent-project-head" data-bs-toggle="tooltip"
                                                    data-bs-title="{{ $recent_investment->offering->name }}" onclick="window.location.href = '{{ route('offering-details', $recent_investment->offering->id) }}'">{{ $recent_investment->offering->name }}</h5>
                                                <div class="tooltip bs-tooltip-top" role="tooltip">
                                                    <div class="tooltip-arrow"></div>
                                                    <div class="tooltip-inner">
                                                        {{ $recent_investment->offering->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="project-cost">
                                                <span>${{ number_format($recent_investment->offering->investment_required) }}</span>
                                            </div>
                                        </div>
                                        <div class="equity-recent">
                                            <ul>
                                                <li>{{ $recent_investment->offering->investment_type }}</li>
                                                <li>{{ $recent_investment->offering->project_type }}</li>
                                            </ul>
                                        </div>
                                        <p class="project-description">
                                            {{ htmlentities($recent_investment->offering->short_desc) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function () {
            var table = $('.transaction').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.transactions.listing') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'date'},
                    {data: 'type'},
                    {data: 'amount'},
                    {data: 'status'},
                ]
            });
        });
    </script>
@endsection

