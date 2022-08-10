@if(count($all_business)>0)
@foreach($all_business as $key => $business)
    <div class="col-12">
        @include('customer.business.single_item')
    </div>
@endforeach
@else
    <div class="text-center ml-6"> <img src="{{ asset('img/norecordfound.png') }}"></div>
@endif

@include('customer.components.business_contact_now')
@include('customer.components.business_ask_quote')

<div class="business-list-pagination">
    {{ $all_business->render('vendor.pagination.custom-paginate') }}
</div>
