@extends('layouts.investor.layout')

@section('title')
    <title>Angelo Investments | Portfolio</title>
@endsection

@section('styles')

@endsection

@section('content')
    <section class="wallet-distributions-sec">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="dashbard-head">
                        <h1>Portfolio</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabs-animated">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active "><a href="#tab1" aria-controls="tab1"
                                                                       role="tab" data-bs-toggle="tab" class="active">Current
                                    Investments</a></li>
                            <li role="presentation"><a href="#tab2" class="m-0" aria-controls="tab2"
                                                       role="tab" data-bs-toggle="tab">Completed Investments</a></li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-0">
                            <div role="tabpanel" class="tab-pane fade in active show" id="tab1">

                                <div class="table-main portfolio-table">

                                    <div class="table-header">
                                        <div class="table-head">
                                            <h4>Current Investments</h4>
                                        </div>

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table curr_investments">
                                            <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Investment Required</th>
                                                <th scope="col">Invested</th>
                                                <th scope="col">Units</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Holding Period</th>
                                                <th scope="col">IRR</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab2">

                                <div class="table-main portfolio-table">

                                    <div class="table-header">
                                        <div class="table-head">
                                            <h4>Completed Investments</h4>
                                        </div>

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table comp_investments">
                                            <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Investment Required</th>
                                                <th scope="col">Invested</th>
                                                <th scope="col">Units</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Holding Period</th>
                                                <th scope="col">IRR</th>
                                                <th scope="col">Actual IRR</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
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
        $(function () {
            var table = $('.curr_investments').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.portfolio.current.investments') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'name'},
                    {data: 'type'},
                    {data: 'investment_required'},
                    {data: 'invested'},
                    {data: 'units'},
                    {data: 'date'},
                    {data: 'holding_period'},
                    {data: 'irr'},
                    {data: 'action'},

                ]
            });
        });
        $(function () {
            var table = $('.comp_investments').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.portfolio.completed.investments') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'name'},
                    {data: 'type'},
                    {data: 'investment_required'},
                    {data: 'invested'},
                    {data: 'units'},
                    {data: 'date'},
                    {data: 'holding_period'},
                    {data: 'irr'},
                    {data: 'actual_irr'},
                    {data: 'action'},

                ]
            });
        });
    </script>
@endsection

