@extends('layouts.admin.layout')

@section('title')
    <title>Angelo Investments | Admin Dashboard::Offerings Investments</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}"/>
    <link rel="stylesheet"
          href="{{asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}"/>
    <link rel="stylesheet"
          href="{{asset('admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}"/>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Offerings /</span> Investments</h4>

    <div class="row gy-4">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <div class="user-info text-center">
                                <h5 class="mb-2">{{$offering->name}}</h5>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-2 border-bottom mb-4">Details</h5>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold me-2">Investment Type:</span>
                                <span>{{$offering->investment_type}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Project Type:</span>
                                <span>{{$offering->project_type}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Minimum Investment:</span>
                                <span>{{'$'.number_format($offering->min_investments)}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Hold Period:</span>
                                <span>{{$offering->hold_period}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Target IRR:</span>
                                <span>{{$offering->target_irr}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Est. Construction Completion:</span>
                                <span>{{$offering->est_construction_completion}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Preferred Rate:</span>
                                <span>{{'$'.number_format($offering->preferred_rate)}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Investment Required:</span>
                                <span>{{'$'.number_format($offering->investment_required)}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">No. Of Shares:</span>
                                <span>{{number_format($offering->no_of_shares)}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Price Per Share:</span>
                                <span>{{'$'.number_format($offering->price_per_share)}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">No. Of Units:</span>
                                <span>{{number_format($offering->no_of_units)}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Status:</span>
                                <span>{{$offering->status ? 'Active' : 'Inactive'}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Progress:</span>
                                <div class="d-flex flex-column"><small class="mb-1">{{ $offering->percentage }}%</small>
                                    <div class="progress w-100 me-3" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: {{ $offering->percentage }}%" aria-valuenow="78%"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /User Card -->
        </div>
        <!--/ User Sidebar -->

        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

            <!-- Project table -->
            <div class="card mb-4">
                <h5 class="card-header">Offering Investments</h5>
                <div class="card-datatable table-responsive pt-0">
                    <table class="datatables-basic table table-bordered users-list">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>User</th>
                            <th>Amount Invested</th>
                            <th>No Of Shares</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /Project table -->
        </div>
        <!--/ User Content -->
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.users-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.offerings.investments.list', $offering->of_id) }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'user_id'},
                    {data: 'amount_invested'},
                    {data: 'no_of_shares'},
                ]
            });
        });
    </script>
@endsection
