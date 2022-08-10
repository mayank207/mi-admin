    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
        <thead>
            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                <th>
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input type="checkbox" class="form-check-input" name="select_all" value="1" id="search-select-all">
                    </div>
                </th>
                <th>Customer Details</th>
                <th>Ratings</th>
                <th>Comment</th>
                <th>Date & time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 fw-bold">
            @if(count($reviews)>0)
            @foreach($reviews as $review)
                <tr class="py-5 fw-bold  border-bottom border-gray-300 fs-6">
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input type="checkbox" name="reviews_id[]" value="{{$review->id}}" class="form-check-input selected_rows" id="bulk_update_id">
                        </div>
                    </td>
                    <td>
                        <img src="{{ isset($review->users_details) && isset($review->users_details->profile_photo) ? $review->users_details->profile_photo : asset('img/user-profile.png')}}" alt="" height="40px" width="40px">
                        {{ isset($review->users_details) ? $review->users_details->name : ''}}
                    </td>

                    <td>
                    @for ($i = 1; $i <= 5; $i++)
                            @if ($i<=$review->rating)
                                <img src="{{asset('img/Star-fill.png')}}" class="img-fluid ml-1" alt="">
                            @else
                                <img src="{{asset('img/Star-blank.png')}}" class="img-fluid ml-1" alt="">
                            @endif
                    @endfor
                    </td>

                    <td>{{ $review->comment }}</td>

                    <!--begin::created at date-->
                    <td>{{ date('m-d-Y h:i A', strtotime($review->created_at)); }}</td>
                    <!--end::created at date-->

                    <td>
                        <button class="btn btn-sm btn-danger delete_row" data-title="review" data-href="{{route('review.destroy',getEncrypted($review->id))}}" data-contact_id ="{{getEncrypted($review->id)}}" data-kt-customer-table-filter="delete_row" ><i class="fas fa-trash" style="margin-left: 5px;"></i></button>
                    </td>
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
        {{ $reviews->render('vendor.pagination.default') }}
    </section>
    {{-- END Pagination --}}
</div>
