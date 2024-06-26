@extends('layouts.admin.layout')

@section('title')
<title>Angelo Investments | Admin Dashboard::Transactions Listing</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Transactions /</span> List</h4>
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>
                        Search by Date : <input class="form-control input-lg" type="text" name="date_range" id="date_range">
                    </label>
                    <button class="btn btn-primary" onclick="reloadDataTable()">Reset</button>
                </div>
            </div>
            <table class="datatables-basic table table-bordered transactions-list">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('admin/assets/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
    <script type="text/javascript">
        var g_date_from = '';
        var g_date_to = '';
        $(function () {
            loadDataTable()

            $('#date_range').daterangepicker({
            }, function(start, end, label) {
                $('.transactions-list').DataTable().destroy();
                g_date_from = start.format('YYYY-MM-DD');
                g_date_to = end.format('YYYY-MM-DD');
                loadDataTable(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            });
        });

        function reloadDataTable(){
            if ( ! $.fn.DataTable.isDataTable( '.transactions-list' ) ) {
                loadDataTable()
            } else{
                $('.transactions-list').DataTable().destroy();
                loadDataTable();
            }
        }

        function loadDataTable(date_from = '', date_to = ''){

            var table = $('.transactions-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{route('admin.transactions.list')}}',
                    data: {
                        date_from: date_from ?? g_date_from,
                        date_to: date_to ?? g_date_to,
                    }
                },
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'date'},
                    {data: 'type'},
                    {data: 'amount'},
                    {data: 'status'},
                ]
            });
        }
    </script>
@endsection
