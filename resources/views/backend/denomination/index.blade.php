@extends('backend.layouts.base')
@section('title')
    {!! setBreadCrumb('Denomination') !!}
@endsection
@section('content')
    <!--begin::Post-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header d-block w-100">
                    <!--begin::Card title-->
                    <div class="card-title d-block">
                        <div class="row col-md-12">
                            <!--begin::Search-->
                            <div class="col-md-3 mt-1">
                                <label>Search</label>
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6"><i class="fas fa-search"></i></span>
                                    <!--end::Svg Icon-->
                                    <form id="filter_form" action="{{ route('denomination.index') }}" method="GET">
                                        <input type="hidden" name="page" value="1" id="filter_page">
                                        <input type="text" name="search_keyword"
                                            class="form-control form-control-solid ps-14" placeholder="Search" />
                                    </form>
                                </div>
                            </div>
                            <!--end::Search-->
                            
                            <div class="col-md-9 my-2 ">
                                <label></label>
                                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                    <!--begin::Add Denomination-->
                                    <a class="btn btn-primary" href="{{ route('denomination.create') }}">Add Denomination</a>
                                    <!--end::Add Denomination-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0" id="load_content">
                    <!--begin::Table-->
                    @include('components.denomination_table')
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
