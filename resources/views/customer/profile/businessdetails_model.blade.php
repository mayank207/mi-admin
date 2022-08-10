<section class="">
    <div class="container-fluid">
        <div class="row">
                <div class="row col-12 br-5 p-3 mx-0 mt-lg-0">
                    <div class="col-md-3 col-lg-3">
                        <div class="d-flex h-100">
                        <img src="{{$business->users_details->user_profile}}" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-md-9 mt-4 mt-md-0 px-sm-0">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">
                                    {{$business->business_name}} 
                                </h3>                                
                                    <span class="font-18 bg-warning text-slate-green rounded px-2 font-mulish d-inline-block"> @if(!empty($business->church_details)){{$business->church_details->name}}@endif</span>
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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row col-12 br-5 p-3 mx-0 " id="about-us">
                    <div class="col-md-8 col-lg-8">

                        <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">About  {{$business->business_name}}</h3>
                            <p class="mt-4"> {{$business->description}} 

                            @if(!empty($business->website_url))
                                <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold mt-3 ">Website </h3>
                                <p class="mb-0"> <a target="blank" href="https://{{$business->website_url}}" class="blacklight-color">{{$business->website_url}}</a> </p>
                                @endif
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold mt-4">Address Details</h3>
                        <p class="mb-0">{{$business->address}}</p>
                            @if($business->address_2)
                            <p class="mb-0">{{$business->address_2}}</p>
                            @endif
                            <p  class="mb-0"> {{$business->city}}, {{ '- '.$business->zip_code}}, </p>{{$business->state}}   {{ ' , '.$business->country->name}}
                            <p class="mb-0">Office ({{ '+'. $business->country->phone}}) {{$business->business_mobile_number}}</p>

                           

                        @if(!empty($business->social_media_url[0]))
                            <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold mt-3"> Social Media</h3>
                            <div class="nav-item d-flex  mt-2">
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
                    
                </div>

                <div class="row br-5 p-3 mx-0" id="contact-us">
                    <div class="col-12 col-lg-12">
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
        </div>
    </div>
</section>
<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js?') }}"></script>
