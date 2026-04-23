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
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/flash.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('assets/plugins/daterangepicker/daterangepicker.css') }}"> --}}
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
<script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": false,
      "searching": true,
      "ordering": true,
      "paging": true,
      "info": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
{{-- <script src="{{ url('assets/plugins/moment/moment.min.js') }}"></script> --}}
{{-- <script src="{{ url('assets/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
<script src="{{ url('assets/js/adminlte.min.js') }}"></script>
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
