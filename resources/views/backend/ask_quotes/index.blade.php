@extends('backend.layouts.base')
@section('title')
    {!! setBreadCrumb('Ask Quotes') !!}
@endsection
@section('content')
    <!--begin::Post-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body pt-6">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" id="bulk_delete_btn" data-url="{{route('ask_quotes.bulk_delete')}}" data-title="quotes" disabled>Bulk Delete</button>
                         <!--begin::Search-->
                         <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6"><i class="fas fa-search"></i></span>
                            <!--end::Svg Icon-->
                            <form id="filter_form" action="{{ route('ask_quotes.index') }}" method="GET">
                                <input type="hidden" name="orderbycolumn" class="input-sm form-control"
                                    id="form-orderbycolumn">
                                <input type="hidden" name="orderby" class="input-sm form-control" id="form-orderby">
                                <input type="hidden" name="page" value="1" id="filter_page">
                                <input type="text" name="search_keyword"
                                    class="form-control form-control-solid w-250px ps-14" placeholder="Search" />
                            </form>
                        </div>
                        <!--end::Search-->
                    </div>
                    <hr class='text-muted'>
                    <div id="load_content">
                        <!--begin::Table-->
                        @include('components.ask_quotes_table')
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
@section('external-scripts')
@endsection
