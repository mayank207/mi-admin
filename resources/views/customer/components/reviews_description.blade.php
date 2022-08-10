@if ($reviews)
            @foreach ($reviews as $review)
            <div class="row border-bottom-1 mb-4 ">
                <div class="col-12">
                    <div class="row align-items-center mb-4">
                        <div class="col-auto">
                            @if($review->users_details->profile_photo)
                                <img src="{{asset( ($review->users_details) ? $review->users_details->profile_photo : '')}}" class="img-fluid cus-w60 border-raidus-50" alt="">
                            @else
                                <img src="{{asset('img/user-profile.png')}}" class="img-fluid cus-w60 border-raidus-50" alt="">
                            @endif
                        </div>
                        <div class="col-auto">
                            <div class="d-flex flex-column flex-sm-row align-items-sm-center ">
                                <h4 class="text-navy-blue-dark font-18 font-weight-bold font-mulish mb-0">{{$review->users_details->name}}</h4>
                                <div class="ml-sm-4">
                                    <img src="{{asset('img/Star-fill.png')}}" class="img-fluid mb-1" alt="">
                                    <span class="font-16 text-navy-blue-dark font-weight-bold ml-2 font-mulish">{{$review->rating}}</span>
                                </div>
                            </div>
                            <p class="mb-0"> {{$review->created_at->format('M Y')}}</p>
                        </div>
                    </div>
                    <p>
                        {{$review->comment}}
                    </p>
                </div>
            </div>
            @endforeach

        @endif
