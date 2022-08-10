<div id="reviewModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Review</h5>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-4">
                <form action="{{ route('business.review') }}" id="review_form" method="post" class="row mb-0">
                    @csrf
                    <input type="hidden" name="business_id" id="hidden_business_id">
                    <div class="col-md-12">
                        <div class="custom-give-rating rating">
                            <input type="radio" name="rating" data-error="#rating-error" value="5" id="5"><label for="5">☆</label>
                            <input type="radio" name="rating" data-error="#rating-error" value="4" id="4"><label for="4">☆</label>
                            <input type="radio" name="rating" data-error="#rating-error" value="3" id="3"><label for="3">☆</label>
                            <input type="radio" name="rating" data-error="#rating-error" value="2" id="2"><label for="2">☆</label>
                            <input type="radio" name="rating" data-error="#rating-error" value="1" id="1"><label for="1">☆</label>
                        </div>
                        <div class="error" id="rating-error"></div>
                    </div>
                    <div class="col-md-12">
                        <label class="required">Review</label>
                        <textarea name="review" id="review" rows="5" class="form-control bg-light-gray border rounded h-auto py-3 pl-lg-3" placeholder="Add description." required></textarea>
                    </div>
                    <div class=" col-md-12 modal-footer mt-3 pb-0">
                        <button type="submit" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish submit-form-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
