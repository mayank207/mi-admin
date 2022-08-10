<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="load_content">
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th>Transaction Id</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date & Time</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold">
        @if(count($subscription_history)>0)
        @foreach($subscription_history as $history)
            <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                <td>
                    {{ $history->profile_id }}
                </td>
                <td>
                    @if($history->status == 1 || $history->status == 2 )
                        {{ date('m/d/Y', strtotime($history->start_date)); }}
                    @else
                        <div class="ml-5">-</div>
                    @endif
                </td>
                <td>
                    @if($history->status == 1 || $history->status == 2 )
                        {{ date('m/d/Y', strtotime($history->end_date)); }}
                    @else
                        <div class="ml-5">-</div>
                    @endif
                </td>

                <td>
                    @if($history->subscription)
                     {{ $history->subscription->price . ' $'}}
                    @else
                     {{'-'}}
                    @endif
                </td>

                <td>@if($history->status == 0)
                    {{'Transaction Initiated'}}
                    @elseif($history->status == 1)
                    {{'Subscribe successfully'}}
                    @elseif($history->status == 2)
                    {{'Subscription Renew'}}
                    @elseif($history->status == 3)
                    {{'Subscription Cancelled'}}
                    @endif
                </td>

                <!--begin::created at date-->
                <td>{{ date('m/d/Y H:i:s', strtotime($history->created_at)); }}</td>
                <!--end::created at date-->
            </tr>
        @endforeach
        @else
        <tr>
            <th colspan="6" class="text-center"> No records found </th>
        </tr>
        @endif
    </tbody>
</table>

{{-- Pagination --}}
<section class="custom-pagination">
    {{ $subscription_history->render('vendor.pagination.default') }}
</section>
{{-- END Pagination --}}
