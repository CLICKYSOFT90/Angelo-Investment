@extends('layouts.admin.layout')

@section('title')
    <title>Angelo Investments | Admin Dashboard::Create Offering Type</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/dropzone/dropzone.css')}}"/>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Offerings /</span> Create</h4>
    <form action="{{ route('admin.offerings.type.store') }}" method="post" id="create-offering-type">
        @csrf
        <div class="card mb-4">
            <h5 class="card-header">Create Offering Types</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type">
                            @if ($errors->has('type'))
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="status" checked name="status">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
    <script>
        $('#create-offering-type').validate({
            rules: {
                type: {
                    required: true
                },
                status: {
                    required: false
                },
            },
            messages: {
                type: {
                    required: "This field is required"
                },
                status: {
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
            }
        });
    </script>
@endsection
