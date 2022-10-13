<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>: : Login : :</title>

    <link rel="stylesheet" href="{{asset('plugin/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">

    <style>
        body {
            background-image: linear-gradient(#004995, #00162d);
        }
        .card {
            background-color: transparent;
            border: none !important;
            border-radius:  none !important;
        }
        .login-card-body, .register-card-body {
            background-color: #ffffff1c;
            color: #fff;
            padding: 40px 30px;
        }
        .login-card-body .input-group .input-group-text, .register-card-body .input-group .input-group-text {
            background-color: #00162d;
            color: #fff;
        }
        .input-group-text {
            border:none;
            border-radius: 0px !important;
        }
        .form-control {
            border-radius: 0px !important;
        }
    </style>

    <script type="text/javascript" src="{{asset('plugin/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript">
		$(document).ready(function() {
			$('.preload-wrapper').show();
		});
    </script>

</head>
<body class="hold-transition login-page">
    <div class="preload-wrapper">
        <div id="preloader_1">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="login-box">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Login Administrator</p>
            
                    <form id="login_form">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                            
                        
                    </form>
                </div>
            </div>

        </div>

    <script type="text/javascript" src="{{asset('plugin/sweet_alert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/adminlte.min.js')}}"></script>
    
    <script>
        $(function(){
            $('.preload-wrapper').hide();
        });

        $('#login_form').on('submit', function(event) {
            event.preventDefault();
            idata = new FormData($('#login_form')[0]);

            $.ajax({
                type	: "POST",
                dataType: "json",
                url		: "{{asset('admin/login')}}",
                data	: idata,
                processData: false,
                contentType: false,
                cache 	: false,
                beforeSend: function () { 
                    $('.preload-wrapper').show();
                },
                success	:function(data) {
                    window.location.href = "{{ asset('admin') }}";
                },
                error: function (error) {
                    console.log(error);
                    if(error.responseJSON.status=="warning") {
                        swal('Warning',''+error.responseJSON.messages+'','warning');
                        return false;

                    } else if(error.responseJSON.status=="error") {
                        swal('Error',''+error.responseJSON.messages+'','error');
                        return false;
                    } else {
                        swal(''+error.status+'',''+error.responseJSON.message+'','error');
                        return false;
                    }
                    $('.preload-wrapper').hide();
                }
            });
        });
    </script>
</body>
</html>