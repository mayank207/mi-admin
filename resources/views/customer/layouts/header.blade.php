@php
    $get_current_location = Cookie::get("current_location");
    if(!is_null($get_current_location)){
        $get_current_location = json_decode($get_current_location);
    }
@endphp
<section class="border-bottom px-lg-4 px-xl-5">
    <div class="container-fluid py-4 px-0 px-lg-3">
        <nav class="navbar navbar-expand-lg navbar-light px-lg-0 d-block d-lg-flex">
            <div class="d-flex justify-content-between align-items-center">
                <button class="navbar-toggler btn border-0 shadow-none text-black openNav" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <a class="navbar-brand ml-lg-0 mx-4 mr-lg-5" href="{{route('home')}}"><img src="{{ asset('img/LOGO1.png') }}"
                        class="img-fluid" alt=""></a>

            @if (Auth::check())
                <div class="dropdown show cus-profile d-lg-none">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->user_profile }}"
                            class="w-50px h-50px rounded-circle header-profile-image" alt="">
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <div class="text-center d-block px-4 py-1 text-nowrap">
                            <img src="{{ Auth::user()->user_profile }}"
                                class="img-fluid w-50px h-50px rounded-circle header-profile-image" alt="">
                        </div>
                        <div class="border-bottom d-block px-4 py-1 text-nowrap">
                            <p class="font-18 font-weight-bold text-dark-gray font-mulish mb-0">  {{ ucfirst(Auth::user()->full_name) }}
                            </p>
                            <p class="font-14 text-dark-gray font-mulish mb-0">
                                @if (Auth::user()->role_id == 2)
                                    {{ 'Customer' }}
                                @elseif (Auth::user()->role_id == 3)
                                    {{ 'Business' }}
                                    @if(Auth::user()->business_details != null)
                                       @if (Auth::user()->business_details->is_approved == 0)
                                            <small class="text-warning">(Pending)</small>
                                        @endif
                                   @endif
                                @elseif (Auth::user()->role_id == 4)
                                    {{ 'Pastor/Leader' }}
                                @endif </p>
                        </div>
                        <a class="dropdown-item font-16 font-weight-bold text-navy-blue" href="{{ route('profile') }}">My Profile</a>
                        <a class="dropdown-item font-16 font-weight-bold text-navy-blue" href="{{route('favourite_business')}}">My Favourite</a>
                        <a class="dropdown-item font-16 font-weight-bold text-navy-blue" href="{{ route('logout') }}">Log Out</a>
                    </div>
                </div>
                @else
                    <div class="d-lg-none">
                        <a href="{{ route('signup') }}" class="btn text-white bg-navy-blue br-6 font-12 font-weight-bold shadow-none py-1 px-3 d-none d-md-inline-block">Sign Up</a>
                        <a href="{{ route('login') }}" class="btn text-white bg-navy-blue br-6 font-12 font-weight-bold shadow-none py-1 px-3">Login</a>
                    </div>

                @endif
            </div>

            <div class="navbar-collapse mt-3 mt-lg-0">
                <ul class="navbar-nav align-items-center flex-md-row justify-content-center">
                    <li class="nav-item mr-4">
                        <div class="btn-group">
                            <a href="Javascript:;" class="nav-link text-navy-blue font-12 font-weight-bold font-rubik dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-location-dot"></i>
                                <u id="show_current_location">
                                    @if(!is_null($get_current_location))
                                        {{$get_current_location->city}} {{($get_current_location->postal_code != "")? " - ".$get_current_location->postal_code : ''}}
                                    @else
                                        Use Current Location
                                    @endif
                                </u>
                            </a>
                            <div class="dropdown-menu get-current-location p-3" id="location-dropdown">
                                <div class="form-group">
                                    <button type="button" onclick="getLocation();" class="btn btn-light btn-link border btn-block"><i class="fa-solid fa-location-dot"></i> Detect your location</button>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control text-center" id="search_location" placeholder="Search Your Location">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        {!! Form::open(['route' => 'business.listing', 'class' => 'form-inline my-2 my-lg-0 font-lato', 'method' => 'get']) !!}
                        {!! Form::hidden('location', isset($get_current_location->city)? $get_current_location->city : '', ['id'=>'header-location-input']) !!}
                        {!! Form::hidden('latitude', isset($get_current_location->latitude)? $get_current_location->latitude : '', ['id'=>'header-latitude-input']) !!}
                        {!! Form::hidden('longitude', isset($get_current_location->longitude)? $get_current_location->longitude : '', ['id'=>'header-longitude-input']) !!}
                        <div class="input-group input-group-shadow rounded-pill">
                            @php
                                $place_holder = "Find services";
                                if(!is_null($get_current_location)){
                                    $place_holder = "Find services in " .$get_current_location->city;
                                }
                            @endphp
                            <input type="text" name="search_keyword" class="form-control header-search pl-4 pr-5 border-white rounded-pill-left header-search-input" placeholder="{{$place_holder}}">
                            <div class="input-group-append">
                                <button class="btn bg-navy-blue text-white rounded-pill-right shadow-none px-3" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </li>
                </ul>
                <ul
                    class="navbar-nav ml-auto flex-row justify-content-between mt-3 mt-lg-0 font-mulish d-none d-lg-flex">
                    @if (Auth::check())
                        <li class="nav-item">
                            <div class="dropdown show cus-profile">
                                <a class="dropdown-toggle d-flex align-item-center" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ Auth::user()->user_profile }}"
                                        class="w-50px h-50px rounded-circle header-profile-image" alt="">
                                        <div class="d-block px-2 px-xl-4 py-1 text-nowrap">
                                            <p class="font-18 font-weight-bold text-dark-gray font-mulish mb-0">{{ ucfirst(Auth::user()->full_name) }}</p>
                                            <p class="font-14 text-dark-gray font-mulish mb-0">
                                                @if (Auth::user()->role_id == 2)
                                                    {{ 'Customer' }}
                                                @elseif (Auth::user()->role_id == 3)
                                                    {{ 'Business' }}
                                                    @if(Auth::user()->business_details != null)
                                                    @if (Auth::user()->business_details->is_approved == 0)
                                                         <small class="text-warning">(Pending)</small>
                                                     @endif
                                                @endif
                                                @elseif (Auth::user()->role_id == 4)
                                                    {{ 'Pastor/Leader' }}
                                                @endif</p>
                                        </div>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item font-16 font-weight-bold text-navy-blue" href="{{route('profile')}}">My Profile</a>
                                    <a class="dropdown-item font-16 font-weight-bold text-navy-blue" href="{{route('favourite_business')}}">My Favourite</a>
                                    <a class="dropdown-item font-16 font-weight-bold text-navy-blue" href="{{route('logout')}}">Log Out</a>
                                </div>
                            </div>
                        </li>
                    @else
                    <li class="nav-item mr-4">
                        <a class="nav-link font-16 font-weight-bold text-navy-blue" href="{{route('login')}}">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('signup')}}" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2">Sign Up</a>
                    </li>
                    @endif
                </ul>

            </div>
        </nav>
    </div>
</section>

<section class="shadow-sub-nav px-lg-4 px-xl-5 font-rubik">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light px-lg-0 py-0 py-lg-2">
            <div class="navbar-collapse sidenav px-lg-0" id="mySidenav">
                <button class="btn closebtn bg-transparent d-lg-none closeNav">&times;</button>
                <ul class="navbar-nav px-3 px-lg-0">
                    <li class="nav-item mt-3 d-flex align-items-center d-lg-none">
                       @if(!Auth::check())
                        <a href="{{route('signup')}}"
                            class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2">Sign
                            Up</a>
                        <a href="{{route('login')}}"
                            class="btn font-16 font-weight-bold text-navy-blue ml-3 shadow-none border-navy-blue px-4 py-2 br-6">Log
                            In</a>
                        @endif
                    </li>
                    <li class="nav-item mr-3 mt-3 mt-lg-0">
                        <a class="nav-link text-slate-gray font-16 fw-600 pl-lg-0" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link text-slate-gray font-16 fw-600" href="{{route('aboutus')}}">About</a>
                    </li>
                    <li class="nav-item mr-3">
                        {!! Form::open(['route' => 'business.listing', 'class' => 'form-inline my-2 my-lg-0 font-lato', 'method' => 'get']) !!}
                        {!! Form::hidden('location', isset($get_current_location->city)? $get_current_location->city : '', ['id'=>'header-location-input']) !!}
                        {!! Form::hidden('latitude', isset($get_current_location->latitude)? $get_current_location->latitude : '', ['id'=>'header-latitude-input']) !!}
                        {!! Form::hidden('longitude', isset($get_current_location->longitude)? $get_current_location->longitude : '', ['id'=>'header-longitude-input']) !!}
                             <a class="nav-link text-slate-gray font-16 fw-600" href="{{route('business.listing')}}">Member Directory</a>
                        {!! Form::close() !!}
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link text-slate-gray font-16 fw-600" href="{{route('works')}}">How it Works</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</section>
@if (Auth::check())
    @if (empty(Auth::user()->email_verified_at))
        <section class="shadow-sub-nav px-lg-4 px-xl-5 font-rubik bg-warning">
            <div class="text-center py-1 font-14">
                <i class="fa fa-info-circle"></i> Email verification is pending | <a href="{{route('resend.verification.email',['email',getEncrypted(Auth::user()->id)])}}">Resend Email</a>
            </div>
        </section>
    @endif
    @if (Auth::user()->business_details != null && Auth::user()->business_details->church_approval != 1)
        <section class="shadow-sub-nav px-lg-4 px-xl-5 font-rubik bg-dark">
            <div class="text-center py-1 px-lg-5 px-xl-5 text-white bg-light-red font-14">
                @if(Auth::user()->business_details->church_reject_reason != null)
                <i class="fa fa-info-circle"></i> Church is rejected your Business due to below reason. Please update your profile &<a href="{{route('resend.verification.email',['church',getEncrypted(Auth::user()->id)])}}"><b> click here </b></a> to resend verification mail. <br>
                <h6 class="text-warning"><b> Reject Reason : </h6>
                <div class="mx-5 my-2 text-warning">
                    @if(strlen(Auth::user()->business_details->church_reject_reason) > 250)
                        {{substr(Auth::user()->business_details->church_reject_reason,0,250)}}
                        <span class="read-more-show hide_content"> Show More<i class="fa fa-angle-down"></i></span>
                        <span class="read-more-content"> {{substr(Auth::user()->business_details->church_reject_reason,100,strlen(Auth::user()->business_details->church_reject_reason))}}
                        <span class="read-more-hide hide_content">Show Less <i class="fa fa-angle-up"></i></span> </span>
                    @else
                        {{Auth::user()->business_details->church_reject_reason}}
                    @endif
                </b> </div>
                @elseif(Auth::user()->business_details->church_approval != 1 && Auth::user()->business_details->business_name ==null)
                <i class="fa fa-info-circle"></i>  Your church verification is pending, please complete your business profile for send church verification mail | <a  class="text-primary" href="{{route('profile.update_business_details')}}">Business Details</a>
                @else
                <i class="fa fa-info-circle"></i> Church verification is pending | <a href="{{route('resend.verification.email',['church',getEncrypted(Auth::user()->id)])}}">Resend Email</a>
                @endif
            </div>
        </section>
    @endif
    @if (Auth::user()->business_details != null && Auth::user()->business_details->business_name == null && !empty(Auth::user()->email_verified_at) && Auth::user()->business_details->church_approval == 1)
    <section class="shadow-sub-nav px-lg-4 px-xl-5 font-rubik bg-info">
        <div class="text-center py-1 text-white font-14">
            <i class="fa fa-info-circle"></i> Your business details is not complete click on the link to complete it now | <a  class="text-dark" href="{{route('profile.update_business_details')}}">Business Details</a>
        </div>
    </section>
    @endif
    @if (Auth::user()->business_details != null && Auth::user()->business_details->business_name != null &&Auth::user()->business_details->is_approved == 0 && Auth::user()->business_details->church_approval == 1)
    <section class="shadow-sub-nav px-lg-4 px-xl-5 font-rubik bg-info">
        <div class="text-center py-1 text-white font-14">
            <i class="fa fa-info-circle"></i> Your business approval status is pending
        </div>
    </section>
    @endif
@endif

<div id="locationErrorModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Can't detect your location</h5>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-4">
            Your browser is not allowing to find the location for this site. Please turn it on from your browser setting if you want websites to request your permission before accessing your location.
            </div>
        </div>
    </div>
</div>

{{-- Auth::user()->business_details->church_approval != 1 && Auth::user()->business_details->business_name ==null --}}
