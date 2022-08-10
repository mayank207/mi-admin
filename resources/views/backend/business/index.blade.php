@extends('backend.layouts.base')

@section('title')
        {!! setBreadCrumb('Business', route('business.index')) !!}
@endsection

@php
    $approval_status = '';
    if(isset($_GET['approval_status']) && $_GET['approval_status'] != ""){
        $approval_status = $_GET['approval_status'];
    }
@endphp
@section('content')
    <!--begin::Post-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card" id="load_review_content">
                <!--begin::Card header-->
                <div class="card-header d-block w-100">
                    <!--begin::Card title-->
                    <div class="card-title d-block">
                        <div class="row">
                            <!--begin::Search-->
                            <div class="col-md-3 mt-2">
                                <label>Search</label>
                                <div class="d-flex align-items-center position-relative">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6"><i
                                            class="fas fa-search"></i></span>
                                    <!--end::Svg Icon-->
                                    <form id="filter_form" action="{{ route('business.index') }}" method="GET">
                                        <input type="hidden" name="orderbycolumn" class="input-sm form-control"
                                            id="form-orderbycolumn">
                                        <input type="hidden" name="orderby" class="input-sm form-control" id="form-orderby">
                                        <input type="hidden" name="subscription_status" class="input-sm form-control" id="form-subscription_status">
                                        <input type="hidden" name="status" class="input-sm form-control" id="form-status">
                                        <input type="hidden" name="approval_status" class="input-sm form-control" id="form-approval_status" value="">
                                        <input type="hidden" name="fromdate" class="input-sm form-control"
                                            id="form-fromdate">
                                        <input type="hidden" name="todate" class="input-sm form-control" id="form-todate">
                                        <input type="hidden" name="user_type" class="input-sm form-control"
                                            id="form-user_type">
                                        <input type="hidden" name="page" value="1" id="filter_page">
                                        <input type="text" name="search_keyword"
                                            class="form-control form-control-solid w-230px ps-14" placeholder="Search" />
                                    </form>
                                </div>
                            </div>
                            <!--end::Search-->
                            <div class="col-md-3 mt-2">
                                <label>Status</label>
                                <select name="status" id="status" class="form-select form-select-solid"
                                    data-control="select2" data-hide-search="true" title="Status Filter">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-2">
                                <label>From</label>
                                <input type="text" id="fromdate" placeholder="mm-dd-yyyy"
                                    class="form-control datepicker form-control-solid">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label>To</label>
                                <input type="date" id="todate" placeholder="mm-dd-yyyy"
                                    class="form-control datepicker form-control-solid">
                            </div>
                            <div class="col-12">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <label>Approval Status</label>
                                    <select name="approval_status" id="approval_status" class="form-select form-select-solid" data-control="select2" data-hide-search="true" title="Status Filter" tabindex="0" aria-hidden="false">
                                        <option value="" selected="">All</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-2" data-select2-id="select2-data-14-an3n">
                                    <label> </label>
                                    <span class="form-check form-check-md form-check-custom form-check-solid fv-row mt-5">
                                        <input class="form-check-input mr-6" type="checkbox" id="subscription_status" name="subscription_status"  value="1" title="Subscribed Business Filter">
                                        <span class="fs-4 fw-bold pl-5 mt-2">Subscribed Businesses</span>
                                    </span>
                                </div>

                            <div class="col-md-5 mt-8 px-2 text-right">
                                <button type="button" class="btn btn-secondary" id="reset_filter_btn"><i class="fa fa-refresh" aria-hidden="true"></i>Reset</button>
                            </div>
                        </div>

                        </div>

                        <hr class="text-muted mt-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-select form-select-solid bulk_update_status" data-control="select2" data-hide-search="true"
                                     id="bulk_update_status">
                                    <option value="">Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="bulk_update_status_btn"
                                    data-url="{{ route('business.bulk_updates') }}" data-title="business">Bulk
                                    Update</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0 table-responsive" id="load_content">
                    <!--begin::Table-->
                    @include('components.business_table')
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
