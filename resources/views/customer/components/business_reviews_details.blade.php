        <div class="col-12 col-lg-4">
        <div class="row">
            <div class="col-8">
                <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish">Reviews</h3>
            </div>
            <div class="col-4 text-right">
                <a href="{{ route('business.profile',$business->users_details->user_name) }}" class="text-navy-blue font-14 font-weight-bold business_rating_filter">See All</a>
            </div>
        </div>

        <div class="cus-ratting-box mt-4">

            <div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class=" mb-1">
                        @for ($i = 0; $i < $business->average_rating; $i++)
                        <i class="fa-solid fa-star star-gold ml-1"></i>
                        @endfor

                        <span class="font-18 text-dark-gray ml-2 star-gold font-weight-bold">{{$business->average_rating}}</span>
                    </span>

                    <h3 class=" cus- text-navy-blue-dark font-24 font-weight-bold font-mulish ">{{count($reviews)}} reviews</h3>
                </div>

            </div>
            <table class="table ratting-table cus-w-80">
                <tbody>
                    <tr>
                        <td class="cus-white-space-nowrap">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link rating_hover_5 business_rating_filter" data-ratting_count="5" data-rating="5">
                                <span class="cus-label-star">5 star</span>
                            </a>
                        </td>
                        <td class="middle">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link" data-ratting_count="2">
                                <div class="progress rating_middle_hover_5 business_rating_filter" data-rating="5">
                                    <div class="progress-bar progress_color star-gold-bg" style="width: {{ $reviewObj->review_in_percentage($business->id, 5, $reviewObj->total_rating($business->id)) }}% " role="progressbar"></div>
                                </div>
                            </a>
                        </td>
                         <td class="cus-white-space-nowrap text-right">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link rating_hover_5 business_rating_filter" data-ratting_count="5" data-rating="5">
                                <span class="cus-label-star-count">({{ $reviewObj->review_count($business->id,5) }} )
                                </span>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="cus-white-space-nowrap">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link rating_hover_4 business_rating_filter"  data-rating="4">
                                <span class="cus-label-star">4 star</span>
                            </a>
                        </td>
                        <td class="middle">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link"  >
                                <div class="progress rating_middle_hover_4 business_rating_filter"  data-rating="4">
                                    <div class="progress-bar progress_color star-gold-bg" style="width:{{ $reviewObj->review_in_percentage($business->id, 4, $reviewObj->total_rating($business->id)) }}% " role="progressbar"></div>
                                </div>
                            </a>
                        </td>
                        <td class="cus-white-space-nowrap text-right">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link rating_hover_4 business_rating_filter"   data-rating="4">
                                <span class="cus-label-star-count">({{ $reviewObj->review_count($business->id,4) }} )</span>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="cus-white-space-nowrap">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link rating_hover_3 business_rating_filter"  data-rating="3">
                                <span class="cus-label-star">3 star</span>
                            </a>
                        </td>
                        <td class="middle">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link business_rating_filter"  data-rating="3">
                                <div class="progress rating_middle_hover_3">
                                    <div class="progress-bar progress_color star-gold-bg" style="width:{{ $reviewObj->review_in_percentage($business->id, 3, $reviewObj->total_rating($business->id)) }}% " role="progressbar"></div>
                                </div>
                            </a>
                        </td>
                        <td class="cus-white-space-nowrap text-right">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link rating_hover_3 business_rating_filter"  data-rating="3">
                                <span class="cus-label-star-count">({{ $reviewObj->review_count($business->id,3) }} )</span>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="cus-white-space-nowrap">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link rating_hover_2 business_rating_filter"  data-rating="2" >
                                <span class="cus-label-star">2 star</span>
                            </a>
                        </td>
                        <td class="middle">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link business_rating_filter"  data-rating="2">
                                <div class="progress rating_middle_hover_2">
                                    <div class="progress-bar progress_color star-gold-bg" style="width:{{ $reviewObj->review_in_percentage($business->id, 2, $reviewObj->total_rating($business->id)) }}% " role="progressbar"></div>
                                </div>
                            </a>
                        </td>
                        <td class="cus-white-space-nowrap text-right">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link rating_hover_2 business_rating_filter"  data-rating="2">
                                <span class="cus-label-star-count">({{ $reviewObj->review_count($business->id,2) }}  )</span>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="cus-white-space-nowrap">
                            <a href="javascript:void(0)" class=" font-weight-bold get_review_by_count_link rating_hover_1 cus-blue-color business_rating_filter"  data-rating="1">
                                <span class="cus-label-star">1 star</span>
                            </a>
                        </td>
                        <td class="middle">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link business_rating_filter"  data-rating="1">
                                <div class="progress rating_middle_hover_1">
                                    <div class="progress-bar progress_color star-gold-bg" style="width: {{ $reviewObj->review_in_percentage($business->id, 1, $reviewObj->total_rating($business->id)) }}% " role="progressbar"></div>
                                </div>
                            </a>
                        </td>
                        <td class="cus-white-space-nowrap text-right">
                            <a href="javascript:void(0)" class="cus-blue-color font-weight-bold get_review_by_count_link rating_hover_1 business_rating_filter"  data-rating="1">
                                <span class="cus-label-star-count cus-blue-color">({{ $reviewObj->review_count($business->id,1) }} )</span>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12 col-lg-8 mt-4"  id="load_reviews_content">
        @include('customer.components.reviews_description')
    </div>


