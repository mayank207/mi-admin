@extends('backend.layouts.base')

@section('title')
{!! setBreadCrumb('Business Services') !!}
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
                      <!--begin::Card title-->
                      <div class="card-title w-100 d-block">
                        <div class="row">
                            <!--begin::Search-->
                            <div class="col-md-6 mt-2">
                                <label>Search</label>
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6"><i
                                            class="fas fa-search"></i></span>
                                    <!--end::Svg Icon-->
                                    <form id="filter_form" action="{{route('business_services.index')}}" method="GET">
                                        <input type="hidden" name="status" class="input-sm form-control" id="form-status">
                                        <input type="hidden" name="page" value="1" id="filter_page">
                                        <input type="text" name="search_keyword" class="form-control form-control-solid ps-14" placeholder="Search" />
                                    </form>
                                </div>
                            </div>
                            <!--end::Search-->
                            <!-- <div class="col-md-3 mt-2 d-none">
                                    <label>Category</label>
                                    <select name="status" id="status" class="form-select form-select-solid"
                                        data-control="select2" title="Status Filter">
                                        <option value="">All</option>
                                        @foreach ($categories as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->title }} </option>
                                            @endforeach
                                    </select>
                            </div> -->
                           
                            <div class="col-md-3 mt-2 d-flex justify-content-end w-50">
                                    <!--begin::Add sub category-->
                                    <div class="mt-6" data-kt-customer-table-toolbar="base">
                                    <!--begin::sub category-->
                                    <a class="btn btn-primary" href="{{route('business_services.create')}}">Add Service</a>
                                     <!--end::sub category-->
                                     </div>
                            <!--end::sub category-->
                            </div>
                        </div>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0 table-responsive" id="load_content">
                <!--begin::Table-->
                @include('components.sub_category_table')
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

