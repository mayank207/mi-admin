@extends('backend.layouts.base')
@section('title')
{!! setBreadCrumb('Csm Module',route('cms.module')) !!}
{!! setBreadCrumb($page_title) !!}
@endsection
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-xxl">
        <div class="row g-xl-8">
            <!--begin::church column-->
            <div class="col-xl-12">
                <!--begin::Post-->
                <div class=" d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <h3 class="card-title align-items-start flex-column mb-5">
                                    <span class="fw-bolder text-dark">{{getCMSTitle($cms_module->slug)}}</span>
                                </h3>
                                <form class="form" action="{{route('cms.update',$slug)}}" id="about-us-form" method="post">
                                    @csrf
                                    <!-- Name -->
                                    <div class="fv-row form-group mb-0">
                                        <label class="required fs-6 fw-bold mb-2">Content</label>
                                        <textarea class="form-control form-control-solid" id="aboutus-content" data-error="#content-error" name="content"> @if(isset($cms_module->content)) {!! $cms_module->content !!} @endif </textarea>
                                    </div>
                                    <div class="fv-row mb-7 mt-2" id="content-error"></div>
                                    <!-- end-Name -->
                                    <div class="fv-row mb-15">
                                        <!--begin::Button-->
                                        <a href="{{route('backend.home')}}" class="btn btn-light me-3">Cancel</a>
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <button type="submit" id="add_church_form_submit" data-kt-banner-action="submit" class="btn btn-primary">
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
                <!--end::Post-->
            </div>
            {{-- end church column --}}
        </div>
    </div>
</div>
@endsection
@section('external-scripts')
<script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
<script>
    ClassicEditor.create(document.querySelector('#aboutus-content'))
    .then(editor => {
    })
    .catch(error => {
    });

    $("#about-us-form").validate({
        ignore: [],
        debug: false,
        rules: {
            content: {
                required:true,
            }
        },
        messages: {
            content: {
                required:'Content is required.',
            }
        },
        submitHandler: function (form) {
            return true;
        },
        success: function(label,element) {
            label.parent().removeClass('has-danger');
        },
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
</script>
@endsection
