@extends('layouts.admin.layout')

@section('title')
<title>Angelo Investments | Admin Dashboard::Offerings Listing</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Offerings /</span> List</h4>
    <div class="nav-align-top mb-4">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button
                    type="button"
                    class="nav-link active"
                    role="tab"
                    data-bs-toggle="tab"
                    data-bs-target="#navs-top-home"
                    aria-controls="navs-top-home"
                    aria-selected="true"
                >
                    Current Offerings
                </button>
            </li>
            <li class="nav-item">
                <button
                    type="button"
                    class="nav-link"
                    role="tab"
                    data-bs-toggle="tab"
                    data-bs-target="#navs-top-profile"
                    aria-controls="navs-top-profile"
                    aria-selected="false"
                >
                    Completed Offerings
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="datatables-basic table table-bordered current-offerings-list">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Minimum Investment</th>
                                <th>Total Investments Required</th>
                                <th>Investment Received</th>
                                <th>Target IRR</th>
                                <th>Actual IRR</th>
                                <th>Project Type</th>
                                <th>Status</th>
                                <th>Funded</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                <div class="card">
                    <div class="card-datatable table-responsive pt-0">
                        <table class="datatables-basic table table-bordered completed-offerings-list">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Minimum Investment</th>
                                <th>Total Investments Required</th>
                                <th>Investment Received</th>
                                <th>Target IRR</th>
                                <th>Actual IRR</th>
                                <th>Project Type</th>
                                <th>Status</th>
                                <th>Completed</th>
                                <th>Action</th>
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
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.current-offerings-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.offerings.current.list') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'min_investments'},
                    {data: 'total_investments'},
                    {data: 'investment_received'},
                    {data: 'irr'},
                    {data: 'actual_irr'},
                    {data: 'project_type'},
                    {data: 'status'},
                    {data: 'completed'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        });
        $(function () {
            var table = $('.completed-offerings-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.offerings.completed.list') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'min_investments'},
                    {data: 'total_investments'},
                    {data: 'investment_received'},
                    {data: 'irr'},
                    {data: 'actual_irr'},
                    {data: 'project_type'},
                    {data: 'status'},
                    {data: 'completed'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
