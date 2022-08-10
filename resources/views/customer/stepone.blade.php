@php
    $getAllContrycode = App\Models\Country::select('phone')->orderBy('phone','asc')->distinct()->get();
@endphp
<form role="form" action="{{route('register.step.one')}}" method="post" id="form_step_1" class="login-box" enctype="multipart/form-data">
    @csrf
    <div class="row border rounded">
        <div class="col-12 col-md-6 col-lg-4 px-md-0 text-center d-none d-md-block">
            <img src="{{asset('img/buisness_821.png')}}" class="w-100 h-100 object-fit-cover max-h-738px" alt="">
        </div>
        <div class="col-12 col-md-6 col-lg-8">
            <div class="row p-md-3 p-lg-5 py-4">
                <div class="col-12">
                    <h1 class="text-slate-green font-24 font-weight-bold font-mulish">Your basic
                        information
                    </h1>
                    <p class="text-dark-gray font-18 mb-0">Sign up on Kingdom as a professional business and list your services on our platform.
                    </p>
                </div>
                <div class="col-12 col-xl-12">
                    <div class="row">
                        <div class="col-12 col-xl-6 mt-4">
                            <input class="form-control  bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                                type="text" name="first_name" placeholder="First Name" @if(isset($user_details->first_name)) value="{{$user_details->first_name}}" @endif required>
                        </div>
                        <div class="col-12 col-xl-6 mt-4">
                            <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                                type="text" name="last_name" placeholder="Last Name" @if(isset($user_details->last_name)) value="{{$user_details->last_name}}" @endif required>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                        type="text" name="user_name" placeholder="Username" @if(isset($user_details->user_name)) value="{{$user_details->user_name}}" @endif required>
                </div>
                <div class="col-12 mt-4">
                    <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                        type="email" name="email" placeholder="Email" @if(isset($user_details->email)) value="{{$user_details->email}}" @endif required>
                </div>
                <div class="row col-12 mt-4 pr-0">
                    <div class="col-4 custom-select2">
                        <select name="country_code" id="country_code" required class="form-control bg-light-gray border-0 rounded-0 h-auto " data-control="select2" required>
                            @foreach ($getAllContrycode as $code)
                            <option value="{{$code->phone}}" {{($code->phone==1)?'selected':''}}>+{{$code->phone}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-8 pl-2 pr-0">
                        <input class="form-control mobile_input_mask bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 px-0"
                        type="text" name="mobile_number" id="mobile_number" @if(isset($user_details->mobile_number)) value="{{$user_details->mobile_number}}" @endif placeholder="Mobile Number" required>
                    </div>
                </div>
                <div class="col-12 col-xl-6 mt-4">
                    <input
                        class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                        type="password"  autocomplete="off" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="col-12 col-xl-6 mt-4">
                    <input
                        class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3"
                        type="password" name="confirm_password" autocomplete="off" required placeholder="Confirm Password">
                </div>
                <div class="col-12 col-xl-6 mt-4">
                    <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.sitekey')}}"></div>
                    @if ($errors->has('g-recaptcha-response'))
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                    @endif
                </div>
                <div class="col-12 mt-5">
                    <ul
                        class="list-inline d-flex justify-content-between align-items-center font-mulish">
                        <li>
                            <button type="submit" class="btn bg-slate-green text-white font-16 font-weight-bold px-4 py-2 br-6 step_1_submit" id="step_1">Submit</button>
                        </li>
                        <li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
@if(isset($user_details))
<script>

    var country_code ='{{$user_details->country_code}}';
    $('#country_code').val(country_code);
</script>
@endif
