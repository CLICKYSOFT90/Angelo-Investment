@extends('layouts.admin.layout')

@section('title')
    <title>Angelo Investments | Admin Dashboard::View User Details</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Users /</span> View</h4>
    <div class="row gy-4">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded my-4" src="{{$user->image}}" height="110" width="110" alt="User avatar">
                            <div class="user-info text-center">
                                <h5 class="mb-2">{{$user->name}}</h5>
                            </div>
                        </div>
                    </div>
                    <h5 class="pb-2 border-bottom mb-4">Details</h5>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="fw-bold me-2">Username:</span>
                                <span>{{$user->username}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Email:</span>
                                <span>{{$user->email}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Contact:</span>
                                <span>{{$user->phone}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Accredited Investor:</span>
                                <span>{{$user->accredited_investor ? 'Yes' : 'No'}}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-bold me-2">Receive Digital Updates:</span>
                                <span>{{$user->recieve_digi_updates ? 'Yes' : 'No'}}</span>
                            </li>
                            @if($user->is_tax_form)
                                <li class="mb-3">
                                    <span class="fw-bold me-2">W9 Tax Form:</span>
                                    <span><a href="{{asset('user-tax-form/'.$user->w9_taxform)}}" target="_blank">{{$user->w9_taxform}}</a></span>
                                </li>
                            @endif
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
                <h5 class="card-header">User's Offerings</h5>
                <div class="card-datatable table-responsive pt-0">
                    <table class="datatables-basic table table-bordered users-list">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Offering</th>
                            <th>Amount Invested</th>
                            <th>No. Of Shares</th>
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

    <script>
        $(function () {
            var table = $('.users-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.offering-investments', $user->id) }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'offering_id'},
                    {data: 'amount_invested'},
                    {data: 'no_of_shares'},
                ]
            });
        });
    </script>

@endsection
