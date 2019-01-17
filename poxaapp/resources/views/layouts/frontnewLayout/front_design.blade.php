<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta content="" name="description">
	<meta content="" name="keywords">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Site Metas -->
    <title>Poxa App</title>
    <!-- Site Icons -->
    {{--<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />--}}
    {{--<link rel="apple-touch-icon" href="images/apple-touch-icon.png">--}}
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/frontendnew_css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontendnew_css/bootstrap-touch-slider.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/frontendnew_css/style.css')}}">
    <!-- Colors CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/frontendnew_css/colors.css')}}">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/frontendnew_css/versions.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/frontendnew_css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/frontendnew_css/custom.css')}}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>
<body class="host_version">



@include('layouts.frontnewLayout.front_header')

@yield('content')

@include('layouts.frontnewLayout.front_footer')




<!-- ALL JS FILES -->
<script type="text/javascript" src="{{ asset('public/js/frontendnew_js/all.js')}}"></script>
<!-- ALL PLUGINS -->
<script type="text/javascript" src="{{ asset('public/js/frontendnew_js/custom.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/frontendnew_js/ajax.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/frontendnew_js/luxon.js')}}"></script>
<script type="text/javascript">
@yield('script')

    var host = "{{url('/')}}"
    $(document).ready(function() {
        $('#myCarousel').carousel({
            interval: 10000
        })
    });
</script>
</body>
</html>
