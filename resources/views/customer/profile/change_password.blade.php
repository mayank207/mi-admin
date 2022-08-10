<section class="m-xl-4">
    <div class="row m-0">
        <div class="col-12 col-md-6">
            <b>Change Password :</b>
            <div class="card-body px-0">
                <form class="form" url="{{ route('profile.change_password') }}" id="change_password_form"
                    method="post">
                    @csrf
                    <!-- current Password -->
                    <div class="fv-row form-group mb-4">
                        <label class="fs-6 fw-bold mb-2"> Current Password</label><span
                            class="text-danger">&nbsp;*</span>
                        <input type="password" class="form-control border-1 rounded-0 h-auto" value=""
                            name="current_password" id="current_password" required placeholder="Current Password" />
                        @if ($errors->has('current_password'))
                            <span class="text-danger">{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>
                    <!-- end-current Password -->

                    <!-- Password-->
                    <div class="fv-row form-group mb-4">
                        <label class="fs-6 fw-bold mb-2"> New Password</label><span class="text-danger">
                            &nbsp;*</span>
                        <input type="password" id="password" class="form-control border-1 rounded-0 h-auto" value=""
                            name="password" required placeholder="New Password" />
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <!-- end-Password-->

                    <!-- Confirm Password -->
                    <div class="fv-row form-group mb-4">
                        <label class="fs-6 fw-bold mb-2"> Confirm Password</label><span
                            class="text-danger">&nbsp;*</span>
                        <input type="password" class="form-control border-1 disabled rounded-0 h-auto" value=""
                            name="confirm_password" id="confirm_password" required placeholder="Confirm Password" />
                        @if ($errors->has('confirm_password'))
                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        @endif
                    </div>
                    <!-- end-Confirm Password -->

                    <div class="fv-row d-flex justify-content-end mt-5">
                        <!--begin::Button-->
                        <button type="submit"
                            class="btn bg-navy-blue br-6 font-16 font-weight-bold font-mulish px-4 py-2 text-white shadow-none"
                            id="frm-change-password-submit">Update</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-12 col-md-6">

        </div>
    </div>
</section>
