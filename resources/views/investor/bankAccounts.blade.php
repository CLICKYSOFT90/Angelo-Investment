@extends('layouts.investor.layout')

@section('title')
    <title>Angelo Investments | Bank Accounts</title>
@endsection

@section('styles')

@endsection

@section('content')
    <section class="wallet-distributions-sec">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="ban-account-head">
                        <div class="dashbard-head">
                            <h1 class="m-0">Bank Account</h1>
                        </div>
                        <div class="funds-withdraw-button p-0">
                            <button class="view-all-table" id="add-acc">Add
                                New Bank Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="bank-sec">
        <div class="container-fluid">
            @foreach($bank_accounts as $bank_account)
                <div class="bank-card-main">
                    <div class="row">
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content">
                                <h6>Account Holder Name:</h6>
                                <h4>{{ $bank_account->acc_holder_name }}</h4>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content">
                                <h6>Bank Name:</h6>
                                <h4>{{ $bank_account->bank_name }}</h4>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content">
                                <h6>Routing Number:</h6>
                                <h4>{{ $bank_account->routing_number }}</h4>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content m-0">
                                <h6>Account Number:</h6>
                                <h4>{{ $bank_account->acc_number }}</h4>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content m-0">
                                <h6>IBAN:</h6>
                                <h4>{{ $bank_account->iban }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="delete-edit-main">
                                <button class="view-all-table delete" onclick="deleteAccount({{ $bank_account->id }}, this)">Delete</button>
                                <button class="view-all-table edit" onclick="editAccount({{ $bank_account->id }})">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
                                <h3>Add Bank Accounts</h3>
                            </div>
                        </div>
                    </div>
                    <div class="contact-popup-fields">
                        <form method="post" class="bank-account">
                            @csrf
                            <input type="hidden" name="bank_id" id="bank_id">
                            <div class="row r-gutter">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="contact-fields mb-3">
                                        <input type="text" placeholder="Account Holder Name" name="name" id="name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="contact-fields mb-3">
                                        <input type="text" placeholder="Bank Name" name="bank_name" id="bank_name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="contact-fields mb-3">
                                        <input type="number" placeholder="Account Number" name="acc_number" id="acc_number">
                                        <div class="small">Enter the number without spacing or hyphens</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row r-gutter">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="contact-fields mb-3">
                                        <input type="number" placeholder="Routing Number" name="routing_number" id="routing_number">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="contact-fields mb-3">
                                        <input type="text" placeholder="IBAN" name="iban" id="iban">
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
        $('.close-button').on('click', function () {
            $(this).closest('.modal').modal('hide');
        });

        $('#add-acc').on('click', function (){
            $('#customer-popup .md-head h3').html('Add Bank Account');
            $('#customer-popup').modal('show');
        })

        $('.bank-account').validate({
            rules: {
                name: {
                    required: true
                },
                bank_name: {
                    required: true
                },
                acc_number: {
                    required: true,
                    integer: true
                },
                routing_number: {
                    required: true,
                    integer: true
                },
                iban: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "This field is required"
                },
                name: {
                    required: "This field is required"
                },
                bank_name: {
                    required: "This field is required"
                },
                acc_number: {
                    required: "This field is required"
                },
                routing_number: {
                    required: "This field is required"
                },
                iban: {
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
                    url: "{{ route('investor.add.bank.accounts') }}",
                    method: 'post',
                    data: formValues,
                    beforeSend: function () {
                        $('.bank-account .md-submit').attr('disabled', true).html('Please Wait...')
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
                            $('.bank-account .md-submit').attr('disabled', false).html('Submit')
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
                        $('.md-submit').attr('disabled', false).html('Submit')
                    }
                });
            }
        });

        function deleteAccount(id, ref) {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure you want to delete the bank account?',
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
                        url: "{{ route('investor.delete.bank.accounts') }}",
                        method: 'post',
                        data: {
                            id: id,
                        },
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
                                $(ref).parent().parent().parent().parent().remove();
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
                        }
                    });
                }
            })
        }

        function editAccount(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('investor/bank-accounts/edit') }}"+'/'+id,
                method: 'get',
                success: function (result) {
                    if (result.status == true) {
                        $('#bank_id').empty().val(result.data.id);
                        $('#name').empty().val(result.data.acc_holder_name);
                        $('#bank_name').empty().val(result.data.bank_name);
                        $('#acc_number').empty().val(result.data.acc_number);
                        $('#routing_number').empty().val(result.data.routing_number);
                        $('#iban').empty().val(result.data.iban);
                        $('#customer-popup .md-head h3').html('Edit Bank Account');
                        $('#customer-popup').modal('show');
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
                }
            });
        }
    </script>
@endsection

