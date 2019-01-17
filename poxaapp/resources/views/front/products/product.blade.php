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
                    <li class="active">{{ $products->product_name }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- / tubo block -->

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
                        @foreach( $products->productImages as $key => $productImage )
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

                            @foreach( $products->productImages as $key =>$productImage )
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
                    <h1>{{ $products->product_name }} </h1>

                    <div class="round">
                        <div class="endin">
                            <p class="end">Ends In:</p>
                            @if(($products->winer_user_id == 'NULL' || $products->winer_user_id == 0 ))
                            <a class="title_time" id="product_time_{{$products->id}}">time</a>
                            @else 
                            <a class="title_time">WINNER</a>
                            @endif

                            <p class="soldout" >Sold Out</p>

                            <p class="end topspec">Username:</p>
                            <a class="username" class="title" id="product_username_{{$products->id}}">{{$products->bidingHistories['0']->username or ''}}</a>
                        </div>

                        <div class="endin">
                            <p class="end">Current price:</p>
                            <a class="price" role="button" aria-expanded="true" aria-controls="collapseOne" id="product_price_{{$products->id}}">
                                $ {{ number_format($products->price, 2) }}   
                            </a><sub>USD</sub>

                            <p class="end topspec">Place Bid::</p>
                            @if($products->auctions->isNotEmpty())

                            @guest
                            @if($products->auctions['0']->is_expired == 1 && ($products->winer_user_id == 'NULL' || $products->winer_user_id == 0 ))
                            <button class="btn addbtn btn-success btn-lg">
                                <a href="{{ route('login') }}">Bid Now</a>
                            </button>
                            @endif	
                            @else
                            @if($products->auctions['0']->is_expired == 1 && ($products->winer_user_id == 'NULL' || $products->winer_user_id == 0 ))
                            <button class="btn addbtn btn-success btn-lg" data-acuction_end_time="{{ $products->auctions['0']->end_time or '' }}" data-bidding_history_id="{{$products->bidingHistories['0']->id or 0 }}" id="product_id_{{ $products->id }}" data-last_bidding_user_id="{{$products->bidingHistories['0']->user_id  or 0 }}" data-product_price="{{ $products->price }}" data-time="{{ $products->auctions['0']->time_inc }}" data-price="{{ $products->auctions['0']->price_inc }}" data-product_id="{{ $products->id }}" data-auction_id="{{ $products->auctions['0']->id }}" data-action="{{ route('front.ajax.addBidd') }}" data-user_id="{{  Auth::user()->id }}" data-user_name="{{  Auth::user()->name }}" data-csrf_token="{{ csrf_token() }}" onclick="goDobidding(this);">
                                Bid Now
                            </button>
                            @endif
                            @endguest



                            <!--<button class="btn btn-danger btn-lg">{{'Not started'}}</button>--> 

                            @endif
                        </div>
                        <div class="description">
                            <p>{{ $products->description }}</p>
                        </div>
                    </div>

                    <a class="title msg" id="product_msg_{{$products->id}}" ></a>


                    <!--Bidding form-->



                    <!-- Button to trigger modal -->





                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="history">
                    @if($products->bidingHistories->isNotEmpty())

                    <table class="table table-dark">
                        <h4>BID HISTORIES</h4>
                        <tbody id="biding_histories">
                            <tr>

                                <th>Time</th>
                                <th> Username</th>
<!--<th> Price</th>-->
                                <th>BID TYPE</th>
                            </tr>
                            @foreach($products->bidingHistories as $bidingHistory)
                            <tr>
                                <td>{{ $bidingHistory->created_at }}</td>
                                <td>{{ $bidingHistory->username}}</td>
                                <!--<td> $ {{-- number_format($bidingHistory->price, 2) --}} </td> -->
                                <td>Single Bid</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
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
    // Set the date we're counting down to
    // 1. JavaScript
    // var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
    // 2. PHP
<?php
$date = new \DateTime();
?>



    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get todays date and time
    // 1. JavaScript
    // var now = new Date().getTime();
    // 2. PHP

    //code here


    var slug = "{{ $products->slug }}"
            var CSRF_TOKEN = "{{ csrf_token() }}";
    $.ajax({
    type:'POST',
            url: "{{route('front.ajax.showSingleProduct')}}",
//            data:{ price: price,  _token: $('#_token').val()},
            data:'slug=' + slug + '&_token=' + CSRF_TOKEN,
//            beforeSend: function () {
//                $('.submitBtn').attr("disabled","disabled");
//                $('.modal-body').css('opacity', '.5');
//            },
            success:function(msg){
            console.log(msg);
            if (msg.success == true){
            if (msg.products.biding_histories.length > 0){
            $('#product_username_' + msg.products.biding_histories[0].product_id).html(msg.products.biding_histories[0].username);
            $('#product_id_' + msg.products.biding_histories[0].product_id).data("bidding_history_id", msg.products.biding_histories[0].id);
            $('#product_id_' + msg.products.biding_histories[0].product_id).data("product_price", msg.products.biding_histories[0].price);
            $('#product_id_' + msg.products.biding_histories[0].product_id).data("last_bidding_user_id", msg.products.biding_histories[0].user_id);
            }
            if ((msg.products.auctions.length > 0)){
            $('#product_id_' + msg.products.id).data("acuction_end_time", msg.products.auctions[0].end_time);
            }
            $('#product_price_' + msg.products.id).html('$ ' + msg.products.price.toFixed(2));
            console.log(msg.products.price);
            if ($.isEmptyObject(msg.auctions)){
            console.log(msg.products.auctions[0].end_time);
            console.log('time:' + msg.time);
//            console.log(new Date().getTime());
            var countDownDate = msg.products.auctions[0].end_time * 1000;
            var now = msg.time * 1000;
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
            if (msg.products.winer_user_id == null || msg.products.winer_user_id == 'null' && (msg.products.auctions.length > 0)){
            document.getElementById("product_time_" + msg.products.id).innerHTML = formateTwoDigit(hours) + ": " +
                    formateTwoDigit(minutes) + ": " + formateTwoDigit(seconds);
            }
            console.log(hours + "h " + minutes + "m " + seconds + "s ");
            
            //bidding histories 
            var biding_histories_data = '';
            
            biding_histories_data +='<tr><th>Time</th><th> Username</th><th>BID TYPE</th></tr>';
            
            $.each(msg.products.biding_histories, function(key,data) { 
            
            biding_histories_data += '<tr><td>'+ data.created_at +'</td><td>'+ data.username + '</td><td>Single Bid</td></tr>';
    
            });
            
            $('#biding_histories').html('')
            $('#biding_histories').html(biding_histories_data);
            
            
            
            
            
            
            
            // If the count down is over, write some text 
            if (distance < 0) {
            clearInterval(x);
            var last_bidding_user_id = $("#product_id_" + msg.products.id).data('last_bidding_user_id');
            var bidding_history_id = $("#product_id_" + msg.products.id).data('bidding_history_id');
            var product_id = $("#product_id_" + msg.products.id).data('product_id');
            var auction_id = $("#product_id_" + msg.products.id).data('auction_id');
            var user_id = $("#product_id_" + msg.products.id).data('user_id');
            $.ajax({
            url: "{{route('front.ajax.updatewinner')}}",
                    type: "POST",
                    data: {_token: CSRF_TOKEN, bidding_history_id: bidding_history_id, last_bidding_user_id:last_bidding_user_id, product_id:product_id, auction_id:auction_id, user_id:user_id},
                    dataType: 'JSON',
            })
                    .done(function(data) {
                    console.log("Data update: " + data);
                    if (data.winer_user_id == 1){

                    document.getElementById("product_time_" + msg.products.id).innerHTML = "WINNER";
                    } else if (data.winer_user_id == 0) {

                    document.getElementById("product_time_" + msg.products.id).innerHTML = "EXPIRED";
                    }
                    });
            if (msg.products.winer_user_id == 1){

            //document.getElementById("product_time_"+msg.products.id).innerHTML = "WINNER";

            } else {

            document.getElementById("product_time_" + msg.products.id).innerHTML = "EXPIRED";
            }
            $("#product_id_" + msg.products.id).remove();
//                    document.getElementById("product_time_"+msg.products.id).innerHTML = "EXPIRED";
            }
            }
            } else{

            }

            }
    });
    }, 1000);
</script>


@endsection



