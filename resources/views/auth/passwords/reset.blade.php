@extends('customer.layouts.app')
@section('title','Reset Password')
@section('content')
<section class="px-lg-4 px-xl-5 bg-breadcrumb">
    <div class="container-fluid py-5">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-12 col-lg-8">
                <form class="form w-100" novalidate="novalidate" id="password_form" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input id="email" type="hidden" readonly class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                <div class="row border-light-gray br-5 py-4 p-md-4 m-0 bg-white">
                    <div class="col-12">
                        <h3 class="text-navy-blue font-24 font-weight-bold font-mulish mb-3">Reset Your Password</h3>
                    </div>
                    @error('login-error')
                        <div class="col-12 mt-4">
                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                        </div>
                    @enderror
                    <div class="col-12 mt-3">
                        <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="New Password">
                        @error('password')
                            <div class="invalid-feedback"><div >{{$message}}</div></div>
                        @enderror
                    </div>
                    <div class="col-12 mt-3">
                        <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm Password">
                        @error('password_confirmation')
                            <div class="invalid-feedback"><div >{{$message}}</div></div>
                        @enderror
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" id="submit-form-btn" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish">Reset Password</button>
                    </div>

                    <div class="col-12 text-center mt-4">
                        <span class="font-14 font-weight-bold text-medium-gray">
                            Don’t have an account?
                            <a href="{{route('signup')}}" class="font-14 font-weight-bold text-medium-gray"><u>Sign Up</u></a>
                        </span>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $("#password_form").validate({
        rules: {
            password:{
                required: true,
                pwcheck: true,
            },
            password_confirmation:{
                required: true,
                equalTo : "#password",
            },
        },
        messages:{
            password: {
                required: 'Enter your new password'
            },
            password_confirmation:{
                required: 'Please enter Confirm password',
                equalTo : "Password & confirm password are not same",
            },
        },
        submitHandler: function (form) {
            $('#submit-form-btn').prop('disabled',true);
            $('#submit-form-btn').append(' <i class="fa fa-spin fa-spinner"></i>');
            return true;
        }
    });
</script>
@endsection
