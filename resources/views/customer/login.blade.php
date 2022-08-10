@extends('customer.layouts.app')
@section('title','Login')
@section('content')
<section class="px-lg-4 px-xl-5 bg-breadcrumb">
    <div class="container-fluid py-5">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-12 col-lg-8">
                {!! Form::open(['route'=>'login','id'=>'login-form']) !!}
                <div class="row border-light-gray br-5 py-4 p-md-4 m-0 bg-white">
                    <div class="col-12">
                        <h3 class="text-navy-blue font-24 font-weight-bold font-mulish mb-3">Log In</h3>
                    </div>
                    @error('login-error')
                        <div class="col-12 mt-4">
                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                        </div>
                    @enderror
                    <div class="col-12 mt-2">
                        <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email')}}" placeholder="Email">
                    </div>
                    <div class="col-12 mt-3">
                        <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback"><div >{{$message}}</div></div>
                        @enderror
                    </div>
                    <div class="col-12 mt-3">
                        <ul class="list-inline d-flex flex-column flex-sm-row justify-content-between align-items-sm-center">
                            <li>
                                <label class="cus-checkbox font-14 font-weight-bold text-medium-gray mb-0">
                                    <span class="font-14">Remember me</span>
                                    <input type="checkbox" name="remember_me">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li class="mt-3 mt-sm-0">
                                <a href="{{route('forgot.password')}}" class="font-14 font-weight-bold text-medium-gray">Forgot your password?</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" id="submit-form-btn" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish">Login</button>
                    </div>

                    {{-- <div class="col-12 mt-3">
                        <div class="border-top"></div>
                    </div>

                    <div class="col-12 col-md-6 mt-4">
                        <div class="bg-facebook border-facebook text-center py-2 cursor-pointer">
                            <i class="fa-brands fa-facebook-f text-white float-left ml-2 font-24"></i>
                            <span class="font-14 text-white font-mulish">Sign in with Facebook</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-3 mt-md-4">
                        <div class="bg-google border-google text-center py-2 cursor-pointer">
                            <i class="fa-brands fa-google-plus-g text-white float-left ml-2 font-24"></i>
                            <span class="font-14 text-white font-mulish">Sign in with Google</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <div class="bg-twitter border-twitter text-center py-2 cursor-pointer">
                            <i class="fa-brands fa-twitter text-white float-left ml-2 font-24"></i>
                            <span class="font-14 text-white font-mulish">Sign in with Twitter</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <div class="bg-linkedIn border-linkedIn text-center py-2 cursor-pointer">
                            <i class="fa-brands fa-linkedin-in text-white float-left ml-2 font-24"></i>
                            <span class="font-14 text-white font-mulish">Sign in with LinkedIn</span>
                        </div>
                    </div> --}}

                    <div class="col-12 text-center mt-4">
                        <span class="font-14 font-weight-bold text-medium-gray">
                            Don’t have an account?
                            <a href="{{route('signup')}}" class="font-14 font-weight-bold text-medium-gray"><u>Sign Up</u></a>
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $("#login-form").validate({
        rules: {
            email:{
                required:true,
                email:true
            },
        },
        messages:{
            email:{
                required:"Email is required.",
            },
            password: {
                required: 'Password is required.'
            }
        },
        submitHandler: function (form) {
            $('#submit-form-btn').prop('disabled',true);
            $('#submit-form-btn').append(' <i class="fa fa-spin fa-spinner"></i>');
            return true;
        }
    });
</script>
@endsection
