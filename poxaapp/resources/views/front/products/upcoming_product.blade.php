@extends('layouts.frontLayout.front_design')
@section('content')
<!--tubo block -->
<section class="tubo-block">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <ul>
                    <li><a href="{{ route('index') }}">Home <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                    <li><a href="{{ route('front.show.products') }}">Products <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                    <!--<li><a href="">Filters <i class="fa fa-angle-right" aria-hidden="true"></i></a></li>-->
                    <li class="active">{{ $soldproducts->product_name }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- / tubo block -->
{{-- {!! $soldproducts !!} --}}
<!--part block -->
<section class="part-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <!--<div class="left">
                        <div class="zoom">
                                <a href=""><img src="images/product-7.png" alt="" /></a>
                        </div>
                </div>
                <a href="#" class="view"><i class="fa fa-search-plus" aria-hidden="true"></i> Click Image for larger View</a> -->
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        @foreach( $soldproducts->productImages as $key => $productImage )
                        <div class="item {{$key == 0?'active':''}}">
                            <img src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$productImage->image_name) }}" alt="" class="img-responsive"/>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div id="carousel-thumbs" class="carousel slide">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            @foreach( $soldproducts->productImages as $key =>$productImage )
                            <div class="col-xs-3 {{$key == 0?'active':''}}"onclick="$('#carousel').carousel({{$key}});">
                                <img src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$productImage->image_name) }}" alt="" class="img-responsive"/>
                            </div>
                            @endforeach
                        </div>
                        <!-- Controls
                          <a class="left carousel-control hidden-xs" href="#carousel-thumbs" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                          </a>
                          <a class="right carousel-control hidden-xs" href="#carousel-thumbs" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                          </a>-->
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="right">
                    <h1>{{ $soldproducts->product_name }} </h1>
                    <div class="round">
                        <div class="endin">
                            <p class="end">Ends In:</p>
                            @if(($soldproducts->winer_user_id == 'NULL' || $soldproducts->winer_user_id == 0 ))
                            <a class="title_time" id="product_time_{{$soldproducts->id}}">time</a>
                            @else
                            <a class="title_time">WINNER</a>
                            @endif
                            <p class="soldout" >Sold Out</p>
                            <p class="end topspec">Username:</p>
                            <a class="username" class="title" id="product_username_{{$soldproducts->id}}">{{$soldproducts->bidingHistories['0']->username or ''}}</a>
                        </div>
                        <div class="endin">
                            <p class="end">Current price:</p>
                            <a class="price" role="button" aria-expanded="true" aria-controls="collapseOne" id="product_price_{{$soldproducts->id}}">
                                $ {{ number_format($soldproducts->price, 2) }}
                            </a><sub>USD</sub>
                            <p class="end topspec">Place Bid::</p>
                        </div>
                        <div class="description">
                            <p>{{ $soldproducts->description }}</p>
                        </div>
                    </div>
                    <a class="title msg" id="product_msg_{{$soldproducts->id}}" ></a>
                    <!--Bidding form-->
                    <!-- Button to trigger modal -->
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="history">
                    <table class="table table-dark">
                        <h4>BID HISTORIES</h4>
                        <tbody id="biding_histories">
                            <tr>
                                <th>Time</th>
                                <th> Username</th>
<!--<th> Price</th>-->
                                <th>BID TYPE</th>
                            </tr>
                            @foreach($soldproducts->bidingHistories as $bidingHistory)
                            <tr>
                                <td>{{ $bidingHistory->created_at }}</td>
                                <td>{{ $bidingHistory->username}}</td>
                                <!--<td> $ {{-- number_format($bidingHistory->price, 2) --}} </td> -->
                                <td>Single Bid</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!--part block -->
<!-- alter-block -->
<section class="alter-block">
    <div class="container">
        <div class="large-12 columns">
            <h3>Alternate Products</h3>
            <div class="owl-carousel">
                @foreach($listproducts as $listproduct)
                <div class="item">
                    <div class="box">
                        <div class="product">
                            @if(!is_null($listproduct->productImages))
                            <a href="{{ route('front.get.product', [$listproduct->id, str_slug($listproduct->slug)]) }}"><img src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$listproduct->productImages['0']->image_name) }}" alt="{{ $listproduct->product_name }}" /></a>
                            @else
                            <a href="{{ route('front.get.product', [$listproduct->id, str_slug($listproduct->slug)]) }}"><img src="{{ asset(Config::get('constants.frontend_image_url.frontend_common_url').'no_image.jpg') }}" alt="{{ $listproduct->product_name }}" /></a>
                            @endif
                        </div>
                        <div class="details">
                            <a href="">{{ $listproduct->product_name }}</a>
                            <p >{{ Str_limit($listproduct->description, $limit = 20, $end = '...') }}</p>
                            <h5 id="listproduct_price_{{ $listproduct->id }}">$ {{ number_format($listproduct->price, 2) }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--/ alter-block -->
<script>

//upcoming product function in javascript;
var xv = setInterval(function () {
  var productId;
  var countDownDate;
  var now;
  var distance;
  var data = {!! $soldproducts !!};

    $.each(data, function (key, value) {
      {
        if(key == 'id'){
          productId = value;
        }
        console.log(productId);
        if (key == "auctions" || key == 'auctions') {
          $.each(value, function (key1, value1) {
            console.log(value[key1].start_time + " : " + value[key1].start_time);
            countDownDate = value[key1].start_time;
          })
        }
      }

    // Set the date we're counting down to
    console.log('countDownDate============>'+ countDownDate);
    // Update the count down every 1 second
    //current United State Time Stamp
    @php
    $date = new DateTime();
    $date->format('Y-n-j G:i:s (e)');
    $current_time_stamp = new \DateTime();
    $current_time_stamp = $current_time_stamp->getTimestamp();
    @endphp
    $.getScript("http://localhost/poxaapp/public/js/frontend_js/luxon.js", function() {
      //alert("Script loaded and executed.");
      // here you can use anything you defined in the loaded script
    });
    // Get todays date and time
    var time = Date().toLocaleString("en-US", {timeZone: "America/New_York"});
    //             DateTime.local().zoneName; //=> 'Asia/Tokyo'
    //library  datetime variable luxon for timezone
    var DateTime = luxon.DateTime;
    var local = DateTime.local();
    //      var rezoned = local.setZone("America/Los_Angeles");
    var rezoned = local.setZone("America/New_York");
    //library  datetime variable luxon for timezone
    console.log('javascript=========================================================================>'+rezoned.toString());
    //
    now = rezoned;
    console.log('$current_time_stamp=========================================================================>'+now);
    // Find the distance between now and the count down date
    distance = (countDownDate*1000) - now;
    console.log('distance============>'+ distance);
    // Time calculations for days, hours, minutes and seconds
    //             var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    //             var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var hours = Math.floor((distance) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    //             console.log( "time======================================================================>"+days + "d "+hours + "h " + minutes + "m " + seconds + "s ");
    console.log( "time======================================================================>"+hours + "h " + minutes + "m " + seconds + "s ");
    console.log("product_time_"+ productId);
    // Display the result in the element with id="demo"
    document.getElementById("product_time_"+ productId).innerHTML = formateTwoDigit(hours) + ": " + formateTwoDigit(minutes) + ": " + formateTwoDigit(seconds);
    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
    }
  });
}, 1000);




</script>
@endsection
