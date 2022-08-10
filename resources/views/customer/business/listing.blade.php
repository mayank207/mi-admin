@extends('customer.layouts.app')
@section('title','Business Listing')
@section('content')

@php
    $get_current_location = Cookie::get("current_location");
    if(!is_null($get_current_location)){
        $get_current_location = json_decode($get_current_location);
    }
    $show_record_found = 'd-none';
    $search_latitude =  isset($get_current_location->latitude)? $get_current_location->latitude : '';
    $search_longitude =  isset($get_current_location->longitude)? $get_current_location->longitude : '';
    $search_radius = "0mile - 50mile";
    $search_keyword = "";
    $search_location = $search_sorting =  isset($get_current_location->address)? $get_current_location->address : '';
    $page_number = 0;
    $search_min_radius = 0;
    $search_max_radius = 50;
    $search_rating = [];
    $business_service = null;
    if(isset($_GET) && count($_GET)){
        $show_record_found = '';
        if(isset($_GET['search_keyword']) && $_GET['search_keyword'] != ""){
            $search_keyword = $_GET['search_keyword'];
        }
        if(isset($_GET['location']) && $_GET['location'] != ""){
            $search_location = $_GET['location'];
        }
        if(isset($_GET['latitude']) && $_GET['latitude'] != ""){
            $search_latitude = $_GET['latitude'];
        }
        if(isset($_GET['longitude']) && $_GET['longitude'] != ""){
            $search_longitude = $_GET['longitude'];
        }
        if(isset($_GET['location_radius']) && $_GET['location_radius'] != ""){
            $search_radius = $_GET['location_radius'];
            $radius = explode('-',$search_radius);
            $search_min_radius = isset($radius[0])? (float)$radius[0] : 0;
            $search_max_radius = isset($radius[1])? (float)$radius[1] : 50;
        }
        if(isset($_GET['page']) && $_GET['page'] != ""){
            $page_number = $_GET['page'];
        }
        if(isset($_GET['rating']) && $_GET['rating'] != ""){
            $search_rating = $_GET['rating'];
        }
        if(isset($_GET['category']) && $_GET['category'] != ""){
            $category = $_GET['category'];
        }
        if(isset($_GET['sub_category']) && $_GET['sub_category'] != ""){
            $sub_category = $_GET['sub_category'];
        }
        if(isset($_GET['business_service']) && $_GET['business_service'] != ""){
            $business_service = $_GET['business_service'];
        }
    }
@endphp

<section class="bg-breadcrumb px-lg-4 px-xl-5">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-lg-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}" class="font-14 font-weight-bold text-medium-gray">Home</a></li>
                        <li class="breadcrumb-item"><a class="font-14 font-weight-bold text-medium-gray">Business Listing</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="text-navy-blue-dark font-40 font-weight-bold font-mulish-bold"> <span id="show-search">{{($search_keyword)? ucfirst($search_keyword) : 'Business Listing' }} </span> <span id="show-search-location" class="{{($search_location == "")? 'd-none' : ''}}">in {{$search_location}}</span></span> </h1>
            </div>
        </div>
    </div>
</section>

<section class="px-lg-4 px-xl-5">
    <div class="container-fluid mt-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-8">
                <h3 class="text-navy-blue-dark font-24 font-weight-bold mb-0 font-mulish show-total-listing {{$show_record_found}}">We found <span class="text-navy-blue total-listing">{{$all_business->total()}}</span> {{ucfirst($search_keyword)}} near to your local </h3>
            </div>
            <div class="col-12 col-md-4 text-center text-md-right mt-3 mt-md-0">
                <div class="dropdown">
                    <button class="btn sortby-style dropdown-toggle p-3 br-5 border-light-gray shadow-none"
                        type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img src="{{asset('img/sortby.png')}}" class="img-fluid" alt="">
                        <span class="text-navy-blue-dark font-weight-bold font-18 pl-2 font-mulish">Sort by</span>
                        <span class="text-medium-gray font-weight-bold font-16 px-4 show-sorting-title">Top Rated</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item cust-sorting-item" type="button" data-value="to-rated" data-title="Top Rated">Top Rated</button>
                        <button class="dropdown-item cust-sorting-item" type="button" data-value="recently-uploaded" data-title="Recently Uploaded">Recently Uploaded</button>
                        <button class="dropdown-item cust-sorting-item" type="button" data-value="most-popular" data-title="Most Popular">Most Popular</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 pb-5">
            <div class="col-12 col-lg-4 pr-lg-0 pr-xl-3">
                {!! Form::open(['route'=>'business.listing','id'=>'business-filter','method'=>'GET']) !!}
                <div class="row border-light-gray br-5 py-3 p-xl-3 m-0 mt-4">
                    <div class="col-8">
                        <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">Find a professional
                        </h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{route('business.listing')}}" class="text-navy-blue font-14 font-weight-bold">See All</a>
                    </div>
                    <div class="col-12 mt-2">
                        <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" id="search_keyword" type="text" name="search_keyword" value="{{$search_keyword}}" placeholder="Enter a keyword">
                    </div>
                    {{-- <div class="col-12 mt-3 custom-select2">
                        <select data-control="select2" name="category" id="category" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 category">
                            <option value="">Select Category </option>
                            @if(!is_null($categories))
                                @foreach ($categories as $type)
                                    <option value="{{$type->id}}">{{$type->title}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div> --}}
                    <div class="col-12 mt-3 custom-select2">
                        <select data-control="select2" name="sub_category[]" id="sub_category" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 sub_category cursor-pointer" multiple>
                            <option value="">Select Services </option>
                            @foreach ($sub_Category as $service)
                                <option @if($business_service == $service->slug) {{'selected'}} @endif value="{{$service->slug}}">{{$service->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mt-3 custom-select2">
                        <select data-control="select2" name="denomination" id="denomination" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 denomination">
                            <option value="">Select Denomination </option>
                            @if(!is_null($denomination))
                                @foreach ($denomination as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-12 mt-3 custom-select2">
                        <select data-control="select2" name="churches" id="js-data-example-ajax" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-">
                            <option @if(is_null($selected_church)) selected="selected" @endif value="">Select Church </option>
                            @if(!is_null($selected_church))
                                <option selected="selected" value="{{$selected_church->secret}}">{{$selected_church->name}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-12 mt-3">
                        <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="text" id="input_location" name="location" placeholder="Location" value="{{$search_location}}">
                        <input type="hidden" id="input_latitude" name="latitude" value="{{$search_latitude}}">
                        <input type="hidden" id="input_longitude" name="longitude" value="{{$search_longitude}}">
                    </div>
                    {{-- <div class="col-12 mt-3">
                        <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="text" name="name" placeholder="All Types">
                    </div> --}}
                    {{-- <div class="col-12 mt-3">
                        <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" type="text" name="name" placeholder="All Status">
                    </div> --}}

                    {{-- <div class="col-12 mt-5">
                        <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">Price range</h3>
                        <div class="price-range-slider">
                            <div id="price-range" class="range-bar"></div>
                            <p class="range-value">
                                <input type="text" id="price_range" name="price" class="text-center shadow-none border-0" readonly>
                            </p>
                        </div>
                    </div> --}}

                    <div class="col-12 mt-4">
                        <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">Area range</h3>
                        <div class="price-range-slider">
                            <div id="location-range" class="range-bar"></div>
                            <p class="range-value">
                                <input type="text" name="location_radius" id="location_range" value="{{$search_radius}}" class="text-center shadow-none border-0" readonly>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">Rating</h3>
                        <div class="mt-4">
                            <div class="d-flex align-items-center">
                                <div class="custom-control custom-checkbox rating">
                                    <input type="checkbox" name="rating[5]" value="5" class="custom-control-input" id="customCheck1" @if(in_array(5,$search_rating)) checked @endif>
                                    <label class="custom-control-label" for="customCheck1"></label>
                                </div>
                                <span class="font-18 text-dark-gray ml-3 ml-sm-4">5.00</span>
                                <span class="ml-3 ml-sm-4 mb-1">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid" alt="">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                                </span>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <div class="custom-control custom-checkbox rating">
                                    <input type="checkbox" name="rating[4]" value="4" class="custom-control-input" id="customCheck2" @if(in_array(4,$search_rating)) checked @endif>
                                    <label class="custom-control-label" for="customCheck2"></label>
                                </div>
                                <span class="font-18 text-dark-gray ml-3 ml-sm-4">4.00</span>
                                <span class="ml-3 ml-sm-4 mb-1">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid" alt="">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                                </span>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <div class="custom-control custom-checkbox rating">
                                    <input type="checkbox" name="rating[3]" value="3" class="custom-control-input" id="customCheck3" @if(in_array(3,$search_rating)) checked @endif>
                                    <label class="custom-control-label" for="customCheck3"></label>
                                </div>
                                <span class="font-18 text-dark-gray ml-3 ml-sm-4">3.00</span>
                                <span class="ml-3 ml-sm-4 mb-1">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid" alt="">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                                </span>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <div class="custom-control custom-checkbox rating">
                                    <input type="checkbox" name="rating[2]" value="2" class="custom-control-input" id="customCheck4" @if(in_array(2,$search_rating)) checked @endif>
                                    <label class="custom-control-label" for="customCheck4"></label>
                                </div>
                                <span class="font-18 text-dark-gray ml-3 ml-sm-4">2.00</span>
                                <span class="ml-3 ml-sm-4 mb-1">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid" alt="">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                                </span>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <div class="custom-control custom-checkbox rating">
                                    <input type="checkbox" name="rating[1]" value="1" class="custom-control-input" id="customCheck5" @if(in_array(1,$search_rating)) checked @endif>
                                    <label class="custom-control-label" for="customCheck5"></label>
                                </div>
                                <span class="font-18 text-dark-gray ml-3 ml-sm-4">1.00</span>
                                <span class="ml-3 ml-sm-4 mb-1">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid" alt="">
                                    <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                                    <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-5 text-center">
                        <input type="hidden" name="page" id="search-page" value="{{$page_number}}">
                        <input type="hidden" name="sorting" id="search-sorting" value="{{$search_sorting}}">
                        <button class="btn w-75 py-3 font-18 font-weight-bold bg-yellow text-slate-green rounded-pill font-mulish" type="submit">Filter results</button>
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="row border-light-gray br-5 p-3 m-0 mt-4">
                    <div class="col-6">
                        <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">Featured professionals
                        </h3>
                    </div>
                    <div class="col-6 text-right d-flex justify-content-end">
                        <span class="cus-arrow-left">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </span>
                        <span class="cus-arrow-right ml-3">
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </span>
                    </div>
                    <div class="col-12 px-0">
                        <div class="featured-slider mt-3">
                            @if ($top_business)
                                @foreach ($top_business as $business)
                                    <div>
                                        <div class="text-center">
                                            <img src="{{$business->users_details->user_profile}}" class="img-fluid mx-auto" alt="">
                                        </div>
                                        <div class="col-12 mt-3">
                                            <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">{{$business->business_name}}</h3>
                                            <div class="d-flex align-items-center">
                                                <img src="{{asset('img/Star-fill.png')}}" class="img-fluid " alt="">
                                                <span class="font-18 text-dark-gray ml-3 font-weight-bold">{{$business->average_rating}} </span>
                                            </div>
                                            <div class="bg-light-gray4 br-10 px-3 py-2 mt-3">
                                                <img src="{{asset('img/location.png')}}" class="img-fluid d-inline
                                                d-inline" alt="">
                                                <span class="text-navy-blue-dark pl-2 font-mulish font-weight-bold">{{$business->city}} - {{$business->zip_code}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mt-5 text-center">
                        <a href="#" class="btn w-75 py-3 font-18 font-weight-bold bg-yellow text-slate-green rounded-pill font-mulish">View
                            more</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 load-business-list">
                @include('customer.components.business_listing')
                @include('customer.components.business_contact_now')
                @include('customer.components.business_ask_quote')

            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    function initialize() {
		var options = {
            types: ['address'],
            componentRestrictions: {
                country: 'us'
            }
        };
		var input = document.getElementById('input_location');
		var searchBox = new google.maps.places.SearchBox(input,options);
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                $('#input_latitude').val(place.geometry.location.lat());
                $('#input_longitude').val(place.geometry.location.lng());
            });
        });
    }
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script>
    /* Location radius ranger */
    $(function () {
        $("#location_range").val("0mile - 50mile");
        $("#location-range").slider({
            range: true,
            min: 0,
            max: 50,
            values: ["{{$search_min_radius}}", {{$search_max_radius}}],
            slide: function (event, ui) {
                $("#location_range").val(ui.values[0] + "mile - " + ui.values[1]+'mile');
            }
        });
        $("#location_range").val($("#location-range").slider("values", 0) + "mile - " + $("#location-range").slider("values", 1)+'mile');
    });
    /* Churches Filter */

    $("#js-data-example-ajax").select2({
        ajax: {
            url: "{{route('get.church')}}",
            type: "get",
            dataType: 'json',
            delay: 250,
            cache: true,
            data: function (params) {
                return {
                    search_keyword: params.term ,
                    latitude:lat,
                    longitude:long,
                    denomination:denomination,
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
        }
    });
    var lat;
    var long;
    var denomination;
    $(document).on('change','#input_location',function(){
          lat = $('#input_latitude').val();
          long = $('#input_longitude').val();
    });
    $(document).on('change','#denomination',function(){
          denomination = $('#denomination').val();
          $('#js-data-example-ajax').val(null).trigger('change');
    });

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


</script>
<script>
    $("#denomination").select2();
    $(".contact_popover").hover('hide');
</script>
@endsection
