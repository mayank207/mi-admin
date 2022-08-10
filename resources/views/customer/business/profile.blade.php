@extends('customer.layouts.app')
@section('title','Business Profile')

@section('content')

<section class="bg-breadcrumb px-lg-4 px-xl-5 blacklight-color">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-lg-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"
                                class="font-14 font-weight-600 text-medium-gray">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('business.listing')}}"
                                class="font-14 font-weight-600 text-medium-gray">Business Listing</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#"
                                class="font-14 font-weight-600 text-medium-gray">Business Profile</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12 col-lg-8">
                <div class="d-flex flex-column flex-sm-row align-items-sm-center">
                    <h1 class="text-navy-blue-dark font-40 font-weight-bold font-mulish-bold">{{$business->business_name}}</h1>
                    {{-- <div class="ml-sm-4 mt-2">
                        <img src="{{asset('img/Star-fill.png')}}" class="img-fluid mb-1" alt="">
                        <span
                            class="font-16 text-navy-blue-dark font-weight-bold ml-2 font-mulish">4.4
                            (23
                            reviews)</span>
                    </div> --}}
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="d-flex align-items-center justify-content-sm-end mt-3 mt-sm-0">

                    <span class="px-4 py-2 bg-slate-green text-white font-12 font-weight-bold br-5 font-mulish"><i class="fa-solid fa-bolt-lightning text-white pr-2"></i> Kingdom Verified</span>
                    @if(Auth::check())
                        @if($business->favouriteBusiness)
                            <a href="Javascript:;" id="favourite"  class="btn-following ml-4 favourite rounded-circle d-flex     align-items-center justify-content-center" data-title="business" data-href="{{route('business.favourite')}}" data-id ="{{getEncrypted($business->id)}}" data-is_favourite='1'>
                            <i class="fa-regular fa-heart"></i>
                            </a>
                        @else
                            <a href="Javascript:;" id="favourite"  class="btn-follow ml-4 favourite rounded-circle d-flex align-items-center justify-content-center" data-title="business" data-href="{{route('business.favourite')}}" data-id ="{{getEncrypted($business->id)}}" data-is_favourite='0'>
                                 <i class="fa-regular fa-heart"></i>
                             </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="px-lg-4 px-xl-5 blacklight-color">
    <div class="container-fluid mt-5 pb-5">
        <div class="row mt-3">

            <div class="col-12 col-lg-12">
                <div class="row border-light-gray br-5 p-3 mx-0 mt-4 mt-lg-0">
                    <div class="col-12 col-md-3">
                        <div class="d-flex h-100">
                            <img src="{{$business->users_details->user_profile}}" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-9 mt-4 mt-md-0 px-sm-0">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">
                                    {{$business->business_name}}
                                </h3>
                                {{-- <span class="text-dark-gray font-18">@if(!@empty($business->category)) {{$business->category->category_name}} @endif</span> --}}
                                @if(Auth::check())
                                    <span class="font-18 bg-warning text-slate-green rounded px-2 font-mulish d-inline-block"> @if(!empty($business->church_details)){{$business->church_details->name}}@endif</span>
                                @endif
                                <div class="mt-2">
                                    @foreach ($business->toFiveServices() as $item)
                                        <span class="font-14 font-weight-normal badge badge-secondary">{{$item->title}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-flex flex-column flex-sm-row align-items-sm-center">
                                    <div class="bg-light-gray4 br-10 px-3 py-2">
                                        <img src="{{asset('img/location.png')}}" class="img-fluid" alt="">
                                        <span class="text-navy-blue-dark font-weight-bold pl-2 font-mulish">{{$business->country->name}}
                                            -
                                            {{$business->zip_code}}</span>
                                    </div>

                                     <div class="ml-sm-4 mt-2">
                                        <img src="{{asset('img/Star-fill.png')}}" class="img-fluid mb-1" alt="">
                                        <span class="font-16 text-navy-blue-dark font-weight-bold ml-2 font-mulish">{{$business->average_rating}}
                                            ({{$business->total_review}} reviews)</span>
                                    </div>
                                </div>

                                <div class="mt-4 pt-1">
                                    <p class="font-18 text-dark-gray">{{$business->sort_description}} </p>
                                </div>
                                @include('customer.components.business_contact_now')
                                @include('customer.components.business_ask_quote')
                                <div class="d-flex align-items-center flex-wrap pt-1">
                                    @php
                                        $registration_process_completed = true;
                                        if(Auth::check()){
                                            $error_message = "Please complete your registration process first.";
                                            if( (Auth::user()->role_id == 3 && empty(Auth::user()->email_verified_at) || empty(Auth::user()->business_details))){
                                                $registration_process_completed = false;
                                            }
                                        }else{
                                            $registration_process_completed = false;
                                            $error_message = "Log in or create a free account to";
                                        }
                                    @endphp
                                    @if($registration_process_completed)
                                        <a href='javascript:;' class="btn contact_now text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish mt-3 mr-4" id={{getEncrypted($business->users_details->id)}}>Contact now</a>

                                        <a href='javascript:;' class="font-16 ask_quote font-weight-bold mr-3 text-navy-blue mr-4 mt-3 font-mulish" id={{getEncrypted($business->users_details->id)}}>Ask a quote</a>
                                        {{-- Review section --}}
                                        @if(Auth::check() && Auth::user()->id != $business->users_details->id)
                                        @if (!empty($business_review))
                                            @if(!in_array($business->id, $business_review))
                                                <a class="btn give_review text-white bg-navy-blue font-16 mt-3 font-mulish" data-id={{getEncrypted($business->id)}} href="Javascript:;">Review</a>
                                            @endif
                                        @else
                                            <a class="btn give_review text-white bg-navy-blue font-16 mt-3 font-mulish" data-id={{getEncrypted($business->id)}} href="Javascript:;">Review </a>
                                        @endif
                                        @endif
                                    @else
                                        <a class="btn contact_popover readonly text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish mt-3 mr-4"  data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{$error_message}} {{(!Auth::check())? "contact" : '' }}">Contact now</a>

                                        <a class="font-16 contact_popover readonly font-weight-bold mr-3 text-navy-blue mr-4 mt-3 font-mulish"  data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{$error_message}} {{(!Auth::check())? "ask quote" : '' }}">Ask a quote</a>

                                        <a class="btn text-white contact_popover bg-navy-blue font-16 mt-3 font-mulish" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{$error_message}} {{(!Auth::check())? "give a review" : '' }}">Review</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border-light-gray br-5 p-3 mx-0 mt-4 d-none">
                    <div class="col-12">
                        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-evenly">
                            <div class="cus-menunav ">
                                <a href="javascript:;" class="btm-brder-link w-100 text-navy-blue-dark font-18 font-weight-bold font-mulish-bold scroll-offset" data-section="about-us">About</a>
                            </div>
                            <div class="cus-menunav">
                                <a href="javascript:;" class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold btm-brder-link w-100 scroll-offset" data-section="contact-us"> Contact</a>
                            </div>
                            <div class="cus-menunav">
                                <a href="javascript:;" class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold btm-brder-link w-100 scroll-offset" data-section="reviews"> Reviews </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row border-light-gray br-5 p-3 mx-0 mt-4" id="about-us">
                    <div class="col-12 col-lg-8">

                        <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">About  {{$business->business_name}}</h3>
                        <p class="mt-4"> {{$business->description}}
                        </p>
                        @if(!empty($business->social_media_url[0]))
                            <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold mt-5"> {{$business->business_name}} Social Media</h3>
                            <div class="nav-item d-flex  mt-4">
                                @if($business->social_media_url[0]->facebook_url)
                                <a class="nav-link pl-0" href="https://www.facebook.com/{{$business->social_media_url[0]->facebook_url}}" target="_blank"><img src="{{asset('img/Vector-1.png')}}" class="img-fluid" alt="Facebook"></a>
                                @endif

                                @if($business->social_media_url[0]->twitter_url)
                                <a class="nav-link" href="https://twitter.com/{{$business->social_media_url[0]->twitter_url}}" target="_blank"><img src="{{asset('img/Vector.png')}}" class="img-fluid" alt="Twitter"></a>
                                @endif

                                @if($business->social_media_url[0]->instagram_url)
                                <a class="nav-link" href="https://www.instagram.com/{{$business->social_media_url[0]->instagram_url}}" target="_blank"><img src="{{asset('img/Group-1.png')}}" class="img-fluid" alt="Instagram"></a>
                                @endif

                                @if($business->social_media_url[0]->linked_in_url)
                                <a class="nav-link" href="https://www.linkedin.com/{{$business->social_media_url[0]->linked_in_url}}" target="_blank"><img src="{{asset('img/Vector-2.png')}}" class="img-fluid" alt="Linked In"></a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="col-12 col-lg-4">
                        @if(!$business->business_media->isEmpty())
                        <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">Photos and videos</h3>
                        <div class="d-flex flex-wrap ">
                            @foreach ($business->business_media as $media)
                                <div class="col-auto pl-2 pr-2 mt-3">
                                    <a target="_blank" class="d-block card-rounded overlay h-lg-100" data-fslightbox="lightbox-projects" href="{{$media->media_url}}">
                                        <img src="{{$media->thumbnail}}" width="100px" height="75px">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @if(Auth::check())
                    @include('customer.components.business_contact_details')
                @endif
                <div class="row border-light-gray br-5 py-3 p-sm-3 mx-0 mt-4" >
                @include('customer.components.business_reviews_details')
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js?') }}"></script>

<script src="{{ asset('assets/js/jquery.googlemap.js?v='.time()) }}"></script>
<script>
var lat ='{{$business->latitude}}';
var long ='{{$business->longitude}}';
    $(function() {
        $("#business_map").googleMap({
            zoom: 17,
            coords: [lat, long],
            type: "ROADMAP",
        });
        if(lat != "" && long != ""){
            $("#business_map").addMarker({
                zoom: 10,
                coords: [lat, long],
                type: "ROADMAP",
            });
        }
    });
</script>
<script>
    $(document).on('click','.business_rating_filter',function(e){
    e.preventDefault();
    var rating = $(this).data('rating');
    var form_url =$('.business_rating_filter').attr('href');
    $(".progress_color").removeClass('bg-blacklight-color');
    $(".progress_color").addClass('star-gold-bg');
    $(this).find('.progress_color').removeClass('star-gold-bg');
    $(this).find('.progress_color').addClass('bg-blacklight-color');
    $.ajax({
        type: "get",
        url: form_url,
        dataType: 'json',
        cache: false,
        data: { rating: rating },

        success: function(data) {
            if(data.status == 200){
                $('#load_reviews_content').html(data.content);
            }else{
                toastr.error(data.message);
            }
        },
        error: function(){
            toastr.error('Something went wrong');
        }
    });
});
</script>
<script>
    $('.contact_popover').popover();
  </script>
@endsection
