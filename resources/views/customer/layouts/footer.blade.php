<footer class="{{(\Route::currentRouteName() == 'home')?'':'pt-1 mt-5'}}">
    <section class="border-top py-5 px-lg-4 px-xl-5">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12 col-lg-3 mt-3 mt-lg-0 order-md-4 order-lg-1 text-center text-lg-left">
                    <ul class="nav flex-column justify-content-center">
                        <li class="nav-item">
                            <a href="{{route('home')}}">
                                <img src="{{ asset('img/LOGO1.png') }}" class="img-fluid" alt="">
                            </a>
                        </li>
                        <li class="nav-item d-flex justify-content-center justify-content-lg-start mt-4">
                            <a class="nav-link pl-lg-0" href="https://www.facebook.com/Kingdom-Directory-111701378076637Youtube" target="_blank"><img
                                    src="{{ asset('img/Vector-1.png') }}" class="img-fluid" alt=""></a>
                            <a class="nav-link" href="https://instagram.com/kingdom_directory?utm_medium=copy_linkFacebook" target="_blank"><img
                                    src="{{ asset('img/Group-1.png') }}" class="img-fluid" alt=""></a>
                            <a class="nav-link" href="https://www.youtube.com/channel/UCXrfG6G4SPCUh3ckxY00cPw" target="_blank"><img
                                    src="{{ asset('img/youtube.png') }}" class="img-fluid" alt=""></a>
                        </li>
                    </ul>
                </div>

                <div class="col-12 col-md-6 col-lg-6 mt-3 mt-lg-0 order-md-3 order-lg-1">
                    <ul class="nav flex-column d-flex justify-content-between">
                        <li class="nav-item">
                            <p class="text-slate-green font-weight-bold font-18 font-mulish">Business Services</p>
                        </li>
                        <div class="row">
                            @foreach ($all_categories as $value)
                                <div class="col-md-6 mt-2">
                                    <a href="{{route('business.listing')}}?business_service={{$value->slug}}" class="font-18 text-dark-gray" value="{{$value->title}}"> {{$value->title}}</a>
                                </div>
                            @endforeach
                        </div>

                    </ul>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mt-3 mt-lg-0 order-md-2 order-lg-2">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <p class="text-slate-green font-weight-bold font-18 font-mulish">Resources</p>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="font-18 text-dark-gray" href="{{route('statement-of-faith')}}" target="_blank"> Statement of Faith </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="font-18 text-dark-gray" href="{{route('membership-requirement')}}" target="_blank"> Membership Requirements </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="font-18 text-dark-gray" href="mailto:{{env('CONTACT_EMAIL')}}" target="_blank"> Contact Us </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="font-18 text-dark-gray" href="{{route('terms.condition')}}" target="_blank"> Terms and Conditions </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="font-18 text-dark-gray" href="{{route('privacy.policy')}}" target="_blank"> Privacy Policy </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="font-18 text-dark-gray" href="mailto:{{env('SUPPORT_EMAIL')}}" target="_blank"> Support </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="border-top mt-5">
        <div class="container-fluid py-4">
            <div class="row mx-lg-5 align-items-center">
                <div class="col-12 col-lg-4">
                    <p class="text-medium-gray font-14 mb-0">© Kingdom Businesses All Rights Reserved {{date('Y')}}</p>
                </div>
            </div>
        </div>
    </section>
</footer>
