@extends('layouts.admin.layout')

@section('title')
    <title>Angelo Investments | Admin Dashboard::View Offering</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/libs/dropzone/dropzone.css')}}"/>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Offerings /</span> View</h4>
        <div class="card mb-4">
            <h5 class="card-header">View Offering</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $offering->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="investment_type" class="form-label">Investment Type</label>
                            <select class="form-select" id="investment_type" name="investment_type">
                                <option value="0" selected disabled>Select InvestmentType</option>
                                <option value="Equity" {{ $offering->investment_type == 'Equity' ? 'selected' : '' }}>
                                    Equity
                                </option>
                                <option value="Fund" {{ $offering->investment_type == 'Fund' ? 'selected' : '' }}>Fund
                                </option>
                            </select>
                            @if ($errors->has('investment_type'))
                                <span class="text-danger">{{ $errors->first('investment_type') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="project_type" class="form-label">Project Type</label>
                            <select class="form-select" id="project_type" name="project_type">
                                <option value="0" selected disabled>Select Project Type</option>
                                <option
                                    value="Value- Add" {{ $offering->project_type = 'Value- Add' ? 'selected' : '' }}>
                                    Value- Add
                                </option>
                                <option
                                    value="Development" {{ $offering->project_type = 'Development' ? 'selected' : '' }}>
                                    Development
                                </option>
                                <option value="REIT" {{ $offering->project_type = 'REIT' ? 'selected' : '' }}>REIT
                                </option>
                            </select>
                            @if ($errors->has('project_type'))
                                <span class="text-danger">{{ $errors->first('project_type') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="project_type" class="form-label">Offering Type</label>
                            <select class="form-select" id="offering_type" name="offering_type">
                                <option value="0" selected disabled>Select Project Type</option>
                                @foreach($types as $type)
                                    <option
                                        value="{{ $type->id }}" {{ $offering->offering_types == $type->id ? 'selected' : '' }}>{{ $type->type }}</option>
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
                            <input type="text" class="form-control" id="total_investment" name="total_investment"
                                   value="{{ $offering->investment_required }}">
                            @if ($errors->has('total_investment'))
                                <span class="text-danger">{{ $errors->first('total_investment') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="min_investment" class="form-label">Minimum Investment</label>
                            <input type="text" class="form-control" id="min_investment" name="min_investment"
                                   value="{{ $offering->min_investments }}"
                                   onkeyup="calcNoOfShares(this)">
                            @if ($errors->has('min_investment'))
                                <span class="text-danger">{{ $errors->first('min_investment') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="min_investment" class="form-label">No Of Shares</label>
                            <input type="text" class="form-control" id="no_of_shares" name="no_of_shares"
                                   value="{{ $offering->no_of_shares }}" readonly>
                            @if ($errors->has('no_of_shares'))
                                <span class="text-danger">{{ $errors->first('no_of_shares') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="min_investment" class="form-label">Price Per Share</label>
                            <input type="text" class="form-control" id="price_per_share" name="price_per_share"
                                   value="{{ $offering->price_per_share }}"
                                   readonly>
                            @if ($errors->has('price_per_share'))
                                <span class="text-danger">{{ $errors->first('price_per_share') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="no_of_shares" class="form-label"># Of units</label>
                            <input type="text" class="form-control" id="no_of_units" name="no_of_units"
                                   value="{{ $offering->no_of_units }}">
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
                                   id="basic-default-dob" name="est_completion"
                                   value="{{ $offering->est_construction_completion }}">
                            @if ($errors->has('est_completion'))
                                <span class="text-danger">{{ $errors->first('est_completion') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="preferred_rate" class="form-label">Preferred Rate (%)</label>
                            <input type="text" class="form-control" id="preferred_rate" name="preferred_rate"
                                   value="{{ $offering->preferred_rate }}">
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
                            <input type="text" class="form-control" id="irr" name="irr"
                                   value="{{ $offering->target_irr }}">
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
                            <input type="text" class="form-control" id="hold_period" name="hold_period"
                                   placeholder="5 Years" value="{{ $offering->hold_period }}">
                            @if ($errors->has('hold_period'))
                                <span class="text-danger">{{ $errors->first('hold_period') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ $offering->address }}">
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address" class="form-label">Banner Image</label>
                            <input class="form-control" type="file" name="banner_img"
                                   accept="image/jpeg, image/jpg, image/png">
                            <img src="{{ asset('offerings/banner'.'/'.$offering->offering_bg) }}" class="img-fluid">
                            @if ($errors->has('banner_img'))
                                <span class="text-danger">{{ $errors->first('banner_img') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="status"
                                       {{ $offering->status == 1 ? 'checked' : '' }} name="status">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="short_desc" class="form-label">Short Description</label>
                            <textarea class="form-control" name="short_desc"
                                      id="short_desc">{{ $offering->short_desc }}</textarea>
                            @if ($errors->has('short_desc'))
                                <span class="text-danger">{{ $errors->first('short_desc') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="long_desc" class="form-label">Long Description</label>
                            <textarea class="form-control" name="long_desc"
                                      id="long_desc">{{ $offering->long_desc }}</textarea>
                            @if ($errors->has('long_desc'))
                                <span class="text-danger">{{ $errors->first('long_desc') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="disclaimer" class="form-label">Disclaimers</label>
                            <textarea class="form-control" name="disclaimer"
                                      id="disclaimer">{{ $offering->disclaimer }}</textarea>
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
                        @foreach($offering->offeringImages as $key => $images)
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-5">
                                    <img id="first-img-{{$key}}"
                                         src="{{ asset('offerings/gallery'.'/'.$images->image) }}" class="img-fluid"
                                         width="150px">
                                </div>
                                <div class="col-md-5 col-10">
                                    <input class="form-control" type="file" name="offering_images_old[]"
                                           id="first-file-{{ $key }}"
                                           class="input-upload"
                                           accept="image/jpeg, image/jpg, image/png"
                                           onchange="uploadOfferingImage(this, 'first-img-{{ $key }}', 'first-name','first-file-{{ $key }}')">
                                    <input type="hidden" name="image_ids[]" value="{{ $images->id }}">
                                    <div class="form-text">Images will be resized to (420X266)</div>
                                    @if ($errors->has('offering_images'))
                                        <span class="text-danger">{{ $errors->first('offering_images') }}</span>
                                    @endif
                                </div>
                                @if($key > 0)
                                    <div class="col-md-2 col-2">
                                        <div class="delete-image" title="Delete Image"
                                             onclick="deleteAttachments(this,'image', {{ $images->id }})"
                                             style="cursor: pointer">
                                            <i class="bx bx-trash me-1"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
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
                        @foreach($offering->offeringVideos as $key => $video)
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-5">
                                    {{--                                    <img id="first-video-{{$key}}" src="{{ asset('offerings/videos'.'/'.$video->image) }}" class="img-fluid" width="150px">--}}
                                    <video width="150" height="150" controls id="first-video-{{$key}}" src="{{ asset('offerings/videos'.'/'.$video->video) }}">
                                    </video>
                                </div>
                                <div class="col-md-5 col-10">
                                    <input class="form-control" type="file" name="offering_videos_old[]"
                                           id="first-file-video-{{$key}}"
                                           class="input-upload"
                                           onchange="uploadOfferingVideo(this, 'first-video-{{ $key }}', 'first-name','first-file-video-{{$key}}')">
                                    <input type="hidden" name="video_ids[]" value="{{ $video->id }}">
                                </div>
                                @if($key > 0)
                                    <div class="col-md-2 col-2">
                                        <div class="delete-image" title="Delete Image"
                                             onclick="deleteAttachments(this,'video', {{ $video->id }})"
                                             style="cursor: pointer">
                                            <i class="bx bx-trash me-1"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
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
                        @foreach($offering->offeringDocuments as $key => $doc)
                            @php
                                $strArray = explode('.',$doc->documents);
                                $lastElement = end($strArray);
                            @endphp
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-5">
                                    <img src="{{ asset('images/icons/'.$lastElement.'.png') }}" id="first-image-{{ $key }}" width="150px"
                                         class="img-fluid">
                                </div>
                                <div class="col-md-5 col-10">
                                    <input type="file" name="offering_docs_old[]"
                                           id="first-file-doc-{{$key}}"
                                           onchange="readNameAndType(this, 'first-doc', 'first-file-doc-{{ $key }}','first-image-{{ $key }}')"
                                           class="form-control">
                                    <input type="hidden" name="doc_ids[]" value="{{ $doc->id }}">
                                    <a href="{{ asset('offerings/docs/'.$doc->documents) }}" target="_blank">Click here to view doc</a>
                                </div>
                                @if($key > 0)
                                    <div class="col-md-2 col-2">
                                        <div class="delete-image" title="Delete Image"
                                             onclick="deleteAttachments(this,'docs', {{ $doc->id }})"
                                             style="cursor: pointer">
                                            <i class="bx bx-trash me-1"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
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
        </div>
    </form>

@endsection

@section('scripts')

@endsection
