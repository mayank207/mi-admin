@extends('backend.layouts.base')

@section('title')
{!! setBreadCrumb('Pastors') !!}
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
                    <div class="card-title d-block w-100">
                        <div class="row">
                            <!--begin::Search-->
                            <div class="col-md-3 mt-1">
                                <label>Search</label>
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6"><i class="fas fa-search"></i></span>
                                    <!--end::Svg Icon-->
                                    <form id="filter_form" action="{{route('pastors.index')}}" method="GET">
                                        <input type="hidden" name="status" class="input-sm form-control" id="form-status">
                                        <input type="hidden" name="fromdate" class="input-sm form-control" id="form-fromdate">
                                        <input type="hidden" name="todate" class="input-sm form-control" id="form-todate">
                                        <input type="hidden" name="user_type" class="input-sm form-control" id="form-user_type">
                                        <input type="hidden" name="page" value="1" id="filter_page">
                                        <input type="text" name="search_keyword" class="form-control form-control-solid w-230px ps-14" placeholder="Search" />
                                    </form>
                                </div>
                            </div>
                            <!--end::Search-->
                            <div class="col-md-3 mt-2">
                                <label>Status</label>
                                <select name="status" id="status" class="form-select form-select-solid" data-control="select2"  data-hide-search="true"
                                    title="Status Filter">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <label>From</label>
                                <input type="text" id="fromdate" placeholder="mm-dd-yyyy" class="form-control datepicker form-control-solid">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label>To</label>
                                <input type="date" id="todate" placeholder="mm-dd-yyyy" class="form-control datepicker form-control-solid">
                            </div>
                        </div>
                        <hr class='text-muted'>
                        <div class="row d-flex justify-content-between">
                                <div class="col-md-3">
                                    <label>Bulk Update</label>
                                        <select class="form-select form-select-solid" name="bulk_update_status" data-control="select2"  data-hide-search="true" id="bulk_update_status">
                                            <option value="">Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                </div>
                                <div class="col-md-7 mt-8">
                                        <button type="button" class="btn btn-primary" id="bulk_update_status_btn" data-url="{{route('user.bulk_updates')}}" data-title="pastors">Bulk Update</button>
                                </div>
                            <div class="col-md-1 mx-4 mt-8">
                                <button type="button" class="btn btn-secondary" id="reset_filter_btn">Reset</button>
                            </div>
                        </div>
                        

                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 table-responsive" id="load_content">
                    <!--begin::Table-->
                    @include('components.pastors_table')
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
