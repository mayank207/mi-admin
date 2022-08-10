@extends('customer.layouts.app')
@section('title','Church Verification for Business Owner')
@section('content')
<section class="bg-breadcrumb px-lg-4 px-xl-5">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-lg-0">
                        <li class="breadcrumb-item"><a  href="{{route('home')}}" class="font-14 font-weight-bold text-medium-gray">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a class="font-14 font-weight-bold text-medium-gray">Business Verification</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-12">
                <h1 class="text-navy-blue-dark font-40 font-weight-bold font-mulish">Church Verification for Business Owner</h1>
            </div>
        </div>
    </div>
</section>
<section class="px-lg-4 px-xl-5">
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10" id="main_form">
                <form role="form" action="{{route('church.verify.email',[$business_id,$token])}}" method="POST" id="approve_business_form" class="login-box">
                    @csrf
                    <div class="row border rounded">
                    <div class="col-12 col-md-6 col-lg-4 px-md-0 text-center d-none d-md-block">
                        <img src="{{asset('img/church_613.png')}}" class="w-100 h-60 object-fit-cover max-h-738px" alt="">
                    </div>
                        <div class="col-12 col-md-6 col-lg-8">
                            <div class="row p-md-3 px-lg-5 pb-4">
                                <div class="col-12">
                                    <h1 class="text-slate-green font-14 font-weight-bold font-mulish">Please click the “Signature” button to sign this preapproval process for the business owner. Once you have signed your name, chosen your response and submitted this form, the business owner will be notified whether their application was approved or rejected. Thank you for your continual help in ensuring our Christian standards.</h1>
                                    <input type="hidden" value="" id="drawsignbase" name="signature">
                                    <button type="button" class="btn btn-secondary py-3 btn-block" data-toggle="modal" data-target="#myModal1" style="margin-top: 27px;" >Signature</button>
                                    <img id="signature_image" class="mt-2 d-none" src="" width="150" />
                                    <div class="text-danger d-none" id="signature-error">Signature is required.</div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="church_approval" type="radio" value="1" id="approv" checked>
                                            <label class="form-check-label" for="approv">Approve</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="church_approval" type="radio" value="2" id="reject">
                                            <label class="form-check-label" for="reject">Reject</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3 reject_reason d-none">
                                    <div class="form-group">
                                        <textarea class="form-control h-auto py-3 " id="reject_reason" name="reject_reason" placeholder="Reject Resaon" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn bg-slate-green text-white font-16 font-weight-bold px-4 py-2 br-6" id="submit-form-btn">Submit</button>
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
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script src="{{ asset('assets/plugins/signature/js/signature_pad.umd.js')}}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script>
    var signaturePad1 = new SignaturePad(document.getElementById('signature-pad1'), {
        backgroundColor: 'rgba(255, 255, 255, 0)',
        penColor: 'rgb(0, 0, 0)'
    });
    var saveButton = document.getElementById('save1');
    var cancelButton = document.getElementById('clear1');
    saveButton.addEventListener('click', function (event) {
        $('#signature-error').addClass('d-none');
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
    $('input[name="church_approval"]').change(function(){
        if($(this).val() == 2){
            $('.reject_reason').removeClass('d-none');
        }else{
            $('.reject_reason').addClass('d-none');
        }
    });
    $("#approve_business_form").validate({
        rules: {
            signature:{
                required:true,
            },
            church_approval:{
                required:true,
            }
        },
        messages:{
            signature: {
                required: 'Please enter your signature',
            },
            church_approval: {
                required: 'This field is required.'
            }
        },
        submitHandler: function (form) {
            if($('#drawsignbase').val() == ""){
                $('#signature-error').removeClass('d-none');
                return false;
            }
            $('#submit-form-btn').prop('disabled',true);
            $('#submit-form-btn').append(' <i class="fa fa-spin fa-spinner"></i>');
            return true;
        },
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
</script>
<script>

</script>
@endsection
