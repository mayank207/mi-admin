<div class="row border-light-gray rounded m-0 mt-4 p-3">
<div class="col-12 col-md-3 mt-md-0 px-sm-0">
        <div>
            <a target="_blank" href="{{ route('business.profile',$business->users_details->user_name) }}">
                <img src="{{$business->users_details->user_profile}}" width="100%" class="img-fluid" alt="Business Image">
        </div>
    </div>
    <div class="col-12 col-md-9 mt-4 mt-md-0">
        <div class="row">
            <div class="col-12 col-sm-7">
                <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish">
                    <a target="_blank" href="{{ route('business.profile',$business->users_details->user_name) }}">{{$business->business_name}}</a>
                </h3>
                <div class="d-flex align-itmes-center flex-wrap">
                    {{-- <span class="text-dark-gray font-18"> @if(!empty($business->category)){{$business->category->category_name}}@endif</span> --}}
                    @if(!empty($business->church_details))
                    {{-- <span class="mx-2">|</span> --}}
                    <span class="font-18 bg-warning text-slate-green rounded px-2 font-mulish d-inline-block"> {{$business->church_details->name}}
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-5 mt-3 mt-sm-0 pr-lg-0">
                <div class="d-flex align-items-center justify-content-start justify-content-sm-end px-3 px-sm-0">
                    <span class="p-2 bg-slate-green text-white font-12 row font-weight-bold br-5 font-mulish mr-3"><i class="fa-solid fa-bolt-lightning text-white p-1"></i> Kingdom Verified</span>
                    @if(Auth::check())
                        @if($business->favouriteBusiness)
                            <a href="Javascript:;" id="favourite"  class="btn-following favourite rounded-circle d-flex align-items-center justify-content-center" data-title="business" data-href="{{route('business.favourite')}}" data-id ="{{getEncrypted($business->id)}}" data-is_favourite='1'>
                                    <i class="fa-regular fa-heart"></i>
                                    </a>
                        @else
                            <a href="Javascript:;" id="favourite"  class="btn-follow favourite rounded-circle d-flex align-items-center justify-content-center" data-title="business" data-href="{{route('business.favourite')}}" data-id ="{{getEncrypted($business->id)}}" data-is_favourite='0'>
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="col-12 mt-3 mt-sm-0">
                <div class="d-flex flex-column flex-sm-row flex-lg-column flex-xl-row align-items-sm-center align-items-lg-start align-items-xl-center mt-3">
                    <div class="bg-light-gray4 br-10 px-3 py-2">
                        <img src="{{asset('img/location.png')}}" class="img-fluid" alt="">
                        <span class="text-navy-blue-dark font-weight-bold pl-2 font-mulish"> {{$business->city}} - {{$business->zip_code}}
                        </span>
                    </div>
                    <div class="ml-sm-4 ml-lg-0 ml-xl-4 mt-2">
                        <img src="{{asset('img/Star-fill.png')}}" class="img-fluid mb-1" alt="">
                        <span class="font-16 text-navy-blue-dark font-weight-bold ml-2 font-mulish">{{$business->average_rating}}
                            ({{$business->total_review}} reviews)</span>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="font-18 text-dark-gray">{{$business->sort_description}} </p>
                </div>

                <div class="d-flex align-items-center flex-wrap">
                    @php
                        $registration_process_completed = true;
                        if(Auth::check()){
                            $error_message = "Please complete your registration process first.";
                            if( (empty(Auth::user()->email_verified_at))){
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
                            @if ($business->businessReviews)
                                @if(!$business->businessReviews)
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


