@extends('backend.layouts.base')

@section('title')
    {!! setBreadCrumb('Business', route('business.index')) !!}
    {!! setBreadCrumb('Edit') !!}
@endsection
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-xxl">
        <div class="row g-5 g-xl-8">

            <!--begin::business details column-->
            <div class="col-xl-12">
                <!--begin::2nd column-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <form class="form" action="{{ route('business.update', getEncrypted($business->id)) }}" id="edit_business_form" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="py-5">Business Details :</h3>
                                                <!-- Name -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Business Name</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        value="{{ $business->business_name }}" name="business_name" />
                                                    @if ($errors->has('business_name'))
                                                        <span class="text-danger">{{ $errors->first('business_name') }}</span>
                                                    @endif
                                                </div>
                                                <!-- end-Name -->

                                                <!-- email -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Business Email</label>
                                                    <input type="email" class="form-control form-control-solid"
                                                        value="{{ $business->business_email }}" name="business_email" />
                                                    @if ($errors->has('business_email'))
                                                        <span class="text-danger">{{ $errors->first('business_email') }}</span>
                                                    @endif
                                                </div>
                                                <!-- end-email -->

                                                <!-- Mobile -->
                                                <div class="fv-row mb-7 form-group">
                                                    <label class="required fs-6 fw-bold mb-2">Business Mobile Number</label>
                                                        <div class="row">
                                                            <div class="col-md-4 pl-0">
                                                                <select name="business_country_code" id='business_country_code' class="form-select form-select-solid" data-control="select2">
                                                                    @foreach ($country as $value)
                                                                        <option value="{{ $value->phone }}" {{ $value->phone == $business->country_code ? 'selected' : '' }}>
                                                                            {{ '+'. $value->phone }} </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="business_mobile_number" class="form-control form-control-solid mobile_input_mask" value="{{$business->business_mobile_number}}" placeholder="" name="business_mobile_number" />


                                                            </div>
                                                        </div>
                                                        @if ($errors->has('business_mobile_number'))
                                                            <span class="text-danger">{{ $errors->first('business_mobile_number') }}</span>
                                                        @endif
                                                    </div>
                                                <!-- end-Mobile -->

                                                <h3 class="py-5">Business Category Details</h3>
                                                {{-- <!--begin::category group-->
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="required">Category</span>
                                                    </label>
                                                    <!--end::Label-->

                                                    <select name="business_category" data-error="#error-category" id="business_category" class="form-select form-select-solid" data-control="select2">
                                                        <option value="">Choose Business Category</option>
                                                        @if (!empty($user_category))
                                                            @foreach ($categories as $value)
                                                            <option value="{{ $value->id }}" {{ $value->id == $user_category ? 'selected' : '' }}>
                                                                {{ $value->title }} </option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($categories as $value)
                                                                <option value="{{ $value->id }}">
                                                                {{ $value->title }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div id="error-category"></div>
                                                </div>
                                                <!--end::category group--> --}}

                                                <!--begin::sub category group-->
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="">Business Services</span>
                                                    </label>
                                                    <!--end::Label -->

                                                    <!--start::business_sub_category -->
                                                    <select name="business_sub_category[]" id="business_sub_category" class="form-select form-select-solid" data-control="select2" multiple >
                                                        @if (!empty($business_sub_categories))
                                                            @foreach ($sub_categories as $value)
                                                                <option value="{{ $value->id }}" @if(in_array($value->id, $business_sub_categories)) {{'selected'}} @endif>{{ $value->title }} </option>
                                                            @endforeach
                                                            @else
                                                                @foreach ($sub_categories as $value)
                                                                    <option value="{{ $value->id }}">{{ $value->title }} </option>
                                                                @endforeach
                                                        @endif
                                                    </select>
                                                    <!--end::business_sub_category -->
                                                </div>
                                                <!--end::sub category group-->

                                                {{-- <!--secondary category group-->
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="">Secondary Category</span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <select name="secondary_category" data-error="#error-category" id="secondary_category" class="form-select form-select-solid" data-control="select2">
                                                        <option value="">Choose Business Category</option>
                                                        @if (!empty($secondary_category))
                                                            @foreach ($categories as $value)
                                                            <option value="{{ $value->id }}" {{ $value->id == $secondary_category ? 'selected' : '' }}>
                                                                {{ $value->title }} </option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($categories as $value)
                                                                <option value="{{ $value->id }}">
                                                                {{ $value->title }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div id="error-category"></div>
                                                </div>
                                                <!--end::secondary category group-->

                                                <!--begin::secondary sub category group-->
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="">Secondary Sub Category </span>
                                                    </label>
                                                    <!--end::Label -->

                                                    <!--start::business_secondary_sub_category -->
                                                    <select name="secondary_sub_category[]" id="secondary_sub_category" class="form-select form-select-solid" data-control="select2" multiple>
                                                        @if (!empty($secondary_subcategory))
                                                            @foreach ($secondary_sub_categories as $value)
                                                                <option value="{{ $value->id }}" @if(in_array($value->id, $secondary_subcategory)) {{'selected'}} @endif>{{ $value->title }} </option>
                                                            @endforeach
                                                        @else
                                                            @foreach ($secondary_sub_categories as $value)
                                                                <option value="{{ $value->id }}">{{ $value->title }} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <!--end::business_secondary_sub_category -->
                                                </div>
                                                <!--end::secondarysub category group--> --}}

                                                <h3 class="py-5">Description Details :</h3>
                                                <!-- short description -->
                                                <div class="fv-row mb-7">
                                                    <label class="required fs-6 fw-bold mb-2">
                                                        <span>Short Description</span>
                                                    </label>
                                                    <textarea class="form-control description-hight form-control-solid" rows="3" name="sort_description" placeholder="Short Description">{{ $business->sort_description }}</textarea>
                                                </div>
                                                <!--end- short description -->

                                                <!-- description -->
                                                <div class="fv-row mb-7">
                                                    <label class="fs-6 fw-bold mb-2">
                                                        <span class="required">Description</span>
                                                    </label>
                                                    <textarea class="form-control description-hight form-control-solid" rows="6" placeholder="Description"
                                                        name="description">{{ $business->description }}</textarea>
                                                </div>
                                                <!--end-description -->

                                                {{-- <div class="col-md-12"> --}}
                                                    <!-- Status dropdown -->
                                                    <div class="fv-row mb-7">
                                                       <label class="fs-6 fw-bold mb-2">
                                                           <span class="required ">Approval Status</span>
                                                       </label>
                                                       @php
                                                           $approval_status = ['0'=>'Pending','1'=>'Approved','2'=>'Rejected'];
                                                           if($business->users_details->email_verified_at == "" || $business->church_approval != 1){
                                                               $approval_status = ['0'=>'Pending','2'=>'Rejected'];
                                                           }
                                                       @endphp
                                                       {!! Form::select('is_approved', $approval_status, $business->is_approved, ['class'=>'form-select form-select-solid','id'=>'is_approved']) !!}
                                                   </div>
                                                   <!-- end-Status dropdown -->
                                                   <!-- Status dropdown -->
                                                   <div class="fv-row mb-7 d-none reject-reason-input">
                                                       <label class="fs-6 fw-bold mb-2">
                                                           <span>Reject Reason</span>
                                                       </label>
                                                       {!! Form::textarea('reject_reason', '', ['class'=>'form-control form-control-solid', 'rows'=>3]) !!}
                                                   </div>
                                                   <!-- end-Status dropdown -->
                                               {{-- </div> --}}

                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="py-5">Social Links</h3>
                                            <!-- facebook -->
                                            <label class=" fs-6 fw-bold mb-2">Facebook Link</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook-f"> </i> &nbsp;&nbsp;www.facebook.com/</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Facebook Link" name="facebook_url" id="facebook_url" data-error="#error-facebook"  value="{{ ($business->social_links) ? $business->social_links->facebook_url :'' }}">
                                            </div>
                                            <div id="error-facebook"></div>
                                            <!-- facebook -->

                                            <!-- instagram -->
                                            <label class=" fs-6 fw-bold mb-2">Instagram Link</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fab fa-instagram"> </i> &nbsp;&nbsp;www.instagram.com/</span>
                                                </div>
                                                <input type="text" class="form-control" data-error="#error-instagram" placeholder="Instagram Link" name="instagram_url" id="instagram_url"  value="{{ ($business->social_links) ? $business->social_links->instagram_url :'' }}">
                                            </div>

                                            <div id="error-instagram"></div>
                                            <!-- end-instagram -->

                                            <!-- twitter -->
                                            <label class=" fs-6 fw-bold mb-2">Twitter Link</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fab fa-twitter"> </i> &nbsp;&nbsp; &nbsp;&nbsp;www.twitter.com/  &nbsp;&nbsp; &nbsp;</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Twitter Link" name="twitter_url" data-error="#error-twitter" id="twitter_url" value="{{ ($business->social_links) ? $business->social_links->twitter_url :'' }}">
                                            </div>
                                            <div id="error-twitter"></div>
                                            <!-- end-twitter -->
                                             <!-- linked_in_url -->
                                             <label class=" fs-6 fw-bold mb-2">Linkedin Link</label>
                                             <div class="input-group mb-3">
                                                 <div class="input-group-prepend">
                                                 <span class="input-group-text" id="basic-addon1"><i class="fab fa-linkedin"> </i> &nbsp;&nbsp;&nbsp;&nbsp;www.linked_in.com/</span>
                                                 </div>
                                                 <input type="text" class="form-control" placeholder="Linkedin Link" name="linked_in_url" data-error="#error-linkedin" id="linked_in_url" value="{{ ($business->social_links) ? $business->social_links->linked_in_url :'' }}">
                                             </div>
                                             <div id="error-linkedin"></div>

                                             <!-- end-linked_in_url -->

                                               <!-- Website -->
                                               <label class=" fs-6 fw-bold mb-2">Website Link</label>
                                               <div class="input-group mb-3">
                                                   <input type="text" class="form-control" placeholder="Website Link" data-error="#error-website" name="website_url" id="website_url"  value="{{$business->website_url}}">
                                               </div>
                                               <div id="error-website"></div>
                                               <!-- end-Website -->

                                            <h3 class="py-5">Address Details</h3>
                                            <!-- Address -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2">Address Line 1</label>
                                                    <input type="text" class="form-control form-control-solid address" id="edit_business_location" value="{{  $business->address }}" name="address" placeholder="Address Line 1" />
                                                    <input type="hidden" name="latitude" id="edit_latitude" value="{{  $business->latitude }}">
                                                    <input type="hidden" name="longitude" id="edit_longitude" value="{{  $business->longitude }}">
                                            </div>
                                            <!-- end-Address -->

                                            <!-- address_2 code -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="fs-6 fw-bold mb-2 address">Address Line 2</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    value="{{ $business->address_2 }}" id="address_2" name="address_2" placeholder="Address Line 2" />
                                            </div>
                                            <!-- end-address_2 code -->

                                            <!-- zip code -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2 address">Zip Code</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    value="{{ $business->zip_code }}" id="zip_code" name="zip_code" placeholder="Zip Code" />
                                            </div>
                                            <!-- end-zip code -->

                                            <!-- city -->
                                             <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2 address">City</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    value="{{ $business->city }}" name="city" placeholder="City"/>
                                            </div>
                                            <!-- end-city -->

                                            <!-- state -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="required fs-6 fw-bold mb-2 address">State</label>
                                                <input type="text" class="form-control form-control-solid"
                                                    value="{{ $business->state }}" name="state" placeholder="State"/>
                                            </div>
                                            <!-- end-state -->
                                            <!-(- country dropdown -->
                                            <div class="fv-row mb-7 form-group">
                                                <label class="fs-6 fw-bold mb-2">
                                                    <span class="required ">Country</span>
                                                </label>
                                                    <select name="country" class="form-select form-select-solid address" data-control="select2">
                                                @foreach ($country as $value)
                                                    <option value="{{ $value->id }}" data-country="{{ $value->name }}"
                                                        {{ $value->id == $business->country_id ? 'selected' : '' }}>
                                                        {{ $value->name }} </option>
                                                        @endforeach
                                                </select>
                                            </div>
                                            <!-- end-country dropdown -->
                                        </div>


                                        <div class="col-md-12">
                                            <div class="fv-row mt-5">
                                                @if($business->users_details->email_verified_at == "")
                                                    <p><span class="bg-light-danger text-danger p-2 d-block mb-1"><i class="fa fa-info-circle text-danger"></i> User email verification pending</span></p>
                                                @endif
                                                @if($business->church_approval != 1)
                                                    <p><span class="bg-light-warning text-warning p-2 d-block mb-1"><i class="fa fa-info-circle text-warning"></i> User church verification pending</span></p>
                                                @endif
                                                @if($business->users_details->email_verified_at == "" || $business->church_approval != 1)
                                                    <p><span class="bg-light-dark text-dark p-2 d-block mb-1"><b><i class="fa fa-info-circle text-dark"></i> Note:</b> If a user's email or church verification pending then you can not approved their business.</span></p>
                                                @endif
                                            </div>
                                            <input type="hidden" value="{{$business->user_id}}" name="user_id">
                                            <div class="fv-row mt-5 d-flex justify-content-end">
                                                <!--begin::Button-->
                                                <a href="{{ route('business.index') }}" class="btn btn-light me-3">Cancel</a>
                                                <!--end::Button-->
                                                <!--begin::Button-->
                                                <button type="submit" id="edit_business_form_submit" data-kt-banner-action="submit"
                                                    class="btn btn-primary">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::2nd column-->

            </div>
            <!--end::business details column-->

            <!--Begin::church details column-->
            <div class="col-xl-12">
                <div id="kt_content_container" class="container mt-4 ">
                    @if (isset($business->church_details))
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <h3 class="card-title align-items-start flex-column mb-5">
                                <span class="fw-bolder text-dark">Church Details</span>
                            </h3>


                             <!--begin::Church details-->
                                <div class="row p-5">
                                    <label class="col-lg-4 fw-bold text-muted mb-2">Name</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800 mb-2"> {{ ($business->church_details)? $business->church_details->name:'' }}</span>
                                    </div>
                                    <label class="col-lg-4 fw-bold text-muted mb-2">Email</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800 mb-2">{{ ($business->church_details)? $business->church_details->email:'' }}</span>
                                    </div>
                                    <label class="col-lg-4 fw-bold text-muted mb-2">Denomination</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800 mb-2">{{ ($business->church_address_details->church_type)? $business->church_address_details->church_type->name:'' }}</span>
                                    </div>
                                    <label class="col-lg-4 fw-bold text-muted mb-2">Name Of Spritual Authority</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800 mb-2">{{ ($business->church_address_details)? $business->church_address_details->name_of_leader:'' }}</span>
                                    </div>
                                    <label class="col-lg-4 fw-bold text-muted mb-2">Address</label>
                                    <div class="col-lg-8">
                                        <span class="fw-bolder fs-6 text-gray-800 mb-2">
                                            @if($business->church_address_details)
                                            {{$business->church_address_details->address}}<br>
                                            {{$business->church_address_details->address_2}} <br>
                                            {{$business->church_address_details->city}} -
                                            {{$business->church_address_details->zip_code}} <br>
                                            {{$business->church_address_details->state}}
                                            @if($business->church_address_details->country)
                                            ,{{$business->church_address_details->country->name}}
                                            @endif
                                        @endif </span>
                                    </div>
                                </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    @else
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <h5 class="text-center">No church details found</h5>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!--end::church details column-->


            <!--begin::2nd column-->
            <div class="col-xl-12">

                <!--begin::business photos -->
                <div id="kt_content_container" class="container mt-4 ">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">Business Photos and videos</h3>
                            @if(!$business->business_media->isEmpty())
                                <div class="d-flex flex-wrap ">
                                    @foreach ($business->business_media as $media)
                                        <div class="col-auto pl-2 pr-2 m-3">
                                            <div class="d-flex position-relative pic_{{$media->id}}_delete">
                                                <a target="_blank" class="card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="{{$media->media_url}}">
                                                    <img src="{{$media->thumbnail}}" width="150px" height="100px" >
                                                </a>
                                                <div class="avatar-delete image_trash" data-value="{{$media->id}}">
                                                    <label for="">
                                                        <i class="fa fa-trash text-danger" data-toggle="modal" data-target="#spam-message"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <h5 class="text-center">No business media found</h5>
                            @endif

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::business photos -->

                <!--begin::location card-->
                @include('backend.business.location_card')
                <!--end::location card-->
            </div>
            <!--end::2nd column-->
        </div>
    </div>
</div>
@endsection

@section('external-scripts')
<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js?v=' . time()) }}"></script>
    <script src="{{ asset('assets/js/jquery.googlemap.js?v=' . time()) }}"></script>

    <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
    <script>
        var id='{{$business->id}}';
        $("#edit_business_form").validate({
        rules: {
            business_name:{
                required:true,
                noSpace:true,
            },
            business_email:{
                checkemail:true,
				required: true,
                remote: {
							type: 'post',
							url: "{{route('backend.business.email_exists')}}",
							data: {'_token': $("input[name=_token]").val(),id:id},
							dataFilter: function (data)
							{
                                console.log(data);
								var json = JSON.parse(data);
								if (json.valid === true) {
                                    return '"true"';
								} else {
                                    return "\"" + json.message + "\"";
								}
							}
                        }

					},
            business_mobile_number:{
                required:true ,
                input_mask_mobile_number:true,
            },
            city:{
                required:true ,
                noSpace:true,
            },
            state:{
                required:true ,
                noSpace:true,
            },
            zip_code:{

                required:true ,
                minlength:5,
                maxlength:10,
            },
            description:{
                required:true ,
                noSpace:true,
            },
            sort_description:{
                required:true,
                noSpace:true,
            },
            business_category:{
                required:true,
            },
            address:{
                required:true,
                noSpace:true,
                validateAddress:true,
            },
            facebook_url:{
                checkurl:true,
            },
            twitter_url:{
                checkurl:true,
            },
            instagram_url:{
                checkurl:true,
            },
            linked_in_url:{
                checkurl:true,
            },
            website_url:{
                checkWebsiteUrl: true,
            },

        },
        messages: {
            business_name: 'Please enter business name',
            business_email:{
                required:"Please enter email",
                remote:"Email is already exists",
                checkemail:"Please enter valid email",
            },
            business_mobile_number: {
                required:'Please enter mobile number',
                input_mask_mobile_number:"Please enter a valid number",
            },
            city:"Please enter business city",
            state:"Please enter business state",
            zip_code:"Please enter zip code",
            description:"Please enter description",
            sort_description:"Please enter short description",
            address:{
               required:"Please enter address",
            },
            business_category:{
                required:"please choose category",
            },
            facebook_url: {
                checkurl:"Please enter valid facebook url",
            },
            instagram_url: {
                checkurl:"Please enter valid instagram url",
            },
            linked_in_url: {
                checkurl:"Please enter valid linkedin url",
            },
            twitter_url: {
                checkurl:"Please enter valid twitter url",
            },
            website_url: {
                url:"Please enter valid website url"
            },

        },
        errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
        submitHandler: function (form) {
            return true;
        },
        success: function(label,element) {
            label.parent().removeClass('has-danger');
        },
    });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('change','#business_category', function () {
                var id = this.value;
                $("#business_sub_category").html('');
                $.ajax({
                    url: "{{route('fetch_sub_category')}}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#business_sub_category').html('');
                        $.each(data.sub_category, function (key, value) {
                            $("#business_sub_category").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                    }
                });
            });

            $(document).on('change','#secondary_category', function () {
                var id = this.value;
                $("#secondary_sub_category").html('');
                $.ajax({
                    url: "{{route('fetch_sub_category')}}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#secondary_sub_category').html('');
                        $.each(data.sub_category, function (key, value) {
                            $("#secondary_sub_category").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                    }
                });
            });
        });

        /* Show Reject reason conditional */
        $(document).on('change','#is_approved',function(){
            if($(this).val() == '2'){
                $('.reject-reason-input').removeClass('d-none');
                $('.reject-reason-input').find('textarea').val('');
            }else{
                $('.reject-reason-input').addClass('d-none');
            }
        });

        /* delete business image */
        $(document).on('click','.image_trash',function(){
            var id =$(this).attr('data-value');
            Swal.fire({
                text: "Are you sure to delete this media file ?",
                icon: "warning",
                showCancelButton: !0,
                buttonsStyling: !1,
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary" },
            }).then(function (result) {
                console.log(result.isConfirmed);
                if(result.isConfirmed){
                    $.ajax({
                        url: "{{route('business_media.destroy')}}",
                        type: "POST",
                        data: {
                            id: id,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (data) {
                            $('.pic_'+id+'_delete').remove();
                            if(data.status=='success')
                            {
                                toastr.success(data.message);
                            }
                            else
                            {
                                toastr.error(data.message);
                            }
                        }
                    });
                }else{

                }
            });

            });
    </script>

        {{-- Location of business --}}
        <script>
            var address = "{{($business)? $business->address : 'New York'}}";
            const show_latitude = "{{($business)? $business->latitude : '40.7127753'}}";
            const show_longitude = "{{($business)? $business->longitude : '-74.0059728'}}";
            initialize();
            function initialize(){
                var infoWindow = new google.maps.InfoWindow();
                var myLatlng = new google.maps.LatLng(show_latitude,show_longitude);
                var myOptions = {
                        zoom: 17,
                        center: myLatlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                map = new google.maps.Map(document.getElementById("show-map"), myOptions);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    title: address,
                    draggable: true
                });

                infoWindow.setContent(marker.title);
                infoWindow.open(map, marker);

                google.maps.event.addListener(marker, 'dragend', function () {
                    $('#edit_latitude').val(marker.getPosition().lat());
                    $('#edit_longitude').val(marker.getPosition().lng());
                    infoWindow.setContent(marker.title);
                    infoWindow.open(map, marker);
                    map.setCenter(marker.getPosition());
                    map.setZoom(17); // Why 17? Because it looks good.
                    $('#show_lat').html(marker.getPosition().lat());
                    $('#show_long').html(marker.getPosition().lng());
                })
            }

            /* On change address */
            $('.address').blur(function(){
            // $('#edit_business_location').blur(function () {
                if($('#edit_business_location').val() != "" && $('#city').val() != "" && $('#state').val() != "" && $('#zip_code').val() !=""){
                // if($(this).val() != ""){
                    var address = $('#edit_business_location').val() + ','+$('#address_2').val() + ',' + $('#city').val()  +','+ $('#zip_code').val() + ',' + $('#state').val() +','+ $('option:selected','#country').data('country');
                          
                            $('#edit_latitude').val('');
                            $('#edit_longitude').val('');
                    var map = new google.maps.Map(document.getElementById("show-map"));
                    var latlngbounds = new google.maps.LatLngBounds();
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ 'address': address }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            var Latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                            var marker = new google.maps.Marker({
                                position: Latlng,
                                map: map,
                                title: results[0].formatted_address,
                                draggable: true
                            });

                            $('#edit_latitude').val(results[0].geometry.location.lat());
                            $('#edit_longitude').val(results[0].geometry.location.lng());

                            latlngbounds.extend(marker.position);
                            google.maps.event.addListener(marker, "click", function (e) {
                                infoWindow.setContent(marker.title);
                                infoWindow.open(map, marker);
                            });

                            google.maps.event.addListener(marker, 'dragend', function () {

                                $('#edit_latitude').val(marker.getPosition().lat());
                                $('#edit_longitude').val(marker.getPosition().lng());



                                infoWindow.setContent(marker.title);
                                infoWindow.open(map, marker);
                            })
                            if (results[0].geometry.viewport) {
                                map.fitBounds(results[0].geometry.viewport);
                            } else {
                                map.setCenter(results[0].geometry.location);
                                map.setZoom(17); // Why 17? Because it looks good.
                            }
                        } else {
                            $('#edit_latitude').val('');
                            $('#edit_longitude').val('');
                        }
                    });
                }
                return false;
            });

        </script>
@endsection
