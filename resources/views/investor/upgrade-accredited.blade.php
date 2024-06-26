@extends('layouts.investor.layout')

@section('title')
    <title>Angelo Investments | Account Settings</title>
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
                                <h1 class="m-0">Upgrade To Accredited Investor</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bank-sec">
            <div class="container-fluid">
                <div class="bank-card-main bg-remove account-card">
                    <form action="{{ route('investor.upgrade.accredited,post') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                @error('user_docs')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <h4>
                                    You can demonstrate that you have an income that satisfies the requirements of being
                                    an Accredited Investor, by submitting to Angelo Investments, LLC any of the
                                    following documents;
                                </h4>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>Credit Report</h6>
                                    <input type="file" name="user_docs[credit_report]" class="upload-file form-control"><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>Value of private company securities holdings</h6>
                                    <input type="file" name="user_docs[values_privates]"
                                           class="upload-file form-control"><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>IRS form or tax return</h6>
                                    <input type="file" name="user_docs[irs]" class="upload-file form-control"><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>Proof of vehicle ownership</h6>
                                    <input type="file" name="user_docs[proof_vehicle_ownership]"
                                           upload-file class="form-control"><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>Deeds or other evidence of ownership for real estate holdings</h6>
                                    <input type="file" name="user_docs[deeds]" class="upload-file form-control"><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>Third-party valuation of property holdings</h6>
                                    <input type="file" name="user_docs[third_party]"
                                           class="upload-file form-control"><br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>
                                    You can demonstrate that you have a net worth that qualifies you as an Accredited
                                    Investor by submitting to Angelo Investments, LLC by submitting any of the following
                                    documents;
                                </h4>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>Credit report</h6>
                                    <input type="file" name="user_docs[net_credit_report]"
                                           class="upload-file form-control"><br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>
                                    As an alternative, persons can acquire and submit a letter from a third-party
                                    attesting as to the investor’s accreditation status so long as the grantor of the
                                    letter is one of the following:
                                </h4>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>A registered broker dealer</h6>
                                    <input type="file" name="user_docs[registered_broker]"
                                           class="upload-file form-control"><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>An attorney; or</h6>
                                    <input type="file" name="user_docs[an_attorney]"
                                           class="upload-file form-control"><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>A registered investment advisor</h6>
                                    <input type="file" name="user_docs[registered_investment]"
                                           class="upload-file form-control"><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="bank-info-content m-0">
                                    <h6>A certified public accountant</h6>
                                    <input type="file" name="user_docs[certified_accountant]"
                                           class="upload-file form-control"><br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="funds-withdraw-button p-0">
                                    <button type="submit" class="view-all-table account-edit">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
@endsection

@section('scripts')

    <script>
        let is_file = 0;
        $('.upload-file').on('change', function () {
            var fileObj = $(this);
            var file = $(fileObj)[0].files[0].name;
            var fileExtension = ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx'];
            if ($.inArray(file.split('.').pop().toLowerCase(), fileExtension) == -1) {
                Swal.fire({
                    icon: 'error',
                    title: "Only formats are allowed : " + fileExtension.join(', '),
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonColor: '#3ea99d',
                })
                fileObj.val('');
            } else {
                is_file = ++is_file;
                console.log(is_file);
            }
        })
    </script>

@endsection

