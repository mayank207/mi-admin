@extends('backend.layouts.base')
@section('title')
    {!! setBreadCrumb('Denomination', route('denomination.index')) !!}
    {!! setBreadCrumb('Add') !!}
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-xxl">
            <div class="row g-xl-8">
                <!--begin::category column-->
                <div class="col-xl-8">
                    <!--begin::Post-->
                    <div class=" d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <h3 class="card-title align-items-start flex-column mb-5">
                                        <span class="fw-bolder text-dark">Add Denomination</span>
                                    </h3>
                                    <form class="form" action="{{ route('denomination.store') }}"
                                        id="add_denomination" method="post">
                                        @csrf
                                        <!-- Title -->
                                        <div class="fv-row mb-7 form-group">
                                            <label class="required fs-6 fw-bold mb-2">Name</label>
                                            <input type="text" class="form-control form-control-solid" name="name" id="name"/>
                                            @if ($errors->has('name'))
                                                <div class="error">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- end-Title -->
                                        <div class="fv-row mb-7 form-group">
                                            <label class="fs-6 fw-bold mb-2">Display Order Number</label>
                                            <input type="text" class="form-control form-control-solid" name="display_order" />
                                        </div>
                                        <div class="fv-row mb-15">
                                            <!--begin::Button-->
                                            <a href="{{ route('denomination.index') }}" class="btn btn-light me-3">Cancel</a>
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <button type="submit" id="add_denomination_form_submit"
                                                data-kt-banner-action="submit" class="btn btn-primary">
                                                <span class="indicator-label">Submit</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                {{-- end denomination column --}}
            </div>
        </div>
    </div>
@endsection
@section('external-scripts')
<script>
        var id = '0';
        $("#add_denomination").validate({
            rules: {
                name: {
                    required: true,
                    noSpace: true,
                    remote: {
                        type: 'post',
                        url: "{{ route('isDenominationExists') }}",
                        data: {
                            '_token': $("input[name=_token]").val(),
                            id: id
                        },
                        dataFilter: function(data) {
                            console.log(data);
                            var json = JSON.parse(data);
                            if (json.valid === true) {
                                return '"true"';
                            } else {
                                return "\"" + json.message + "\"";
                            }
                        }
                    }
                },
                display_order: {
                    digits: true,
                    min: 1,
                    maxlength : 3,
                },
            },
            messages: {
                name: {
                    required: 'Please enter denomination',
                },
                display_order: {
                    digits: "Please enter valid value",
                    maxlength: "Maximum 3 digit value is allowed",
                },
              
            },
            submitHandler: function(form) {
                return true;
            },
            success: function(label, element) {
                label.parent().removeClass('has-danger');
            },
        });
    </script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
@endsection
