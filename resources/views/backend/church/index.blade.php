@extends('backend.layouts.base')
@section('title')
    {!! setBreadCrumb('Church') !!}
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
                                    <form id="filter_form" action="{{ route('church.index') }}" method="GET">
                                        <input type="hidden" name="orderbycolumn" class="input-sm form-control"
                                            id="form-orderbycolumn">
                                        <input type="hidden" name="orderby" class="input-sm form-control" id="form-orderby">
                                        <input type="hidden" name="denomination" id="form-denomination"
                                            class="form-control form-control-solid w-250px ps-14" placeholder="Denomination" />
                                        <input type="hidden" name="page" value="1" id="filter_page">
                                        <input type="text" name="search_keyword"
                                            class="form-control form-control-solid ps-14" placeholder="Search" />
                                    </form>
                                </div>
                            </div>
                            <!--end::Search-->
                            <div class="col-md-3 my-2">
                                <label>Denomination</label>
                                <select name="denomination" id="denomination" class="form-select form-select-solid"
                                    data-control="select2" title="Status Filter">
                                    <option value="">All</option>
                                    @foreach ($denomination as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 my-2 ">
                                <label></label>
                                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                    <!--begin::Add customer-->
                                    <a class="btn btn-primary" href="{{ route('church.create') }}">Add Church</a>
                                    <!--end::Add customer-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0" id="load_content">
                    <!--begin::Table-->
                    @include('components.church_table')
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
