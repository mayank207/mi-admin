@php
    $getAllContrycode = App\Models\Country::select('id','phone','name')->get();
@endphp
<form class="form" action="{{ route('church.update', getEncrypted($church->id)) }}" id="edit_church_form" method="post">
    @csrf
    @method('patch')

    <input type="hidden" value="{{ \Route::currentRouteName() }}" id="prev_route" name="prev_route">
    <!-- Name & email of pastor will update in users table-->
    <div class="row">
        <div class="fv-row mb-7 col-md-6 form-group">
            <label class="required fs-6 fw-bold mb-2">Name of Pastor/Leader of your church</label>
                <input type="text" class="form-control form-control-solid" id="name_of_leader" name="name_of_leader" value="{{ $church->name }}" placeholder="Name of Pastor/Leader of your church"/>
                @if ($errors->has('name_of_leader'))
                <div class="error">
                    <strong>{{ $errors->first('name_of_leader') }}</strong></div>
                @endif
        </div>
        <div class="fv-row mb-7 col-md-6 form-group">
            <label class="required fs-6 fw-bold mb-2">Email of Pastor/Leader of your church</label>
                <input type="email" class="form-control form-control-solid" id="email_of_leader" name="email_of_leader" value="{{ $church->email }}" placeholder="Email of Pastor/Leader of your church"/>
                @if ($errors->has('email_of_leader'))
                <div class="error">
                    <strong>{{ $errors->first('email_of_leader') }}</strong></div>
                @endif
        </div>
    </div>

    <div class="row">
    <!-- Name & email of church will update in church details table-->
    <div class="fv-row mb-7 form-group col-md-6">
            <label class="required fs-6 fw-bold mb-2">Church Name</label>
            <input type="text" class="form-control form-control-solid" placeholder="Church Name" id="church_name" name="church_name"
                value="{{isset($church->church_details) ? $church->church_details->church_name : ''}}">
                @if ($errors->has('church_name'))
                    <div class="error">
                    <strong>{{ $errors->first('church_name') }}</strong></div>
                @endif
        </div>
        <!-- end-Name -->
         <!-- Email -->
         <div class="fv-row mb-7 form-group col-md-6">
            <label class="required fs-6 fw-bold mb-2">Church Email</label>
            <input type="email" class="form-control form-control-solid" placeholder="Email" id="church_email"
                name="church_email" value="{{isset($church->church_details) ? $church->church_details->church_email : ''}}" />
            @if ($errors->has('church_email'))
                <div class="error">
                <strong>{{ $errors->first('church_email') }}</strong></div>
            @endif
        </div>
        <!-- end-Email -->
    </div>

    <div class="row">
        <!-- Address line 1-->
        <div class="fv-row mb-7 form-group col-md-6">
            <label class=" fs-6 fw-bold mb-2">Address Line 1</label><span class="text-danger">*</span>
            <input type="text" class="form-control form-control-solid address" value="{{ isset($church->church_details) ? $church->church_details->address : ''}}" name="address" id="edit_church_location" placeholder="Address Line 1" />
            <input type="hidden" name="latitude" id="edit_latitude" value="{{ isset($church->church_details) ? $church->church_details->latitude : ''}}">
            <input type="hidden" name="longitude" id="edit_longitude" value="{{ isset($church->church_details) ? $church->church_details->longitude : ''}}">
            @if ($errors->has('address'))
                <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
        </div>
        <!-- end-Address line 1 -->
        <!-- Address line 2-->
        <div class="fv-row mb-7 form-group col-md-6">
            <label class="fs-6 fw-bold mb-2">Address line 2</label>
            <input type="text" class="form-control form-control-solid address" id="address_2" name="address_2" placeholder="Address Line 2" value="{{ isset($church->church_details) ? $church->church_details->address_2 : ''}}"/>
        </div>
        <!-- end-Address line 2 -->
    </div>

    <div class="row">
        <!-- City-->
        <div class="fv-row mb-7 form-group col-md-6">
            <label class="required fs-6 fw-bold mb-2 address">City</label>
            <input type="text" class="form-control form-control-solid" id="city" name="city" placeholder="City" value="{{ isset($church->church_details) ? $church->church_details->city : ''}}"/>
            @if ($errors->has('city'))
                <div class="error">
                <strong>{{ $errors->first('city') }}</strong></div>
            @endif
        </div>
        <!-- end-City-->
        <!-- zip Code-->
        <div class="fv-row mb-7 form-group col-md-6">
            <label class="required fs-6 fw-bold mb-2">Zip Code</label>
            <input type="text" class="form-control address form-control-solid" id="zip_code" name="zip_code" placeholder="Zip Code" value="{{isset($church->church_details) ? $church->church_details->zip_code : ''}}"/>
            @if ($errors->has('zip_code'))
                <div class="error">
                <strong>{{ $errors->first('zip_code') }}</strong></div>
            @endif
        </div>
        <!-- end-Zip Code-->
    </div>
    <div class="row">
        <!-- State-->
        <div class="fv-row mb-7 form-group col-md-6">
            <label class="required fs-6 fw-bold mb-2">State</label>
            <input type="text" class="form-control form-control-solid address" id="state" name="state" placeholder="state" value="{{isset($church->church_details) ? $church->church_details->state : ''}}"/>
            @if ($errors->has('state'))
                <div class="error">
                <strong>{{ $errors->first('state') }}</strong></div>
            @endif
        </div>
        <!-- end-Zip Code-->
        <!-- Country-->
        <div class="fv-row mb-7 form-group col-md-6">
            <label class="required fs-6 fw-bold mb-2">Country</label>
            <div class="custom-select2">
                <select name="country" id="country" required class="form-control form-control-solid border-0 rounded-0 h-auto address"  data-control="select2" required>
                    @foreach ($getAllContrycode as $code)
                    <option value="{{$code->id}}" data-country="{{$code->name}}" {{ isset($church->church_details) && $church->church_details->country_id == $code->id ? 'selected' : ''}}>{{$code->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- end-Country-->
    </div>
    <div class="row">

        <div class="fv-row mb-7 form-group col-md-6">
            <label class="required fs-6 fw-bold mb-2">Description</label>
            <textarea class="form-control description-hight" id="description" name="description" placeholder="Description" rows="3">{{ isset($church->church_details) ? $church->church_details->description : ''}}</textarea>
        </div>
          <!-- denomination-->
          <div class="fv-row mb-7 form-group col-md-6">
            <label class="required fs-6 fw-bold mb-2">Denomination</label>
            <div>
                <select name="denomination" data-error="#error-denomination" id="denomination"  class="form-control form-control-solid border-0 rounded-0 h-auto"  data-control="select2">
                    <option value="">Select Denomination</option>
                    @foreach ($denomination as $type)
                        <option data-title="{{$type->name}}" value="{{$type->id}}" {{ isset($church->church_details) && $church->church_details->denomination_id == $type->id ? 'selected' : '' }}>{{$type->name}} @if($type->name=='Other' &&$church->church_details->denomination_id == $type->id) {{ ($church->church_details) ? '('.$church->church_details->new_denomination .')' : '' }} @endif</option>
                    @endforeach
                </select>
                <div id="error-denomination"></div>
            </div>
            @if ($errors->has('denomination'))
            <div class="error">
                <strong>{{ $errors->first('denomination') }}</strong></div>
            @endif

            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 mt-4 d-none" type="text"  autocomplete="off" id="new_denomination" name="new_denomination" placeholder="Enter Your Denomination" required  @if($church->church_details) value="{{$church->church_details->new_denomination}}" @endif>

        </div>
        <!-- end-denomination-->

    </div>


    <!-- Status -->
    <div class="fv-row mb-15 mt-5">
        <label class="fs-6 fw-bold mb-2">Status</label>
        <label class="form-check form-switch form-check-custom form-check-solid">
            <input class="form-check-input" name="status" type="checkbox" value="1"
                {{ $church->status == 1 ? 'checked' : '' }} />
            <span class="form-check-label fw-bold text-muted" for="edit_status"></span>
        </label>
    </div>
    <!-- end-Status -->

    <!-- Location map -->
    <div class="d-flex justify-content-end mb-4">
        <span id="show_lat">{{ isset($church->church_details) ? $church->church_details->latitude : ''}}</span> &nbsp; , &nbsp;
        <span id="show_long">{{ isset($church->church_details) ? $church->church_details->longitude : ''}}</span>
    </div>
    <div class="fv-row mb-7 form-group">
        <div id="show-map"></div>
    </div>
    <!--End Location map -->

    <div class="fv-row mb-15 d-flex justify-content-end">
        <!--begin::Button-->
        <a href="{{ route('church.index') }}" class="btn btn-light me-3">Cancel</a>
        <!--end::Button-->
        <!--begin::Button-->
        <button type="submit" id="edit_church_form_submit"
            data-kt-banner-action="submit" class="btn btn-primary">
            <span class="indicator-label">Submit</span>
            <span class="indicator-progress">Please wait...
                <span
                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
</form>
