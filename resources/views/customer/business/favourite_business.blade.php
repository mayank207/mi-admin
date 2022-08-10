@extends('customer.layouts.app')
@section('title','Favourite Business Listing')
@section('content')
<section class="bg-breadcrumb px-lg-4 px-xl-5">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-lg-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}" class="font-14 font-weight-bold text-medium-gray">Home</a></li>
                        <li class="breadcrumb-item"><a class="font-14 font-weight-bold text-medium-gray">Favourite Business Listing</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="text-navy-blue-dark font-40 font-weight-bold font-mulish-bold">Favourite Business Listing</h1>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid px-0">
    <div class="row load-business-list d-flex justify-content-center mt-3 m-0">
            @include('customer.components.favourite_business_listing')

    </div>
</div>
@endsection
