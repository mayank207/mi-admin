@extends('customer.layouts.app')
@section('title','Business SignUp')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.steps.css') }}">
@endsection
@section('content')

<section class="bg-breadcrumb px-lg-4 px-xl-5">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-lg-0">
                        <li class="breadcrumb-item"><a  href="{{route('home')}}" class="font-14 font-weight-bold text-medium-gray">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('signup')}}" class="font-14 font-weight-bold text-medium-gray">Sign  Up</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('business.signup')}}" class="font-14 font-weight-bold text-medium-gray">Business Sign Up</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12 col-lg-5">
                <h1 class="text-navy-blue-dark font-40 font-weight-bold font-mulish">Sign Up Your Business</h1>
            </div>
            <div class="col-12 col-lg-7 mt-4 mt-lg-0">
                <div class="wizard font-mulish">
                    <div class="wizard-inner">
                        <ul class="nav nav-tabs">
                            <li class="active" class="cust-form-step" id="form-step-one">
                                <a href="Javascript:;" class="cus-step custom-step" data-step="1" data-url="{{route('render.signup.form')}}?form_type=1"><span class="round-tab">1 </span> <i>Step 1</i></a>
                            </li>

                            @if(Auth::check())
                                @if(Auth::user()->role_id == 3 && empty(Auth::user()->business_details) && !empty(Auth::user()->email_verified_at))
                                <li class="active cust-form-step" id="form-step-two">
                                    <a href="Javascript:;" class="cus-step  custom-step" data-step="2" data-url="{{route('render.signup.form')}}?form_type=2"><span class="round-tab">2</span> <i>Step 2</i></a>
                                </li>
                                @else
                                    <li class=" cust-form-step" id="form-step-two">
                                        <a href="Javascript:;" class="cus-step  custom-step" data-step="2" data-url="{{route('render.signup.form')}}?form_type=2"><span class="round-tab">2</span> <i>Step 2</i></a>
                                    </li>
                                @endif

                            @else
                                <li class="cust-form-step" id="form-step-two">
                                    <a href="Javascript:;" class="cus-step  custom-step" data-step="2" data-url="{{route('render.signup.form')}}?form_type=2"><span class="round-tab">2</span> <i>Step 2</i></a>
                                </li>
                            @endif

                            <li class="cust-form-step" id="form-step-three">
                                <a href="Javascript:;" class="custom-step" data-step="3" data-url="{{route('render.signup.form')}}?form_type=3"><span class="round-tab">3</span> <i>Step 3</i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="px-lg-4 px-xl-5">
    <div class="container-fluid mt-5">
        <div class="row justify-content-center m-0">
            <div class="col-12 col-xl-10" id="main_form">
                @if(Auth::check() && empty(Auth::user()->business_details))
                     @include('customer.steptwo')
                @else
                    @include('customer.stepone')
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script>
    var current_form_step = 1;
    $(document).on('click','.custom-step',function(){
        var step = $(this).data('step');
        var url = $(this).data('url');
        if(current_form_step >= step){
            $.ajax({
                url: url,
                type: "get",
                dataType: 'json',
                success: function (response) {
                    $('#main_form').html(response.html_form);
                    formValidation();
                }
            });
        }
        $('.cust-form-step').removeClass('active');
        if(current_form_step == 1 || current_form_step == 2 || current_form_step == 3){
            $('#form-step-one').addClass('active');
        }
        if(current_form_step == 1 ||current_form_step == 2 || current_form_step == 3){
            $('#form-step-two').addClass('active');
        }
        if(current_form_step == 3){
            $('#form-step-three').addClass('active');
        }
    });
    $(document).on('click','#choose-profile',function(){
        $('#profile').trigger('click');
    });
    $(document).on('change','#profile',function(){
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var validExtensions = ['jpg','jpeg','png'];
            var file_name = input.files[0].name;
            var file_extention = file_name.substr(file_name.lastIndexOf('.') + 1);
            if ($.inArray(file_extention, validExtensions) == -1){
                $('#choose-profile').attr('src',$('#choose-profile').attr('alt'));
                return;
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#choose-profile').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    /* Form validation  */
    formValidation();
    function formValidation(){
        if($('#form_step_1').length > 0){
            $("#form_step_1").validate({
                rules: {
                    first_name:{
                        required:true,
                        noSpace:true,
                    },
                    last_name:{
                        required:true,
                        noSpace:true,
                    },
                    email:{
                        checkemail:true,
                        required:true,
                        email:true,
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
                    mobile_number:{
                            required:true ,
                            minlength:10,
                            input_mask_mobile_number:true,
                            remote: {
                                type: 'post',
                                url: "{{route('isUserMobileNumberExists')}}",
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
                    password:{
                        required: true,
                        pwcheck: true,
                    },
                    confirm_password:{
                        equalTo : "#password",
                    },
                    country_code:{
                        required:true,
                    },
                    profile:{
                        extension: "jpg|jpeg|png",
                    }
                },
                messages:{
                    first_name: {
                        required:'Please enter first name',
                        noSpace: 'Please enter valid value',
                    },
                    last_name: {
                        required:'Please enter Last name',
                        noSpace: 'Please enter valid value',
                    },
                    user_name: {
                        required:'Please enter username',
                        remote:'This username is already exists.',
                    },
                    email: {
                        required:'Please enter email',
                        remote: 'This email is already exists.',
                    },
                    mobile_number: {
                        required:'Please enter mobile number',
                        input_mask_mobile_number:"Enter valid mobile numbers",
                    },
                    password: {
                        required:'Please enter password',
                    },
                    confirm_password: {
                        required:'Please enter confirm password',
                        equalTo:'Password & confirm password are not same.'
                    },
                    country_code: {
                        required:'Please select country code',
                    },
                    profile:{
                        extension: "Please images only jpg, jpeg & png"
                    }
                },
                submitHandler: function (form) {
                    $('#form_step_1').find('#step_1').append(' <i class="fa fa-spin fa-spinner"></i>').attr('disabled',true);
                    var url = form.action;
                    var formData = new FormData(form);
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response){
                            $('#form_step_1').find('.step_1_submit').html('Submit').attr('disabled',false);
                            grecaptcha.reset();
                            if(response.status == true){
                                window.location.href = response.redirect_link;
                            }else{
                                toastr.error(response.message);
                            }
                        },
                        error: function(error){
                            $('#form_step_1').find('.step_1_submit').html('Submit').attr('disabled',false);
                            grecaptcha.reset();
                            toastr.error('Something went wrong.');
                        }
                    });
                },
                success: function(label,element) {
                    $('#form-step-one').removeClass('error');
                    label.parent().removeClass('has-danger');
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                    $('#form-step-one').addClass('error');
                }
            });
            $('#country_code').select2({
                placeholder: "Select Country Code",
            });

        }
        if($('#form_step_2').length > 0){
            $("#form_step_2").validate({
                rules: {
                    agree:{
                        required:true,
                    },
                },
                messages:{
                    agree: 'Please accept above terms and conditions',
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        dataType: 'json',
                        success: function (response) {
                            if(response.status == true){
                                $('#main_form').html(response.html_form);
                                formValidation();
                                current_form_step = 3;
                                $('.cust-form-step').removeClass('active');
                                $('#form-step-one').addClass('active');
                                $('#form-step-two').addClass('active');
                                $('#form-step-three').addClass('active');
                                $('html, body').animate({
                                    scrollTop: $("#main_form").offset().top
                                }, 500);
                            }else{
                                toastr.error('Something went wrong.');
                            }
                        }
                    });
                    return false;
                },
                success: function(label,element) {
                    label.parent().removeClass('has-danger');
                    $('#form-step-two').removeClass('error');
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                    $('#form-step-two').addClass('error');
                }
            });
        }
        if($('#form_step_3').length > 0){
            $("#form_step_3").validate({
                rules: {
                    signature:{
                        required:true,
                    },
                    church_first_name:{
                        required:true,
                    },
                    church_email:{
                        required:true,
                    }
                },
                messages:{
                    signature: 'Please enter your signature',
                },
                submitHandler: function (form) {
                    if($('#drawsignbase').val() == ""){
                        $('#signature-error').removeClass('d-none');
                        $('#form-step-three').addClass('error');
                        return false;
                    }
                    $('#submit-form-btn').prop('disabled',true);
                    $('#submit-form-btn').append(' <i class="fa fa-spin fa-spinner"></i>');
                    var url = form.action;
                    var formData = new FormData(form);
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if(response.status == true){
                                window.location.href = response.redirect_url;
                            }else{
                                toastr.error(response.message);
                                $('#submit-form-btn').find('.fa-spinner').remove();
                                $('#submit-form-btn').prop('disabled',false);
                            }
                        }
                    });
                    return false;
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                    $('#form-step-three').addClass('error');
                },
                success: function(label,element) {
                    $('#form-step-three').removeClass('error');
                    label.parent().removeClass('has-danger');
                }
            });
        }


        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    }
    /* END - Form validation  */
</script>
@endsection
