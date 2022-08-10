@extends('customer.layouts.app')
@section('title','Forgot Password')
@section('content')
<section class="px-lg-4 px-xl-5 bg-breadcrumb">
    <div class="container-fluid py-5">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-12 col-lg-8">
                @if (session('status'))
                    <div class="alert col-md-12 alert-success alert-dismissible mb-0" role="alert">
                        <div class="d-flex align-items-center">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            {{ session('status') }}
                        </div>
                    </div>
                    <br>
                @endif
                {!! Form::open(['route'=>'password.reset_link','id'=>'forgot_password']) !!}
                <div class="row border-light-gray br-5 py-4 p-md-4 m-0 bg-white">
                    <div class="col-12">
                        <h3 class="text-navy-blue font-24 font-weight-bold font-mulish mb-3">Forgot Password</h3>
                        <div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div>
                    </div>
                    @csrf
                    <div class="col-12 mt-2">
                        <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="email" id="email" name="email" value="{{old('email')}}" placeholder="Please enter your registered email">
                        <label id="login_errorMsg"></label>
                        <div class="form-group mb-4" id="loginstatus">
                            @if (Session::has('email_error'))
                                <label class="text-danger">
                                    {{ Session::get('email_error') }}
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" id="submit-form-btn" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish">Send Email</button>
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
    $("#forgot_password").validate({
        rules: {
            email: {
            checkemail:true,
            required: true,
        },
        messages:{
            email:{
                required:"Please enter email",
            },
        },
        submitHandler: function (form) {
            $('#submit-form-btn').prop('disabled',true);
            $('#submit-form-btn').append(' <i class="fa fa-spin fa-spinner"></i>');
            return true;
        }
    }
    });
</script>
@endsection
