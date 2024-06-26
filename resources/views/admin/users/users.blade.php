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
            <table class="datatables-basic table table-bordered users-list">
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
            var table = $('.users-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.list') }}",
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
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        });

        function changeStatus(id, status) {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure you want to change the status?',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#3ea99d',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('admin.users.status.change') }}",
                        method: 'post',
                        data: {
                            id: id,
                            status: status,
                        },
                        {{--beforeSend: function() {--}}
                        {{--    $(ref).html('{{ __('shares.Please wait') }}'+'...');--}}
                        {{--},--}}
                        success: function (result) {
                            if (result.status == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: result.message,
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                                location.reload();
                            }
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }
    </script>
@endsection
