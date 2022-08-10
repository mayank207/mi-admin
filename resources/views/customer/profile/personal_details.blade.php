<section class="m-xl-4">
    <form class="form" action="{{route('profile.update_personal_details',getEncrypted($profile->id))}}" id="edit_personal_details_form" method="post">
    @csrf
    <div class="row m-0">
            <div class="col-12 col-md-6">
                <b>Personal Details :</b>
                <div class="card-body px-0">
                    @if(Auth::user()->role_id == 4)
                        <!--Church Name -->
                        <div class="fv-row mb-4 form-group">
                            <label class="required fs-6 fw-bold mb-2"> Name of Pastor/Leader of your church</label>
                            <input type="text" class="form-control border-1  rounded-0 h-auto "
                                value="{{$profile->name}}" name="name_of_leader" placeholder="Church Name of your church"/>
                            @if ($errors->has('name_of_leader'))
                                <span class="text-danger">{{ $errors->first('name_of_leader') }}</span>
                            @endif
                        </div>
                        <!-- end-Church Name -->
                    @else
                        <!--first Name -->
                        <div class="fv-row mb-4 form-group">
                            <label class="required fs-6 fw-bold mb-2"> First Name</label>
                            <input type="text" class="form-control border-1  rounded-0 h-auto "
                                value="{{$profile->first_name}}" name="first_name" placeholder="First Name"/>
                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <!-- end-first Name -->
                        <!-- last Name -->
                        <div class="fv-row mb-4 form-group">
                            <label class="required fs-6 fw-bold mb-2"> Last Name</label>
                            <input type="text" class="form-control border-1  rounded-0 h-auto "
                                value="{{$profile->last_name}}" name="last_name" placeholder="Last Name"/>
                            @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                        <!-- end-last Name -->

                    @endif

                    @if(Auth::user()->role_id != 4)
                    <!-- User Name -->
                        <div class="fv-row mb-4 form-group">
                            <label class="required fs-6 fw-bold mb-2"> Username</label>
                            <input type="text" class="form-control border-1  rounded-0 h-auto "
                                value="{{$profile->user_name}}" name="user_name" placeholder="Username"/>
                            @if ($errors->has('user_name'))
                                <span class="text-danger">{{ $errors->first('user_name') }}</span>
                            @endif
                        </div>
                        <!-- end-User Name -->
                    @endif

                    <!-- email -->
                    <div class="fv-row mb-4 form-group">
                        <label class="required fs-6 fw-bold mb-2"> Email</label>
                        <input type="text" class="form-control border-1 disabled  rounded-0 h-auto "
                            value="{{$profile->email}}" readonly name="email"  required placeholder="Email"/>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <!-- end-email -->
                    @if(Auth::user()->role_id == 4)
                        <!-- Name of Pastor/Leader -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">Church Name</label>
                        <input type="text" class="form-control border-1 rounded-0 h-auto"
                            value="{{ ($profile->church_details) ?  $profile->church_details->church_name : '' }}" name="church_name" placeholder="Church Name" />
                    </div>
                    <!-- end-Name of Pastor/Leader -->

                    <!-- email of Pastor/Leader -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">Church Email</label>
                        <input type="email" readonly class="form-control border-1 rounded-0 h-auto"
                            value="{{ ($profile->church_details) ?  $profile->church_details->church_email : '' }}" name="church_email" placeholder="Church Email" />
                    </div>
                    <!-- end-email of Pastor/Leader -->

                        <!--Denomination -->
                    <div class="fv-row mb-7 form-group profile-select2">
                        <label class=" fs-6 fw-bold mb-2">Denomination</label>
                        <select name="denomination" id='denomination' class="form-control border-1 rounded-0 h-auto "  required>
                            @foreach ($denomination as $type)
                            <option data-title="{{$type->name}}" value="{{ $type->id }}"
                                {{ $type->id == $profile->church_details->denomination_id ? 'selected' : '' }}>
                                {{ $type->name }} @if($type->name =='Other' && $type->id == $profile->church_details->denomination_id) {{($profile->church_details) ?'('. $profile->church_details->new_denomination .')' :'-' }} @endif</option>
                            @endforeach
                        </select>

                        <input class="form-control border-1 rounded-0 h-auto mt-3 d-none" type="text"  autocomplete="off" id="new_denomination" name="new_denomination" placeholder="Enter Your Denomination" required  @if($profile->church_details) value="{{$profile->church_details->new_denomination}}" @endif>
                    </div>
                    <!-- end-Denomination -->

                    <div class="fv-row my-4 form-group">
                        <div id="show-map"></div>
                    </div>
                    @endif
                    @if(Auth::user()->role_id != 4)
                        <!-- Mobile -->
                        <div class="fv-row mb-4 form-group">
                            <div class="row">
                                <div class="col-md-4 profile-select2">
                                    <label class="required fs-6 fw-bold mb-2">Country Code</label>
                                    <select name="country_code" id='country_code' class="form-control border-1 rounded-0 h-auto "  required>
                                        @foreach ($country as $value)
                                        <option value="{{ $value->phone }}"
                                            {{ $value->phone == $profile->country_code ? 'selected' : '' }}>
                                            {{'+'. $value->phone }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-8">
                                    <label class="required fs-6 fw-bold mb-2"> Mobile Number</label>
                                    <input type="text" id="mobile_number" class="form-control border-1  rounded-0 h-auto mobile_input_mask" value="{{$profile->mobile_number}}" placeholder="Mobile Number" required name="mobile_number" />
                                </div>
                            </div>
                            @if ($errors->has('mobile_number'))
                                <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                            @endif
                        </div>
                        <!-- end-Mobile -->
                        <div class="fv-row mt-5 d-flex justify-content-end">
                            <!--begin::Button-->
                            <button type="submit" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish" id="frm-edit-user-submit">Update</button>
                        </div>
                    @endif
                </div>
            </div>
            @if(Auth::user()->role_id == 4)
            <div class="col-12 col-md-6">
                <b>Address Details :</b>
                <div class="card-body">
                    <!-- end-Mobile -->
                    <!-- address 1 -->
                    <div class="fv-row mb-4 form-group">
                        <label class=" fs-6 fw-bold mb-2">Address Line 1</label><span class="text-danger">*</span>
                        <input type="text" class="form-control border-1 rounded-0 h-auto address" value="{{ $profile->church_details->address }}" name="address" id="edit_business_location" placeholder="Address Line 1" />
                        <input type="hidden" name="latitude" id="edit_latitude" value="{{$profile->church_details->latitude}}">
                        <input type="hidden" name="longitude" id="edit_longitude" value="{{$profile->church_details->longitude}}">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <!-- end-address 1 -->

                    <!-- address 2 -->
                    <div class="fv-row mb-4 form-group">
                        <label class=" fs-6 fw-bold mb-2">Address Line 2</label>
                        <input type="text" class="form-control border-1 rounded-0 h-auto address"
                            value="{{ ($profile->church_details) ?  $profile->church_details->address_2 : '' }}" name="address_2"
                            placeholder="Address Line 2" id="address_2" />
                        @if ($errors->has('address_2'))
                            <span class="text-danger">{{ $errors->first('address_2') }}</span>
                        @endif
                    </div>
                    <!-- end-address 2 -->
                    <!-- city -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">City</label><span class="text-danger">*</span>
                        <input type="text" class="form-control border-1 rounded-0 h-auto address"
                            value="{{ ($profile->church_details) ?  $profile->church_details->city : '' }}" name="city" placeholder="City" id="city" />
                    </div>
                    <!-- end-city -->
                    <!-- zip code -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2">Zip Code</label><span class="text-danger">*</span>
                        <input type="text" class="form-control border-1 rounded-0 h-auto address"
                            value="{{  ($profile->church_details) ?  $profile->church_details->zip_code : '' }}" id="zip_code" name="zip_code"
                            placeholder="Zip Code" />
                    </div>
                    <!-- end-zip code -->
                    <!-- state -->
                    <div class="fv-row mb-7 form-group">
                        <label class=" fs-6 fw-bold mb-2 address">State</label><span class="text-danger">*</span>
                        <input type="text" class="form-control border-1 rounded-0 h-auto address"
                            value="{{  ($profile->church_details) ?  $profile->church_details->state : '' }}" name="state" placeholder="State" id="state"/>
                    </div>
                    <!-- end-state -->


                    <!-- country dropdown -->
                    <div class="fv-row mb-7 form-group">
                        <label class="fs-6 fw-bold mb-2">Country</label><span class="text-danger">*</span>
                        <div class="profile-select2">
                            <select name="country" id="country" class="form-control border-1 rounded-0 h-auto address"
                                data-control="select2">
                                @if ($profile->church_details)
                                    @foreach ($countryName as $value)
                                        <option value="{{ $value->id }}" data-country="{{ $value->name }}"
                                            {{ $value->id == $profile->church_details->country_id ? 'selected' : '' }}>
                                            {{ ucfirst($value->name) }} </option>
                                    @endforeach
                                @else
                                @foreach ($country as $value)
                                    <option value="{{ $value->id }}" data-country="{{ $value->name }}">
                                        {{ ucfirst($value->name) }} </option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>
                    <!-- end-country dropdown -->
                </div>
                <div class="fv-row mt-5 d-flex justify-content-end">
                    <!--begin::Button-->
                    <button type="submit" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish" id="frm-edit-user-submit">Update</button>
                </div>
            </div>
            @endif
        </div>
    </form>
</section>


