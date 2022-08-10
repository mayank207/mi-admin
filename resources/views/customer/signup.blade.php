@extends('customer.layouts.app')
@section('title','SignUp')
@section('content')
<section class="px-lg-4 px-xl-5">
    <div class="container-fluid mt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-10 col-lg-10 mb-4">
                <h2 class="font-24 font-weight-bold font-mulish text-blue">Select your account type</h2>
            </div>
            <div class="col-12 col-xl-6">
                <div class="row border rounded m-0">
                    <div class="col-12 col-md-6 col-lg-4 pl-md-0 text-center text-lg-left position-relative min-h-300px">
                        <img src="{{asset('img/business_318.png')}}" class="img-fluid cus-image-style object-fit-cover w-100" alt="">
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                        <div class="row px-md-3 py-4">
                            <div class="col-12">
                                <h1 class="text-slate-green font-24 font-weight-bold font-mulish pt-3">Sign Up Your Business
                                </h1>
                                <p class="text-dark-gray font-18 mb-0 mt-4">Sign up on Kingdom as a professional business and list your services on our platform.
                                </p>
                            </div>
                            <div class="col-12 mt-5">
                                <ul
                                    class="list-inline d-flex  align-items-center font-mulish">
                                    <li>
                                        <a href="{{route('business.signup')}}" class="btn bg-slate-green text-white font-16 font-weight-bold next-step px-4 py-2 br-6">Start Now</a>
                                    </li>
                                    <li class="ml-4">
                                        {{-- <a class="text-slate-green font-16 font-weight-bold cursor-pointer">Learn More</a> --}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6 mt-4 mt-xl-0">
                <div class="row border rounded m-0">
                    <div class="col-12 col-md-6 col-lg-4 pl-md-0 text-center text-lg-left position-relative min-h-300px">
                        <img src="{{asset('img/church_318.png')}}" class="img-fluid cus-image-style object-fit-cover w-100" alt="">
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                        <div class="row px-md-3 py-4">
                            <div class="col-12">
                                <h1 class="text-yellow font-24 font-weight-bold font-mulish pt-3">Sign Up Your Church
                                </h1>
                                <p class="text-dark-gray font-18 mb-0 mt-4">Register your church and help your members be intentional with supporting the Christian economy.
                                </p>
                            </div>
                            <div class="col-12 mt-5">
                                <ul
                                    class="list-inline d-flex  align-items-center font-mulish">
                                    <li>
                                        <a href="{{route('church.signup')}}" class="btn bg-yellow text-white font-16 font-weight-bold next-step px-4 py-2 br-6">Start Now</a>
                                    </li>
                                    <li class="ml-4">
                                        {{-- <a class="text-yellow font-16 font-weight-bold cursor-pointer">Learn More</a> --}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-xl-6">
                <div class="row border mx-0 rounded mt-4">
                    <div class="col-12 col-md-6 col-lg-4 pl-md-0 text-center text-lg-left position-relative min-h-300px">
                        <img src="{{asset('img/Rectangle-18.png')}}" class="img-fluid cus-image-style object-fit-cover w-100" alt="">
                    </div>
                    <div class="col-12 col-md-6 col-lg-8">
                        <div class="row px-md-3 py-4">
                            <div class="col-12">
                                <h1 class="text-slate-green font-24 font-weight-bold font-mulish pt-3">Sign Up as a Customer
                                </h1>
                                <p class="text-dark-gray font-18 mb-0 mt-4">By using Kingdom, you are ensuring that your dollars are supporting other Christian families.
                                </p>
                            </div>
                            <div class="col-12 mt-5">
                                <ul
                                    class="list-inline d-flex  align-items-center font-mulish">
                                    <li>
                                        <a href="{{route('customer.signup')}}" class="btn bg-slate-green text-white font-16 font-weight-bold next-step px-4 py-2 br-6">Start Now</a>
                                    </li>
                                    <li class="ml-4">
                                        {{-- <a class="text-slate-green font-16 font-weight-bold cursor-pointer">Learn More</a> --}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
            </div>

        </div>
    </div>
</section>
@endsection
