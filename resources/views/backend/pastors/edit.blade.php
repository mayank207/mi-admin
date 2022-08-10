@extends('backend.layouts.base')

@section('title')
{!! setBreadCrumb('Pastors',route('pastors.index')) !!}
{!! setBreadCrumb('Edit') !!}
@endsection
@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-xxl">
        <!--begin::Row-->
        <div class="row g-xl-8">
            <!--begin:: column-->
            <div class="col-xl-8">
                <!--begin::-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <h3 class="card-title align-items-start flex-column mb-5">
                                    <span class="fw-bolder text-dark">Edit Pastor</span>
                                </h3>
                                <form class="form" action="{{route('pastors.update',getEncrypted($pastor->id))}}" id="edit_pastors_form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                     <!-- Name -->
                                    <div class="fv-row mb-4">
                                        <label class="required fs-6 fw-bold mb-2">Name</label>
                                        <input type="text" class="form-control form-control-solid" id="name" placeholder="" value="{{$pastor->name}}" name="name"/>
                                        @if ($errors->has('name'))
                                        <div class="error">
                                            <strong>{{ $errors->first('name') }}</strong></div>
                                        @endif
                                    </div>
                                    <!-- end- Name -->
                                    <!-- Email -->
                                    <div class="fv-row mb-4">
                                        <label class="required fs-6 fw-bold mb-2">
                                            <span >Email</span>
                                        </label>
                                        <input type="email" id="email" class="form-control form-control-solid" value="{{$pastor->email}}" placeholder="" name="email" />
                                        @if ($errors->has('email'))
                                        <div class="error">
                                            <strong>{{ $errors->first('email') }}</strong></div>
                                        @endif
                                    </div>
                                    <!--end-Email -->
                                    <div class="fv-row mb-15">
                                            <label class="fs-6 fw-bold mb-2">Status</label>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" name="status" type="checkbox" value="1"
                                                    {{ $pastor->status == 1 ? 'checked' : '' }} />
                                                <span class="form-check-label fw-bold text-muted" for="edit_status"></span>
                                            </label>
                                        </div>

                                    <div class="fv-row mb-15">
                                        <!--begin::Button-->
                                        <a href="{{route('pastors.index')}}" class="btn btn-light me-3">Cancel</a>
                                        <!--end::Button-->
                                        <!--begin::Button-->
                                        <input type="submit" id="edit_users_form_submit" data-kt-banner-action="submit" class="btn btn-primary">

                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>

                                    </div>
                                </form>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Container-->
                </div>
            </div>
            <!--end:: column-->
        </div>
        <!--end:: Row-->
    </div>
</div>
@endsection
@section('external-scripts')
<script>
    var id='{{$pastor->id}}';

        $("#edit_pastors_form").validate({
        rules: {
            name: {
                required:true ,
                noSpace:true,
            },
            email: {
                checkemail:true,
				required: true,
				remote: {
							type: 'post',
							url: "{{route('backend.user.email_exists')}}",
							data: {'_token': $("input[name=_token]").val(),id:id},
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
            name: 'Please enter name',
            email:{
                required:"Please enter email",
                remote:"Email is already exists",
                checkemail:"Please enter valid email",
            },
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
