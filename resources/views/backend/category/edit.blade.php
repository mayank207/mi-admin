@extends('backend.layouts.base')
@section('title')
    {!! setBreadCrumb('Category', route('category.index')) !!}
    {!! setBreadCrumb('Edit') !!}
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-xxl">
            <div class="row g-xl-8 ">
                <!--begin::edit category column-->
                <div class="col-xl-8">
                    <!--begin::edit category form-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <h3 class="card-title align-items-start flex-column mb-5">
                                        <span class="fw-bolder text-dark">Edit Category</span>
                                    </h3>
                                    <form class="form"
                                        action="{{ route('category.update', getEncrypted($category->id)) }}"
                                        id="edit_category_form" method="post">
                                        @csrf
                                        @method('patch')
                                        <!-- Name -->
                                        <div class="fv-row mb-7 form-group">
                                            <label class="required fs-6 fw-bold mb-2">Title</label>
                                            <input type="text" class="form-control form-control-solid"
                                                value="{{ $category->title }}" name="title" />
                                        </div>
                                        <!-- end-Name -->
                                        <!-- Status -->
                                        <div class="fv-row mb-15">
                                            <label class="fs-6 fw-bold mb-2">Status</label>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="status" type="checkbox" value="1"
                                                    {{ $category->status == 1 ? 'checked' : '' }} />
                                                <span class="form-check-label fw-bold text-muted" for="edit_status"></span>
                                            </label>
                                        </div>
                                        <!-- end-Status -->
                                        <div class="fv-row mb-15">
                                            <!--begin::Button-->
                                            <a href="{{ route('category.index') }}" class="btn btn-light me-3">Cancel</a>
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <button type="submit" id="edit_category_form_submit"
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
                    <!--end::edit category form-->
                </div>
                <!--end::edit category column-->
            </div>
        </div>
    </div>
@endsection
@section('external-scripts')
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script>
        var id = "{{ $category->id }}";
        $("#edit_category_form").validate({
            rules: {
                title: {
                    required: true,
                    noSpace:true,
                    remote: {
                        type: 'post',
                        url: "{{ route('isCategoryExists') }}",
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
            },
            messages: {
                title: 'Please enter category title',

            },
            success: function(label, element) {
                label.parent().removeClass('has-danger');
            },
        });
    </script>
@endsection
