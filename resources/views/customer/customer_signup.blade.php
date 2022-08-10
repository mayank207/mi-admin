@extends('customer.layouts.app')
@section('title','Customer SignUp')
@section('content')
<section class="px-lg-4 px-xl-5 bg-breadcrumb">
    <div class="container-fluid py-5">
        <form action="{{route('customer.register')}}" method="post" id='sign_up_form'>
            @csrf
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-12 col-lg-8">
                <div class="row border-light-gray br-5 py-4 p-md-4 m-0 bg-white">

                    <div class="col-12">
                        <h3 class="text-navy-blue font-24 font-weight-bold font-mulish">Customer Sign Up</h3>
                        <p class="text-dark-gray font-18 mb-3">By using Kingdom, you are ensuring that your dollars are supporting other Christian families.</p>
                    </div>
                        <div class="col-12 mt-2">
                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                                type="text" name="first_name" id="first_name" placeholder="First name">
                        </div>
                        <div class="col-12 mt-2">
                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                                type="text" name="last_name" id="last_name" placeholder="Last name">
                        </div>
                        <div class="col-12 mt-3">
                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                                type="text" name="user_name" placeholder="Username">
                        </div>
                        <div class="col-12 mt-3">
                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                                type="email" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="row col-12 mt-3 px-0 mx-0">
                            <div class="col-4 custom-select2">
                                <select name="country_code" id="country_code" class="form-control bg-light-gray border-0 rounded-0 h-auto " data-control="select2"  required>
                                    @foreach ($country as $code)
                                    <option value="{{$code->phone}}">+{{$code->phone}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-8 ">
                                <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-5 mobile_input_mask" type="text" name="mobile_number"  id="mobile_number" placeholder="Mobile Number">
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                                type="password" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="col-12 mt-3">
                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                                type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password">
                        </div>
                        <div class="col-12 mt-3">
                            <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.sitekey')}}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                            @endif
                        </div>
                        <div class="col-12 mt-3">
                            <input type="submit"
                            class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish" value="Sign Up">
                        </div>

                    <div class="col-12 text-center mt-4">
                        <span class="font-14 font-weight-bold text-medium-gray">
                            Already have an account?
                            <a href="{{route('login')}}" class="font-14 font-weight-bold text-medium-gray"><u>Log In</u></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>

    </div>
</section>
@endsection

@section('script')
<script>
$("#sign_up_form").validate({
    rules: {
        first_name: {
            noSpace:true,
            required:true ,
        },
        last_name: {
            noSpace:true,
            required:true ,
        },
        user_name: {
            required:true,
            username: true,
            minlength:3,
            remote: {
                type: 'post',
                url: "{{route('isUserNameExists')}}",
                data: {'_token': $("input[name=_token]").val()},
                dataFilter: function (data)
                {
                    var json = JSON.parse(data);
                    if (json.valid === true) {
                        return '"true"';
                    } else {
                        return "\"" + json.message + "\"";
                    }
                }
            }
        },

        email: {
            checkemail:true,
            required: true,
            remote: {
                    type: 'post',
                    url: "{{route('isEmailExists')}}",
                    data: {'_token': $("input[name=_token]").val()},
                    dataFilter: function (data)
                    {
                        var json = JSON.parse(data);
                        if (json.valid === true) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
                },
        mobile_number: {
            required:true ,
            input_mask_mobile_number:true,
        },
        password:  {
            required:true,
            pwcheck: true,
        },
        confirm_password:{
            required:true ,
            equalTo : "#password",
        },
    },
    messages: {
        first_name: {
            required:'Please enter your first name',
        },
        last_name: {
            required:'Please enter your last name',
        },
        username: {
            required:"Username is required.",
            remote:'This username is already exists.',
        },
        email:{
            required:"Please enter email",
            remote:"Email is already exists",
            checkemail:"Please enter valid email",
        },
        mobile_number: {
            required:'Please enter mobile number',
            input_mask_mobile_number:"Enter valid mobile numbers",

        },
        password:{
            required:"Please enter Password",
        },
        confirm_password:{
            required:"Please enter confirm password",
            equalTo:"Password & confirm password are not same.",

        }
    },
    submitHandler: function (form) {

        return true;
    },
    success: function(label,element) {
        label.parent().removeClass('has-danger');
    },
    });

    $('#country_code').val("1").select2({
        placeholder: "Select Country Code",
    });
</script>
@endsection
