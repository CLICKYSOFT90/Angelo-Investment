@extends('layouts.investor.layout')

@section('title')
    <title>Angelo Investments | Funds Withdrawal</title>
@endsection

@section('styles')

@endsection

@section('content')
    <section class="wallet-distributions-sec">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="dashbard-head">
                        <h1>Funds Withdrawal</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type and scrambled it to
                            make a type specimen book. Lorem Ipsum is simply dummy text of the printing
                            and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                            text ever since the 1500s, when an unknown printer took a galley of type and
                            scrambled it to make a type specimen book. </p>
                    </div>
                    <div class="funds-withdraw-button">
                        <button class="view-all-table" data-bs-toggle="modal" data-bs-target="#customer-popup">FUNDS
                            WITHDRAWAL
                        </button>
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
                                <h4>Funds Withdrawal</h4>
                            </div>

                        </div>
                        <div class="table-responsive ">
                            <div class="transaction-table">
                                <table class="table fund-withdrawals-listings">
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
    <div class="modal fade wdraw-modal" id="customer-popup" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-modal="true">
        <div class="modal-dialog modal-dialog-slideout modal-wd-funds" role="document">
            <div class="modal-content news-modal-content">
                <div class="close-button">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div class="modal-body contact-popup md-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-head">
                                <h3>Funds Withdrawal</h3>
                            </div>
                        </div>
                    </div>
                    <div class="contact-popup-fields">
                        <form id="withdrawals">
                            @csrf
                            <div class="row r-gutter">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="contact-fields">
                                        <select name="bank_id">
                                            <option selected disabled>Select Bank Account</option>
                                            @foreach($bank_accounts as $bank_account)
                                                <option value="{{ $bank_account->id }}">{{ $bank_account->bank_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="contact-fields">
                                        <input type="number" placeholder="Amount" name="amount">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="submit-form">
                                        <button type="submit" class="view-all-table md-submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var table = $('.fund-withdrawals-listings').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.fund.withdrawals.listing') }}",
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

        $('.close-button').on('click', function () {
            $(this).closest('.modal').modal('hide');
        });
        jQuery.validator.addMethod("dollarsscents", function(value, element) {
            return this.optional(element) || /^\d{0,4}(\.\d{0,2})?$/i.test(value);
        }, "You must include two decimal places");
        $('#withdrawals').validate({
            rules: {
                bank_id: {
                    required: true
                },
                amount: {
                    required: true,
                    number: true,
                    dollarsscents: true
                },
            },
            messages: {
                bank_id: {
                    required: "This field is required"
                },
                amount: {
                    required: "This field is required",
                },
            },
            // errorElement : 'div',
            errorPlacement: function (error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                let formValues = $(form).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('investor.fund.withdrawals.money') }}",
                    method: 'post',
                    data: formValues,
                    beforeSend: function () {
                        $('#withdrawals .md-submit').attr('disabled', true).html('Please Wait...')
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
                            $('#withdrawals .md-submit').attr('disabled', false).html('Submit')
                            location.reload();
                        }
                    },
                    error: function (result) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: result.responseJSON.message,
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        $('#withdrawals .md-submit').attr('disabled', false).html('Submit')
                    }
                });
            }
        });
    </script>
@endsection

