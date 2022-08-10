@extends('backend.layouts.base')
@section('title')
    {!! setBreadCrumb('Business', route('business.index')) !!}
    {!! setBreadCrumb($page_title) !!}
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
                                <div class="card" id="kt_profile_details_view">
                                    <!--begin::Card header-->
                                    <div class="card-header cursor-pointer">
                                        <!--begin::Card title-->
                                        <div class="card-title m-0">
                                            <h3 class="fw-bolder m-0">Business Details</h3>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Action-->
                                        @if($business_details->is_approved == 0 && $business_details->business_name != "" && $business_details->get_revision != null && $business_details->users_details->email_verified_at != "" && $business_details->church_approval == 1)
                                            <button class="btn btn-primary align-self-center change_status_class" data-status="{{$business_details->is_approved}}" data-url="{{route('business.update_approval_status',getEncrypted($business_details->id))}}">Approved</a>
                                        @endif
                                        <!--end::Action-->
                                    </div>
                                    <!--begin::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body p-9 pb-2">
                                        <!--begin::Row-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Business Name</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bolder fs-6 text-gray-800">{{$business_details->business_name}}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Business Email</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bolder fs-6 text-gray-800">{{$business_details->business_email}}</span>
                                                @if($business_details->business_email != "")
                                                @if($business_details->email_verified == 1)
                                                    <span class="badge badge-success">Verified</span>
                                                @else
                                                    <span class="badge badge-danger">Not Verified</span>
                                                @endif
                                                @endif
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Row-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Business Mobile Number</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bolder fs-6 text-gray-800">{{($business_details->country != null)? "+".$business_details->country->phone : ''}} <span class="mobile_input_mask">{{$business_details->business_mobile_number}}</span></span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        {{-- <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Category</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <span class="fw-bold text-gray-800 fs-6">
                                                    <span class="badge badge-secondary">{{$business_details->category_name}}</span>
                                                </span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group--> --}}
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Sub Category</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 d-flex align-items-center">
                                                <span class="fw-bolder fs-6 text-gray-800 me-2">
                                                    @if(!is_null($business_details->sub_categories))
                                                        @foreach ($business_details->sub_categories as $item)
                                                            <span class="badge badge-secondary">{{ $item->title }}</span>
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Short Description</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{$business_details->sort_description}}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Description</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{$business_details->description}}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Address Line 1</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{$business_details->address}}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Address Line 2</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{$business_details->address_2}}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">City</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{$business_details->city}}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">State</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{$business_details->state}}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Country</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{($business_details->country != null)? $business_details->country->name : ''}}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-bold text-muted">Status</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                @if($business_details->is_approved == 1)
                                                    <span class="badge badge-light-success">Approved</span>
                                                @elseif($business_details->is_approved == 2)
                                                    <span class="badge badge-light-danger">Rejected</span>
                                                @else
                                                    <span class="badge badge-light-warning">Pending</span>
                                                @endif
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card body-->
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

                <!--begin::business photos -->
                <div id="kt_content_container" class="container mt-4 ">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">Business Photos and videos</h3>
                            @if(!$business_details->business_media->isEmpty())
                                <div class="d-flex flex-wrap ">
                                    @foreach ($business_details->business_media as $media)
                                        <div class="col-auto pl-2 pr-2 m-3">
                                            <div class="d-flex">
                                                <a target="_blank" class="card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="{{$media->media_url}}">
                                                    <img src="{{$media->thumbnail}}" width="100px" height="75px" style="margin-right:3px;">
                                                </a>
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
        </div>
    </div>
@endsection

@section('external-scripts')
    <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js?') }}"></script>
    <script src="{{ asset('assets/js/jquery.googlemap.js?v=' . time()) }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    <script>
            //  Location of business
            var address = "{{($business_details)? $business_details->address : 'New York'}}";
            const show_latitude = "{{($business_details)? $business_details->latitude : '40.7127753'}}";
            const show_longitude = "{{($business_details)? $business_details->longitude : '-74.0059728'}}";
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
                    draggable: false
                });

                infoWindow.setContent(marker.title);
                infoWindow.open(map, marker);


            }
    </script>
@endsection
