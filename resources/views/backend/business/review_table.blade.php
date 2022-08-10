<div class="card-body">

    <h3 class="card-title align-items-start flex-column mb-5">
        <span class="fw-bolder text-dark">Reviews</span>
    </h3>
    <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-danger" id="bulk_delete_btn" data-url="{{route('review.bulk_delete')}}" data-title="reviews" disabled>Bulk Delete</button>
        <!--begin::Search-->
        <div class="d-flex align-items-center position-relative">
            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
            <span class="svg-icon svg-icon-1 position-absolute ms-6"><i class="fas fa-search"></i></span>
            <!--end::Svg Icon-->
            <form id="filter_form" action="{{ route('review.search',[getEncrypted($business->id)]) }}" method="GET">
                <input type="hidden" name="orderbycolumn" class="input-sm form-control"
                    id="form-orderbycolumn">
                <input type="hidden" name="orderby" class="input-sm form-control" id="form-orderby">
                <input type="hidden" name="page" value="0" id="filter_page">
                <input type="text" name="search_keyword" id="search_keyword"
                    class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
            </form>
        </div>
        <!--end::Search-->
    </div>
    <div id="load_content">
        @include('backend.business.review_list')
    </div>
</div>
