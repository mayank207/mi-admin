@extends('customer.layouts.app')
@section('title', 'My Profile')
@section('content')
    <div class="mt-3 border-1">
        <div class="row m-0">
            <div class="col-12 col-lg-12 load-business-profile">
                <div class="row border-light-gray br-5 p-3 mx-0 my-4 mt-lg-0">
                    <div class="col-12 col-md-auto pl-md-0 pr-md-5">
                        <div class="avatar-edit">
                            <label for="imageUpload">
                                <i class="far fa-edit cursor-pointer" data-toggle="modal" data-target="#spam-message"></i>
                            </label>
                        </div>
                        <div class="avatar-preview">
                            <div id="profile_image">
                                <img src="{{ $profile->user_profile }}" class="img-fluid w-100 profile_image"
                                    alt="Profile Picture" width="200px">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 mt-4 mt-md-0 ">
                        <div class="row">
                            @if(!empty($profile->business_details->business_name) && Auth::user()->role_id == 3)
                                <div class="col-12 col-sm-6">
                                    <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish">
                                        {{ $profile->business_details->business_name }}

                                        <div>
                                            <span class="text-dark-gray font-18 mr-2"> @if(!empty($profile->category)){{$profile->category->category_name}}@endif</span>

                                        </div>

                                    </h3>
                                    <p class="text-dark-gray mb-0 font-18">
                                        {{ $profile->business_details->business_email }}</p>
                                    <p class="text-dark-gray mb-0 font-18">
                                        {{ $profile->business_details->business_mobile_number }}</p>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="d-flex align-items-center justify-content-sm-end">
                                        <span class="px-4 py-2 bg-slate-green text-white font-12 font-weight-bold br-5 font-mulish"><i class="fa-solid fa-bolt-lightning text-white pr-2"></i> Kingdom Verified</span>
                                    </div>
                                </div>
                                <div class="col-12 mt-3 mt-sm-0">
                                    <div class="d-flex flex-column flex-sm-row align-items-sm-center">
                                        <div class="bg-light-gray4 br-10 px-3 py-2">
                                            <img src="{{ asset('img/location.png') }}" class="img-fluid" alt="">
                                            <span class="text-navy-blue-dark font-weight-bold pl-2 font-mulish">
                                                {{ $profile->business_details->city }}
                                                -
                                                {{ $profile->business_details->zip_code }}</span>
                                        </div>
                                        <div class="ml-sm-4 ml-lg-0 ml-xl-4 mt-2">
                                            <img src="{{asset('img/Star-fill.png')}}" class="img-fluid mb-1" alt="">
                                            <span class="font-16 text-navy-blue-dark font-weight-bold ml-2 font-mulish">{{$profile->business_details->average_rating}}
                                                ({{$profile->business_details->total_review}} reviews)</span>
                                        </div>
                                    </div>


                                    <div class="mt-4">
                                        </h3>{{ $profile->business_details->sort_description }} </p>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 col-sm-6">
                                    <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish">
                                        {{ $profile->name }}
                                    </h3>
                                    <p class="text-dark-gray mb-0 font-18">{{ $profile->email }}</p>
                                    <p class="text-dark-gray mb-0 font-18">{{ $profile->mobile_number }}</p>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="row  border-light-gray br-5 py-3 mx-0 mt-4 ">
                    <div class="col-12">
                        <ul class="nav nav-pills mb-3 justify-content-start" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{(Route::currentRouteName() == 'profile')? 'active' : ''}} mx-4" href="{{route('profile')}}"
                                    role="tab" aria-controls="personal_details" aria-selected="true">Personal Details</a>
                            </li>
                            @if (Auth::user()->role_id == 4 && !empty($profile->church_details))
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{(Route::currentRouteName() == 'profile.assosiatedBusinesses')? 'active' : ''}} mx-4" href="{{route('profile.assosiatedBusinesses')}}"
                                    role="tab" aria-controls="assosiated_businesses" aria-selected="true">Assosiated Businesses</a>
                                </li>
                            @endif
                            @if (Auth::user()->role_id == 3 && !empty($profile->business_details))
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{(Route::currentRouteName() == 'profile.update_business_details')? 'active' : ''}} mx-4" href="{{route('profile.update_business_details')}}"
                                    role="tab" aria-controls="personal_details" aria-selected="true">Business Details</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{(Route::currentRouteName() == 'profile.business_media')? 'active' : ''}} mx-4" href="{{route('profile.business_media')}}"
                                    role="tab" aria-controls="business_media" aria-selected="true">Business Media</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{(Route::currentRouteName() == 'profile.subscription')? 'active' : ''}} mx-4" href="{{route('profile.subscription')}}"
                                    role="tab" aria-controls="business_subscription" aria-selected="true">My Subscription</a>
                                </li>
                            @endif
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mx-4 {{(Route::currentRouteName() == 'profile.change_password')? 'active' : ''}}" href="{{route('profile.change_password')}}">Change Password</a>
                            </li>
                        </ul>
                        {{-- Begin Content --}}
                        <div>
                            {{-- upload.media --}}
                            @if(Route::currentRouteName() == 'profile')
                                @include('customer.profile.personal_details')
                            @elseif (Route::currentRouteName() == 'profile.assosiatedBusinesses')
                                @include('customer.profile.assosiated_businesses')
                            @elseif (Route::currentRouteName() == 'profile.update_business_details')
                                @include('customer.profile.business_details')
                            @elseif (Route::currentRouteName() == 'profile.business_media')
                                @include('customer.profile.business_media')
                            @elseif (Route::currentRouteName() == 'profile.change_password')
                                 @include('customer.profile.change_password')
                            @elseif (Route::currentRouteName() == 'profile.subscription')
                                 @include('customer.profile.business_subscription')
                            @endif
                        </div>
                        {{-- End Content --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Profile Picture Modal --}}
    <div class="modal fade custommodel" id="spam-message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="bold-lable" id="exampleModalLabel bold-lable">Please Select Profile Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-right">
                    <div class="text-center">
                        <label class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none font-mulish cursor-pointer"> Choose Image <input type="file" id="upload" class="upload-profile"
                                size="60" style='display: none;' accept="image/*"></label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div id="upload-demo" style="width:350px;"></div>
                    </div>
                    <div class="border-top"></div>
                    <div class="mt-2">
                        <button class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none font-mulish upload-result px-4"
                            data-url="{{ route('change.profile.picture') }}">Save</button>
                        <button class="btn btn-light px-4" data-dismiss="modal">Close</button>
                        <input type='hidden' id='textshow'>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Beging - business details modal -->
    <div id="BusinessDetailModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl ">
            <!-- Modal content-->
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h4 class="modal-title">Business Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="load-bussiness-details">

                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- End- business details modal -->
@endsection
@section('css')
    <link rel="stylesheet" type='text/css' href="{{ asset('assets/plugins/cropper/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/dropzone.css') }}" />
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/cropper/cropper.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropzone/dropzone.js') }}"></script>
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
    <script>
        var id='{{$profile->id}}';
        $("#edit_business_details_form").validate({
            rules: {
                business_name: {
                    required: true,
                    noSpace:true,
                },
                business_email: {
                    required: true,
                    noSpace:true,
                    checkemail:true,
                    remote: {
                        type: 'post',
                        url: "{{ route('isbusinessEmailExists') }}",
                        data: {
                            '_token': $("input[name=_token]").val(),
                            'id':id,
                        },
                        dataFilter: function(data) {
                            var json = JSON.parse(data);
                            if (json.valid === true) {
                                return '"true"';
                            } else {
                                return "\"" + json.message + "\"";
                            }
                        }
                    }
                },
                business_mobile_number: {
                    required:true ,
                    input_mask_mobile_number:true,
                },
                country_code: {
                    required: true,
                },
                address: {
                    required: true,
                    noSpace:true,
                    validateAddress:true,
                },
                city: {
                    required: true,
                    noSpace:true,
                },
                state: {
                    required: true,
                    noSpace:true,
                },
                zip_code: {
                    required: true,
                    noSpace:true,
                    minlength:5,

                },
                "sub_category[]": {
                    required: true,
               },
                sort_description: {
                    required: true,
                    noSpace:true,
                },
                description: {
                    required: true,
                    noSpace:true,
                },
                category: {
                    required: true,
                },
                facebook_url: {
                    checkurl: true,
                },
                twitter_url: {
                    checkurl: true,
                },
                instagram_url: {
                    checkurl: true,
                },
                linkedin_url: {
                    checkurl: true,
                },
                website_url: {
                    checkWebsiteUrl: true,
                },

            },
            messages: {
                business_name: {
                    required: 'Please enter your business name',
                },
                business_email: {
                    required: "Please enter email",
                    checkemail: "Please enter valid email",
                },
                business_mobile_number: {
                    required:'Please enter mobile number',
                    input_mask_mobile_number:"Please enter a valid number",
                },
                country_code: {
                    required: "Please choose country code",
                },
                "sub_category[]": {
                    required: "Please choose the Business Service",
               },
                address: {
                    required: "Please enter address"
                },
                city: {
                    required: "Please enter city ",
                },
                state: {
                    required: "Please enter state",
                },
                zip_code: {
                    required: "Please enter zip code",
                    minlength:'Enter minimum 5 digits',
                },
                description: {
                    required: "Please enter description",
                },
                sort_description: {
                    required: "Please enter short description",
                },
                category: {
                    required: "Please choose business category",
                },
                facebook_url: {
                    noSpace: "Please enter valid facebook url",
                },
                instagram_url: {
                    noSpace: "Please enter valid instagram url",
                },
                linkedin_url: {
                    noSpace: "Please enter valid linkedin url",
                },
                twitter_url: {
                    noSpace: "Please enter valid twitter url",
                },
                website_url: {
                    url: "Please enter valid website url",
                },

            },
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {

                return true;
            },
            success: function(label, element) {
                label.parent().removeClass('has-danger');
            },
        });
        $(document).on('submit','#edit_business_details_form',function(e){
            e.preventDefault();
            var form_data = $(this).serialize();
            var form_url = $(this).attr('url');
            $.ajax({
                type: "post",
                url: form_url,
                dataType: 'json',
                cache: false,
                data: form_data,

                success: function(data) {

                    if(data.status == 200){
                        toastr.success('Business details updated successfully');
                    }else{
                        toastr.error(data.message);
                    }
                },
                error: function(){
                    toastr.error(data.message);
                }
            });
        });
    </script>
    <script>
        var id='{{$profile->id}}';
        $("#change_password_form").validate({
            rules: {
                current_password: {
                    required: true,
                    noSpace:true,
                    remote: {
                        type: 'post',
                        url: "{{ route('passwordCheck') }}",
                        data: {
                            '_token': $("input[name=_token]").val(),
                            'id':id,
                        },
                        dataFilter: function(data) {
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
            },
            messages: {

                current_password: {
                    required: "Enter your current password",
                },
                password: {
                    required:'Please enter new password',
                },
                confirm_password: {
                    required:'Please enter confirm password',
                    equalTo:'Password & confirm password are not same.'
                },
            },
            submitHandler: function(form) {

                return true;
            },
            success: function(label, element) {
                label.parent().removeClass('has-danger');
            },
        });
        $(document).on('submit','#change_password_form',function(e){
            e.preventDefault();
            var form_data = $(this).serialize();
            var form_url = $(this).attr('url');
            $.ajax({
                type: "post",
                url: form_url,
                dataType: 'json',
                cache: false,
                data: form_data,
                success: function(data) {
                    if(data.status == 200){
                        $('#current_password').val('');
                        $('#password').val('');
                        $('#confirm_password').val('');
                        toastr.success(data.message);
                    }else{
                        toastr.error(data.message);
                    }
                },
                error: function(){
                    toastr.error(data.message);
                }
            });
        });
    </script>
    <script>
        var id='{{$profile->id}}';
        $("#edit_personal_details_form").validate({
            rules: {
                church_name:{
                    required: true,
                    noSpace:true,
                },
                first_name: {
                    required: true,
                    noSpace:true,
                },
                last_name: {
                    required: true,
                    noSpace:true,
                },
                user_name: {
                    required: true,
                    noSpace:true,
                    username: true,
                    minlength:3,
                    remote: {
                        type: 'post',
                        url: "{{ route('isUserNameExists') }}",
                        data: {
                            '_token': $("input[name=_token]").val(),
                            'id':id,
                        },
                        dataFilter: function(data) {
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
                    required: true,
                },
                mobile_number: {
                    required:true ,
                    input_mask_mobile_number:true,
                },
                country_code: {
                    required: true,
                },
                zip_code:{
                    required:true,
                    minlength:5,
                },
                address:{
                    required:true,
                    validateAddress:true,
                },
                city:{
                    required:true,
                },
                state:{
                    required:true,
                },
                name_of_leader:{
                    required:true,
                },
                email_of_leader:{
                    required:true,
                    checkemail:true,
                },
                new_denomination:{
                    required:true,
                }
            },
            messages: {
                church_name:{
                    required: 'Please enter church name',
                },
                first_name: {
                    required: 'Please enter your first name',
                },
                last_name: {
                    required: 'Please enter your last name',
                },
                user_name: {
                    required: "Enter your username.",
                    remote: 'This username is already exists.',
                },
                email: {
                    required: "Please enter email",
                    checkemail: "Please enter valid email",
                },
                country_code: {
                    required: "Please choose country code",
                },
                mobile_number: {
                    required:'Please enter mobile number',
                    input_mask_mobile_number:"Please enter a valid number",
                },
                city:{
                    required: 'Please enter city name',
                },
                state:{
                    required: 'Please enter state name',
                },
                address:{
                    required : 'Please enter address line 1',
                },
                zip_code:{
                    required: 'Please enter zip code',
                    minlength : 'Minimum 5 digit zip code allowed',
                },
                name_of_leader:{
                    required:"Please enter name of pastor/leader ",
                },
                email_of_leader:{
                    required:"Please enter email of pastor/leader ",
                    checkemail:"Please enter valid email",
                },
                new_denomination:{
                    required:"Please enter denomination ",
                }

            },
            submitHandler: function(form) {

                return true;
            },
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
            success: function(label, element) {
                label.parent().removeClass('has-danger');
            },
        });
    </script>
    <script>
        $('#country_code').select2({});
        $('#business_country_code').select2({});
        $('#category').select2({});
        $('#country').select2({});
        $('#sub_category').select2({
            maximumSelectionLength: 5,
            language: {
                maximumSelected: function (e) {
                    var t = "You can only select 5 services";
                    return t ;
                }
            }
        });
        $('#secondary_category').select2({});
        $('#secondary_sub_category').select2({});
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#category', function() {
                var id = this.value;
                $("#sub_category").html('');
                $.ajax({
                    url: "{{ route('fetchSubCategory') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#sub_category').html('');
                        $.each(data.sub_category, function(key, value) {
                            $("#sub_category").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                    }
                });
            });
            /* secondary subcategory fetch */
            $(document).on('change', '#secondary_category', function() {
                var id = this.value;
                $("#secondary_sub_category").html('');
                $.ajax({
                    url: "{{ route('fetchSubCategory') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#secondary_sub_category').html('');
                        $.each(data.sub_category, function(key, value) {
                            $("#secondary_sub_category").append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });
                    }
                });
            });
            /* end secondary subcategory fetch */
        });

        /* Crop profile */
        $uploadCrop = $('#upload-demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 200,
                height: 200,
            }
        });

        /* Preview selected profile */
        $('#upload').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function() {});
            }
            reader.readAsDataURL(this.files[0]);
        });

        /* Choose profile get file name */
        $('.upload-profile').change(function(e) {
            var fileName = e.target.files[0].name;
            $('#textshow').val(fileName);
        });

        /* Profile upload */
        $('.upload-result').on('click', function(ev) {
            var textshow = $('#textshow').val();
            if (textshow == '') {
                toastr.error('please select an image from choose image option first');
            } else {
                $(this).append(' <i class="fa fa-spin fa-spinner"></i>');
                $('#spam-message button').prop('disabled', true);
                var url = $(this).data('url');
                var $this = $(this);
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(resp) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            "image": resp,
                            '_token': $("input[name=_token]").val()
                        },
                        success: function(response) {
                            $('#upload-demo img').attr('src', '');
                            $this.html('Save');
                            $('#spam-message button').prop('disabled', false);
                            $('#spam-message').modal('hide');
                            if (response.status == true) {
                                $('.profile_image').attr('src', response.url);
                                $('.header-profile-image').attr('src', response.url);
                                toastr.success(response.message, "Success");
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function() {
                            $this.html('Save');
                            $('#upload-demo img').attr('src', '');
                            $('#spam-message button').prop('disabled', false);
                            $('#spam-message').modal('hide');
                            toastr.error('Something went wrong.');
                        }
                    });
                });
            }

        });

        /* Business media */
        Dropzone.options.dropzoneForm = {
            maxFilesize: 200,
            parallelUploads: 20,
            acceptedFiles: "jpeg,.jpg,.png,.mp4,.mov,.webm",
            dictFileTooBig: 'File is bigger than 200MB',
            clickable: true,
            addRemoveLinks: false,
            maxFiles: 20,
            init: function() {
                var msg = 'Maximum File Size Video 200MB / Image 20MB';
                var brswr_img = "{{ asset('img/upload-cloud.png') }}";
                var apnd_msg = '<img src="' + brswr_img +
                    '" alt=""><h1 class="pt-2 mb-1 font-20 text-color-4 font-weight-normal">Drop files here or  <svp class="text-color-1">browse</svp></h1><h3 class="font-14 text-color-4 font-weight-normal">' +
                    msg + '</h3>';
                $('#dropzoneForm .dz-message').append(apnd_msg);
                $('#dropzoneForm .dz-message span').hide();

            },
            error: function(file, response) {
                if ($.type(response) === "string") {
                    var message = response;
                } else {
                    var message = response.message;
                }
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            },
            success: function(file, data) {
                this.removeFile(file);
                if (data.status == 200) {
                    $('#load-business-media').empty().append(data.html);
                } else {
                    if (!data.message) {
                        toastr.error("Something wrong went");
                    } else {
                        toastr.error(data.message);
                    }
                }
            }
        };



         /* delete business image */
         $(document).on('click','.image_trash',function(){

            var id =$(this).attr('data-value');
            bootbox.confirm({
                title: "Delete Media ",
                message: "Are you sure to delete this media file ?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirm'
                    }
                },
                callback: function (result) {
                    if(result){
                        $('.pic_'+id+'_delete').remove();
                        $.ajax({
                            url: "{{route('business_media.delete')}}",
                            type: "POST",
                            data: {
                                id: id,
                                _token: '{{csrf_token()}}'
                            },
                            dataType: 'json',
                            success: function (data) {
                                toastr.success('Media deleted successfully');
                            }
                        });
                    }
                    else{

                    }
                }
            });
        });
    </script>
        @if (Auth::user()->role_id == 3 && !empty($profile->business_details) && Route::currentRouteName() == 'profile.update_business_details' || Auth::user()->role_id == 4 && !empty($profile->church_details) && Route::currentRouteName() == 'profile')
        <script>
            @if(Auth::user()->role_id == 3 && Route::currentRouteName() == 'profile.update_business_details')
                var address = "{{($business_details->address)? $business_details->address : 'New York'}}";
                const show_latitude = "{{($business_details->latitude)? $business_details->latitude : '40.7127753'}}";
                const show_longitude = "{{($business_details->longitude)? $business_details->longitude : '-74.0059728'}}";
            @endif
            @if(Auth::user()->role_id == 4 && Route::currentRouteName() == 'profile')
                 var address = "{{($profile->church_details->address)? $profile->church_details->address : 'New York'}}";
                const show_latitude = "{{($profile->church_details->latitude)? $profile->church_details->latitude : '40.7127753'}}";
                const show_longitude = "{{($profile->church_details->longitude)? $profile->church_details->longitude : '-74.0059728'}}";
            @endif
        initialize();
        function initialize(){

            var infoWindow = new google.maps.InfoWindow();
            var myLatlng = new google.maps.LatLng(show_latitude,show_longitude);
            var myOptions = {
                    zoom: 17,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }

            map = new google.maps.Map(document.getElementById("show-map"), myOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: address,
                draggable: true
            });

            infoWindow.setContent(marker.title);
            infoWindow.open(map, marker);

            google.maps.event.addListener(marker, 'dragend', function () {
                $('#edit_latitude').val(marker.getPosition().lat());
                $('#edit_longitude').val(marker.getPosition().lng());
                infoWindow.setContent(marker.title);
                infoWindow.open(map, marker);
                map.setCenter(marker.getPosition());
                map.setZoom(17); // Why 17? Because it looks good.
            })
        }

        /* On change address */
        $('.address').blur(function(){
            if($('#edit_business_location').val() != "" && $('#city').val() != "" && $('#state').val() != "" && $('#zip_code').val() !=""){
               var address = $('#edit_business_location').val() + ','+$('#address_2').val() + ',' + $('#city').val()  +','+ $('#zip_code').val() + ',' + $('#state').val() +','+ $('option:selected','#country').data('country');
                var map = new google.maps.Map(document.getElementById("show-map"));
                var latlngbounds = new google.maps.LatLngBounds();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'address': address }, function (results, status) {
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

                        latlngbounds.extend(marker.position);
                        google.maps.event.addListener(marker, "click", function (e) {
                            infoWindow.setContent(marker.title);
                            infoWindow.open(map, marker);
                        });

                        google.maps.event.addListener(marker, 'dragend', function () {
                            console.log(marker.getPosition());

                            $('#edit_latitude').val(marker.getPosition().lat());
                            $('#edit_longitude').val(marker.getPosition().lng());

                            infoWindow.setContent(marker.title);
                            infoWindow.open(map, marker);
                        })
                        if (results[0].geometry.viewport) {
                            map.fitBounds(results[0].geometry.viewport);
                        } else {
                            map.setCenter(results[0].geometry.location);
                            map.setZoom(17); // Why 17? Because it looks good.
                        }
                    } else {
                        $('#edit_latitude').val('');
                        $('#edit_longitude').val('');
                    }
                });
            }
            return false;
        });
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
    <script>
        $(document).on('click','#add_service',function(){
            $('#new_service').toggle();
            $('#new_service').removeClass('d-none');
            $("#newServiceError").html('');
        });
        $(document).on('click','#cancle_add_service',function(){
            $('#new_service').toggle();
            $('#new_service').removeClass('d-none');
            $("#newServiceError").html('');
        });

        $(document).on('click','#submit_new_service',function(){
            var service = $('#new_business_service').val();
            if(service){
                var count = $("#sub_category :selected").length;
                if(count < 5){
                        $("#sub_category").append('<option selected value="new_'+service+'">'+service +'</option>');
                        $('#new_business_service').val(null);
                        $('#new_service').hide();
                }
                else{
                    toastr.error('You can select maximum 5 business services');
                    $("#newServiceError").html("Please enter business service").addClass("error");
                    $('#new_business_service').val(null);
                    $('#new_service').hide();
                }
            }
            $("#newServiceError").html("Please enter business service").addClass("error");

        });
    </script>
    <script>
        $('.BusinessModal').on('click',function(){
                var form_url = $(this).data('url');
                var id = $(this).data('user_id');
                $.ajax({
                url: form_url,
                type: 'post',
                data: {'_token': $("input[name=_token]").val(),'id':id},
                success: function(response){
                    if(response.status == 'success'){
                        $('#load-bussiness-details').html(response.html);
                        $('#BusinessDetailModal').modal('show');
                        // $('.BusinessDetails').html(data.total_records);
                    }else{
                        toastr.error(response.message);
                    }
                },
            });
        });
    </script>
    <script>
     $(document).on('click', '.confirmation', function (e) {
            e.preventDefault();

            bootbox.confirm({
                title: "Cancle Subscription ",
                message: "Are you sure you want to cancel business subscription?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirm'
                    }
                },
                    callback: function (result) {
                        if(result){
                            $.ajax({
                                url: "{{route('subscription.paypal.cancel')}}",
                                type: "POST",
                                data: {
                                    _token: '{{csrf_token()}}'
                                },
                                dataType: 'json',
                                success: function (response) {
                                    if(response.status == 200){
                                        location.reload();
                                    }else{
                                        toastr.error(response.message);
                                    }

                                }
                            });
                        }
                        else{

                        }
                    }
                });
            });
</script>
@endsection
