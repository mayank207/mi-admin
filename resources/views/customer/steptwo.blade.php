@php
    $statement_of_faith = App\Models\CmsModule::where('slug','statement-of-faith')->where('status',1)->first();
    $member_requirement = App\Models\CmsModule::where('slug','member-requirement')->where('status',1)->first();
@endphp
<form role="form" action="{{route('register.step.two')}}" method="post" id="form_step_2" class="login-box">
    @csrf
    <fieldset>
        <div class="row border rounded p-3">

            <div class="col-12 mt-4">
                <h1 class="font-24 text-slate-green font-weight-bold font-mulish">Membership Requirements
                </h1>

                <p class="font-italic font-16 text-slate-gray mt-4">To become a member you must
                    meet
                    all the requirements of this section and submit an application, including a
                    church leader verification. As long as you continue to meet these
                    requirements
                    and fulfill all membership responsibilities, your membership will continue.
                </p>
                <p class="font-italic font-16 text-slate-gray mt-4 pt-2">We believe the
                    following
                    membership requirements benefit all members by being Scriptural, and
                    ensuring
                    proper accountability. Kingdom retains the discretion to remove from
                    membership
                    any member whose behavior violates Biblical standards such that they may
                    bring
                    the business into disrepute. </p>
                <p class="font-italic font-16 text-slate-gray mt-4 pt-2">Our membership
                    requirements
                    strive to encourage Christian maturity and foster accountability and a
                    healthy
                    lifestyle. Therefore, we ask that all members agree to our Statement of
                    Faith
                    and to our Membership Agreement below:</p>
            </div>

            <div class="col-12">
                {{-- max-h-300px overflow-auto --}}
                <div class="bg-light-gray2 br-6 p-3">
                    <div class="font-14 font-weight-bold text-navy-blue-dark pl-4 font-mulish">
                        @if(isset($member_requirement->content))
                            {!! $member_requirement->content !!}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12">
                <hr />
            </div>

            <div class="col-12 mt-4 font-mulish">
                <h1 class="font-24 text-slate-green font-weight-bold">Statement of Faith</h1>
                <div class="font-16 font-weight-bold text-navy-blue-dark pl-4">
                    @if(isset($statement_of_faith->content))
                        {!! $statement_of_faith->content !!}
                    @endif
                </div>
            </div>

            <div class="col-12 mt-4">
                <p class="font-italic font-16 text-slate-gray mt-4">If at any time you no longer
                    meet all of these membership requirements, you must notify Kingdom
                    immediately,
                    and your membership and all privileges will be suspended unless otherwise
                    indicated.</p>
            </div>

            <div class="col-12 mt-4">
                <ul class="list-inline d-flex">
                    <li class="mr-5">
                        <label class="cus-checkbox font-16 font-weight-bold text-navy-blue-dark">
                            I agree to the Statement of Faith and to meet all the membership requirements
                            <input type="checkbox" name="agree" data-error="#error-agree" id="agree" @if(isset($agreement->agree)) checked @endif value="1">
                            <span class="checkmark mt-1" required></span>
                        </label>
                        <div id="error-agree"></div>
                    </li>
                    <li class="text-right">
                        <input type="submit"  class="btn bg-slate-green text-white font-16 font-weight-bold px-4 py-2 br-6 align-right" id="step_2" value="Next Step">
                    </li>
                </ul>
            </div>
        </div>
    </fieldset>
</form>
