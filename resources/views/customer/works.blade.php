@extends('customer.layouts.app')
@section('title','How It Works')
@section('content')
<section class="bg-breadcrumb px-lg-4 px-xl-5">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-lg-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}" class="font-14 font-weight-bold text-medium-gray">Home</a></li>
                        <li class="breadcrumb-item"><a class="font-14 font-weight-bold text-medium-gray">How It Works</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="text-navy-blue-dark font-40 font-weight-bold font-mulish-bold">How It Works</h1>
            </div>
        </div>
    </div>
</section>

<section class="px-lg-4 px-xl-5">
    <div class="container-fluid custom-height bg-read-book">
        <div class="row pt-5">
            <div class="col-12 col-lg-7">
                @if(isset($how_it_works->content))
                    {!! $how_it_works->content !!}
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

