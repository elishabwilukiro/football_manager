<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ !empty(strtoupper($data['title']).' | '.strtoupper($data['header'])) ? strtoupper($data['title']).' | '.strtoupper($data['header']) : ''}}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/css/flash.css') }}">
</head>
<body class="hold-transition login-page">
    <p class="h1 mb-5">TAREFA</p>
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <p class="h4">{{ $data['title'] }}</p>
            </div>
            <div class="card-body">
                @include('backend.layouts._message')
                <form id="form" class="form" method="post">                    
                    @csrf    
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Reset</button>
                    </div>
                </form>
                <p class="mb-1 text-muted">
                    I've account. <a href="{{ route('login') }}" class="mr-2">Login</a>
                </p>
            </div>
        </div>
    </div>
</body>
  
<script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>

<script>
$(document).ready(function () {
    $('form#form').submit(function (e) {
        e.preventDefault();
        $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        var formData = new FormData(this);
        $.ajax({
            url: '{{ route("welcome") }}',
            type: 'POST',
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status == 200) {
                    showFlashMessage("success", data.message);
                    setTimeout(function() {
                        window.location.href = data.redirect_url;
                    }, 2000);
                } else {
                    showFlashMessage("warning", data.message);
                }
            },
            error: function(response) {
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#' + key).after('<span class="error">' + value[0] + '</span>');
                    });
                } else {
                    alert('An error occurred. Please try again.');
                }
            }
        });
    });
});
</script>

<div id="forFlash"></div>
<script type="text/javascript">
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