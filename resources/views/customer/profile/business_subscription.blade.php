<section class="m-xl-4">
<div class="row m-0">
    <div class="col-12 col-md-12">
        <b>My Subscription</b>
        @if(!$profile->is_subscribe())
        <p class="text-dark-gray mt-1 font-18">
            Upgrade your business account - ${{$subscription->price}} / {{$subscription->billing_period}}
        </p>
        <form action="{{route('subscription.paypal.checkout')}}" id="cancle_subscription" method="post">
            {{csrf_field()}}
            <button class="btn bg-slate-green text-white font-18 font-weight-bold px-5 rounded-pill font-mulish">Subscribe with Paypal</button>
        </form>
        @else
            @if(Auth::user()->subscription->is_payment_received == 0)
            <p>Your subscription is being processed, please check back shortly</p>
            @else
            <p>Your subscription will renew on {{ \Carbon\Carbon::parse(Auth::user()->subscription->end_date)->format('m-d-Y') }} </p>
            @endif

            @if(Auth::user()->subscription->is_cancel == 0)
            <form action="{{route('subscription.paypal.cancel')}}" method="post">
                {{csrf_field()}}
                <button class="btn bg-slate-green text-white font-18 font-weight-bold px-5 rounded-pill font-mulish confirmation">Cancel Subscription</button>
            </form>
            @else
            <p class="text-dark-gray mt-1 font-18">
                Upgrade your business account - ${{$subscription->price}} / {{$subscription->billing_period}}
            </p>
            <form action="{{route('subscription.paypal.checkout')}}" method="post">
                {{csrf_field()}}
                <button class="btn bg-slate-green text-white font-18 font-weight-bold px-5 rounded-pill font-mulish">Subscribe with Paypal</button>
            </form>
            @endif
        @endif
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative justify-content-end">
                <form id="filter_form" action="{{ route('transaction_history.search') }}" method="GET">
                    <input type="hidden" name="orderbycolumn" class="input-sm form-control"
                        id="form-orderbycolumn">
                    <input type="hidden" name="orderby" class="input-sm form-control" id="form-orderby">
                    <input type="hidden" name="page" value="1" id="filter_page">
                    <div class="input-group input-group-shadow rounded-pill">
                        <input type="text" name="search_keyword" class="form-control header-search pl-4 pr-5 border-white rounded-pill-left" placeholder="Search">
                        <div class="input-group-append">
                            <div class="bg-navy-blue text-white rounded-pill-right shadow-none px-3 py-2 d-flex align-items-center"><i class="fa-solid fa-magnifying-glass"></i></div>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Search-->
            @include('customer.profile.subscribe_transaction_histories')
       

    </div>
</div>
</section>
