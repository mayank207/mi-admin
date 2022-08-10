<form role="form" action="{{route('register.step.three')}}" method="post" id="form_step_3" class="login-box">
    @csrf
    <div class="row border rounded">
        <div class="col-12 col-md-6 col-lg-4 px-md-0 text-center d-none d-md-block">
            <img src="{{asset('img/buisness_821.png')}}" class="w-100 h-100 object-fit-cover max-h-738px" alt="">
        </div>
        <div class="col-12 col-md-6 col-lg-8">
            <div class="row  p-md-3 p-lg-5 py-4">
                <div class="col-12 mt-4">
                    <div class="alert alert-danger custom-error-msg d-none" role="alert"></div>
                </div>

                <div class="col-12 ">
                    <h1 class="text-slate-green font-24 font-weight-bold font-mulish">Electronic signature from business owner
                    </h1>
                    <div class="font-14 font-mulish">
                        Please click the “Signature” button to sign this preapproval process for the business owner. Once you have signed your name, chosen your response and submitted this form, the business owner will be notified whether their application was approved or rejected. Thank you for your continual help in ensuring our Christian standards.
                    </div>
                    <input type="hidden" value="" id="drawsignbase" name="signature">
                    <button type="button" class="btn btn-secondary py-3 btn-block" data-toggle="modal" data-target="#myModal1" style="margin-top: 27px;" >Signature</button>
                    <img id="signature_image" class="d-none mt-3" src="" width="150" />
                    <div class="text-danger d-none" id="signature-error">Signature is required.</div>
                </div>
                <input type="hidden" value="" name="is_church_added" id="is_church_added">
                <div class="col-12 mt-2 custom-select2 mt-4">
                    <select name="added_church_name" id="added_church_name" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-5" data-control="select2" id="added_church_name" required data-error="#error-added_church_name">
                        <option value="">Select Church</option>
                        @foreach ($getAllChurch as $item)
                            <option value="{{$item->email}}">{{$item->name}} ({{$item->email}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-1">
                    <ul class="list-inline d-flex justify-content-end font-mulish">
                        <li>
                            <a href="#" class="add_church" data-toggle="modal" data-target="#addChurchModal">Add Church</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12" id="error-added_church_name"></div>
                <div class="col-12 mt-4">
                    <div class="church-email py-3"></div>

                    <input class="form-control h-auto py-3" id="church_email" type="hidden" name="church_email" placeholder="Church Email" readonly>
                </div>
                <div class="col-12 mt-5">
                    <ul class="list-inline d-flex justify-content-between align-items-center font-mulish">
                        <li>
                            <button type="submit" class="btn bg-slate-green text-white font-16 font-weight-bold px-4 py-2 br-6" id="submit-form-btn">Submit</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Draw Signature</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="wrapper signature-wrap text-center" >
                    <canvas id="signature-pad1" class="signature-pad" width=400 height=200></canvas>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save1" class="btn btn-primary" data-dismiss="modal">Save</button>
                <button type="button" id="clear1" class="btn btn-secondary">Clear</button>
            </div>
        </div>
    </div>
</div>
    <div id="addChurchModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h4 class="modal-title">Add Church</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body p-2 m-2">
                    <form action="{{route('add.church')}}" id="add_church_form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="church_name">Church Name</label> <span class="text-danger">* </span>
                                <input type="text" name="church_name" id="church_name" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="Church Name">
                                @if ($errors->has('church_name'))
                                <div class="error"><strong>{{ $errors->first('church_name') }}</strong></div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="church_email">Church Email</label> <span class="text-danger">* </span>
                                <input type="email" name="church_email" id="church_email" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="Church Email">
                                @if ($errors->has('church_email'))
                                <div class="error"><strong>{{ $errors->first('church_email') }}</strong></div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="church_address">Address Line 1</label> <span class="text-danger">* </span>
                                <input type="text" name="church_address" id="church_address" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="Address Line 1">
                                @if ($errors->has('church_address'))
                                <div class="error"><strong>{{ $errors->first('church_address') }}</strong></div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="church_address_2">Address Line 2</label>
                                <input type="text" name="church_address_2" id="church_address_2" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="Address Line 2">
                                @if ($errors->has('church_address_2'))
                                <div class="error"><strong>{{ $errors->first('church_address_2') }}</strong></div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="church_city">City</label> <span class="text-danger">* </span>
                                <input type="text" name="church_city" id="church_city" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="City">
                                @if ($errors->has('church_city'))
                                <div class="error"><strong>{{ $errors->first('church_city') }}</strong></div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="church_zip_code">Zip Code</label> <span class="text-danger">* </span>
                                <input type="text" name="church_zip_code" id="church_zip_code" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="Zip Code">
                                @if ($errors->has('church_zip_code'))
                                 <div class="error"><strong>{{ $errors->first('church_zip_code') }}</strong></div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="church_state">State</label> <span class="text-danger">* </span>
                                <input type="text" name="church_state" id="church_state" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="State">
                                @if ($errors->has('church_state'))
                                    <div class="error"><strong>{{ $errors->first('church_state') }}</strong></div>
                                @endif
                            </div>
                            <div class="col-md-6 custom-select2">
                                <label for="country">Country</label> <span class="text-danger">* </span>
                                <select name="country" id="country" required class="form-control bg-light-gray border-0 rounded-0 h-auto"  data-control="select2" required data-error="#error-country">
                                    @foreach ($AllContries as $code)
                                    <option value="{{$code->id}}" {{($code->id==239) ?'selected':''}} >{{$code->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="row mt-2 custom-select2">
                            <div class="col-md-12">
                                <label for="denomination">Denomination</label> <span class="text-danger">* </span>
                                <select name="denomination" data-error="#error-denomination" id="denomination" required class="form-control bg-light-gray border-0 rounded-0 h-auto"  data-control="select2" required>
                                    <option value="">Please Select Denomination</option>
                                    @foreach ($getChurchType as $type)
                                    <option data-title="{{$type->name}}" value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                                <div id="error-denomination"></div>

                                <input class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3 mt-4 d-none" type="text"  autocomplete="off" id="new_denomination" name="new_denomination" placeholder="Enter Your Denomination" required >
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="church_description">Description</label>
                                <textarea class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" name="church_description" id="church_description" placeholder="Description" rows="3"></textarea>
                                @if ($errors->has('church_description'))
                                    <div class="error"><strong>{{ $errors->first('church_description') }}</strong></div>
                                @endif

                            </div>
                        </div>
                        <!-- begin select pastors/leaders -->
                        <div class="text-bold">
                            <hr>
                           <b>Pastor/Leader Details</b> 
                        </div>
                        <div class="row mt-2 border-1" id="new_pastor">
                            <div class="col-md-12 mt-2">
                                <label for="name_of_leader">Name of Pastor/Leader of your church <span class="text-danger">* </span></label>
                                <input type="text" name="name_of_leader" id="name_of_leader" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="Name of Pastor/Leader of your church">
                                @if ($errors->has('name_of_leader'))
                                <div class="error"><strong>{{ $errors->first('name_of_leader') }}</strong></div>
                                @endif
                            </div>
                            <div class="col-md-12  mt-2">
                                <label for="email_of_leader">Email of Pastor/Leader of your church <span class="text-danger">* </span></label>
                                <input type="email" name="email_of_leader" id="email_of_leader" class="form-control bg-light-gray border-0 rounded-0 h-auto py-3 pl-lg-3" placeholder="Email of Pastor/Leader of your church">
                                @if ($errors->has('email_of_leader'))
                                <div class="error"><strong>{{ $errors->first('email_of_leader') }}</strong></div>
                                @endif
                            </div>
                        </div>
                        <!-- end select pators/leaders -->
                        <div class=" col-md-12 modal-footer mt-3">
                            <input type="submit" class="btn btn-lg btn-primary">
                        </div>
                    </form>
                    </div>
            </div>

        </div>
    </div>

<script src="{{ asset('assets/plugins/signature/js/signature_pad.umd.js')}}"></script>
<script>
    var signaturePad1 = new SignaturePad(document.getElementById('signature-pad1'), {
        backgroundColor: 'rgba(255, 255, 255, 0)',
        penColor: 'rgb(0, 0, 0)'
    });
    var saveButton = document.getElementById('save1');
    var cancelButton = document.getElementById('clear1');
    saveButton.addEventListener('click', function (event) {
        $('#signature-error').addClass('d-none');
        $('#form-step-three').removeClass('error');
        if (signaturePad1.isEmpty()) {
            $('#signature_image').attr('src','').addClass('d-none');
            $("#drawsignbase").val('');
        } else {
            var data = signaturePad1.toDataURL('image/png');
            $('#signature_image').attr('src',data).removeClass('d-none');
            $("#drawsignbase").val(data);
        }
    });
    cancelButton.addEventListener('click', function (event) {
        signaturePad1.clear();
    });
    $('#added_church_name').select2({
        placeholder: "Select church",
    });
    $(document).on('change', '#added_church_name', function(){
        $('#church_email').val($('#added_church_name').val());
        $.ajax({
            url: "{{route('get.church.address')}}",
            type: 'POST',
            data: {'_token':$('meta[name="csrf-token"]').attr('content'),'email':$('#added_church_name').val()},
            dataType: 'json',
            success: function (response) {
                $('.church-email').html(response.html);
            }
        });
    });

    $(document).on('click', '.add_church', function(){
        $('#new_added_church_name').val('');
        $('#new_church_email').val('');
    });

    /* add church validation */
    $("#add_church_form").validate({
        rules: {
            church_name: {
                required:true ,
                noSpace:true,
            },
            church_email: {
                required: true,
                checkemail:true,
                noSpace:true,
                remote: {
                        type: 'post',
                        url: "{{route('isChurchEmailExists')}}",
                        data: {'_token': $("input[name=_token]").val()},
                        dataFilter: function (data)
                        {
                            var json = JSON.parse(data);
                            if (json.valid === true) {
                                return '"true"';
                            } else {
                                return "\"" + json.message + "\"";
                            }
                        }
                    }
                },
            church_address:{
                required:true,
            },
            denomination:{
                required:true,
            },
            church_city:{
                required:true,
            },
            church_state:{
                required:true,
            },
            country:{
                required:true,
            },
            church_zip_code:{
                required:true,
                minlength:5,
            },
            name_of_leader:{
                required:true,
                notEqualTo : '#church_name',
            },
            email_of_leader:{
                required:true,
                checkemail:true,
                remote: {
                        type: 'post',
                        url: "{{route('isEmailExists')}}",
                        data: {'_token': $("input[name=_token]").val()},
                        dataFilter: function (data)
                        {
                            var json = JSON.parse(data);
                            if (json.valid === true) {
                                return '"true"';
                            } else {
                                return "\"" + json.message + "\"";
                            }
                        }
                    },
                notEqualTo : '#church_email',
            },
            new_denomination:{
                required:true,
            }
        },
        messages: {
            church_name: {
                required:'Please enter church name',
            },
            church_email:{
                required:"Please enter church email",
                remote:"Email is already exists",
                checkemail:"Please enter valid email",
            },
            church_address:{
                required:"Please enter your address line 1",
            },
            denomination:{
                required:"Please select denomination",
            },
            name_of_leader:{
                required:"Please enter name of pastor/leader ",
                notEqualTo: 'Same as church name not allowed',
            },
            church_city:{
                required:"Please enter your city",
            },
            church_state:{
                required:"Please enter your state",
            },
            church_zip_code:{
                required:"Please enter your zip code",
                minlength:"Enter minimum 5 digits"
            },
            email_of_leader:{
                required:"Please enter email of pastor/leader ",
                checkemail: "Please enter valid email",
                remote:"Pastor is already exists",
                notEqualTo: 'Same as church email address not allowed',
            },
            new_denomination:{
                required:"Please enter denomination",
            }
        },
        errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
        submitHandler: function (form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                dataType: 'json',
                success: function (response) {
                    if(response.status == true){
                        console.log(response.html_form);
                        $('#main_form').html(response.html_form);
                        formValidation();
                        current_form_step = 3;
                        $('.cust-form-step').removeClass('active');
                        $('#form-step-one').addClass('active');
                        $('#form-step-two').addClass('active');
                        $('#form-step-three').addClass('active');
                        $('#addChurchModal').modal('hide');
                        $('#added_church_name').prop('readonly', true);
                        $("#added_church_name").append('<option selected value="' + response.details.leader_name + '">'+response.details.church_name +'('+response.details.church_email+')</option>');
                        $('#church_email').val(response.details.leader_email);
                        $('#is_church_added').val(1);
                        $('.church-email').html('');
                        $('.church-email').html(response.html);
                    }else{
                        toastr.error('Something went wrong.');
                    }
                }
            });
            return false;
        },
        success: function(label,element) {
            label.parent().removeClass('has-danger');
        },
    });
    $('#country').select2();
    $('#denomination').select2();
    $('#leader').select2();
</script>
<script>
    $(document).on('change','#denomination',function(){
    var name = $(this).find(':selected').data('title');
        if (name == 'Other') {
            $('#new_denomination').show();
            $('#new_denomination').removeClass('d-none');
        }
        else{
            $('#new_denomination').hide();
        }
    });
</script>
