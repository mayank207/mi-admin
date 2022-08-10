@extends('backend.layouts.base')

@section('title')
{!! setBreadCrumb('Account Setting') !!}
@endsection
@section('content')
<!--begin::Post-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <!--begin::Sign-in Method-->
        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_signin_method" class="collapse show">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">

                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="Javascript:;" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{$admin->name}}</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                        {{-- <a target="_blank" href="mailto:{{$admin->email}}" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                <span class="svg-icon svg-icon-4 me-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black" />
                                                        <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black" />
                                                    </svg>
                                                </span>
                                            <!--end::Svg Icon-->
                                            {{$admin->email}}
                                        </a> --}}
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <!--begin::Email Address-->
                    <div class="d-flex flex-wrap align-items-center">
                        <!--begin::Label-->
                        <div id="kt_signin_email">
                            <div class="fs-6 fw-bolder mb-1">Email Address</div>
                            <div class="fw-bold text-gray-600">{{$admin->email}}</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Edit-->
                        <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                            <!--begin::Form-->
                            <form id="kt_signin_change_email" action="{{route('admin.account_setting',getEncrypted($admin->id))}}" class="form" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="action" value="change_email">
                                <div class="row mb-6">
                                    <div class="col-lg-6">
                                        <div class="fv-row mb-0">
                                            <label for="name" class="form-label fs-6 fw-bolder mb-3">Name</label>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="name" id="name" value="{{$admin->name}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4 mb-lg-0">
                                        <div class="fv-row mb-0">
                                            <label for="emailaddress" class="form-label fs-6 fw-bolder mb-3">Enter New Email Address</label>
                                            <input type="email" class="form-control form-control-lg form-control-solid" id="email" placeholder="Email Address" name="email" value="{{$admin->email}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button id="kt_signin_submit" type="button" class="btn btn-primary me-2 px-6">Update</button>
                                    <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Edit-->
                        <!--begin::Action-->
                        <div id="kt_signin_email_button" class="ms-auto">
                            <button class="btn btn-light btn-active-light-primary">Change Email</button>
                        </div>
                        <!--end::Action-->
                    </div>
                    <!--end::Email Address-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Password-->
                    <div class="d-flex flex-wrap align-items-center mb-10">
                        <!--begin::Label-->
                        <div id="kt_signin_password">
                            <div class="fs-6 fw-bolder mb-1">Password</div>
                            <div class="fw-bold text-gray-600">************</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Edit-->
                        <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                            <!--begin::Form-->
                            <form id="kt_signin_change_password" action="{{route('admin.account_setting',getEncrypted($admin->id))}}"  class="form" novalidate="novalidate">
                                @csrf
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="currentpassword" class="form-label fs-6 fw-bolder mb-3">Current Password</label>
                                            <input type="password" class="form-control form-control-lg form-control-solid" name="currentpassword" id="currentpassword" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="password" class="form-label fs-6 fw-bolder mb-3">New Password</label>
                                            <input type="password" class="form-control form-control-lg form-control-solid" name="password" id="password" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="password_confirmation" class="form-label fs-6 fw-bolder mb-3">Confirm New Password</label>
                                            <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation" id="password_confirmation" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-text mb-5">Password must be at least 8 character and contain symbols</div>
                                <div class="d-flex">
                                    <button id="kt_password_submit" type="button" class="btn btn-primary me-2 px-6">Update Password</button>
                                    <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Edit-->
                        <!--begin::Action-->
                        <div id="kt_signin_password_button" class="ms-auto">
                            <button class="btn btn-light btn-active-light-primary">Reset Password</button>
                        </div>
                        <!--end::Action-->
                    </div>
                    <!--end::Password-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
@endsection
@section('external-scripts')
<script src="{{ asset('assets/js/custom/account/settings/signin-methods.js')}}"></script>
@endsection
