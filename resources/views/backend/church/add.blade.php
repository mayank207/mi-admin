@extends('backend.layouts.base')
@section('title')
    {!! setBreadCrumb('Church', route('church.index')) !!}
    {!! setBreadCrumb('Add') !!}
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-xxl">
            <div class="row g-xl-8">
                <!--begin::church column-->
                <form class="form" action="{{ route('church.store') }}" id="add_curch_form" method="post">
                    @csrf
                    <div class="d-flex">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <h3 class="card-title align-items-start flex-column mb-5">
                                        <span class="fw-bolder text-dark">Add church</span>
                                    </h3>
                                 
                                    <div class="row">
                                        <div class="fv-row col-md-6 form-group mb-7">
                                            <label class="required fs-6 fw-bold mb-2">Name of Pastor/Leader of your church</label>
                                            <input type="text" class="form-control form-control-solid" id="name_of_leader"
                                                name="name_of_leader" value="" placeholder="Name of Pastor/Leader of your church" />
                                            @if ($errors->has('name_of_leader'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('name_of_leader') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="fv-row col-md-6 form-group mb-7">
                                            <label class="required fs-6 fw-bold mb-2">Email of Pastor/Leader of your church</label>
                                            <input type="text" class="form-control form-control-solid" id="email_of_leader"
                                                name="email_of_leader" value="" placeholder="Email of Pastor/Leader of your church" />
                                            @if ($errors->has('email_of_leader'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('email_of_leader') }}</strong>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row">
                                        <!-- Name -->
                                        <div class="fv-row form-group col-md-6 mb-7">
                                            <label class="required fs-6 fw-bold mb-2">Church Name</label>
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Church Name" id="church_name" name="church_name" />
                                            @if ($errors->has('church_name'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('church_name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- end-Name -->
                                        <!-- Email -->
                                        <div class="fv-row form-group col-md-6 mb-7">
                                            <label class="required fs-6 fw-bold mb-2">Church Email</label>
                                            <input type="email" placeholder="Email" class="form-control form-control-solid"
                                                id="church_email" name="church_email" />
                                            @if ($errors->has('church_email'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('church_email') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- end-Email -->
                                    </div>
                                    <div class="row">
                                        <!-- Address line 1-->
                                        <div class="fv-row form-group col-md-6 mb-7">
                                            <label class="required fs-6 fw-bold mb-2">Address line 1</label>
                                            <input type="text" class="form-control form-control-solid" value=""
                                                name="address" id="add_church_location" placeholder="Address Line 1" />
                                            <input type="hidden" name="latitude" id="edit_latitude" value="">
                                            <input type="hidden" name="longitude" id="edit_longitude" value="">
                                            @if ($errors->has('address'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- end-Address line 1 -->
                                        <!-- Address line 2-->
                                        <div class="fv-row form-group col-md-6 mb-7">
                                            <label class="fs-6 fw-bold mb-2">Address line 2</label>
                                            <input type="text" class="form-control form-control-solid" id="address_2"
                                                name="address_2" placeholder="Address Line 2" />
                                            @if ($errors->has('address_2'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('address_2') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- end-Address line 2 -->
                                    </div>
                                    <div class="row">
                                        <!-- City-->
                                        <div class="fv-row form-group col-md-6 mb-7">
                                            <label class="required fs-6 fw-bold mb-2">City</label>
                                            <input type="text" class="form-control form-control-solid" id="city" name="city"
                                                placeholder="City" />
                                            @if ($errors->has('city'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- end-City-->
                                        <!-- zip Code-->
                                        <div class="fv-row form-group col-md-6 mb-7">
                                            <label class="required fs-6 fw-bold mb-2">Zip Code</label>
                                            <input type="text" class="form-control form-control-solid" id="zip_code"
                                                name="zip_code" placeholder="Zip Code" />
                                            @if ($errors->has('zip_code'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('zip_code') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- end-Zip Code-->
                                    </div>
                                    <div class="row">
                                        <!-- State-->
                                        <div class="fv-row form-group col-md-6 mb-7">
                                            <label class="required fs-6 fw-bold mb-2">State</label>
                                            <input type="text" class="form-control form-control-solid" id="state"
                                                name="state" placeholder="state" />
                                            @if ($errors->has('state'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('state') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- end-Zip Code-->
                                        <!-- Country-->
                                        <div class="fv-row form-group col-md-6 mb-7">
                                            <label class="required fs-6 fw-bold mb-2">Country</label>
                                            <div class=""> <select name="country" id="country" required
                                                    class="form-control form-control-solid rounded-0 h-auto border-0"
                                                    data-control="select2" required>
                                                    @foreach ($getAllContrycode as $code)
                                                        <option value="{{ $code->id }}">{{ $code->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('country'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('country') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- end-Country-->
                                    </div>
                                    <div class="row">

                                        <div class="fv-row form-group col-md-6 mb-7">
                                            <label class="required fs-6 fw-bold mb-2">Description</label>
                                            <textarea class="form-control description-hight" id="description" name="description" placeholder="Description" rows="3"></textarea>
                                            @if ($errors->has('description'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- denomination-->
                                        <div class="fv-row col-md-6 form-group mb-7">
                                            <label class="required fs-6 fw-bold mb-2">Denomination</label>
                                            <div>
                                                <select name="denomination" data-error="#error-denomination"
                                                    id="denomination"
                                                    class="form-control form-control-solid rounded-0 h-auto border-0"
                                                    data-control="select2">
                                                    <option value="">Select Denomination</option>
                                                    @foreach ($denomination as $type)
                                                        <option data-title="{{ $type->name }}" value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div id="error-denomination"></div>
                                            </div>
                                            @if ($errors->has('denomination'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('denomination') }}</strong>
                                                </div>
                                            @endif
                                            <input
                                                class="form-control bg-light-gray rounded-0 pl-lg-3 d-none mt-4 h-auto border-0 py-3"
                                                type="text" autocomplete="off" id="new_denomination" name="new_denomination"
                                                placeholder="Enter Your Denomination" required>
                                        </div>
                                        <!-- end-denomination -->
                                    </div>

                                    <!-- Location map -->
                                    <div class="fv-row form-group my-7">
                                        <div id="show-map"></div>
                                    </div>
                                    <!--End Location map -->

                                    <div class="fv-row mb-15 d-flex justify-content-end">
                                        <!--begin::Button-->
                                        <a href="{{ route('church.index') }}" class="btn btn-light me-3">Cancel</a>
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="add_church_form_submit" data-kt-banner-action="submit"
                                            class="btn btn-primary" value="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm ms-2 align-middle"></span></span>
                                        </button>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Container-->
                    </div>
                </form>
                {{-- end church column --}}
            </div>
        </div>
    </div>
@endsection
@section('external-scripts')
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script>
        var id = '0';
        $("#add_curch_form").validate({
            rules: {
                church_name: {
                    required: true,
                    noSpace: true,
                },
                church_email: {
                    required: true,
                    checkemail: true,
                    remote: {
                        type: 'post',
                        url: "{{ route('backend.church.isChurchEmailExists') }}",
                        data: {
                            '_token': $("input[name=_token]").val()
                        },
                        dataFilter: function(data) {
                            var json = JSON.parse(data);
                            if (json.valid === true) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                },
                address_1: {
                    required: true,
                },
                city: {
                    required: true,
                    noSpace: true,
                },
                name_of_leader: {
                    required: true,
                    noSpace: true,
                },
                email_of_leader: {
                    required: true,
                    checkemail: true,
                    remote: {
                        type: 'post',
                        url: "{{ route('backend.user.email_exists') }}",
                        data: {
                            '_token': $("input[name=_token]").val()
                        },
                        dataFilter: function(data) {
                            var json = JSON.parse(data);
                            if (json.valid === true) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                },
                denomination: {
                    required: true,
                    noSpace: true,
                },
                state: {
                    required: true,
                    noSpace: true,
                },
                country_code: {
                    required: true,
                },
                zip_code: {
                    required: true,
                    maxlength: 5,
                },
                new_denomination:{
                    required:true,
                }
            },
            messages: {
                church_name: {
                    required: 'Please enter church name',
                },
                church_email: {
                    required: "Please enter email",
                    remote: "Email is already exists",
                    checkemail: "Please enter valid email",
                },
                address_1: {
                    required: "Please enter your address",
                },
                city: {
                    required: "Please enter your city",
                },
                denomination: {
                    required: "Please select denomination",
                },
                name_of_leader: {
                    required: "Please enter name of pastor/leader",
                },
                email_of_leader: {
                    required: "Please enter email of pastor/leader",
                    remote:"Pastor is already exists",
                },
                state: {
                    required: "Please enter your state",
                },
                zip_code: {
                    required: "Please enter your zip code",
                    maxlength: "Enter maximum 5 digits"
                },
                new_denomination:{
                    required:"Please enter denomination",
                }
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
        $('#country_code').select2({
            placeholder: "Select Country Code",
        });
    </script>
    <script>
        var address = "{{ 'New York' }}";
        const show_latitude = "{{ '40.7127753' }}";
        const show_longitude = "{{ '-74.0059728' }}";
        initialize();

        function initialize() {
            var infoWindow = new google.maps.InfoWindow();
            var myLatlng = new google.maps.LatLng(show_latitude, show_longitude);
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

            google.maps.event.addListener(marker, 'dragend', function() {
                $('#edit_latitude').val(marker.getPosition().lat());
                $('#edit_longitude').val(marker.getPosition().lng());
                infoWindow.setContent(marker.title);
                infoWindow.open(map, marker);
                map.setCenter(marker.getPosition());
                map.setZoom(17); // Why 17? Because it looks good.
            })
        }

        /* On change address */
        $('#add_church_location').blur(function() {
            if ($(this).val() != "") {
                var map = new google.maps.Map(document.getElementById("show-map"));
                var latlngbounds = new google.maps.LatLngBounds();
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    'address': $(this).val()
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var Latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0]
                            .geometry.location.lng());
                        var marker = new google.maps.Marker({
                            position: Latlng,
                            map: map,
                            title: results[0].formatted_address,
                            draggable: true
                        });

                        $('#edit_latitude').val(results[0].geometry.location.lat());
                        $('#edit_longitude').val(results[0].geometry.location.lng());

                        latlngbounds.extend(marker.position);
                        google.maps.event.addListener(marker, "click", function(e) {
                            infoWindow.setContent(marker.title);
                            infoWindow.open(map, marker);
                        });

                        google.maps.event.addListener(marker, 'dragend', function() {
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
                        initialize();
                    }
                });
            }
            return false;
        });
    </script>
    <script>
        $(document).on('change', '#denomination', function() {
            var name = $(this).find(':selected').data('title');
            if (name == 'Other') {
                $('#new_denomination').show();
                $('#new_denomination').removeClass('d-none');
            } else {
                $('#new_denomination').hide();
            }
        });
    </script>
@endsection
