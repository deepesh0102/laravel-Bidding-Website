@extends('layouts.frontnewLayout.front_design')
@section('content')

        <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="false" >
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>
                <li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
                <li data-target="#bootstrap-touch-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div id="home" class="first-section" style="background-image:url('{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/banner/banner.jpg') }}');background-position: bottom;">
                        <!-- <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <div class="big-tagline">
                                        <img src="images/logos/logo-hosting.png" alt="image">
                                        <h2 data-animation="animated zoomInRight">Best <strong>Shared Hosting</strong> Company</h2>
                                        <p class="lead" data-animation="animated fadeInLeft">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>
                                         <a data-scroll href="#pricing" class="btn btn-light btn-radius btn-brd effect-1 slide-btn" data-animation="animated fadeInLeft">View Plans</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a data-scroll href="#overviews" class="btn btn-light btn-radius btn-brd effect-1 slide-btn" data-animation="animated fadeInRight">All Features</a>
                                    </div>
                                </div>
                            </div>
                        </div> --><!-- end container -->
                    </div><!-- end section -->
                </div>
                <div class="item">
                    <div id="home" class="first-section" style="background-image:url('{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/banner/banner.jpg') }}');background-position: bottom;">
                        <!-- <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <div class="big-tagline">
                                        <img src="images/logos/logo-hosting.png" alt="image">
                                        <h2 data-animation="animated zoomInRight">Find the right <strong>Hosting</strong></h2>
                                        <p class="lead" data-animation="animated fadeInLeft">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>
                                         <a data-scroll href="#pricing" class="btn btn-light btn-radius btn-brd effect-1 slide-btn" data-animation="animated fadeInLeft">View Plans</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a data-scroll href="#overviews" class="btn btn-light btn-radius btn-brd effect-1 slide-btn" data-animation="animated fadeInRight">All Features</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div><!-- end section -->
                </div>
                <div class="item">
                    <div id="home" class="first-section" style="background-image:url('{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/banner/banner.jpg') }}');background-position: bottom;">
                        <!-- <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <div class="big-tagline">
                                        <img src="images/logos/logo-hosting.png" alt="image">
                                        <h2 data-animation="animated zoomInRight">Best <strong>VPS Servers</strong> Company</h2>
                                        <p class="lead" data-animation="animated fadeInLeft">1 IP included with each server (more on request to justification)
                                            Your Choice of any OS (CentOS, Windows, Debian, Fedora)
                                            FREE Reboots</p>
                                         <a data-scroll href="#pricing" class="btn btn-light btn-radius btn-brd effect-1 slide-btn" data-animation="animated fadeInLeft">View Plans</a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a data-scroll href="#overviews" class="btn btn-light btn-radius btn-brd effect-1 slide-btn" data-animation="animated fadeInRight">All Features</a>
                                    </div>
                                </div>
                            </div>
                        </div> --><!-- end container -->
                    </div><!-- end section -->
                </div>
                <!-- Left Control -->
                <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <!-- Right Control -->
                <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    <div id="overviews" class="section wb">
        <div class="container">
            <h3 class="h3_head">Live Auctions
                <span><a href="{{ route('front.show.products') }}">View All</a></span>
            </h3>
            <div class="row">
                @foreach($products as $product)

                    <!--Start Check if auction created-->
                        @if($product->auctions->isNotEmpty())

                            <div class="col-md-3 col-sm-6">
                            <div class="product-grid4" id="product_content_{{$product->id}}">

                        <div class="product-image4">
                            @if(!is_null($product->productImages))
                                <a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}"><img class="pic-1" src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$product->productImages['0']->image_name) }}" alt="{{ $product->product_name }}" /></a>
                            @else
                                <a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}"><img class="pic-1" src="{{ asset(Config::get('constants.frontend_image_url.frontend_common_url').'no_image.jpg') }}" alt="{{ $product->product_name }}" /></a>
                            @endif
                        </div>

                        <div class="product-content">

                            <p class="title-p"><a id="product_username_{{$product->id}}" href="#">{{$product->bidingHistories['0']->username  or '' }}</a></p>
                            <!--start check winner-->
                            @if(($product->winer_user_id == 'NULL' || $product->winer_user_id == 0 ))
                                <p class="demo" id="product_time_{{$product->id}}">time</p>
                                <!--No winner-->
                            @else
                            <!-- winner -->
                                <p class="title-p"><a class="">WINNER</a></p>
                                <p class="title-p"><a href="#" class="">Sold Out</a></p>
                            @endif
                            <!-- end check winner-->

                            <div class="price">

                                <span id="product_price_{{$product->id}}">$ {{ number_format($product->price, 2) }}</span>
                                <!-- <span>$16.00</span> -->
                            </div>
                            <h4 class="title-h4"><a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}">{{ $product->product_name }}</a></h4>
                            @guest
                            <!--not login-->
                                @if($product->auctions['0']->is_expired == 1 && ($product->winer_user_id == 'NULL' || $product->winer_user_id == 0 ))
                                <!--start check auction not-expired and  no-winner-->
                                    <a class="add-to-bid" href="{{ route('login') }}">Bid</a>
                                @endif

                            @else
                            <!-- Login Member Condition -->
                            <!--start check auction not-expired and  no-winner-->
                                @if($product->auctions['0']->is_expired == 1 && ($product->winer_user_id == 'NULL' || $product->winer_user_id == 0 ))
                                    <a class="add-to-bid btn submitBtn"  data-acuction_end_time="{{ $product->auctions['0']->end_time or '' }}" data-bidding_history_id="{{$product->bidingHistories['0']->id or 0  }}" id="product_id_{{ $product->id }}" data-last_bidding_user_id="{{$product->bidingHistories['0']->user_id  or 0 }}" data-product_price="{{ $product->price }}" data-time="{{ $product->auctions['0']->time_inc }}" data-price="{{ $product->auctions['0']->price_inc }}" data-product_id="{{ $product->id }}" data-auction_id="{{ $product->auctions['0']->id }}" data-action="{{ route('front.ajax.addBidd') }}" data-user_id="{{  Auth::user()->id }}" data-user_name="{{  Auth::user()->name }}" data-csrf_token="{{ csrf_token() }}" onclick="goDobidding(this);">Bid</a>
                                @endif
                            <!--end check auction not-expired and  no-winner-->
                            @endguest
                        <!--End Check Login for user condition-->
                            <a class="title msg" id="product_msg_{{$product->id}}" ></a>
                        </div>
                    </div>
                </div>
                        @endif
                @endforeach
            </div>
{{--            {{$upcoming_products}}--}}
            {{-- =============================================== --}}
            <!--Start Block Upcoming Product For Auction-->
            {{-- ======================================================= --}}

            <div id="upcoming" class="section wb">
                <div class="container">
                    <h3 class="h3_head">Upcoming Auctions
                        <a href="{{ route('front.show.products') }}"><span>View All</span></a>
                    </h3>
                    @if(count($upcoming_products))
                        <!--//upcoming Product Block-->
                            @foreach($upcoming_products as $product)
                                <!--Start Check if auction created-->
                                    @if($product->auctions->isNotEmpty())

                    <div class="row upcoming_section" id="remove_upcoming_product_{{$product->id}}">
                        <div class="">
                            <div class="col-md-2">
                                <div class="upcm_img">

                                @if(!is_null($product->productImages))
                                    <a href="{{ route('front.get.upcoming', [$product->id, str_slug($product->slug)]) }}"><img style="width: 108px" src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$product->productImages['0']->image_name) }}" alt="{{ $product->product_name }}" /></a>
                                @else
                                    <a href="{{ route('front.get.upcoming', [$product->id, str_slug($product->slug)]) }}"><img src="{{ asset(Config::get('constants.frontend_image_url.frontend_common_url').'no_image.jpg') }}" alt="{{ $product->product_name }}" /></a>
                                @endif
                                    {{--<img src="images/upcom/1.png">--}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="upcoming_head">
                                    <h4><a href="{{ route('front.get.upcoming', [$product->id, str_slug($product->slug)]) }}">{{ $product->product_name }}</a></h4>
                                    <p>{{ Str_limit($product->description, $limit = 20, $end = '...') }}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="upcm_price">
                                    <p id="upproduct_price_{{$product->id}}">$ {{ number_format($product->price, 2) }}</p>
                                    <span>(instead of $ {{ number_format($product->buy_now_price, 2) }})</span>
                                </div>
                            </div>
                            {{--<div class="col-md-2">--}}
                                {{--<div class="usr_upcmn">--}}
                                    {{--<h4>Username</h4>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-2">
                                <div class="upcmg_timer_btn">

                                    <p id="upproduct_time_{{$product->id}}" class="demo">time</p>
                                    {{--<p><a class="add-to-bid" href="">Bid</a></p>--}}
                                    <p><span>{{ date("M j G:i:s ", $product->auctions[0]->start_time)}}</span></p>
                                </div>
                            </div>

                        </div>
                    </div>
                                    @endif
                                    <!--End Check if auction created-->
                            @endforeach
                        {{-- =================================================== --}}
                    <!--End Block Upcoming Product For Auction-->
                        {{-- ======================================================== --}}
                    @endif


                </div>
            </div>
        </div>
        <div id="testimonial" class="section wb">
            <div class="container">
                <div class="row">
                    <h3 class="head1">What Our Client’s Say About Us</h3>

                    <div id="myCarousel" class="carousel slide">

                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Carousel items -->
                        <div class="carousel-inner">



                            <div class="item active">

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/testimonial/1.png') }}">
                                    <span class="pointer"></span>
                                    <a href="#x" class="thumbnail">
                                        <blockquote aria-label="testimonial comment">
                                            <ul class="star">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li><li><i class="fa fa-star" aria-hidden="true"></i></li>

                                            </ul>
                                            <div class="clearfix"></div>
                                            <p>	<i class="fa fa-quote-left" aria-hidden="true"></i>It is a long established fact that a
                                                reader will be distracted by the readable content of a page when looking at
                                                its layout.<i class="fa fa-quote-right" aria-hidden="true"></i></p>
                                        </blockquote>
                                    </a><span>- Paul Buckhead</span></div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/testimonial/1.png') }}">
                                    <span class="pointer"></span>
                                    <a href="#x" class="thumbnail">
                                        <blockquote aria-label="testimonial comment">
                                            <ul class="star">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li><li><i class="fa fa-star" aria-hidden="true"></i></li>

                                            </ul><div class="clearfix"></div>
                                            <p>	<i class="fa fa-quote-left" aria-hidden="true"></i>It is a long established fact that a
                                                reader will be distracted by the readable content of a page when looking at
                                                its layout.<i class="fa fa-quote-right" aria-hidden="true"></i></p>
                                        </blockquote>
                                    </a><span>- Paul Buckhead</span></div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/testimonial/1.png') }}">
                                    <span class="pointer"></span>
                                    <a href="#x" class="thumbnail">
                                        <blockquote aria-label="testimonial comment">
                                            <ul class="star">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li><li><i class="fa fa-star" aria-hidden="true"></i></li>

                                            </ul><div class="clearfix"></div>
                                            <p>	<i class="fa fa-quote-left" aria-hidden="true"></i>It is a long established fact that a
                                                reader will be distracted by the readable content of a page when looking at
                                                its layout.<i class="fa fa-quote-right" aria-hidden="true"></i></p>
                                        </blockquote>
                                    </a><span>- Paul Buckhead</span></div>

                            </div>

                            <div class="item ">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/testimonial/1.png') }}">
                                    <span class="pointer"></span>
                                    <a href="#x" class="thumbnail">
                                        <blockquote aria-label="testimonial comment">
                                            <ul class="star">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li><li><i class="fa fa-star" aria-hidden="true"></i></li>

                                            </ul><div class="clearfix"></div>
                                            <p>	<i class="fa fa-quote-left" aria-hidden="true"></i>It is a long established fact that a
                                                reader will be distracted by the readable content of a page when looking at
                                                its layout.<i class="fa fa-quote-right" aria-hidden="true"></i></p>
                                        </blockquote>
                                    </a><span>- Paul Buckhead</span>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/testimonial/1.png') }}">
                                    <span class="pointer"></span>
                                    <a href="#x" class="thumbnail">

                                        <blockquote aria-label="testimonial comment">
                                            <ul class="star">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li><li><i class="fa fa-star" aria-hidden="true"></i></li>

                                            </ul><div class="clearfix"></div>
                                            <p>	<i class="fa fa-quote-left" aria-hidden="true"></i>It is a long established fact that a
                                                reader will be distracted by the readable content of a page when looking at
                                                its layout.<i class="fa fa-quote-right" aria-hidden="true"></i></p>
                                        </blockquote>
                                    </a><span>- Paul Buckhead</span></div>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/testimonial/1.png') }}">
                                    <span class="pointer"></span>
                                    <a href="#x" class="thumbnail">
                                        <blockquote aria-label="testimonial comment">
                                            <ul class="star">
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li><li><i class="fa fa-star" aria-hidden="true"></i></li>

                                            </ul><div class="clearfix"></div>
                                            <p>	<i class="fa fa-quote-left" aria-hidden="true"></i>It is a long established fact that a
                                                reader will be distracted by the readable content of a page when looking at
                                                its layout.<i class="fa fa-quote-right" aria-hidden="true"></i></p>
                                        </blockquote>
                                    </a><span>- Paul Buckhead</span></div>


                            </div><!--/item-->




                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                        </div><!--/myCarousel-->


                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
    {{--<script>--}}
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



    {{--</script>--}}
@stop

@endsection
