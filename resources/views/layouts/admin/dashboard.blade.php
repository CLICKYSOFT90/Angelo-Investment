@extends('layouts.admin.layout')

@section('title')
    <title>Angelo Investments | Admin Dashboard</title>
@endsection

@section('styles')

@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-primary">
                                    <i class="bx bx-user fs-3"></i>
                                </span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Total Investors</span>
                            <h2 class="mb-0">{{ $all_users }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-success">
                                    <i class="bx bx-user fs-3"></i>
                                </span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Accredited Investors</span>
                            <h2 class="mb-0">{{ $accerited }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-danger">
                                    <i class="bx bx-user fs-3"></i>
                                </span>
                            </div>
                            <span class="d-block mb-1 text-nowrap"> Normal investors</span>
                            <h2 class="mb-0">{{ $normal }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-primary">
                                    <i class="bx bx-home fs-3"></i>
                                </span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Total Offerings</span>
                            <h2 class="mb-0">{{ $total_offerings }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-success">
                                    <i class="bx bx-home fs-3"></i>
                                </span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Live Offerings</span>
                            <h2 class="mb-0">{{ $current_offerings }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-danger">
                                    <i class="bx bx-home fs-3"></i>
                                </span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Completed Offerings</span>
                            <h2 class="mb-0">{{ $completed_offerings }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-danger">
                                    <i class="bx bx-dollar fs-3"></i>
                                </span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Total Investments</span>
                            <h2 class="mb-0">${{ number_format($total_investments) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-danger">
                                    <i class="bx bx-user fs-3"></i>
                                </span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Accredited Investor Request</span>
                            <h2 class="mb-0">{{ $accerited_request }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-label-danger">
                                    <i class="bx bx-dollar fs-3"></i>
                                </span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">New Withdrawals Request</span>
                            <h2 class="mb-0">{{ $new_withdrawals_requests }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    </div>
    <!-- Content wrapper -->
@endsection

@section('scripts')
@endsection
