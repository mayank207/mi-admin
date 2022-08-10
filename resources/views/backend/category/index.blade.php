@extends('backend.layouts.base')
@section('title')
    {!! setBreadCrumb('Category') !!}
@endsection
@section('content')
    <!--begin::Post-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6"><i class="fas fa-search"></i></span>
                            <!--end::Svg Icon-->
                            <form id="filter_form" action="{{ route('category.index') }}" method="GET">
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
                    <!--end::Card title-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Add customer-->
                            <a class="btn btn-primary" href="{{ route('category.create') }}">Add Category</a>
                            <!--end::Add customer-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0" id="load_content">
                    <!--begin::Table-->
                    @include('components.category_table')
                    <!--end::Table-->
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
