@extends('layouts.admin.layout')

@section('title')
    <title>Angelo Investments | Admin Dashboard::View Accredited User</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/dropzone/dropzone.css')}}"/>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Accredited /</span> User</h4>
    <div class="card mb-4">
        <h5 class="card-header">View Accredited User</h5>
        <form action="{{ route('admin.accredited.approve.store') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $user->id }}" name="user_id">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" disabled value="{{ $user->first_name }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" disabled value="{{ $user->last_name }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" disabled value="{{ $user->username }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" disabled value="{{ $user->email }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" disabled
                               value="{{ $user->phone }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="accredited_investor" class="form-label mb-2">Accredited Investor</label><br>
                        <span class="badge rounded-pill  bg-label-warning">No</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="is_tax_form" class="form-label mb-2">Is Tax Form</label><br>
                        <span class="badge rounded-pill  bg-label-{{ $user->is_tax_form == 1 ? 'success' : 'warning' }}">{{ $user->is_tax_form == 1 ? 'Yes' : 'No' }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" name="image"
                               accept="image/jpeg, image/jpg, image/png" disabled><br>
                        <img src="{{ asset('profiles/'.$user->image) }}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="approve_disapprove" class="form-label">Approve</label>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="approve_disapprove"
                                    name="approve_disapprove">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="is_tax_form" class="form-label mb-2">Message</label><br>
                        <textarea class="form-control" name="message"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="card-header">Accredited User Documents</h5>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="row align-items-center">
                        @foreach($user->userDocs as $key => $doc)
                            @php
                                $strArray = explode('.', $doc->filename);
                                $lastElement = end($strArray);
                            @endphp
                                <div class="col-md-3">
                                    <img src="{{ asset('images/icons/'.$lastElement.'.png') }}" id="first-image-{{ $key }}" width="150px"
                                         class="img-fluid">
                                </div>
                                <div class="col-md-3 col-3">
                                    <h6 class="text-uppercase">{{ str_replace('_', ' ', $doc->doc_type) }}</h6>
                                    <a href="{{ asset('user_docs/'.$doc->filename) }}" target="_blank">Click here to view doc</a>
                                </div>
                        @endforeach
                    </div>
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
