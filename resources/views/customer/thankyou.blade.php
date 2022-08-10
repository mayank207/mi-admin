@extends('customer.layouts.app')
@section('title','Thank You')
@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-8 text-center my-2 d-block">
        <img class="my-4" src="{{asset('img/correct_img.png')}}" alt="Thank you image">
        <h1 class="my-4">Verify your email</h1>
        <h4 class="mt-3">We've sent an email to {{Auth::user()->email}} to verify your email address and active your account. The link in the email will expire in 24 hours.</h4>
        <h4 class="mt-3"><a href="{{route('resend.verification.email',['email',getEncrypted(Auth::user()->id)])}}">Click here</a> if you did not received an email</h4>
    </div>
</div>
@endsection

