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
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Newsletter /</span> List</h4>
    <div class="card">
        <div class="card-header flex-column flex-md-row">
            <div class="dt-action-buttons text-end pt-3 pt-md-0">
                <a href="{{ route('admin.export.csv') }}" class="dt-button create-new btn btn-primary">Export CSV</a>
                <a href="{{ route('admin.export.xlsx') }}" class="dt-button create-new btn btn-primary">Export Excel</a>
            </div>
        </div>
        <div class="card-datatable table-responsive pt-0">

            <table class="datatables-basic table table-bordered users-list">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
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
                ajax: "{{ route('admin.newsletter.list') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        });

        function removeUser(id) {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure you want to remove from newsletter subscription?',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#3ea99d',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('admin.newsletter.user.remove') }}",
                        method: 'post',
                        data: {
                            id: id,
                            status: status,
                        },
                        success: function (result) {
                            if (result.status == true) {
                            console.log(result.message)
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
                        },
                        error: function (result){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Warning',
                                text: "User not found",
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }
    </script>
@endsection
