@extends('layouts.admin.layout')

@section('title')
    <title>Angelo Investments | Admin Dashboard::Profile Settings</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/dropzone/dropzone.css')}}"/>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Profile /</span> Settings</h4>
    <div class="card mb-4">
        <h5 class="card-header">Edit Your Information</h5>
        <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $user->id }}" name="user_id">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                            @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" name="image"
                                   accept="image/jpeg, image/jpg, image/png">
                            <img src="{{ $user->image }}" class="img-fluid">
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="investor_limit" class="form-label">Change Investor Limit</label>
                            <input type="tel" class="form-control" id="investor_limit" name="investor_limit" required value="{{ $investor_limit->limit }}">
                            <div id="defaultFormControlHelp" class="form-text">
                                This will implement on overall investments of the investor.
                            </div>
                            @if ($errors->has('investor_limit'))
                                <span class="text-danger">{{ $errors->first('investor_limit') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="card-header">Change Your Password</h5>
            <div class="card-body">
                <div class="row mb-3">
{{--Change Password--}}
                    <div class="mb-3">
                        <label for="newPasswordInput" class="form-label">New Password</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="newPasswordInput" placeholder="New Password">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation"
                               placeholder="Confirm New Password">
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')


@endsection
