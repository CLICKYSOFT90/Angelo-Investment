@extends('layouts.investor.layout')

@section('title')
    <title>Angelo Investments | Transactions Listing</title>
@endsection

@section('styles')

@endsection

@section('content')
    <section class="wallet-distributions-sec">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="dashbard-head">
                        <h1>Transaction</h1>
                    </div>
                </div>
            </div>
            <div class="wallet-boxes">
                <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 col-sm-12 col-12">
                        <div class="wallet-box">
                            <div class="wallet-content">
                                <h6>Deposits</h6>
                                <h5>${{ number_format(getUserDeposits(auth()->user()->id), 2) }}</h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3 col-sm-12 col-12">
                        <div class="wallet-box">
                            <div class="wallet-content">
                                <h6>Withdrawals</h6>
                                <h5>${{ number_format(getUserWithdrawls(auth()->user()->id), 2) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3 col-sm-12 col-12">
                        <div class="wallet-box">
                            <div class="wallet-content">
                                <h6>Total Investments</h6>
                                <h5>${{ number_format(getUserInvestments(auth()->user()->id), 2) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3 col-xm-12 col-12">
                        <div class="wallet-box">
                            <div class="wallet-content">
                                <h6>Distribution/Profit</h6>
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
                <div class="col-md-12">
                    <div class="table-main ">
                        <div class="table-header">
                            <div class="table-head">
                                <h4>Transaction</h4>
                            </div>
                            <div class="balance-cost">
                                <h6>Balance: <span>${{ number_format(getUserWallet(auth()->user()->id), 2) }}</span></h6>
                            </div>
                        </div>
                        <div class="transaction-table">
                            <div class="table-responsive ">
                                <table class="table table-fixed transaction">
                                    <thead>
                                    <tr class="sticky-table-headers__sticky">
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Transaction Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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

