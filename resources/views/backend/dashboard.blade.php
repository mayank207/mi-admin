@extends('backend.layouts.base')
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container">
        <!--begin::Row-->
        <div class="row g-xl-8">
            <!--begin::Users-->
            <div class="col-xl-3">
                <!--begin::Customers-->
                <a href="{{route('users.index')}}" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
                                <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
                                <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{$total_users}}</div>
                        <div class="fw-bold text-gray-100">Total Customers</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Customers-->
            </div>
            <!--end::Users-->

            <!--begin::Total business-->
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="{{route('business.index')}}" class="card bg-primary hoverable card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                       <!--begin::Svg Icon | path: icons/duotune/graphs/gra005.svg-->
                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path d="M21 7h-6a1 1 0 0 0-1 1v3h-2V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zM8 6h2v2H8V6zM6 16H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V6h2v2zm4 8H8v-2h2v2zm0-4H8v-2h2v2zm9 4h-2v-2h2v2zm0-4h-2v-2h2v2z"/></svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{$all_business}}</div>
                        <div class="fw-bold text-gray-100">Total Business</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <!--end::Total business-->

             <!--begin::pending business-->
             <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="{{route('business.index')}}?approval_status=0"  class="card bg-warning hoverable card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <!-- Uploaded to SVGRepo https://www.svgrepo.com -->
                                <title>ic_fluent_shifts_pending_24_regular</title>
                                <desc>Created with Sketch.</desc>
                                <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="ic_fluent_shifts_pending_24_regular" fill="#212121" fill-rule="nonzero">
                                        <path d="M6.5,12 C9.53756612,12 12,14.4624339 12,17.5 C12,20.5375661 9.53756612,23 6.5,23 C3.46243388,23 1,20.5375661 1,17.5 C1,14.4624339 3.46243388,12 6.5,12 Z M6.5,19.88 C6.15509206,19.88 5.87548893,20.1596031 5.87548893,20.5045111 C5.87548893,20.849419 6.15509206,21.1290221 6.5,21.1290221 C6.84490794,21.1290221 7.12451107,20.849419 7.12451107,20.5045111 C7.12451107,20.1596031 6.84490794,19.88 6.5,19.88 Z M17.75,3 C19.5449254,3 21,4.45507456 21,6.25 L21,17.75 C21,19.5449254 19.5449254,21 17.75,21 L11.9774077,21.0012092 C12.2742498,20.5377831 12.5138894,20.0341997 12.6863646,19.5004209 L17.75,19.5 C18.7164983,19.5 19.5,18.7164983 19.5,17.75 L19.5,6.25 C19.5,5.28350169 18.7164983,4.5 17.75,4.5 L6.25,4.5 C5.28350169,4.5 4.5,5.28350169 4.5,6.25 L4.49957906,11.3136354 C3.96580034,11.4861106 3.46221691,11.7257502 2.99879075,12.0225923 L3,6.25 C3,4.45507456 4.45507456,3 6.25,3 L17.75,3 Z M6.5000438,14.0030924 C5.45209485,14.0030924 4.63575024,14.8204841 4.64666418,15.9573825 C4.64931495,16.2335122 4.87531114,16.4552106 5.15144079,16.4525598 C5.42757044,16.449909 5.64926888,16.2239129 5.6466181,15.9477832 C5.64105975,15.3687734 6.00627225,15.0030924 6.5000438,15.0030924 C6.97241724,15.0030924 7.35344646,15.3949794 7.35344646,15.9525829 C7.35344646,16.1768805 7.27815856,16.343747 7.03551615,16.6299729 L6.93650069,16.7432479 L6.67112833,17.0333231 C6.18682267,17.5748716 6.0000438,17.9254825 6.0000438,18.5006005 C6.0000438,18.7767429 6.22390142,19.0006005 6.5000438,19.0006005 C6.77618617,19.0006005 7.0000438,18.7767429 7.0000438,18.5006005 C7.0000438,18.268353 7.07645293,18.0980788 7.32379001,17.8062547 L7.42473827,17.6907646 L7.69048308,17.400276 C8.16815154,16.8660369 8.35344646,16.5185919 8.35344646,15.9525829 C8.35344646,14.8488849 7.5310877,14.0030924 6.5000438,14.0030924 Z M11.75,6 C12.1296958,6 12.443491,6.28215388 12.4931534,6.64822944 L12.5,6.75 L12.5,12 L16.2482627,12 C16.6624763,12 16.9982627,12.3357864 16.9982627,12.75 C16.9982627,13.1296958 16.7161089,13.443491 16.3500333,13.4931534 L16.2482627,13.5 L11.75,13.5 C11.3703042,13.5 11.056509,13.2178461 11.0068466,12.8517706 L11,12.75 L11,6.75 C11,6.33578644 11.3357864,6 11.75,6 Z" id="🎨-Color"/>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{$pending_business}}</div>
                        <div class="fw-bold text-gray-100">Pending Business</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <!--end::pending business-->

             <!--begin::approved business-->
             <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="{{route('business.index')}}?approval_status=1" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8 aprroval_status_dashboard_filter">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none"><path d="M16.5163 8.93451L11.0597 14.7023L8.0959 11.8984" stroke="black" stroke-width="2"/><path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="black" stroke-width="2"/></svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{$approved_business}}</div>
                        <div class="fw-bold text-gray-100">Approved Business</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <!--end::approved business-->

            <!--begin::total church-->
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="{{route('church.index')}}"  class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                       <!--begin::Svg Icon | path: icons/duotune/general/gen049.svg-->
                        <span class="svg-icon svg-icon-2x svg-icon-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="436.38px" height="436.381px" viewBox="0 0 436.38 436.381" style="enable-background:new 0 0 436.38 436.381;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M218.19,232c54.735,0,99.107-51.936,99.107-116c0-88.842-44.371-116-99.107-116c-54.736,0-99.107,27.158-99.107,116    C119.083,180.064,163.455,232,218.19,232z"/>
                                        <path d="M432.47,408.266l-50-112.636c-1.838-4.142-5.027-7.534-9.045-9.626l-79.62-41.445c-4.809-2.504-10.423-2.947-15.564-1.231    c-5.141,1.715-9.364,5.442-11.707,10.329L232.7,324.266l4.261-38.408c0.133-1.201-0.174-2.412-0.865-3.405l-13.8-19.839    c-0.048-0.068-0.104-0.131-0.154-0.195l11.935-9.061c1.028-0.781,1.633-1.998,1.633-3.291c0-4.834-3.935-8.769-8.77-8.769h-17.498    c-4.835,0-8.769,3.935-8.769,8.769c0,1.293,0.604,2.51,1.633,3.291l11.934,9.061c-0.051,0.064-0.106,0.127-0.154,0.195    l-13.8,19.839c-0.691,0.993-0.999,2.204-0.865,3.405l4.26,38.408l-33.834-70.609c-2.342-4.887-6.566-8.614-11.707-10.329    c-5.14-1.716-10.757-1.271-15.564,1.231l-79.62,41.445c-4.018,2.092-7.207,5.484-9.045,9.626l-50,112.636    c-2.746,6.188-2.177,13.342,1.512,19.018c3.689,5.674,9.999,9.098,16.768,9.098h392c6.769,0,13.078-3.424,16.768-9.1    C434.648,421.607,435.216,414.453,432.47,408.266z"/>
                                    </g>
                                </g>
                                </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{$total_church}}</div>
                        <div class="fw-bold text-gray-100">Total Church</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <!--end::total church-->
        </div>
        <!--end::Row-->
    </div>
</div>
@endsection
