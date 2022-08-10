<div class="row border-light-gray br-5 p-3 mx-0 mt-4" id="contact-us">
    <div class="col-12 col-lg-4">
        <div id="business_map" style="width:100%; height: 250px;"></div>
    </div>
    <div class="col-12 col-lg-8 ">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold mt-2">Contact</h3>
                    <p class="mb-0">{{$business->address}}</p>
                    @if($business->address_2)
                    <p class="mb-0">{{$business->address_2}}</p>
                    @endif
                    <p  class="mb-0"> {{$business->city}}, {{ '- '.$business->zip_code}}, </p>{{$business->state}}   {{ ' , '.$business->country->name}}
                    <p class="mb-0">Office ({{ '+'. $business->country->phone}}) {{$business->business_mobile_number}}</p>

                    @if(!empty($business->website_url))
                    <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold mt-3 ">Website </h3>
                    <p class="mb-0"> <a target="blank" href="https://{{$business->website_url}}" class="blacklight-color">{{$business->website_url}}</a> </p>
                    @endif


            </div>
                <div class="col-12 col-lg-6">
                @if(!empty($business->church_details))
                <h3 class="text-navy-blue-dark font-18 font-weight-bold font-mulish-bold">Church Details </h3>
                    <p class="mb-0">{{$business->church_details->name}}</p>
                    @if(!empty($business->church_address_details->address))
                    <p class="mb-0">{{$business->church_address_details->description}}</p>
                    <p class="mb-0">{{$business->church_address_details->address}},</p>
                        @if($business->church_address_details->address_2)
                        <p class="mb-0">{{$business->church_address_details->address_2}},</p>
                        @endif
                        <p class="mb-0"> {{$business->church_address_details->city}}, {{ '- '.$business->church_address_details->zip_code}}, </p>{{$business->church_address_details->state}}
                        @endif
                    @endif
            </div>
        </div>
    </div>
</div>
