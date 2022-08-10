@extends('backend.layouts.base')

@section('title')
{!! setBreadCrumb('Business Services',route('business_services.index')) !!}
{!! setBreadCrumb('Edit') !!}
@endsection
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-xxl">
        <!--begin::sub category Row-->
        <div class="row g-xl-8">
            <!--begin:: column-->
            <div class="col-xl-8">
                <!--begin::sub category-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <h3 class="card-title align-items-start flex-column mb-5">
                                    <span class="fw-bolder text-dark">Edit Service</span>
                                </h3>
                                <form class="form" action="{{route('business_services.update',getEncrypted($sub_category->id))}}" id="edit_sub_category_form" method="post">
                                    @csrf
                                    @method('patch')
                                    <!-- <div class="fv-row mb-7 d-none">
                                        <label class="fs-6 fw-bold mb-2">
                                            <span class="required ">Category</span>
                                        </label>

                                        <select name="category_id" class="form-select form-select-solid" data-control="select2">

                                            @foreach ($categories as $value)
                                            <option value="{{ $value->id }}" {{ $value->id == $sub_category->category_id ? 'selected' : '' }}>
                                                {{ $value->title }} </option>
                                            @endforeach
                                        </select>
                                    </div> -->
                                    <!-- end-category names -->
                                    <!-- sub category  -->
                                    <div class="fv-row mb-7 form-group">
                                        <label class="required fs-6 fw-bold mb-2">Service Title </label>
                                        <input type="text" class="form-control form-control-solid" value="{{$sub_category->title}}" name="title"/>
                                    </div>
                                    <!-- end-sub category -->
                                     <!-- Status -->
                                     <div class="fv-row mb-15">
                                        <div class="col-md-1 px-0">
                                            <label class="fs-6 fw-bold mb-2">Status</label>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="status" type="checkbox" value="1" {{ ($sub_category->status == 1)? 'checked' : '' }} />
                                                <span class="form-check-label fw-bold text-muted" for="edit_status"></span>
                                                </label>
                                            </div>
                                        </div>
                                    <!-- end-Status -->
                                    <div class="fv-row mb-15">
                                        <!--begin::Button-->
                                        <a href="{{route('business_services.index')}}" class="btn btn-light me-3">Cancel</a>
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="edit_sub_category_form_submit" data-kt-banner-action="submit" class="btn btn-primary">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
                <!--end::sub category-->
            </div>
            <!--end:: column-->
        </div>
        <!--end::sub category Row-->
    </div>
</div>
@endsection
@section('external-scripts')
<script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
<script>
    var id="{{$sub_category->id}}";
    $("#edit_sub_category_form").validate({
    rules: {
        title: {
            required:true ,
            noSpace:true,
            remote: {
                type: 'post',
                url: "{{route('isSubCategoryExists')}}",
                data: {'_token': $("input[name=_token]").val(),id:id,},
                dataFilter: function (data)
                {
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
        title: {
            required: "Please enter service title." ,
            noSpace: "Please enter service title.",
        }
    },
    submitHandler: function (form) {
        return true;
    },
    success: function(label,element) {
        label.parent().removeClass('has-danger');
    },
});
</script>
@endsection
