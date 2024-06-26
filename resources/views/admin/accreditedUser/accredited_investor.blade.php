@extends('layouts.admin.layout')

@section('title')
    <title>Angelo Investments | Admin Dashboard::Users Listing</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Users /</span> List</h4>
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-bordered user-list">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Joined</th>
                    <th>Accredited Investor</th>
                    <th>Receive Digital Updates</th>
                    <th>Tax Filled</th>
                    <th>Status</th>
                    <th>Approval</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.user-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.current.accredited.investor') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'username'},
                    {data: 'email'},
                    {data: 'phone'},
                    {data: 'date_joined'},
                    {data: 'accredited_investor'},
                    {data: 'recieve_digi_updates'},
                    {data: 'tax_filled'},
                    {data: 'status'},
                    {data: 'accredited_investor_approval'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
