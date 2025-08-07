@isset($errors)
    @if (count($errors) > 0)
        <script>
            $(document).ready(function () {
                @foreach ($errors->all() as $error)
                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "rtl": 1
                }
                Command: toastr["error"]("{!! $error !!}", "");
                @endforeach
            });
        </script>
    @endif

@endisset
