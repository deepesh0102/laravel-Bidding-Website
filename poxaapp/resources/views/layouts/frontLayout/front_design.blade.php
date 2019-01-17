<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	<meta charset="utf-8">
	<title>POXA APP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta content="" name="description">
	<meta content="" name="keywords">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend_css/bootstrap.css')}}" media="screen">	
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend_css/font-awesome.min.css')}}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend_css/style.css')}}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend_css/responsive.css')}}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend_css/fonts.css')}}" media="screen">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend_css/owl.carousel.min.css')}}" media="screen">


</head>
<body>
<!-- pagewrap -->
<section id="page-wrap">
	<!-- layout -->
	<section id="layout">

@include('layouts.frontLayout.front_header')

@yield('content')
@include('layouts.frontLayout.front_footer')

	</section>
	<!--/ layout -->
</section>
<!--/ pagewrap -->
<script src="{{ asset('public/js/frontend_js/jquery-1.7.1.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/frontend_js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/frontend_js/custom.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/frontend_js/owl.carousel.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/frontend_js/ajax.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/frontend_js/luxon.js')}}"></script>
<script>

      var owl = $('.owl-carousel');
      owl.owlCarousel({
        margin: 10,
        loop: true,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 3
          },
          1000: {
            items: 5
          }
        }
      })
	  
</script>
<script>
	$(document).ready(function() {
	  var totalItems = $('#carousel .item').length;
	  var thumbs = 4;
	  var currentThumbs = 0;
	  var to = 0;
	  var thumbActive = 1;
	  
	  function toggleThumbActive (i) {
		$('#carousel-thumbs .item>div').removeClass('active');
			$('#carousel-thumbs .item.active>div:nth-child(' + i +')').addClass('active');
	  }
	  
	  $('#carousel').on('slide.bs.carousel', function(e) {
		//var active = $(e.target).find('.carousel-inner > .item.active');
		//var from = active.index();
		var from = $('#carousel .item.active').index()+1;
		var next = $(e.relatedTarget);
		to = next.index()+1;
		var nextThumbs = Math.ceil(to/thumbs) - 1;
		if (nextThumbs != currentThumbs) {
			$('#carousel-thumbs').carousel(nextThumbs);
			currentThumbs = nextThumbs;
		}
		thumbActive = +to-(currentThumbs*thumbs);
		//console.log(from + ' => ' + to + ' / ' + currentThumbs);
	  });
	  $('#carousel').on('slid.bs.carousel', function(e) {
		toggleThumbActive(thumbActive);
	  });
	  $('#carousel-thumbs').on('slid.bs.carousel', function(e) {
		toggleThumbActive(thumbActive);
	  });
		$("#carousel").on("swiperight",function(){
		$('#carousel').carousel('prev');
		});
	  $("#carousel").on("swipeleft",function(){
			$('#carousel').carousel('next');
		});
	  $("#carousel-thumbs").on("swiperight",function(){
		$('#carousel-thumbs').carousel('prev');
		});
	  $("#carousel-thumbs").on("swipeleft",function(){
			$('#carousel-thumbs').carousel('next');
		});
	});
</script>
</body>
</html>
