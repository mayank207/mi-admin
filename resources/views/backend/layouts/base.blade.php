<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="{{ url('') }}">
    <title>{{ config('app.name') }} | {{ $page_title }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('img/blue_favicon.png') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ asset('assets/plugins/custom/leaflet/leaflet.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/backend_style.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{env('GOOGLE_MAPS_API_KEY')}}"></script>
    <!--end::Global Stylesheets Bundle-->
</head>
<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside"
                data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                @include('partials.menu')
                <!--end::Aside menu-->
                <!--begin::Footer-->
                <div class="aside-footer flex-column-auto py-5" id="kt_aside_footer">
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" style="" class="header align-items-stretch">
                    <!--begin::Brand-->
                    <div class="header-brand">
                        <!--begin::Logo-->
                        <a href="{{ route('backend.home') }}">
                            <img alt="Logo" src="{{ asset('img/kingdom_logo.png') }}"
                                class="h-auto w-100" />
                        </a>
                        <!--end::Logo-->
                    </div>
                    <!--end::Brand-->
                    @include('partials.top')
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="container">
                        @include('components.alerts')
                    </div>
                    @yield('content')
                </div>
                <!--end::Content-->

                <div id="reason_model" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="#" method="POST" id='approval_status_form'>
                                @csrf
                                <div class="modal-header p-5">
                                    <label class="modal-title">Business Approval</label>
                                    <span class="svg-icon svg-icon-1" id="close_reason_modal" data-kt-users-modal-action="close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                                        </svg>
                                    </span>
                                </div>
                                <div class="modal-body p-5">
                                    <div class="form-group">
                                        <label for="approval_status">Approval Status</label>
                                        <select  class="form-control form-control-solid mt-2" data-control="select2" data-hide-search="true" name="approve_status" id="approve_status">
                                            <option value="1" selected>Approved</option>
                                            <option value="2">Rejected</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-2" id="reject_reason_div">
                                        <label for="reject_reason">Reject Reason</label>
                                        <textarea class="form-control form-control-solid" name="reject_reason" id="reject_reason" rows="3" placeholder="Enter rejection reason"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" >
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <a href="Javascript:;" class="text-gray-800 text-hover-primary">{!! footer_title() !!}</a>
                        </div>
                        <!--end::Copyright-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <!--begin::Javascript-->

    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/form_validation.js?v=' . time()) }}"></script>
    <script src="{{ asset('assets/js/backend_jquery.js?v=' . time()) }}"></script>
    <!--end::Javascript-->

    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{asset('assets/js/jquery.inputmask.bundle.min.js')}}"></script>

    <!--start::External Javascript-->
    @yield('external-scripts')
    <script>
        /* custom validation */
        $.validator.addMethod('checkemail', function(value) {
            return /^([\w-\.]+@([\w-]+\.)+[a-z]{2,10})?$/.test(value);
        }, 'Please enter a valid email');

        $.validator.addMethod("noSpace", function(value, element) {
            if($.trim(value) == 0) {
                return false;
            }
            return true;
        }, "Space are not allowed");

        // jQuery.validator.addMethod("noSpace", function (value, element) {
        //     return this.optional(element) || /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z0-9,./()#?!@$%^&*--, ])*$/.test(value);
        // }, "Please enter valid value");

        $.validator.addMethod("mobile_number", function(value, element) {
            return this.optional(element) ||
                value.match(/^[0-9,\-]+$/);
        }, "Please enter a valid number, or 'NA'");

        $.validator.addMethod("input_mask_mobile_number", function (value, element) {
            return /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/is.test(value);
        }, "Please enter a valid number");

        $.validator.addMethod("validateAddress", function(value, element) {
            if ($("#edit_latitude").val().length > 0 && $("#edit_longitude").val().length > 0) {
                return true;
            }else{
                return false;
            }
        }, "Please enter valid address");

        $.validator.addMethod("pwcheck", function(value) {
                return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(value);
            },
            "The password should contain Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Special Character, 1 Numeric Value."
            );
        $.validator.addMethod("username", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._]+$/.test(value);
        }, "Please enter valid username");

        $.validator.addMethod("checkurl", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._:/]+$/.test(value.trim());
        },"Please enter valid url");

        $.validator.addMethod("checkWebsiteUrl", function(value, element) {
            return this.optional(element) || /^((https?|ftp|smtp):\/\/)?(\www\.[a-z0-9]{5,})+(\.[a-z]{2,}){1,3}(#?\/?[a-zA-Z0-9#]+)*\/?(\?[a-zA-Z0-9-_]+=[a-zA-Z0-9-%]+&?)?$/.test(value.trim());
        },"Please enter valid url");

        setTimeout(() => {
            $('.notice').remove();
        }, 3000);
    </script>
    <script>
        @if (Session::get('toast-success'))
            toastr.success('{{ Session::get('toast-success') }}', "Success");
        @endif
        @if (Session::get('toast-error'))
            toastr.error('{{ Session::get('toast-error') }}', "Error");
        @endif
    </script>
    <!--end::External Javascript-->
</body>
</html>
