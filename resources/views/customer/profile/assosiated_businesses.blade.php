<section class="m-xl-4">
<div class="row m-0">
<div class="col-lg-12 col-md-6 col-sm-12">
<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_table_users">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0" style="vertical-align: middle;">
            <th>Business Name</th>
            <th>Business Email</th>
            <th>Business Mobile Number</th>
            <th>Created At</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($businesses)>0)
        @foreach($businesses as $user)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">

                <td>
                     <div class="text-gray-800">   {{$user->business_name}}</div>
                </td>
                <td>
                     <div class="text-gray-800">   {{$user->business_email}}</div>
                </td>
                <td>
                     <div class="text-gray-800"> {{'+'. $user->country_code}}  {{$user->business_mobile_number}}</div>
                </td>
                <td>{{ date('m-d-Y', strtotime($user->created_at)); }}</td>
                <td>
                    <a href="Javascript:;" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish BusinessModal" data-user_id="{{$user->id}}" data-url="{{route('getBusinessDetails')}}">Show Details</a>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <th colspan="5" class="text-center">
                No records found
            </th>
        </tr>
        @endif
    </tbody>
</table>

{{-- Pagination --}}
<div class="custom-pagination">
    {{ $businesses->render('vendor.pagination.default') }}
</div>
{{-- END Pagination --}}
</div>
</div>
</section>