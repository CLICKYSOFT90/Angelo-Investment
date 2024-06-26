@extends('layouts.admin.layout')

@section('title')
    <title>Angelo Investments | Admin Dashboard::Marked Offering Completed</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/dropzone/dropzone.css')}}"/>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Offerings /</span> Marked as Completed
    </h4>
    <div class="card mb-4">
        <h5 class="card-header">Marked Offering Completed</h5>
        <div class="card-body">
            <form action="{{ route('admin.offerings.marked.completed.post') }}" method="post" id="marked-completed">
                @csrf
                <input type="hidden" value="{{ $offering->of_id }}" name="offering_id">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Targeted IRR (%)</label>
                            <input type="text" class="form-control" disabled value="{{ $offering->target_irr }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Actual IRR (%)</label>
                            <input type="text" class="form-control" id="actual_irr" name="actual_irr"
                                   value="{{ old('actual_irr') }}">
                            <div id="defaultFormControlHelp" class="form-text">
                                Please enter the actual IRR
                            </div>
                            @if ($errors->has('actual_irr'))
                                <span class="text-danger">{{ $errors->first('actual_irr') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="status" class="form-label">Marked as completed</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="completed" name="completed">
                                @if ($errors->has('completed'))
                                    <span class="text-danger">{{ $errors->first('completed') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#actual_irr').on('keyup', function () {
            if (event.which !== 8) {
                $(this).val(function (index, old) {
                    return old.replace(/[^0-9,-]/g, '') + '%';
                });
            }
        });
    </script>
@endsection
