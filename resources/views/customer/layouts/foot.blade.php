<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('bootstrap/js/jquery.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/slick.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/jquery-ui.js') }}"></script>
<script src="{{ asset('bootstrap/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom_v1.js?v=' . time()) }}"></script>
<script src="{{ asset('assets/js/customer_jquery.js?v=' . time()) }}"></script>
<script src="{{ asset('assets/js/bootbox.min.js') }}"></script>
<!-- Google reCAPTCHA CDN -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="{{asset('assets/js/jquery.inputmask.bundle.min.js')}}"></script>
@yield('script')
<script>
    /* validations */
    setTimeout(() => {
        $('.notice').remove();
    }, 3000);
</script>

<script>
    $(".alert").fadeTo(3000, 500).slideUp(500, function() {
        $(".alert").slideUp(500);
    });

    @if (Session::get('toast-success'))
        toastr.success('{{ Session::get('toast-success') }}');
    @endif
    @if (Session::get('toast-error'))
        toastr.error('{{ Session::get('toast-error') }}');
    @endif

</script>
