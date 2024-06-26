@extends('layouts.admin.layout')

@section('title')
    <title>Angelo Investments | Admin Dashboard::Create Offering</title>
@endsection

@section('styles')
    <style>
        #no_of_shares,
        #price_per_share {
            background: #e9ecee;
        }
    </style>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Offerings /</span> Create</h4>
    <form action="{{ route('admin.offerings.create.post') }}" method="post" enctype="multipart/form-data"
          id="create-offering">
        @csrf
        <div class="card mb-4">
            <h5 class="card-header">Create Offerings</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="investment_type" class="form-label">Investment Type</label>
                            <select class="form-select" id="investment_type" name="investment_type" value="{{ old('investment_type') }}">
                                <option value="0" selected disabled>Select InvestmentType</option>
                                <option value="Equity">Equity</option>
                                <option value="Fund">Fund</option>
                            </select>
                            @if ($errors->has('investment_type'))
                                <span class="text-danger">{{ $errors->first('investment_type') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="project_type" class="form-label">Project Type</label>
                            <select class="form-select" id="project_type" name="project_type" value="{{ old('project_type') }}">
                                <option value="0" selected disabled>Select Project Type</option>
                                <option value="Value- Add">Value- Add</option>
                                <option value="Development">Development</option>
                                <option value="REIT">REIT</option>
                            </select>
                            @if ($errors->has('project_type'))
                                <span class="text-danger">{{ $errors->first('project_type') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="project_type" class="form-label">Offering Type</label>
                            <select class="form-select" id="offering_type" name="offering_type" value="{{ old('offering_type') }}">
                                <option value="0" selected disabled>Select Project Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('offering_type'))
                                <span class="text-danger">{{ $errors->first('offering_type') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="total_investment" class="form-label">Total Investment</label>
                            <input type="text" class="form-control" id="total_investment" name="total_investment" value="{{ old('total_investment') }}">
                            @if ($errors->has('total_investment'))
                                <span class="text-danger">{{ $errors->first('total_investment') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="min_investment" class="form-label">Minimum Investment</label>
                            <input type="text" class="form-control" id="min_investment" name="min_investment" value="{{ old('min_investment') }}"
                                   onkeyup="calcNoOfShares(this)">
                            @if ($errors->has('min_investment'))
                                <span class="text-danger">{{ $errors->first('min_investment') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="min_investment" class="form-label">No Of Shares</label>
                            <input type="text" class="form-control" id="no_of_shares" name="no_of_shares" value="{{ old('no_of_shares') }}" readonly>
                            @if ($errors->has('no_of_shares'))
                                <span class="text-danger">{{ $errors->first('no_of_shares') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="min_investment" class="form-label">Price Per Share</label>
                            <input type="text" class="form-control" id="price_per_share" name="price_per_share" value="{{ old('price_per_share') }}"
                                   readonly>
                            @if ($errors->has('price_per_share'))
                                <span class="text-danger">{{ $errors->first('price_per_share') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="no_of_shares" class="form-label"># Of units</label>
                            <input type="text" class="form-control" id="no_of_units" name="no_of_units" value="{{ old('no_of_units') }}">
                            @if ($errors->has('no_of_units'))
                                <span class="text-danger">{{ $errors->first('no_of_units') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="est_completion" class="form-label">Estimated Construction Completion</label>
                            <input type="text" class="form-control flatpickr-validation flatpickr-input"
                                   id="basic-default-dob" name="est_completion" value="{{ old('est_completion') }}">
                            @if ($errors->has('est_completion'))
                                <span class="text-danger">{{ $errors->first('est_completion') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="preferred_rate" class="form-label">Preferred Rate (%)</label>
                            <input type="text" class="form-control" id="preferred_rate" name="preferred_rate" value="{{ old('preferred_rate') }}">
                            <div id="defaultFormControlHelp" class="form-text">
                                It will be in percentage.
                            </div>
                            @if ($errors->has('preferred_rate'))
                                <span class="text-danger">{{ $errors->first('preferred_rate') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="irr" class="form-label">Target IRR (%)</label>
                            <input type="text" class="form-control" id="irr" name="irr" value="{{ old('irr') }}">
                            <div id="defaultFormControlHelp" class="form-text">
                                It will be in percentage.
                            </div>
                            @if ($errors->has('irr'))
                                <span class="text-danger">{{ $errors->first('irr') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="hold_period" class="form-label">Hold Period</label>
                            <input type="text" class="form-control" id="hold_period" name="hold_period" value="{{ old('hold_period') }}"
                                   placeholder="5 Years">
                            @if ($errors->has('hold_period'))
                                <span class="text-danger">{{ $errors->first('hold_period') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address" class="form-label">Banner Image</label>
                            <input class="form-control" type="file" name="banner_img" value="{{ old('banner_img') }}"
                                   accept="image/jpeg, image/jpg, image/png">
                            @if ($errors->has('banner_img'))
                                <span class="text-danger">{{ $errors->first('banner_img') }}</span>
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="short_desc" class="form-label">Short Description</label>
                            <textarea class="form-control" name="short_desc" id="short_desc" rows="10">{{ old('short_desc') }}</textarea>
                            <div id="defaultFormControlHelp" class="form-text">
                                You can enter 700 chatacters.
                            </div>
                            @if ($errors->has('short_desc'))
                                <span class="text-danger">{{ $errors->first('short_desc') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="long_desc" class="form-label">Long Description</label>
                            <textarea class="form-control" name="long_desc"  id="long_desc" rows="10">{{ old('long_desc') }}</textarea>
                            <div id="defaultFormControlHelp" class="form-text">
                                You can enter 1000 chatacters.
                            </div>
                            @if ($errors->has('long_desc'))
                                <span class="text-danger">{{ $errors->first('long_desc') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="disclaimer" class="form-label">Disclaimers</label>
                            <textarea class="form-control" name="disclaimer" id="disclaimer" rows="10"> {{ old('disclaimer') }}</textarea>
                            <div id="defaultFormControlHelp" class="form-text">
                                You can enter 2000 chatacters.
                            </div>
                            @if ($errors->has('disclaimer'))
                                <span class="text-danger">{{ $errors->first('disclaimer') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="card-header">
                Offering Images
                <div class="form-text">Can upload up to 20 images</div>
            </h5>
            <div class="card-body ">
                <div class="append-image">
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-5">
                            <img id="first-img"
                                 src="{{ asset('images/placeholder.png') }}" class="img-fluid" width="150px">
                        </div>
                        <div class="col-md-5 col-10">
                            <input class="form-control" type="file" name="offering_images[]" id="first-file"
                                   class="input-upload"
                                   accept="image/jpeg, image/jpg, image/png"
                                   onchange="uploadOfferingImage(this, 'first-img', 'first-name','first-file')">
                            <div class="form-text">Images will be resized to (420X266)</div>
                            @if ($errors->has('offering_images'))
                                <span class="text-danger">{{ $errors->first('offering_images') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="demo-inline-spacing text-center">
                            <button type="button" class="btn rounded-pill btn-outline-vimeo add-new-image">
                                <i class="tf-icons bx bx-plus-circle"></i> Add Images
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="card-header">
                Offering Videos
                <div class="form-text">Can upload up to 4 videos</div>
            </h5>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="append-video">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-5">
                                {{--                                <img id="first-video" src="{{ asset('images/placeholder.png') }}" class="img-fluid" width="150px">--}}
                                <video width="150" height="150" controls id="first-video">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="col-md-5 col-10">
                                <input class="form-control" type="file" name="offering_videos[]"
                                       id="first-file-video"
                                       class="input-upload"
                                       onchange="uploadOfferingVideo(this, 'first-video', 'first-name','first-file-video')">
                                <div class="form-text">Video should be of less than 2 MB</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="demo-inline-spacing text-center">
                            <button type="button" class="btn rounded-pill btn-outline-vimeo add-new-video">
                                <i class="tf-icons bx bx-plus-circle"></i> Add Videos
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="card-header">Offering Documents</h5>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="append-doc">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-3">
                                <img src="{{ asset('images/placeholder.png') }}" id="first-image" width="150px"
                                     class="img-fluid">
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">required when investing</label>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="doc_required"
                                               name="doc_required[]">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-10">
                                <input type="file" name="offering_docs[]"
                                       accept="application/pdf, application/doc, application/docx"
                                       id="first-file-doc"
                                       onchange="readNameAndType(this, 'first-doc', 'first-file-doc','first-image')"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="demo-inline-spacing text-center">
                            <button type="button" class="btn rounded-pill btn-outline-vimeo add-new-doc">
                                <i class="tf-icons bx bx-plus-circle"></i> Add Documents
                            </button>
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
        function calcNoOfShares(value) {
            var fund_required = $('#total_investment').val();
            var no_of_shares = fund_required / value.value;
            $('#price_per_share').val(value.value);
            $('#no_of_shares').val(no_of_shares);

        }

        //Offering Images
        let image_key = 0;
        $('.add-new-image').on('click', function () {
            ++image_key;
            if (image_key > 19) {
                Swal.fire({
                    icon: 'error',
                    title: "You can only upload 20 images",
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonColor: '#3ea99d',
                })
            } else {
                let number = 1 + Math.floor(Math.random() * 6 + Date.now());
                let div = '<div class="row mb-3 align-items-center">' +
                    '<div class="col-md-5"><img id="' + number + '-img" src="{{ asset('images/placeholder.png') }}" width="150px"></div>' +
                    '<div class="col-md-5 col-10">' +
                    '<input type="file" name="offering_images[]" id="' + number +
                    '-file" class="form-control" accept="image/jpeg, image/jpg, image/png" onchange="uploadOfferingImage(this, \'' + number + '-img\', \'' +
                    number + '-name\', \'' + number + '-file\')">' +
                    '<div class="form-text">Images will be resized to (420X266)</div>' +
                    '</div>' +
                    '<div class="col-md-2 col-2">' +
                    '<div class="remove-image" title="Remove">' +
                    '<i class="tf-icons bx bxs-x-circle cross-sign"></i> ' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('.append-image').append(div);
            }
        })

        $(document).on('click', '.remove-image', function () {
            $(this).parent().parent().remove();
        });

        function uploadOfferingImage(form, imgdiv, namediv, file) {
            var i = $(this).prev('label').clone();
            var fileObj = $('#' + file);
            var file = $('#' + file)[0].files[0].name;
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

        //Offering Videos
        let video_key = 0;
        $('.add-new-video').on('click', function () {
            ++video_key
            if (video_key > 3) {
                Swal.fire({
                    icon: 'error',
                    title: "You can only upload 4 videos",
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonColor: '#3ea99d',
                })
            } else {
                let number = 1 + Math.floor(Math.random() * 6 + Date.now());
                let div = '<div class="row mb-3 align-items-center">' +
                    '<div class="col-md-5">' +
                    '<video width="150" height="150" controls id="' + number + '-video">' +
                    'Your browser does not support the video tag.' +
                    '</video>' +
                    '</div>' +
                    '<div class="col-md-5 col-10">' +
                    '<input type="file" name="offering_videos[]" id="' + number +
                    '-file-video" class="form-control" onchange="uploadOfferingVideo(this, \'' + number + '-video\', \'' +
                    number + '-name\', \'' + number + '-file-video\')">' +
                    '<div class="form-text">Video should be of less than 2 MB</div>'+
                    '</div>' +
                    '<div class="col-md-2 col-2">' +
                    '<div class="remove-video" title="Remove">' +
                    '<i class="tf-icons bx bxs-x-circle cross-sign"></i> ' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('.append-video').append(div);
            }
        })

        $(document).on('click', '.remove-video', function () {
            $(this).parent().parent().remove();
        });

        function uploadOfferingVideo(form, imgdiv, namediv, file) {
            var i = $(this).prev('label').clone();
            var fileObj = $('#' + file);
            let files = $('#' + file)[0].files[0];
            var file = $('#' + file)[0].files[0].name;
            var fileExtension = ['mp4', 'mov', 'wmv', 'flv', 'avi', 'mkv'];
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
                if (files.size > 2000000) {
                    Swal.fire({
                        icon: 'error',
                        title: "The uploaded file should be less than 2 MB",
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonColor: '#3ea99d',
                    })
                    fileObj.val('');
                } else {
                    let blobURL = URL.createObjectURL(files);
                    var fileName = file.split('.');
                    $('#' + namediv).val(fileName[0]);
                    $('#' + imgdiv).attr('src', blobURL);
                }
            }
        }


        //Offering Documents
        let doc_key = 0;
        $('.add-new-doc').on('click', function () {
            ++doc_key;
            let number = 1 + Math.floor(Math.random() * 6 + Date.now());
            let file_doc = number + '-doc';
            let file_file = number + '-file';
            let file_image = number + '-image';
            let div = '<div class="row mb-3 align-items-center">' +
                '<div class="col-md-3">' +
                '<img src="{{ asset('images/placeholder.png') }}" class="img-fluid" id="' + number + '-image" width="150px">' +
                '</div>' +
                '<div class="col-md-2">' +
                '<div class="mb-3">' +
                '<label class="form-label">required when investing</label>' +
                '<div class="form-check form-switch mb-2">' +
                '<input class="form-check-input" type="checkbox" id="doc_required" name="doc_required[]">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-5 col-10">' +
                '<input type="file" name="offering_docs[]" id="' + number +
                '-file" class="form-control" accept="application/pdf, application/doc, application/docx, application/xls, application/xlxs" onchange="readNameAndType(this, \'' + file_doc + '\', \'' +
                file_file + '\', \'' + file_image + '\')">' +
                '</div>' +
                '<div class="col-md-2 col-2">' +
                '<i class="tf-icons bx bxs-x-circle remove-doc"></i>' +
                ' </div>' +
                '</div>';
            $('.append-doc').append(div);
        });

        $(document).on('click', '.remove-doc', function () {
            $(this).parent().parent().remove();
        });

        function readNameAndType(input, divName, file, image) {
            var fileObj = $('#' + file);
            var fileExtension = ['pdf', 'doc', 'docx', 'xls', 'xlxs'];
            var i = $(this).prev('label').clone();
            var file = $('#' + file)[0].files[0].name;
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
                $('#' + divName).val(file);
                var fileExt = file.split('.');
                var imageExt = "{{ url('images/icons/') }}" + '/' + fileExt[1] + '.png';
                $('#' + image).attr('src', imageExt);
            }
        }

        $('#create-offering').validate({
            rules: {
                name: {
                    required: true
                },
                investment_type: {
                    required: true
                },
                project_type: {
                    required: true
                },
                offering_type: {
                    required: true
                },
                total_investment: {
                    required: true,
                    integer: true
                },
                min_investment: {
                    required: true,
                    integer: true
                },
                no_of_shares: {
                    required: true,
                    integer: true
                },
                price_per_share: {
                    required: true,
                    integer: true
                },
                no_of_units: {
                    required: true,
                    integer: true
                },
                est_completion: {
                    required: true
                },
                preferred_rate: {
                    required: true,
                    integer: true
                },
                irr: {
                    required: true,
                    integer: true
                },
                hold_period: {
                    required: true
                },
                address: {
                    required: true
                },
                banner_img: {
                    required: true
                },
                short_desc: {
                    required: true,
                    maxlength:700
                },
                long_desc: {
                    required: true,
                    maxlength:1000
                },
                disclaimer: {
                    required: true,
                    maxlength:2000
                },
                status: {
                    required: true
                },
                "offering_images[]": {
                    required: true
                },
                "offering_videos[]": {
                    required: true
                },
                "offering_docs[]": {
                    required: true
                },
            },
            messages: {
                name: {
                    required: "This field is required"
                },
                investment_type: {
                    required: "This field is required"
                },
                project_type: {
                    required: "This field is required"
                },
                offering_type: {
                    required: "This field is required"
                },
                total_investment: {
                    required: "This field is required"
                },
                min_investment: {
                    required: "This field is required"
                },
                no_of_shares: {
                    required: "This field is required"
                },
                price_per_share: {
                    required: "This field is required"
                },
                no_of_units: {
                    required: "This field is required"
                },
                est_completion: {
                    required: "This field is required"
                },
                preferred_rate: {
                    required: "This field is required"
                },
                irr: {
                    required: "This field is required"
                },
                hold_period: {
                    required: "This field is required"
                },
                address: {
                    required: "This field is required"
                },
                short_desc: {
                    required: "This field is required"
                },
                long_desc: {
                    required: "This field is required"
                },
                disclaimer: {
                    required: "This field is required"
                },
                banner_img: {
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
