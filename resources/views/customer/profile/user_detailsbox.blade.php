 <div class="row border-light-gray br-5 p-3 mx-0 my-4 mt-lg-0">
                    <div class="col-12 col-md-auto pl-md-0 pr-md-5">
                        <div class="avatar-edit">
                            <label for="imageUpload">
                                <i class="far fa-edit cursor-pointer" data-toggle="modal" data-target="#spam-message"></i>
                            </label>
                        </div>
                        <div class="avatar-preview">
                            <div id="profile_image">
                                <img src="{{ $profile->user_profile }}" class="img-fluid w-136px h-136px profile_image"
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
