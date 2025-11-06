<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ !empty(strtoupper($data['header']).' | '.strtoupper($data['title'])) ? strtoupper($data['header']).' | '.strtoupper($data['title']) : ''}}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flash.css') }}">


<script src="{{ asset('assets/plugins/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jquery.min.js')}}"></script>

    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
  {{-- <!-- Tempusdominus Bootstrap 4 --> --}}
  {{-- <link rel="stylesheet" href="{{ url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
  <!-- iCheck -->
  {{-- <link rel="stylesheet" href="{{ url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
  <!-- JQVMap -->
  {{-- <link rel="stylesheet" href="{{ url('assets/plugins/jqvmap/jqvmap.min.css') }}"> --}}
  <!-- Theme style -->
  <!-- overlayScrollbars -->
  {{-- <link rel="stylesheet" href="{{ url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> --}}
  <!-- Daterange picker -->
  {{-- <link rel="stylesheet" href="{{ url('assets/plugins/daterangepicker/daterangepicker.css') }}"> --}}
  <!-- summernote -->
  {{-- <link rel="stylesheet" href="{{ url('assets/plugins/summernote/summernote-bs4.min.css') }}"> --}}

{{-- <script src="{{ asset('assets/jquery.slim.min.js')}}"></script> --}}
{{-- <script src="{{ asset('assets/bootstrap.bundle.min.js')}}"></script> --}}
</head>

@php 
if (!Auth::check()) {
    Auth::logout();
    redirect()->route('login');
    exit;
}
@endphp
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('backend.layouts.navbar')
        @include('backend.layouts.sidebar')
        @yield('content')
        @include('backend.layouts.footer')
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
</body>

<!-- jQuery Core Js -->
{{-- <script src="{{ asset('assets/jquery.slim.min.js')}}"></script> --}}
{{-- <script src="{{ asset('assets/bootstrap.bundle.min.js')}}"></script> --}}
<script src="{{ url('assets/js/adminlte.js') }}"></script>


<script src="{{ url('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jquery.min.js')}}"></script>
<script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
{{-- <script src="{{ url('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
{{-- <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
<!-- ChartJS -->
{{-- <script src="{{ url('assets/plugins/chart.js/Chart.min.js') }}"></script> --}}
<!-- Sparkline -->
{{-- <script src="{{ url('assets/plugins/sparklines/sparkline.js') }}"></script> --}}
<!-- JQVMap -->
{{-- <script src="{{ url('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
{{-- <script src="{{ url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src="{{ url('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
<!-- daterangepicker -->
{{-- <script src="{{ url('assets/plugins/moment/moment.min.js') }}"></script> --}}
{{-- <script src="{{ url('assets/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
<!-- Tempusdominus Bootstrap 4 -->
{{-- <script src="{{ url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
<!-- Summernote -->
{{-- <script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
<!-- overlayScrollbars -->
{{-- <script src="{{ url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ url('assets/js/demo.js') }}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ url('assets/js/pages/dashboard.js') }}"></script> --}}

<div id="forFlash"></div>
<script type="text/javascript">
    function showWarningToast(title, message) {
        Swal.fire({
            icon: 'warning',
            title: title,
            text: message,
            showConfirmButton: true,
            timer: 5000
        });
    }

    function showSuccessToast(title, message) {
        Swal.fire({
            icon: 'success',
            title: title,
            text: message,
            showConfirmButton: false,
            timer: 6000
        });
    }

    function showErrorToast(title, message) {
        Swal.fire({
            icon: 'error',
            title: title,
            text: message,
            showConfirmButton: true,
            timer: 10000
        });
    }

    function disableBtn(btn, access) {

        if (access) {
            $('#' + btn).prop("disabled", true);
            // add spinner to button
            $('#' + btn).html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
            );
        } else {
            $('#' + btn).prop("disabled", false);
            // add spinner to button
            $('#' + btn).html("Save")
        }

    }

    function removeSpecialCharacter(text) {
        var sanitizedValue = text.replace(/[!@#$%^&*()\-_=+\[\]{}|\\;:'",.<script>\/?]/g, "");
        return sanitizedValue
    }

    function showFlashMessage(indicator, message) {

        if (indicator == "danger") {
            $("#forFlash").html('<div id="flash-message"><span class="flashmessage"></span></div>')
            var flashMessage = document.getElementById('flash-message');
        }
        if (indicator == "success") {
            $("#forFlash").html('<div id="flash-message-success"><span class="flashmessage"></span></div>')
            var flashMessage = document.getElementById('flash-message-success');
        }
        if (indicator == "warning") {
            $("#forFlash").html('<div id="flash-message-warning"><span class="flashmessage"></span></div>')
            var flashMessage = document.getElementById('flash-message-warning');
        }

        var messageElement = flashMessage.querySelector('.flashmessage');

        messageElement.innerText = message;
        flashMessage.style.display = 'block';

        var secondsLeft = 10;
        var countdown = setInterval(function() {
            secondsLeft--;

            if (secondsLeft >= 0) {
                messageElement.innerText = message + ' (' + secondsLeft + 's)';
            } else {
                clearInterval(countdown);
                flashMessage.style.display = 'none';
                $("#forFlash").html('')
            }
        }, 1000);
    }

    function formatDate(dateString) {
        const date = new Date(dateString);

        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();

        const formattedDate = `${day}/${month}/${year}`;

        return formattedDate;
    }
</script>
</html>
