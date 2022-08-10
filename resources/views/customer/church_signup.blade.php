@extends('customer.layouts.app')
@section('title','Church SignUp')
@section('content')
@php
    $getAllContrycode =App\Models\Country::select('name','id')->get();
    $getPestors = App\Models\User::select('id','name','email')->where('role_id',5)->where('status',1)->where('is_delete',0)->get();
    $getChurchType = App\Models\ChurchType::orderBy('display_order','asc')->where('status',1)->get();
@endphp
<section class="bg-breadcrumb px-lg-4 px-xl-5">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-lg-0">
                        <li class="breadcrumb-item"><a  href="{{route('home')}}" class="font-14 font-weight-bold text-medium-gray">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('signup')}}" class="font-14 font-weight-bold text-medium-gray">Sign  Up</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('church.signup')}}" class="font-14 font-weight-bold text-medium-gray">Church Sign Up</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12 col-lg-5">
                <h1 class="text-navy-blue-dark font-40 font-weight-bold font-mulish-bold">Sign Up Your Church</h1>
            </div>
        </div>
    </div>
</section>

<section class="px-lg-4 px-xl-5 mb-5">
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <form role="form" name="church_signup_form" id="church_signup_form" action="{{route('church.register')}}" class="login-box church_signup" enctype="multipart/form-data" method="post">
                    <div class="tab-content" id="main_form">
                        @csrf
                        <div class="tab-pane active" role="tabpanel">
                            <div class="row border rounded">
                                <div class="col-12 col-md-6 col-lg-4 px-md-0 text-center d-none d-md-block">
                                    <img src="{{asset('img/church_821.png')}}" class="w-100 h-100 object-fit-cover max-h-1025px" alt="">
                                </div>
                                <div class="col-12 col-md-6 col-lg-8">
                                    <div class="row  p-md-3 p-lg-5 py-4">
                                        <div class="col-12">
                                            <h1 class="text-slate-green font-24 font-weight-bold font-mulish-bold">Your basic
                                                information
                                            </h1>
                                            <p class="text-dark-gray font-18 mb-0">Register your church and help your members be intentional with supporting the Christian economy.
                                            </p>
                                        </div>
                                        <div class="col-12 col-xl-12">
                                            <div class="row">
                                                    <div class="col-12 mt-4">
                                                        <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="text" name="church_name" id="church_name" placeholder="Church Name" @if($church_detail) value="{{$church_detail->church_name}}" @endif>
                                                    </div>

                                                @if(!empty($church_detail))
                                                    <div class="col-12 col-xl-12 mt-4">
                                                        <input class="form-control readonly_input_gray bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                                                        type="email" name="email" id="email" value="{{$church_detail->church_email}}" placeholder="Church Email" readonly>
                                                    </div>
                                                    <input type="hidden" name="id" id="id" value="{{$church->id}}">
                                                @else
                                                    <div class="col-12 col-xl-12 mt-4">
                                                        <input class="form-control  bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                                                        type="email" name="email" id="email" value="" placeholder="Church Email">
                                                    </div>
                                                    <input type="hidden" name="id" id="id" value="0">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6 mt-4">
                                            <input type="text" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" name="address" id="church_signup_location" placeholder="Address Line 1" @if($church_detail) value="{{$church_detail->address}}" @endif />
                                            <input type="hidden" name="latitude" id="edit_latitude" value="">
                                            <input type="hidden" name="longitude" id="edit_longitude" value="">
                                        </div>
                                        <div class="col-12 col-xl-6 mt-4">
                                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="text"  autocomplete="off" id="address_2" name="address_2" placeholder="Address Line 2" @if($church_detail) value="{{$church_detail->address_2}}" @endif>
                                        </div>
                                        <div class="col-6 mt-4">
                                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="text" name="city" autocomplete="off" required placeholder="City" @if($church_detail) value="{{$church_detail->city}}" @endif>
                                        </div>
                                        <div class="col-6 mt-4">
                                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="text" name="zip_code" autocomplete="off" required placeholder="Zip Code" @if($church_detail) value="{{$church_detail->zip_code}}" @endif>
                                        </div>
                                        <div class="col-6 mt-4">
                                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="text" name="state" autocomplete="off" required placeholder="State" @if($church_detail) value="{{$church_detail->state}}" @endif>
                                        </div>

                                        <div class="col-6 mt-4 custom-select2">
                                            <select name="country_code" id="country_code" required class="form-control bg-light-gray border-0 rounded-0 h-auto"  data-control="select2" required>
                                                @if($church_detail)
                                                    @foreach ($getAllContrycode as $code)
                                                    <option value="{{$code->id}}" {{($code->id==$church_detail->country_id) ?'selected':''}} >{{$code->name}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($getAllContrycode as $code)
                                                    <option value="{{$code->id}}" {{($code->id==239) ?'selected':''}} >{{$code->name}}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                        <div class="col-12 mt-4 custom-select2">
                                            <select name="denomination" data-error="#error-denomination" id="denomination" required class="form-control bg-light-gray border-0 rounded-0 h-auto"  data-control="select2" required data-error="#error-church_type">
                                                <option value="">Please Select Denomination</option>
                                                @if($church_detail)
                                                    @foreach ($getChurchType as $type)
                                                    <option data-title="{{$type->name}}" value="{{$type->id}}" {{($type->id == $church_detail->denomination_id) ?'selected':''}}>{{$type->name}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach ($getChurchType as $type)
                                                    <option data-title="{{$type->name}}" value="{{$type->id}}">{{$type->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div id="error-denomination"></div>
                                                <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 mt-4 d-none" type="text"  autocomplete="off" id="new_denomination" name="new_denomination" placeholder="Enter Your Denomination" required  @if($church_detail) value="{{$church_detail->new_denomination}}" @endif>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <textarea class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" name="description" id="description" placeholder="Description" rows="3">@if($church_detail) {{$church_detail->description}}   @endif</textarea>
                                        </div>

                                         <!-- begin select pastors/leaders -->

                                         <div class="col-12 border-1 my-2">
                                             <hr>
                                             Pastor/Leader Details <br>
                                             <span class="text-muted">Note: Pastor/leader details  will be consider for the church login</span>

                                        </div>
                                        @if($church)
                                            <div class="col-12 border-1">
                                                    <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 mt-4" type="text"  autocomplete="off" id="name_of_leader" name="name_of_leader" placeholder="Name of Pastor/Leader of your church" required value="{{$church->name}}" >

                                                    <input class="form-control readonly_input_gray bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 mt-4 " type="email"  autocomplete="off" id="email_of_leader" name="email_of_leader" placeholder="Email of Pastor/Leader of your church" value="{{$church->email}}" readonly required >
                                            </div>
                                        @else
                                            <div class="col-12 border-1">
                                                    <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 mt-4" type="text"  autocomplete="off" id="name_of_leader" name="name_of_leader" placeholder="Name of Pastor/Leader of your church" required >

                                                    <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 mt-4 " type="email"  autocomplete="off" id="email_of_leader" name="email_of_leader" placeholder="Email of Pastor/Leader of your church" required >
                                            </div>
                                        @endif
                                        <div class="col-12 col-xl-6 mt-4">
                                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="password"  autocomplete="off" id="password" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="col-12 col-xl-6 mt-4">
                                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="password" name="confirm_password" autocomplete="off" required placeholder="Confirm Password">
                                        </div>
                                        <!-- end select pators/leaders -->
                                        <div class="col-12 mt-4">
                                            <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.sitekey')}}"></div>
                                            @if ($errors->has('g-recaptcha-response'))
                                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                            @endif
                                        </div>
                                        <div class="d-none">
                                            <div id="show-map"></div>
                                        </div>
                                        <div class="col-12 mt-5">
                                            <ul
                                                class="list-inline d-flex justify-content-between align-items-center font-mulish">
                                                <li>
                                                    <input type="submit" id="church_signup_submit" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish" value="Submit">
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    var address = "{{'New York'}}";
    const show_latitude = "{{'40.7127753'}}";
    const show_longitude = "{{'-74.0059728'}}";
    /* On change address */
    $('#church_signup_location').blur(function () {
        if($(this).val() != ""){
            var map = new google.maps.Map(document.getElementById("show-map"));
            var latlngbounds = new google.maps.LatLngBounds();
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'address': $(this).val() }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var Latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                    var marker = new google.maps.Marker({
                        position: Latlng,
                        map: map,
                        title: results[0].formatted_address,
                        draggable: true
                    });
                    $('#edit_latitude').val(results[0].geometry.location.lat());
                    $('#edit_longitude').val(results[0].geometry.location.lng());

                } else {

                }
            });
        }
        return false;
    });
</script>
<script>
    var id=$('#id').val();
    $("#church_signup_form").validate({
        rules: {
            church_name: {
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
                    url: "{{route('isChurchEmailExists')}}",
                    data: {'_token': $("input[name=_token]").val(),'id':id},
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
        address:{
            required:true,
            noSpace:true,
        },
        denomination:{
            required:true,
        },
        city:{
            required:true,
            noSpace:true,
        },
        state:{
            required:true,
            noSpace:true,
        },
        country_code:{
            required:true,
            noSpace:true,
        },
        zip_code:{
            required:true,
            noSpace:true,
            minlength:5,
        },
        password:  {
            required:true,
            pwcheck: true,
        },
        confirm_password:{
            required:true ,
            equalTo : "#password",
        },
        new_denomination:{
            required:true,
            noSpace:true,
        },
        email_of_leader:{
            checkemail:true,
            required: true,
            remote: {
                    type: 'post',
                    url: "{{route('isEmailExists')}}",
                    data: {'_token': $("input[name=_token]").val(),'id':id},
                    dataFilter: function (data)
                    {
                        var json = JSON.parse(data);
                        if (json.valid === true) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                },
            notEqualTo : '#email',
        },
        name_of_leader:{
            required:true,
            noSpace:true,
            notEqualTo : '#church_name',
        }
    },
    messages: {
        church_name: {
            required:'Please enter church name',
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
        address:{
            required:"Please enter your address",
        },
        denomination:{
            required:"Please select denomination",
        },
        leader:{
            required:"Please select pastor/leader",
        },
        name_of_leader:{
            required:"Please enter name of pastor/leader ",
            notEqualTo: 'Same as church name not allowed',
        },
        email_of_leader:{
            required:"Please enter email of pastor/leader ",
            checkemail: "Please enter valid email",
            remote:"Pastor is already exists",
            notEqualTo: 'Same as church email address not allowed',
        },
        city:{
            required:"Please enter your city",
        },
        state:{
            required:"Please enter your state",
        },
        zip_code:{
            required:"Please enter your zip code",
            minlength:"Enter minimum 5 digits"
        },
        password:{
            required:"Please enter password",
        },
        confirm_password:{
            required:"Please enter confirm password",
            equalTo:"Password & confirm password are not same.",
        },
        new_denomination:{
            required:"Please enter your denomination",
        },
    },
    submitHandler: function (form) {
        return true;
        $('#church_signup_submit').prop('disabled',true);
        $('#church_signup_submit').append(' <i class="fa fa-spin fa-spinner"></i>');
    },
    success: function(label,element) {
        label.parent().removeClass('has-danger');

    },
    errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
    });

</script>
<script>
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

</script>

@if($church_detail)
<script>
        var country_code ='{{$church_detail->country_id}}';
        $('#country_code').val(country_code);
        var denomination ='{{$church_detail->denomination_id}}';
        $('#denomination').val(denomination);

</script>
@endif
<script>
$(document).on('change','#denomination',function(){
    var name = $(this).find(':selected').data('title');
    if (name == 'Other') {
        $('#new_denomination').show();
        $('#new_denomination').removeClass('d-none');
    }
    else{
        $('#new_denomination').hide();
    }
});
</script>
@endsection
