<section class="m-xl-4">
    @if($business_details != null)
        @if ($business_details->is_approved == 0 && $business_details->business_name != "")
            <h5 class="card-title align-items-start flex-column">
                <b>Note:<span class="fw-bolder text-info"> Your submitted changes are pending to approval</span></b>
            </h5>
        @elseif($business_details->is_approved == 2)
            <h5 class="card-title align-items-start flex-column">
                <b>Note:<span class="fw-bolder text-info"> Your submitted changes are <span class="text-danger">rejected</span> by admin
                </span></b>
                <div class="font-16">
                    @if($business_details->reject_reason != "") Reason: <span class="font-14 text-danger">{{$business_details->reject_reason}}</span> @endif
                </div>
            </h5>
        @endif
    @endif
    <form class="form" url="{{ route('profile.update_business_details') }}"
        id="edit_business_details_form" method="post">
        @csrf
        <div class="row m-0">
            <div class="col-12 col-md-6">
                <b>Business Details :</b>
                <div class="card-body px-0">
                    <!-- Name -->
                    <div class="fv-row mb-4 form-group">
                        <label class=" fs-6 fw-bold mb-2">Business Name</label><span class="text-danger">*</span>
                        <input type="text" class="form-control border-1 rounded-0 h-auto "
                            value="{{ $business_details->business_name }}" name="business_name"
                            placeholder="Business Name" id="business_name" />
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <!-- end-Name -->

                    <!-- email -->
                    <div class="fv-row mb-4 form-group">
                        <label class=" fs-6 fw-bold mb-2">Business Email</label><span class="text-danger">*</span>
                        <input type="text" class="form-control border-1 rounded-0 h-auto "
                            value="{{ $business_details->business_email }}" name="business_email"
                            placeholder="Business Email" id="business_email" />

                    </div>
                    <!-- end-email -->

                    <!-- Mobile -->
                    <div class="fv-row mb-4 form-group">
                        <div class="row">
                            <div class="col-md-4 pr-0 profile-select2">
                                <label class=" w-100 fs-6 fw-bold mb-2">Country Code</label>
                                <select name="business_country_code" id='business_country_code'
                                    class="form-control border-1 rounded-0 h-auto " required>
                                    @foreach ($country as $value)
                                        <option value="{{ $value->phone }}"
                                            @php
                                            $selected = '';
                                            if($value->phone == 1) {
                                                $selected = 'selected';
                                            }
                                            if($value->phone == $business_details->country_code){
                                                $selected = 'selected';
                                            }
                                            @endphp
                                            {{ $selected }}>
                                            {{ '+' . $value->phone }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label class=" fs-6 fw-bold mb-2"> Mobile Number</label><span
                                    class="text-danger">*</span>
                                <input type="text" id="business_mobile_number"
                                    class="form-control border-1 rounded-0 h-auto mobile_input_mask"
                                    value="{{ $business_details->business_mobile_number }}"
                                    placeholder="Business Mobile Number" required name="business_mobile_number" />
                            </div>
                        </div>
                        @if ($errors->has('mobile_number'))
                            <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                        @endif
                    </div>
                </div>

                <b>Address Details :</b>
                <div class="card-body px-0">
                    <!-- end-Mobile -->
                    <!-- address 1 -->
                    <div class="fv-row mb-4 form-group">
                        <label class=" fs-6 fw-bold mb-2">Address Line 1</label><span class="text-danger">*</span>
                        <input type="text" class="form-control border-1 rounded-0 h-auto address" value="{{ $business_details->address }}" name="address" id="edit_business_location" placeholder="Address Line 1" />
                        <input type="hidden" name="latitude" id="edit_latitude" value="{{$business_details->latitude}}">
                        <input type="hidden" name="longitude" id="edit_longitude" value="{{$business_details->longitude}}">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <!-- end-address 1 -->

                    <!-- address 2 -->
                    <div class="fv-row mb-4 form-group">
                        <label class=" fs-6 fw-bold mb-2">Address Line 2</label>
                        <input type="text" class="form-control border-1 rounded-0 h-auto address"
                            value="{{ $business_details->address_2 }}" name="address_2"
                            placeholder="Address Line 2" id="address_2" />
                        @if ($errors->has('address_2'))
                            <span class="text-danger">{{ $errors->first('address_2') }}</span>
                        @endif
                    </div>
                    <!-- end-address 2 -->

                    <!-- country dropdown -->
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-bold mb-2">Country</label><span class="text-danger">*</span>
                        <div class="profile-select2">
                            <select name="country" id="country" class="form-control border-1 rounded-0 h-auto address"
                                data-control="select2">
                                @foreach ($countryName as $value)
                                    <option value="{{ $value->id }}" data-country="{{$value->name}}"
                                        {{ $value->id == $business_details->country_id ? 'selected' : '' }}>
                                        {{ ucfirst($value->name) }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- end-country dropdown -->

                    <!-- state -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">State</label><span class="text-danger">*</span>
                        <input type="text" class="form-control border-1 rounded-0 h-auto edit_state address" id="state"
                            value="{{ $business_details->state }}" name="state" placeholder="State" />
                    </div>
                    <!-- end-state -->

                    <!-- city -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">City</label><span class="text-danger">*</span>
                        <input type="text" class="form-control border-1 rounded-0 h-auto edit_city address" id="city"
                            value="{{ $business_details->city }}" name="city" placeholder="City" />
                    </div>
                    <!-- end-city -->
                    <!-- zip code -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">Zip Code</label><span class="text-danger">*</span>
                        <input type="text" class="form-control border-1 rounded-0 h-auto edit_zip_code address"
                            value="{{ $business_details->zip_code }}" id="zip_code" name="zip_code"
                            placeholder="Zip Code" />
                    </div>
                    <!-- end-zip code -->
                    <div class="fv-row mb-7 form-group">
                        <div id="show-map"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <b>&nbsp;</b>
                <div class="card-body px-0">
                    {{-- <!--category -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">Primary Category</label><span class="text-danger">*</span>
                        <div class="profile-select2">
                            <select name="category" id="category" class="form-select form-select-solid"
                                data-error="#error-category" data-control="select2">
                                <option value="">Choose Business Category</option>
                                @if (!empty($user_category))
                                    @foreach ($categories as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $value->id == $user_category ? 'selected' : '' }}>
                                            {{ $value->title }} </option>
                                    @endforeach
                                @else
                                    @foreach ($categories as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->title }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div id="error-category"></div>
                    </div>
                    <!-- end cantegory --> --}}
                    <!--category -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">Business Services<span class="text-danger">*</span></label>
                        <div class="profile-select2">
                            <select name="sub_category[]" id="sub_category" data-error="#sub_category-error" class="form-select form-select-solid" data-control="select2" multiple data-placeholder="Select business services">
                                @foreach ($sub_categories as $value)
                                    @if (!empty($business_sub_categories) && in_array($value->id, $business_sub_categories))
                                        <option value="{{ $value->id }}" selected>{{ $value->title }} </option>
                                    @else
                                        <option value="{{ $value->id }}"> {{ $value->title }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div id="sub_category-error" class="error"></div>
                    </div>
                    <div class="text-right">
                        <a href="javascript:;" id="add_service">Add Business Service</a>
                    </div>
                    <div class="fv-row mb-7 form-group d-none" id="new_service">
                        <form name="add_business_service_form" id="add_business_service_form">
                            <label class=" fs-6 fw-bold mb-2 " >New Business Service</label>
                            <input type="text" class="form-control border-1 rounded-0 h-auto"
                                value="" id="new_business_service" name="new_business_service" placeholder="New Business Service" required/>
                                <p id="newServiceError"></p>
                            <div class="text-right mt-1">
                                <input type="button" class="btn btn-danger br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish" id="cancle_add_service" value="Cancel">
                                 <input type="button" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish" value="Add Service" name="submit_new_service" id="submit_new_service">
                            </div>
                        </form>
                    </div>
                    <!-- end sub cantegory -->

                    {{-- <!--Secondary category -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">Secondary Category</label>
                        <div class="profile-select2">
                            <select name="secondary_category" id="secondary_category" class="form-select form-select-solid"
                                data-error="#error-secondary-category" data-control="select2">
                                <option value="">Choose Business Category</option>
                                @if (!empty($secondary_category))
                                    @foreach ($categories as $value)
                                        <option value="{{ $value->id }}"
                                            {{ $value->id == $secondary_category ? 'selected' : '' }}>
                                            {{ $value->title }} </option>
                                    @endforeach
                                @else
                                    @foreach ($categories as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->title }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div id="error-secondary-category"></div>
                    </div>
                    <!-- end Secondary cantegory -->
                    <!--Secondary sub category -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">Secondary Sub Categories</label>
                        <div class="profile-select2">
                            <select name="secondary_sub_category[]" id="secondary_sub_category" class="form-select form-select-solid"
                                data-control="select2" multiple>
                                @if (!empty($secondary_subcategory))
                                    @foreach ($secondary_sub_categories as $value)
                                        <option value="{{ $value->id }}"
                                            @if (in_array($value->id, $secondary_subcategory)) {{ 'selected' }} @endif>
                                            {{ $value->title }} </option>
                                    @endforeach
                                @else
                                    @foreach ($secondary_sub_categories as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->title }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- end sub cantegory --> --}}
                </div>

                <b>Social Links :</b>
                <div class="card-body px-0">

                    <!-- facebook link -->
                    <label class=" fs-6 fw-bold mb-2">Facebook Link</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fab fa-facebook-f"> </i>
                                &nbsp;&nbsp;&nbsp;www.facebook.com/</span>
                        </div>
                        <input type="text" class="form-control" placeholder="" name="facebook_url"
                            id="facebook_url"
                            value="{{ $profile->social_links ? $profile->social_links->facebook_url : '' }}"
                            data-error="#error-facebook_url">
                    </div>
                    <div id="error-facebook_url"></div>
                    <!-- end facebook link -->
                    <!-- Instagram link -->
                    <label class="fs-6 fw-bold mb-2">Instagram Link</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fab fa-instagram">
                                </i>&nbsp;www.instagram.com/</span>
                        </div>
                        <input type="text" class="form-control" placeholder="" name="instagram_url"
                            id="instagram_url"
                            value="{{ $profile->social_links ? $profile->social_links->instagram_url : '' }}"
                            data-error="#error-instagram_url">
                    </div>
                    <div id="error-instagram_url"></div>
                    <!-- end Instagram link -->
                    <!-- twitter link -->
                    <label class="fs-6 fw-bold mb-2">Twitter Link</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fab fa-twitter"> </i>
                                &nbsp;&nbsp;&nbsp;www.twitter.com/ &nbsp;&nbsp;&nbsp;</span>
                        </div>
                        <input type="text" class="form-control" placeholder="" aria-label="twitter_url"
                            value="{{ $profile->social_links ? $profile->social_links->twitter_url : '' }}"
                            name="twitter_url" data-error="#error-twitter_url">
                    </div>
                    <div id="error-twitter_url"></div>
                    <!-- end twitter link -->

                    <!-- linkedin link -->
                    <label class="fs-6 fw-bold mb-2">Linkedin Link</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fab fa-linkedin"> </i>
                                &nbsp;&nbsp;&nbsp;www.linkedin.com/&nbsp;&nbsp;&nbsp;</span>
                        </div>
                        <input type="text" class="form-control" placeholder="" aria-label="linkedin_url"
                            value="{{ $profile->social_links ? $profile->social_links->linked_in_url : '' }}"
                            name="linkedin_url" id="linkedin_url" data-error="#error-linkedin_url">
                    </div>
                    <div id="error-linkedin_url"></div>
                    <!-- end twitter link -->

                    <!-- linkedin link -->
                    <label class="fs-6 fw-bold mb-2">Business Website Link</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="eg. www.google.com/"
                            value="{{ $business_details ? $business_details->website_url : '' }}"
                            name="website_url" id="website_url" data-error="#error-website_url">
                    </div>
                    <div id="error-website_url"></div>
                </div>
                <!-- end twitter link -->
                <b>Business Description :</b>
                <div class="card-body px-0">
                    <!-- short description -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-bold mb-2">
                            <span class="">Short Description</span><span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control border-1 rounded-0 h-auto" rows="2" name="sort_description"
                            placeholder="Short Description">{{ $business_details->sort_description }}</textarea>
                    </div>
                    <!--end-short description -->

                    <!-- description -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-bold mb-2">
                            <span class="">Description</span><span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control border-1 rounded-0 h-auto" rows="3" name="description"
                            placeholder="Description">{{ $business_details->description }}</textarea>
                    </div>
                    <!--end-description -->
                </div>
                @if ($church)
                    <b>Church Details :</b>
                    <div class="card-body church-email-box mt-2">
                            <div class="row">
                                <span class="col-md-12">{{$church->name}} </span>
                            </div>
                            @if ($church->church_details)
                                <div class="row">
                                    <span class="col-md-12">{{$church->church_details->address}} <br>
                                    @if($church->church_details->address_2)
                                    {{$church->church_details->address_2}} <br>
                                    @endif
                                    {{ucfirst($church->church_details->city)}} -{{$church->church_details->zip_code}}  <br>
                                    {{ucfirst($church->church_details->state)}} ,{{($church->church_details->country)? $church->church_details->country->name:''}}  </span>
                                </div>
                            @endif

                    </div>
                @endif
            </div>
            <div class="col-12">
                <div class="fv-row mt-5 d-flex justify-content-end">
                    <button type="submit"
                        class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish"
                        id="frm-edit-business-details-submit">Update</button>
                </div>
            </div>
        </div>
    </form>
</section>
