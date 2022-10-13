<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Agent X </title>

    <link rel="stylesheet" href="{{asset('plugin/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/loading.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script type="text/javascript" src="{{asset('plugin/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript">
		$(document).ready(function() {
			$('.preload-wrapper').show();
		});
    </script>
</head>
<body>
    <div class="preload-wrapper">
        <div id="preloader_1">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container">
            <div class="header-container d-flex align-items-center">
                <div class="logo mr-auto">
                    <h1 class="text-light"><a href="#"><span>Agent X</span></a></h1>
                </div>
                <nav class="nav-menu d-none d-lg-block">
                    <ul>
                        <li class="active"><a href="{{asset('/')}}">Home</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    @yield('content')

    {{-- <main id="main">
        sdsdf
    </main> --}}


    <script type="text/javascript" src="{{asset('plugin/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugin/sweet_alert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>


    @yield('custom_js',' ')

    <script type="text/javascript">
        $(function(){
            $('.preload-wrapper').hide();
        });
    </script>
    
</body>
</html>