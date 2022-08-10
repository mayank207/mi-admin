@extends('customer.layouts.app')
@section('title','Terms & Conditions')
@section('content')
<section class="bg-breadcrumb px-lg-4 px-xl-5">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-lg-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}" class="font-14 font-weight-bold text-medium-gray">Home</a></li>
                        <li class="breadcrumb-item"><a class="font-14 font-weight-bold text-medium-gray">Membership Requirements</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="text-navy-blue-dark font-40 font-weight-bold font-mulish-bold">Membership Requirements</h1>
            </div>
        </div>
    </div>
</section>

<section class="px-lg-4 px-xl-5">
    <div class="col-12 mt-4">

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

        @if(isset($member_requirement->content))
            {!! $member_requirement->content !!}
        @endif
    </div>

</section>
@endsection
