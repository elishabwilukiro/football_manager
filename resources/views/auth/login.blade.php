<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
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
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"  value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3" id="show_hide_password">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="{{ old('password') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox">
                        <label class="form-check-label text-muted" for="checkbox">Show password</label>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </form>
                <p class="mb-1">
                    <a href="{{ route('reset-password') }}" class=" text-muted">Forgot Password.?</a>
                </p>
            </div>
        </div>      
    </div>
</body>
  
<script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>

<script type="">
$(document).ready(function () {
    $("input[name=checkbox]").on('click', function (event) {
        // event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
        }
    });

    $('form#form').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
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

// $(document).ready(function() {
//     $('#loginForm').submit(function(e) {
//         e.preventDefault();
//         var formData = $(this).serialize();

//         $.ajax({
//             type: 'POST',
//             url: '{{ route("login") }}',
//             data: formData,
//             dataType:'json'
//             success: function(response) {

//                 if (response.status == 'success') {
//                     $('#showMessage').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
//                         '<strong>'+response.message+'</strong>'+
//                         '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
//                         '<span aria-hidden="true">&times;</span>'+
//                         '</button>'+
//                     '</div>').show();
//                     // window.location.href = '/dashboard';

//                 }else{
//                     $('#showMessage').html('<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">'+
//                         '<strong>'+response.message+'</strong>'+
//                         '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
//                         '<span aria-hidden="true">&times;</span>'+
//                         '</button>'+
//                     '</div>').show();
//                 }
//             },
//             error: function(xhr, status, error) {
//                 $('#showMessage').html('<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">'+
//                     '<strong>'+xhr.responseJSON.message+'</strong>'+
//                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
//                     '<span aria-hidden="true">&times;</span>'+
//                     '</button>'+
//                 '</div>').show();

//             }
//         });
//     });
// });
</script>

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