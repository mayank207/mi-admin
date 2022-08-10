<div id="contactModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Contact Us</h5>
          <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <form action="{{route('business.contact_now')}}" id="contact_now_form" method="post" class="row">
                @csrf
                <input type="hidden" id="business_id" name='business_id'>
                <div class="col-md-12">
                    <p class="font-14">Fill out this contact form and we’ll get you in touch with this business.  Be sure to provide accurate contact information and a description of what you are looking for.</p>
                </div>
                <div class="col-md-12">
                    <label for="name">Name</label> <span class="text-danger">* </span>
                    <input type="text" name="name" id="name" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="Name">
                    @if ($errors->has('name'))
                    <div class="error"><strong>{{ $errors->first('name') }}</strong></div>
                    @endif
                </div>

                <div class="col-md-12">
                    <label for="email">Email</label> <span class="text-danger">* </span>
                    <input type="email" name="email" id="email" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="Email" required>
                    @if ($errors->has('email'))
                    <div class="error">
                        <strong>{{ $errors->first('email') }}</strong></div>
                    @endif
                </div>

                <div class="col-md-12">
                    <label for="mobile">Mobile Number</label> <span class="text-danger">* </span>
                    <input type="text" name="mobile_number"  id="mobile_number" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 mobile_input_mask" placeholder="Mobile number" required>
                    @if ($errors->has('mobile_number'))
                    <div class="error">
                        <strong>{{ $errors->first('mobile_number') }}</strong></div>
                    @endif
                </div>
                <div class="col-md-12">
                <label for="description">Description</label> <span class="text-danger">* </span>
                    <textarea name="description" id="description" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" required></textarea>
                    @if ($errors->has('description'))
                    <div class="error">
                        <strong>{{ $errors->first('description') }}</strong></div>
                    @endif
                </div>
                <div class="col-md-12 mt-3">
                    <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.sitekey')}}"></div>
                    @if ($errors->has('g-recaptcha-response'))
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                    @endif
                </div>
                <div class=" col-md-12 modal-footer mt-3 pb-0">
                    <button type="submit" class="btn text-white bg-navy-blue br-6 font-16 font-weight-bold shadow-none px-4 py-2 font-mulish submit-form-btn">Submit</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
