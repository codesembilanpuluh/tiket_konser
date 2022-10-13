<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', '. : Aplikasi Tiket : .')</title>

    <link rel="stylesheet" href="{{asset('plugin/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/adminlte.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugin/dataTable-bootstrap4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/dataTable-bootstrap4/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/dataTable-buttons/css/buttons.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugin/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugin/select2/css/select2.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/loading.css')}}">


    <script type="text/javascript" src="{{asset('plugin/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript">
		var tokenCSRF   = jQuery('meta[name="csrf-token"]').attr('content');
		$(document).ready(function() {
			$('.preload-wrapper').show();
		});
    </script>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background: url('{{asset('img/seamless.png')}}');">

    <div class="preload-wrapper">
        <div id="preloader_1">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="wrapper">
        @include('admin.layout.navbar')
        @include('admin.layout.sidebar')
        <div class="content-wrapper" style="padding-top: 10px;">
            @yield('content')
        </div>
    </div>


    <div class='modal fade in' id='modal-detail' data-keyboard="false" data-backdrop="static" tabindex='0' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog' id="modal-size">
            <div class='modal-content'>
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class='modal-body' id="modal-body"></div>
                <div class="modal-footer justify-content-between" id="modal-footer"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('assets/js/adminlte.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('plugin/dataTable-bootstrap4/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/dataTable-bootstrap4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/dataTable-bootstrap4/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/dataTable-bootstrap4/js/responsive.bootstrap4.min.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('plugin/dataTable-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/dataTable-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/select2/js/select2.min.js')}}"></script>
    

    <script type="text/javascript" src="{{asset('plugin/sweet_alert.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>

    @yield('custom_js',' ')
    <script type="text/javascript">
        $(function(){
            $('.preload-wrapper').hide();
        });
    </script>
    
</body>
</html>