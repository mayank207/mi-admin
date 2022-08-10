@if(count($all_business)>0)
@foreach($all_business as $key => $business)
    <div class="mb-3">
        @include('customer.business.single_item')
    </div>
@endforeach
@else
    <div class="text-center"> <img src="{{ asset('assets/media/No-Record-Found.png') }}"></div>
@endif
<div class="business-list-pagination">
    {{ $all_business->render('vendor.pagination.custom-paginate') }}
</div>
<p id="filter_text" class="filter-text">{{ count($all_business) <= 5 && isset($text) ? $text : ''}}</p>

