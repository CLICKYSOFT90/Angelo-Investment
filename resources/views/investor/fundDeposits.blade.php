@extends('layouts.investor.layout')

@section('title')
    <title>Angelo Investments | Funds Deposit</title>
@endsection

@section('styles')

@endsection

@section('content')
    <section class="wallet-distributions-sec">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="dashbard-head">
                        <h1>Funds Deposit</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type and scrambled it to
                            make a type specimen book. Lorem Ipsum is simply dummy text of the printing
                            and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                            text ever since the 1500s, when an unknown printer took a galley of type and
                            scrambled it to make a type specimen book. </p>
                    </div>
                    <div class="funds-withdraw-button">
                        <button class="view-all-table add-funds" data-bs-toggle="modal"
                                data-bs-target="#customer-popup"> ADD FUNDS IN WALLET
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
                                <h4>Fund Deposits</h4>
                            </div>
                        </div>
                        <div class="transaction-table">
                            <div class="table-responsive ">
                                <table class="table table-fixed fund-deposit-listings">
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
                                <h3>Deposit Funds</h3>
                            </div>
                        </div>
                    </div>
                    <div class="contact-popup-fields">
                        <form action="{{ route('investor.fund.deposits.money') }}" method="post" id="depost-form">
                            @csrf
                            <div class="row r-gutter">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="contact-fields mb-3">
                                        <input type="text" placeholder="Account Title" name="title">
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="contact-fields mb-3">
                                        <input type="text" placeholder="Amount" name="amount" id="amount" maxlength="10">
                                        <div class="small">
                                            Amount to be charged (with processing fees)
                                            <span id="total_amount" class="pull-right">$0.00</span>
                                        </div>
                                    @if ($errors->has('amount'))
                                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="contact-fields mb-3">
                                        <input type="tel" placeholder="Account Number" name="acc_number"
                                               class="cc-number" maxlength="16">
                                        <div class="small">Enter the number without spacing or hyphens</div>
                                        @if ($errors->has('acc_number'))
                                            <span class="text-danger">{{ $errors->first('acc_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row r-gutter">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="contact-fields mb-3">
                                        <input type="tel" class="cc-expires" placeholder="MM / YY" data-payment='cc-exp'
                                               name="expiry">
                                        @if ($errors->has('expiry'))
                                            <span class="text-danger">{{ $errors->first('expiry') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="contact-fields mb-3">
                                        <input type="tel" placeholder="CVC" class="cc-cvc" name="cvv" maxlength="4">
                                        @if ($errors->has('cvv'))
                                            <span class="text-danger">{{ $errors->first('cvv') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <p>*Please note the final itemisation will done by the facility. The total invoice amount may vary.</p>
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
            var table = $('.fund-deposit-listings').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.fund.deposits.listing') }}",
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

        $('#amount').on('keyup', function (){
            let value = $(this).val();
            let total = (((2.9 / 100) * value) + 0.5) + parseInt(value);
            if(!isNaN(total)){
                $('#total_amount').empty().append('$ '+total);
            } else{
                $('#total_amount').empty().append('$ 0.00');
            }
        })


        $('.close-button').on('click', function () {
            $(this).closest('.modal').modal('hide');
        });

        $.validator.addMethod("dateFuture", function (value, element) {
            let today = new Date();
            let currentMonth = today.getMonth() + 1;
            let currentYear = today.getFullYear().toString().substr(-2);
            let inputMonth = parseInt(value.split("/")[0]);
            let inputYear = parseInt(value.split("/")[1]);
            return this.optional(element) || (inputYear > currentYear || (inputYear == currentYear && inputMonth >= currentMonth));
        }, "Please enter a future date in the format MM/YY");
        jQuery.validator.addMethod("dollarsscents", function(value, element) {
            return this.optional(element) || /^\d{0,10}(\.\d{0,2})?$/i.test(value);
        }, "You must include two decimal places");

        $('#depost-form').validate({
            rules: {
                title: {
                    required: true
                },
                amount: {
                    required: true,
                    number: true,
                    dollarsscents: true
                },
                acc_number: {
                    required: true,
                    integer: true
                },
                expiry: {
                    required: true,
                    // pattern: /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])$/,
                    dateFuture: true
                },
                cvv: {
                    required: true,
                    integer: true
                },
            },
            messages: {
                title: {
                    required: "This field is required"
                },
                amount: {
                    required: "This field is required",
                },
                acc_number: {
                    required: "This field is required",
                },
                expiry: {
                    required: "This field is required"
                },
                cvv: {
                    required: "This field is required"
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
                    url: "{{ route('investor.fund.deposits.money') }}",
                    method: 'post',
                    data: formValues,
                    beforeSend: function () {
                        $('#depost-form .md-submit').attr('disabled', true).html('Please Wait...')
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
                            $('#depost-form .md-submit').attr('disabled', false).html('Submit')
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
                        $('#depost-form .md-submit').attr('disabled', false).html('Submit')
                    }
                });
            }
        });

    </script>
@endsection

