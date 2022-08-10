@extends('customer.layouts.app')
@section('title','Home')
@section('content')

    <section class="px-lg-4 px-xl-5 bg-read-book">
        <div class="container-fluid">
            <div class="row pt-5">
                <div class="col-12 col-lg-10">
                    <p class="text-navy-blue font-18 fw-600 font-mulish"><img src="{{asset('img/Line1.png')}}" class="img-fluid mr-3" alt=""> Hire a Christian business today!</p>
                    <h1 class="text-black display-3 font-weight-bold font-mulish-bold">What are you <br /> looking for
                        today?</h1>
                    <p class="text-dark-gray font-18 mt-4">Invest into the Christian economy by hiring a
                            trusted Christian Business today.
                    </p>
                    {!! Form::open(['route'=>'business.listing','class'=>'form-inline mt-4 mb-0','method'=>'get']) !!}
                    <div class="input-group input-group-shadow rounded-pill">
                        <input type="text" name="search_keyword" class="form-control header-search pl-4 pr-5 border-white rounded-pill-left h-auto- py-4" placeholder="Ex: Lawyer">
                        <div class="input-group-append">
                            <button class="btn bg-navy-blue text-white rounded-pill-right shadow-none px-3"
                                type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                {!! Form::close() !!}
                </div>
                <div class="col-12 col-lg-10 mt-5">
                    <p class="text-dark-gray font-18 mt-4">Popular searches:</p>
                    <div class="d-flex flex-wrap font-mulish-bold">
                        {!! Form::open(['route'=>'business.listing','method'=>'get','class'=>'mb-0']) !!}
                        <button type="submit" value="plumber" name="search_keyword" class="btn font-20 font-weight-bold text-navy-blue-dark px-4 py-2 mt-3 rounded-pill bg-white shadow">plumber</button>
                        <button type="submit" value="Handymen" name="search_keyword" class="btn font-20 font-weight-bold text-navy-blue-dark px-4 ml-3 py-2 mt-3 rounded-pill bg-white shadow">
                            Handymen</button>
                        <button type="submit" value="Lawn Care" name="search_keyword" class="btn font-20 font-weight-bold text-navy-blue-dark px-4 ml-sm-3 py-2 mt-3 rounded-pill bg-white shadow">
                            Lawn Care</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-lg-4 px-xl-5 mt-5">
        <div class="container-fluid">
            <div class="row mt-5 pt-lg-5">
                <div class="col-12 text-center mb-5">
                    <h1 class="text-black font-weight-bold font-40 font-mulish-bold">Why people are using <span
                            class="text-navy-blue">Kingdom</span></h1>
                </div>
                <div class="col-12 col-md-6 col-lg-4 text-center">
                    <div>
                        <img src="{{asset('img/Group-1517.png')}}" class="img-fluid" alt="">
                        <h2 class="font-24 font-weight-bold text-black mt-4 font-mulish">Community Based
                        </h2>
                        <p class="font-18 text-dark-gray mt-3">We take a local approach to making sure that your dollars stay in the Christian Kingdom Economy.</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 text-center mt-4 mt-md-0">
                    <div>
                        <img src="{{asset('img/Group-1516.png')}}" class="img-fluid" alt="">
                        <h2 class="font-24 font-weight-bold text-black mt-4 font-mulish">Christ-Centered
                        </h2>
                        <p class="font-18 text-dark-gray mt-3">All of the businesses inside Kingdom are thoroughly vetted to meet our standard and are verified by their Church. </p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 text-center mt-4 mt-lg-0">
                    <div>
                        <img src="{{asset('img/Group-1515.png')}}" class="img-fluid" alt="">
                        <h2 class="font-24 font-weight-bold text-black mt-4 font-mulish">High Standards
                        </h2>
                        <p class="font-18 text-dark-gray mt-3">With customer reviews and our direct involvement, you can rest assured that you are getting great quality work</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5 pt-5 align-items-center">
                <div class="col-12 col-md-6 text-center">
                    <img src="{{asset('img/Image-125.png')}}?v=1" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-md-6 mt-4 mt-md-0">
                    <h1 class="font-40 font-weight-bold text-navy-blue-dark font-mulish-bold"><span
                            class="text-slate-green">Register
                            your business</span> Hundreds of customers searching for services daily.</h1>
                    <!-- <p class="mt-5 text-dark-gray font-18">Get seen by Christian clients in your area buy creating your business account and getting listed in our member directory today.</p> -->
                    <p class="mt-5 text-dark-gray font-18">Meet new customers and grow your business by signing up your business on Kingdom.</p>
                    <a href="{{route('business.signup')}}" class="btn bg-slate-green text-white font-18 font-weight-bold px-5 py-2 rounded-pill mt-4 font-mulish">Register
                        my business</a>
                </div>
            </div>

            <div class="row mt-5 pt-5 align-items-center">
                <div class="col-12 col-md-6">
                    <h1 class="font-40 font-weight-bold text-navy-blue-dark font-mulish-bold"><span
                            class="text-yellow">Register your
                            church</span> and help your members be intentional with supporting the Christian economy</h1>
                    <p class="mt-5 text-dark-gray font-18">By signing up your church, you will help the businesses within your congregation grow.</p>
                    <a href="{{route('church.signup')}}"
                        class="btn text-slate-green bg-yellow font-18 font-weight-bold px-5 py-2 rounded-pill mt-4 font-mulish">Register
                        my church
                    </a>
                </div>
                <div class="col-12 col-md-6 text-center mt-4 mt-md-0">
                    <img src="{{asset('img/Image-1.png')}}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="px-lg-4 px-xl-5 mt-5 py-5 bg-breadcrumb">
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h1 class="text-black font-weight-bold font-40 font-mulish-bold">All of your <span
                            class="text-navy-blue">business
                            service needs</span> in one place</h1>
                </div>
                <div class="col-12 col-lg-4">
                    {!! Form::open(['route'=>'business.listing','class'=>'form-inline my-2 my-lg-0 justify-content-center justify-content-lg-end mb-0','method'=>'get']) !!}
                        <div class="input-group input-group-shadow rounded-pill">
                            <input type="texts" name="search_keyword" class="form-control header-search pl-4 pr-5 border-white rounded-pill-left" placeholder="Find services in New york">
                            <div class="input-group-append">
                                <button class="btn bg-navy-blue text-white rounded-pill-right shadow-none px-3 py-2 d-flex align-items-center" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-12 col-lg-8 mt-3 mt-lg-0">
                    <div class="d-flex align-items-center flex-wrap justify-content-center font-mulish-bold">
                        <p class="text-dark-gray font-18 mb-0 font-lato">Popular searches:</p>
                        {!! Form::open(['route'=>'business.listing','method'=>'get','class'=>'mb-0']) !!}
                        <button name="search_keyword" value="plumber" class="btn font-20 font-weight-bold text-navy-blue-dark px-4 ml-3 mt-3 mt-sm-0 py-2 rounded-pill bg-white shadow"> plumber</button>
                        <button name="search_keyword" value="Handymen" class="btn font-20 font-weight-bold text-navy-blue-dark px-4 ml-3 mt-3 mt-sm-0 py-2 rounded-pill bg-white shadow"> Handymen</button>
                        <button name="search_keyword" value="Lawn Care"class="btn font-20 font-weight-bold text-navy-blue-dark px-4 ml-3 mt-3 mt-sm-0 py-2 rounded-pill bg-white shadow"> Lawn Care</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                @foreach ($all_categories as $value)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="border-light-gray br-5">

                        <div class="d-flex align-items-center justify-content-between bg-white px-3 min-h-85px rounded-top">
                            <a  href="{{route('business.listing')}}?business_service={{$value->slug}}" name="search_keyword" value="{{$value->title}}" class="font-18 text-navy-blue-dark font-weight-bold mb-0 font-mulish-bold">{{$value->title}}</a>
                            <div>
                                <span class="font-14 font-weight-bold text-slate-green bg-light-gray3 w-35px h-35px rounded-circle d-flex align-items-center justify-content-center">{{$value->business_count}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- <section class="px-lg-4 px-xl-5 mt-5 py-5 d-none">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h1 class="text-black font-weight-bold font-40 font-mulish-bold">What 1people are <span
                            class="text-navy-blue">saying
                            about Kingdom? </span></h1>
                </div>

                <div class="col-6">

                </div>
                <div class="col-6 text-right d-flex justify-content-end">
                    <span class="cus-arrow-left">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </span>
                    <span class="cus-arrow-right ml-3">
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </span>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 review-slider">
                    <div class="border-medium-gray br-10 p-3">
                        <div class="d-flex justify-content-between align-items-center font-mulish">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{asset('img/Ellipse-175.png')}}" class="h-50px w-50px" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="font-18 text-dark-gray font-weight-bold m-0">John Vann</p>
                                    <p class="font-14 text-navy-blue-dark m-0">New York</p>
                                </div>
                            </div>
                            <div>
                                <span class="font-16 text-dark-gray font-weight-bold mr-3">4.5</span>
                                <i class="fa-solid fa-star text-light-orange"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="font-16 text-dark-gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Vitae sit donec lectus suscipit ultricies rhoncus.</p>
                        </div>
                    </div>

                    <div class="border-medium-gray br-10 p-3">
                        <div class="d-flex justify-content-between align-items-center font-mulish">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{asset('img/Ellipse-176.png')}}" class="h-50px w-50px" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="font-18 text-dark-gray font-weight-bold m-0">Christine Wilson</p>
                                    <p class="font-14 text-navy-blue-dark m-0">New York</p>
                                </div>
                            </div>
                            <div>
                                <span class="font-16 text-dark-gray font-weight-bold mr-3">4.5</span>
                                <i class="fa-solid fa-star text-light-orange"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="font-16 text-dark-gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Vitae sit donec lectus suscipit ultricies rhoncus.</p>
                        </div>
                    </div>

                    <div class="border-medium-gray br-10 p-3">
                        <div class="d-flex justify-content-between align-items-center font-mulish">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{asset('img/Ellipse-177.png')}}" class="h-50px w-50px" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="font-18 text-dark-gray font-weight-bold m-0">Kevin Jones</p>
                                    <p class="font-14 text-navy-blue-dark m-0">New York</p>
                                </div>
                            </div>
                            <div>
                                <span class="font-16 text-dark-gray font-weight-bold mr-3">4.5</span>
                                <i class="fa-solid fa-star text-light-orange"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="font-16 text-dark-gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Vitae sit donec lectus suscipit ultricies rhoncus.</p>
                        </div>
                    </div>

                    <div class="border-medium-gray br-10 p-3">
                        <div class="d-flex justify-content-between align-items-center font-mulish">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{asset('img/Ellipse-175.png')}}" class="h-50px w-50px" alt="">                                </div>
                                <div class="ml-3">
                                    <p class="font-18 text-dark-gray font-weight-bold m-0">John Vann</p>
                                    <p class="font-14 text-navy-blue-dark m-0">New York</p>
                                </div>
                            </div>
                            <div>
                                <span class="font-16 text-dark-gray font-weight-bold mr-3">4.5</span>
                                <i class="fa-solid fa-star text-light-orange"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="font-16 text-dark-gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Vitae sit donec lectus suscipit ultricies rhoncus.</p>
                        </div>
                    </div>

                    <div class="border-medium-gray br-10 p-3">
                        <div class="d-flex justify-content-between align-items-center font-mulish">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{asset('img/Ellipse-176.png')}}" class="h-50px w-50px" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="font-18 text-dark-gray font-weight-bold m-0">Christine Wilson</p>
                                    <p class="font-14 text-navy-blue-dark m-0">New York</p>
                                </div>
                            </div>
                            <div>
                                <span class="font-16 text-dark-gray font-weight-bold mr-3">4.5</span>
                                <i class="fa-solid fa-star text-light-orange"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="font-16 text-dark-gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Vitae sit donec lectus suscipit ultricies rhoncus.</p>
                        </div>
                    </div>

                    <div class="border-medium-gray br-10 p-3">
                        <div class="d-flex justify-content-between align-items-center font-mulish">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img src="{{asset('img/Ellipse-177.png')}}" class="h-50px w-50px" alt="">
                                </div>
                                <div class="ml-3">
                                    <p class="font-18 text-dark-gray font-weight-bold m-0">Kevin Jones</p>
                                    <p class="font-14 text-navy-blue-dark m-0">New York</p>
                                </div>
                            </div>
                            <div>
                                <span class="font-16 text-dark-gray font-weight-bold mr-3">4.5</span>
                                <i class="fa-solid fa-star text-light-orange"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="font-16 text-dark-gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Vitae sit donec lectus suscipit ultricies rhoncus.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section> --}}

    <section class="px-lg-4 px-xl-5 mt-5 py-5 py-lg-0 bg-navy-blue">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <h1 class="font-40 font-weight-bold text-white font-mulish-bold">Find and connect with Christ-centered businesses</h1>
                    <p class="mt-5 text-light-gray font-18">Search our directory to find top-rated businesses for your next project.</p>
                    <a href="{{route('business.listing')}}" class="btn text-slate-green bg-yellow font-18 font-weight-bold px-5 py-2 rounded-pill mt-4 font-mulish">Find A Business</a>
                </div>
                <div class="col-12 col-lg-6 text-center mt-4 mt-lg-0">
                    <img src="{{asset('img/Group-1510.png')}}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>


@endsection
