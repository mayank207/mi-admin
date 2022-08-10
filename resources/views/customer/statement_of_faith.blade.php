@extends('customer.layouts.app')
@section('title','Statement Of Faith')
@section('content')
<section class="bg-breadcrumb px-lg-4 px-xl-5">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-lg-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}" class="font-14 font-weight-bold text-medium-gray">Home</a></li>
                        <li class="breadcrumb-item"><a class="font-14 font-weight-bold text-medium-gray">Statement Of Faith</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="text-navy-blue-dark font-40 font-weight-bold font-mulish-bold">Statement Of Faith</h1>
            </div>
        </div>
    </div>
</section>

<section class="px-lg-4 px-xl-5">
    <div class="col-12 mt-4">

        @if(isset($statement_of_faith->content))
            {!! $statement_of_faith->content !!}
        @endif
    </div>

</section>
@endsection
