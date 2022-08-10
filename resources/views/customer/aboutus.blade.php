@extends('customer.layouts.app')
@section('title','About')
@section('content')
<section class="bg-breadcrumb px-lg-4 px-xl-5 ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-lg-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}" class="font-14 font-weight-bold text-medium-gray">Home</a></li>
                        <li class="breadcrumb-item"><a class="font-14 font-weight-bold text-medium-gray">About</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="text-navy-blue-dark font-40 font-weight-bold font-mulish-bold">Learn More About Kingdom</h1>
            </div>
        </div>
    </div>
</section>
<section class="px-lg-4 pl-xl-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-7 pt-5 order-2 order-lg-1">
                @if(isset($aboutus->content))
                    {!! $aboutus->content !!}
                @endif
            </div>
            <div class="col-12 col-lg-5 text-right order-1 order-lg-2">
                <img src="{{asset('img/aboutus.png')}}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>
@endsection

