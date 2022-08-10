@extends('backend.layouts.base')

@section('title')
    {!! setBreadCrumb('Church', route('church.index')) !!}
    {!! setBreadCrumb('Edit') !!}
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-xxl">
            <div class="row g-xl-12">
                <!--begin::edit church column-->
                <div class="col-xl-12">
                    <!--begin::edit church form-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                             <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <h3 class="card-title align-items-start flex-column mb-5">
                                        <span class="fw-bolder text-dark">Edit Church</span>
                                    </h3>
                                    @include('backend.church.edit_church_details_form')
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::edit church form-->
                </div>
                <!--end::edit church column-->
            </div>
        </div>
    </div>
@endsection
@section('external-scripts')
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script>
        var id = "{{ $church->id }}";
        $("#edit_church_form").validate({
            rules: {
                church_name: {
                    required: true,
                    noSpace:true,
                },
                church_email: {
                    required: true,
                    checkemail: true,
                    remote: {
							type: 'post',
							url: "{{route('backend.church.isChurchEmailExists')}}",
							data: {'_token': $("input[name=_token]").val(),id:id},
							dataFilter: function (data)
							{
                                console.log(data);
								var json = JSON.parse(data);
								if (json.valid === true) {
                                    return '"true"';
								} else {
                                    return "\"" + json.message + "\"";
								}
							}
                        }
                },
                address:{
                    validateAddress:true,
                    noSpace:true,
                    required:true,
                },
                city:{
                    required:true,
                },
                name_of_leader:{
                    required:true,
                    noSpace:true,
                },
                email_of_leader:{
                    required:true,
                    checkemail:true,
                    remote: {
							type: 'post',
							url: "{{route('backend.user.email_exists')}}",
							data: {'_token': $("input[name=_token]").val(),id:id},
							dataFilter: function (data)
							{
                                console.log(data);
								var json = JSON.parse(data);
								if (json.valid === true) {
                                    return '"true"';
								} else {
                                    return "\"" + json.message + "\"";
								}
							}
                        }
                },
                state:{
                    noSpace:true,
                    required:true,
                },
                country_code:{
                    required:true,
                },
                zip_code:{
                    required:true,
                    minlength:5,
                },
                new_denomination:{
                    required :true,
                }
            },
            messages: {
                church_name: {
                    required:'Please enter church name',
                },
                church_email:{
                    required:"Please enter email",
                    remote:"Email is already exists",
                    checkemail:"Please enter valid email",
                },
                denomination:{
                    required:"Please select denomination",
                },
                address:{
                    required:"Please enter your address",
                },
                city:{
                    required:"Please enter your city",
                },
                name_of_leader:{
                    required:"Please enter name of pastor/leader",
                },
                email_of_leader:{
                    required:"Please enter email of pastor/leader",
                    checkemail: "Please enter valid email",
                    remote:"Pastor is already exists",
                },
                state:{
                    required:"Please enter your state",
                },
                zip_code:{
                    required:"Please enter your zip code",
                    minlength:"Enter minimum 5 digits"
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
            success: function(label, element) {
                label.parent().removeClass('has-danger');
            },
        });
        $('#country_code').select2({
            placeholder: "Select Country Code",
        });
    </script>
  <script>
    var address = "{{($church->church_details)? $church->church_details->address : 'New York'}}";
    const show_latitude = "{{($church->church_details)? $church->church_details->latitude : '40.7127753'}}";
    const show_longitude = "{{($church->church_details)? $church->church_details->longitude : '-74.0059728'}}";
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
            $('#show_lat').html(marker.getPosition().lat());
            $('#show_long').html(marker.getPosition().lng());
        })
    }
    
    $('.address').blur(function(){
    /* On change address */
    // $('#edit_church_location,#state, #country').blur(function location() {
        if($('#edit_church_location').val() != "" && $('#city').val() != "" && $('#state').val() != "" && $('#zip_code').val() !=""){
            var address = $('#edit_church_location').val() + ','+$('#address_2').val() + ',' + $('#city').val()  +','+ $('#zip_code').val() + ',' + $('#state').val() +','+ $('option:selected','#country').data('country') ;
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
