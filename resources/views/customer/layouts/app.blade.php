<html>
<head>
    {{-- Style --}}
    @include('customer.layouts.head')
    {{-- END Style --}}
</head>

<body>
    @php
    $all_categories= App\Models\SubCategory::where('status',1)
        ->where('is_delete',0)
        ->where('status',1)
        ->orderBy('id','desc')
        ->limit(12)
        ->get();
    @endphp
    {{-- Header --}}
    @include('customer.layouts.header')
    {{-- END Header --}}

    {{-- Content --}}
    @yield('content')
    {{-- END Content --}}

    {{-- Footer --}}
    @include('customer.layouts.footer')
    {{-- END Footer --}}

    @if(Auth::check())
    @include('customer.components.business_review')
    @endif

    {{-- Script --}}
    @include('customer.layouts.foot')
    {{-- END Script --}}
</body>

</html>
