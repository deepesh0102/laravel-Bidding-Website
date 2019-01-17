@extends('layouts.frontLayout.front_design')
@section('content')
<style>
  .row.top-space {
      padding-top: 30px;
  }
</style>
  <!-- banner block -->
  <section class="banner-block">
    <h3>Banner</h3>
  </section>
  <!--/ banner block -->
  <!-- product block -->
  <section class="product-block">
    <div class="container">
      <div class="row ">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="title">
            <h2>FEATURED PRODUCTS</h2>
            <a href="{{ route('front.show.products') }}" class="btn">View all <i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach($products as $product)
          <!--Start Check if auction created-->
          @if($product->auctions->isNotEmpty())
            <!--start product block-->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="box">
                <div class="live">live</div>
                <h4><a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}">{{ $product->product_name }}</a></h4>
                <div class="product">
                  @if(!is_null($product->productImages))
                    <a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}"><img src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$product->productImages['0']->image_name) }}" alt="{{ $product->product_name }}" /></a>
                  @else
                    <a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}"><img src="{{ asset(Config::get('constants.frontend_image_url.frontend_common_url').'no_image.jpg') }}" alt="{{ $product->product_name }}" /></a>
                  @endif
                </div>
                <div class="details">
                  <a class="title_pro" id="product_username_{{$product->id}}">{{$product->bidingHistories['0']->username  or '' }}</a>
                  <!--start check winner-->
                  @if(($product->winer_user_id == 'NULL' || $product->winer_user_id == 0 ))
                    <a class="title_time" id="product_time_{{$product->id}}">time</a>
                    <!--No winner-->
                  @else
                    <!-- winner -->
                    <a class="title_time">WINNER</a>
                    <a href="#" class="title_time">Sold Out</a>
                  @endif
                  <!-- end check winner-->
                  <!--Start Check Login for user condition-->
                  @guest
                    <!--not login-->
                    <em class="time_left">Time Left</em>
                    <h5 id="product_price_{{$product->id}}">$ {{ number_format($product->price, 2) }}</h5>
                    <em class="time_left">Retail Price</em>
                    <p>{{ Str_limit($product->description, $limit = 20, $end = '...') }}</p>
                    <!--start check auction not-expired and  no-winner-->
                    @if($product->auctions['0']->is_expired == 1 && ($product->winer_user_id == 'NULL' || $product->winer_user_id == 0 ))
                      <button class="btn btn-success btn-lg">
                        <a href="{{ route('login') }}">Bid Now</a>
                      </button>
                    @endif
                    <!--end check auction not-expired and  no-winner-->
                    <!--<a href="#" class="soldout">Sold Out</a>-->
                  @else
                    <!-- Login Member Condition -->
                    <em class="time_left">Time Left</em>
                    <h5 id="product_price_{{$product->id}}">$ {{ number_format($product->price, 2) }}</h5>
                    <em class="time_left">Retail Price</em>
                    <p>{{ Str_limit($product->description, $limit = 20, $end = '...') }}</p>
                    <a href="#" class="soldout">Sold Out</a>
                    <!--start check auction not-expired and  no-winner-->
                    @if($product->auctions['0']->is_expired == 1 && ($product->winer_user_id == 'NULL' || $product->winer_user_id == 0 ))
                      <button class="btn submitBtn"  data-acuction_end_time="{{ $product->auctions['0']->end_time or '' }}" data-bidding_history_id="{{$product->bidingHistories['0']->id or 0  }}" id="product_id_{{ $product->id }}" data-last_bidding_user_id="{{$product->bidingHistories['0']->user_id  or 0 }}" data-product_price="{{ $product->price }}" data-time="{{ $product->auctions['0']->time_inc }}" data-price="{{ $product->auctions['0']->price_inc }}" data-product_id="{{ $product->id }}" data-auction_id="{{ $product->auctions['0']->id }}" data-action="{{ route('front.ajax.addBidd') }}" data-user_id="{{  Auth::user()->id }}" data-user_name="{{  Auth::user()->name }}" data-csrf_token="{{ csrf_token() }}" onclick="goDobidding(this);">Bid Now</button>
                    @endif
                    <!--end check auction not-expired and  no-winner-->
                  @endguest
                  <!--End Check Login for user condition-->
                  <!--<button class="btn">{{--'Not started'--}}</button>-->
                  <a class="title msg" id="product_msg_{{$product->id}}" ></a>
                </div>
              </div>
            </div>
            <!--end product block-->
          @endif
          <!--End Check if auction created-->
        @endforeach
      </div>
      {{-- =============================================== --}}
      <!--Start Block Upcoming Product For Auction-->
      {{-- ======================================================= --}}
      <div class="row top-space">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="title">
            <h2>UPCOMING PRODUCTS</h2>
            <a href="{{ route('front.show.products') }}" class="btn">View all <i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>

    @if(count($upcoming_products))
    <div class="row">
      <!--//upcoming Product Block-->
        @foreach($upcoming_products as $product)
          <!--Start Check if auction created-->
          @if($product->auctions->isNotEmpty())
            <!--start product block-->
            <div class="col-md-3 col-sm-6 col-xs-12" id="remove_upcoming_product_{{$product->id}}">
              <div class="box">
                <div class="live">upcoming</div>
                <h4><a href="{{ route('front.get.soldproduct', [$product->id, str_slug($product->slug)]) }}">{{ $product->product_name }}</a></h4>
                <div class="product">
                  @if(!is_null($product->productImages))
                    <a href="{{ route('front.get.soldproduct', [$product->id, str_slug($product->slug)]) }}"><img src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$product->productImages['0']->image_name) }}" alt="{{ $product->product_name }}" /></a>
                  @else
                    <a href="{{ route('front.get.soldproduct', [$product->id, str_slug($product->slug)]) }}"><img src="{{ asset(Config::get('constants.frontend_image_url.frontend_common_url').'no_image.jpg') }}" alt="{{ $product->product_name }}" /></a>
                  @endif
                </div>
                <div class="details">
                  <!--Block time-->
                  <a class="title_time" id="upproduct_time_{{$product->id}}">time</a>
                  <!-- Block Time-->
                  <em class="time_left">Time Left</em>
                  <h5 id="upproduct_price_{{$product->id}}">$ {{ number_format($product->price, 2) }}</h5>
                  <em class="time_left">Retail Price</em>
                  <p>{{ Str_limit($product->description, $limit = 20, $end = '...') }}</p>
                  <!--<button class="btn">{{--'Not started'--}}</button>-->
                  <!--<a href="{{-- route('front.get.product', str_slug($product->slug)) --}}" class="btn">Add to cart</a>-->
                </div>
              </div>
            </div>
            <!--end product block-->
          @endif
          <!--End Check if auction created-->
        @endforeach
      </div>
      {{-- =================================================== --}}
      <!--End Block Upcoming Product For Auction-->
      {{-- ======================================================== --}}
      @endif

      {{-- =============================================== --}}
      <!--Start Block Sold Product For Auction-->
      {{-- ======================================================= --}}
      <div class="row top-space">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="title">
            <h2>SOLD PRODUCTS</h2>
            <a href="{{ route('front.show.products') }}" class="btn">View all <i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
    @if(count($sold_products))
      <div class="row">
        <!--//upcoming Product Block-->
        @foreach($sold_products as $product)
          <!--Start Check if auction created-->
          @if($product->auctions->isNotEmpty())
            <!--start product block-->
            <div class="col-md-3 col-sm-6 col-xs-12" id="remove_sold_product_{{$product->id}}">
              <div class="box">
                <div class="live">sold</div>
                <h4><a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}">{{ $product->product_name }}</a></h4>
                <div class="product">
                  @if(!is_null($product->productImages))
                    <a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}"><img src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$product->productImages['0']->image_name) }}" alt="{{ $product->product_name }}" /></a>
                  @else
                    <a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}"><img src="{{ asset(Config::get('constants.frontend_image_url.frontend_common_url').'no_image.jpg') }}" alt="{{ $product->product_name }}" /></a>
                  @endif
                </div>
                <div class="details">
                  <!--Block Sold-->
                  <a class="title_pro" id="product_username_{{$product->id}}">{{$product->bidingHistories['0']->username  or '' }}</a>
                  <a class="title_time">WINNER</a>
                  <a href="#" class="title_time">Sold Out</a>
                  <!-- Block Sold-->
                  <h5 id="solproduct_price_{{$product->id}}">$ {{ number_format($product->price, 2) }}</h5>
                  <em class="time_left">Retail Price</em>
                  <p>{{ Str_limit($product->description, $limit = 20, $end = '...') }}</p>
                  <!--<button class="btn">{{--'Not started'--}}</button>-->
                  <!--<a href="{{-- route('front.get.soldproduct', str_slug($product->slug)) --}}" class="btn">Add to cart</a>-->
                </div>
              </div>
            </div>
            <!--end product block-->
          @endif
          <!--End Check if auction created-->
        @endforeach
      </div>
  @endif
      {{-- =================================================== --}}
      <!--End Block Sold Product For Auction-->
      {{-- ======================================================== --}}
    </div>
  </section>
  <!--/ product block -->
  <script>
  // Set the date we're counting down to
  // 1. JavaScript
  // var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
  // 2. PHP
  // Update the count down every 1 second
  var x = setInterval(function () {
    // Get todays date and time
    // 1. JavaScript
    // var now = new Date().getTime();
    // 2. PHP
    //code here
    var productId = "{{ serialize($productId) }}"
    var CSRF_TOKEN = "{{ csrf_token() }}";
    $.ajax({
      type: 'POST',
      url: "{{route('front.ajax.showMultipleProduct')}}",
      //            data:{ price: price,  _token: $('#_token').val()},
      data: 'productId=' + productId + '&_token=' + CSRF_TOKEN,
      //            beforeSend: function () {
      //                $('.submitBtn').attr("disabled","disabled");
      //                $('.modal-body').css('opacity', '.5');
      //            },
      success: function (success_data) {
        console.log(success_data);
        if (success_data.success == true) {
          $.each(success_data.products, function (key, data) {
            //                        alert(data.id);
            if (data.biding_histories.length > 0) {
              $('#product_username_' + data.biding_histories[0].product_id).html(data.biding_histories[0].username);
              $('#product_id_' + data.biding_histories[0].product_id).data("bidding_history_id", data.biding_histories[0].id);
              $('#product_id_' + data.biding_histories[0].product_id).data("product_price", data.biding_histories[0].price);
              $('#product_id_' + data.biding_histories[0].product_id).data("last_bidding_user_id", data.biding_histories[0].user_id);
            }
            $('#product_price_' + data.id).html(' $ ' + data.price.toFixed(2));
            if ((data.auctions.length > 0)) {
              $('#product_id_' + data.id).data("acuction_end_time", data.auctions[0].end_time);
            }
            console.log(data.price);
            if (!$.isEmptyObject(data.auctions)) {
              console.log('time:' + success_data.time);
              console.log(data.auctions[0].end_time);
              var countDownDate = data.auctions[0].end_time * 1000;
              var now = success_data.time * 1000;
              now = now + 1000;
              // Find the distance between now an the count down date
              var distance = countDownDate - now;
              // Time calculations for days, hours, minutes and seconds
              //        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
              // Output the result in an element with id="demo"
              //        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
              //            minutes + "m " + seconds + "s ";
              //alert(data.winer_user_id);
              if (data.winer_user_id == null || data.winer_user_id == 'null' && (data.auctions.length > 0)) {
                document.getElementById("product_time_" + data.id).innerHTML = formateTwoDigit(hours) + ": " +
                formateTwoDigit(minutes) + ": " + formateTwoDigit(seconds);
              }
              console.log(hours + "h " + minutes + "m " + seconds + "s ");
              // If the count down is over, write some text
              if (distance < 0) {
                //clearInterval(x);
                var last_bidding_user_id = $("#product_id_" + data.id).data('last_bidding_user_id');
                var bidding_history_id = $("#product_id_" + data.id).data('bidding_history_id');
                var product_id = $("#product_id_" + data.id).data('product_id');
                var auction_id = $("#product_id_" + data.id).data('auction_id');
                var user_id = $("#product_id_" + data.id).data('user_id');
                $.ajax({
                  url: "{{route('front.ajax.updatewinner')}}",
                  type: "POST",
                  data: {_token: CSRF_TOKEN, bidding_history_id: bidding_history_id, last_bidding_user_id: last_bidding_user_id, product_id: product_id, auction_id: auction_id, user_id: user_id},
                  dataType: 'JSON',
                })
                .done(function (msg) {
                  console.log("Data update: " + msg);
                  if (msg.winer_user_id == 1) {
                    document.getElementById("product_time_" + data.id).innerHTML = "WINNER";
                  } else if (msg.winer_user_id == 1) {
                    document.getElementById("product_time_" + data.id).innerHTML = "EXPIRED";
                  }
                });
                if (data.winer_user_id == 1) {
                  //document.getElementById("product_time_"+data.id).innerHTML = "WINNER";
                } else {
                  document.getElementById("product_time_" + data.id).innerHTML = "EXPIRED";
                }
                $("#product_id_" + data.id).remove();
                //                    document.getElementById("product_time_"+data.id).innerHTML = "EXPIRED";
              }
            }
          });
        } else {
        }
      }
    });
  }, 1000);


    @if(count($upcoming_products))



  //upcoming product function in javascript;
  var xv = setInterval(function () {
    var productId;
    var countDownDate;
    var now;
    var distance;
    var data = {!! $upcoming_products !!};
    $.each(data, function (i) {
      $.each(this, function (key, value) {
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
      });
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
      console.log("upproduct_time_"+ productId);
      // Display the result in the element with id="demo"
      document.getElementById("upproduct_time_"+ productId).innerHTML = formateTwoDigit(hours) + ": " + formateTwoDigit(minutes) + ": " + formateTwoDigit(seconds);
      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
      }
    });
  }, 1000);


@endif



</script>
@endsection
