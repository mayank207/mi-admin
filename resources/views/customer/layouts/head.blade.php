<title>{{ config('app.name') }} | @yield('title')</title>
<link rel="shortcut icon" href="{{ asset('img/blue_favicon.png') }}" />
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('bootstrap/css/slick-theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('bootstrap/css/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('bootstrap/css/styles.css?v=' . time()) }}">
<!-- END Font Awesome -->
<link rel="stylesheet" href="{{ asset('assets/css/customer_style.css?v=' . time()) }}">

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{env('GOOGLE_MAPS_API_KEY')}}"></script>
<script>
    function initialize() {
		// var options = {
		// 	types: ['(cities)'],
		// };
        var options = {
            types: ['address'],
            // componentRestrictions: {
            //     country: 'us'
            // }
        };
		var input = document.getElementById('search_location');
		var searchBox = new google.maps.places.SearchBox(input,options);

        var postal_code = "";
        var lat = "";
        var long = "";
        var address = "";
        var city = "";
        var city_2 ="";
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();
            address = $('#search_location').val();

            if (places.length == 0) {
                return;
            }
            places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                lat =place.geometry.location.lat();
                long = place.geometry.location.lng();
                for (var i = 0; i < place.address_components.length; i++) {
                    for (var j = 0; j < place.address_components[i].types.length; j++) {
                        if (place.address_components[i].types[j] == "postal_code") {
                            postal_code = place.address_components[i].long_name;
                        }
                        if (place.address_components[i].types[j] == "locality") {
                            city = place.address_components[i].long_name;
                        }
                        if (place.address_components[i].types[j] == "administrative_area_level_2") {
                            city_2 = place.address_components[i].long_name;
                        }
                    }
                }
                if (city == "") {
                    city = city_2;
                }
                 /* update currect location */
                 updateCurrectLocation(address,lat,long,postal_code,city);
            });
        });
	}
	google.maps.event.addDomListener(window, 'load', initialize);

    /* Get current location */
    function showLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var latlongvalue = position.coords.latitude + ","
            + position.coords.longitude;
            codeLatLng(latitude, longitude);
    }
    function errorHandler(err) {
        if(err.code == 1) {
        $('#locationErrorModal').modal('show');
        } else if( err.code == 2) {
            alert("Error: Position is unavailable!");
        }
    }
    function getLocation(){
        if(navigator.geolocation){
            // timeout at 60000 milliseconds (60 seconds)
            var options = {timeout:60000};
            navigator.geolocation.getCurrentPosition
            (showLocation, errorHandler, options);
        } else{
            alert("Sorry, browser does not support geolocation!");
        }

    }
    function codeLatLng(latitude, longitude) {
        //find country name
        var postal_code = "";
        var lat = latitude;
        var long = longitude;
        var address = "";
        var city = "";
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(latitude, longitude);
        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    //find country name
                    address = results[5].formatted_address;
                    for (var i = 0; i < results[0].address_components.length; i++) {
                        for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                            /* Get postal code */
                            if (results[0].address_components[i].types[b] == "postal_code") {
                                postal_code = results[0].address_components[i].long_name;
                            }
                            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                            if (results[0].address_components[i].types[b] == "locality") {
                                //this is the object you are looking for
                                city = results[0].address_components[i].long_name;
                            }
                            if (results[0].address_components[i].types[b] == "administrative_area_level_2") {
                            city_2 = results[0].address_components[i].types[b];
                            }
                            if(city != "" && postal_code != ""){
                                break;
                            }
                        }
                    }
                    if (city == "") {
                         city = city_2;
                        }
                    /* Update current location */
                    updateCurrectLocation(address,lat,long,postal_code,city);
                } else {
                    alert("No results found");
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
    }

    function updateCurrectLocation(address,lat,long,postal_code,city){
        $('#input_location').val(address);
        $('#input_latitude').val(lat);
        $('input_longitude').val(long);
        var show_location_name = city;
        if(postal_code != ""){
            show_location_name = city +' - '+postal_code;
        }
        if(show_location_name == ""){
            show_location_name = address;
        }
        $('#show_current_location').html(show_location_name);
        $('.header-search-input').attr('placeholder','Find services in '+city);
        $('#header-location-input').val(city);
        $('#header-latitude-input').val(lat);
        $('#header-longitude-input').val(long);
        $("#location-dropdown").removeClass('show');
        $.ajax({
            url: "{{route('update.current.location')}}",
            type: "POST",
            dataType: 'json',
            data: {'_token': $('meta[name="csrf-token"]').attr('content'),'address': address, 'latitude':lat, 'longitude': long, 'city':city,'postal_code':postal_code },
            success: function (data) {
                return true;
            }
        });
    }
</script>

@yield('css')
