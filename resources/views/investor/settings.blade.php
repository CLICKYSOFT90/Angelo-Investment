@extends('layouts.investor.layout')

@section('title')
    <title>Angelo Investments | Account Settings</title>
@endsection

@section('styles')

@endsection

@section('content')
    <form action="{{ route('investor.settings.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <section class="wallet-distributions-sec">
            <div class="container-fluid flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ban-account-head">
                            <div class="dashbard-head">
                                <h1 class="m-0">Account setting</h1>
                            </div>
                            <div class="funds-withdraw-button p-0">
                                <button type="submit" class="view-all-table account-edit">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bank-sec">
            <div class="container-fluid">
                <div class="bank-card-main bg-remove account-card">
                    <div class="row">
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content">
                                <h6>First Name:</h6>
                                <input type="text" class="bank-custom-input" name="first_name"
                                       value="{{ auth()->user()->first_name }}"><br>
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content">
                                <h6>Last Name:</h6>
                                <input type="text" class="bank-custom-input" name="last_name"
                                       value="{{ auth()->user()->last_name }}"><br>
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content">
                                <h6>User Name:</h6>
                                <input type="text" class="bank-custom-input" name="username" disabled
                                       value="{{ auth()->user()->username }}"><br>
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content m-0">
                                <h6>Email Address:</h6>
                                <input type="text" class="bank-custom-input" name="email" disabled
                                       value="{{ auth()->user()->email }}"><br>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content m-0">
                                <h6>Phone Number:</h6>
                                <input type="text" class="bank-custom-input" name="phone"
                                       value="{{ auth()->user()->phone }}"><br>
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-4 col-sm-12 col-12">
                            <div class="bank-info-content m-0">
                                <h6>Profile Image:</h6>
                                <input type="file" name="image" id="file" class="form-control" onchange="uploadImage(this)"><br>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror
                                <img src="{{ auth()->user()->image }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="col-md-12 mb-3">
                                <div class="bank-info-content m-0">
                                    <h6 for="password">Password:</h6>
                                    <input type="password" class="bank-custom-input" id="password" name="password" placeholder="New Password"><br>
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="bank-info-content m-0">
                                    <h6 for="c_password">Confirm Password:</h6>
                                    <input type="password" class="bank-custom-input" name="password_confirmation" id="password_confirmation" placeholder="Confirm New Password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="digi-updates">
                                    <p class="digi-text">Receive and digital updates about investments,
                                        offerings, and Angelo Investments news.</p>
                                    <div class="checkbox-main">
                                        <div class="check-1">
                                            <input type="radio" name="recieve_digi_updates" value="yes"
                                                   class="check-with-label"
                                                   id="Yes" {{ auth()->user()->recieve_digi_updates == 1 ? 'checked' : '' }}>
                                            <label class="ch-lab" for="Yes">Yes</label>
                                        </div>
                                        <div class="check-1 checkbox-check">
                                            <input type="radio" class="check-with-label" name="recieve_digi_updates"
                                                   value="no"
                                                   id="No" {{ auth()->user()->recieve_digi_updates == 0 ? 'checked' : '' }}>
                                            <label for="No" class="ch-lab">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bank-info-content m-0">
                                <h6>Tax Form: (Please download the w9 form,  enter all the necessary details and upload here. <a href="{{ asset('user-tax-form/w9.pdf') }}" target="_blank"><i class="fa fa-download"></i> Download</a>)</h6>
                                <input type="file" name="tax_form" accept="application/pdf" class="form-control"><br>
                                @error('tax_form')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror
                                @if(auth()->user()->is_tax_form == 1)
                                    <a href="{{ asset('user-tax-form/'.auth()->user()->w9_taxform) }}" target="_blank"><i class="fa fa-eye"></i> View Uploaded Form</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@section('scripts')
    <script>
        function uploadImage(file) {
            var i = $(this).prev('label').clone();
            var fileObj = $('#file');
            var file = $(fileObj)[0].files[0].name;
            var fileExtension = ['png', 'jpg', 'jpeg'];
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
                var fileName = file.split('.');
                $('#' + namediv).val(fileName[0]);
                if (form.files && form.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#' + imgdiv)
                            .attr('src', e.target.result);
                    };

                    reader.readAsDataURL(form.files[0]);
                }
            }
        }
    </script>
@endsection

