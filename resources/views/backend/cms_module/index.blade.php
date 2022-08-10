@extends('backend.layouts.base')
@section('title')
{!! setBreadCrumb($page_title) !!}
@endsection
@section('content')
<!--begin::Post-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body pt-0 table-responsive" id="load_content">
                <!--begin::Table-->
                @include('components.cms_table')
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

