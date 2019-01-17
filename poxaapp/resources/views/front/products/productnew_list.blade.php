@extends('layouts.frontnewLayout.front_design')
@section('content')
    <div class="wrapperc">
        <div class="category-bg">
            <!-- banner area start -->
            <div class="banner-box">
                <div class="container">
                    <div class="row">
                        <div class="banner-block">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="textblock">
                                    <span>Best Deal on</span>
                                    <p>Live Auction</p>
                                    <p>Products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner area end  -->

            <!-- product area start -->
            <div class="product-box">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- product category start -->
                            <div id="overviews" class="section wb">
                                <div class="">
                                    <h3 class="h3_head">Live Auctions
                                        {{--<span>View All</span>--}}
                                    </h3>
                                    <div class="row">

                                        @foreach($products as $product)
                                            <!--start check auctions-->
                                                @if($product->auctions->isNotEmpty())

                                                <div class="col-md-3 col-sm-6">
                                            <div class="product-grid4">
                                                <div class="product-image4">
                                                    <a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}">
                                                        @if(!is_null($product->productImages))

                                                            <img class="pic-1" src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$product->productImages['0']->image_name) }}" alt="{{ $product->product_name }}">

                                                        @else
                                                            <img class="pic-1" src="{{ asset(Config::get('constants.frontend_image_url.frontend_common_url').'no_image.jpg') }}" >

                                                        @endif


                                                    </a>

                                                </div>
                                                <div class="product-content">
                                                    <p class="title-p" ><a href="#" id="product_username_{{$product->id}}">{{$product->bidingHistories['0']->username or '' }}</a></p>

                                                    @if(($product->winer_user_id == 'NULL' || $product->winer_user_id == 0 ))
                                                        <p class="demo" id="product_time_{{$product->id}}">time</p>
                                                    @else
                                                        <p class="demo">WINNER</p>
                                                    @endif


                                                    <div class="price" id="product_price_{{$product->id}}">
                                                        <span> $ {{ number_format($product->price, 2) }}</span>
                                                        <!-- <span>$16.00</span> -->
                                                    </div>
                                                    <h4 class="title-h4"><a href="{{ route('front.get.product', [$product->id, str_slug($product->slug)]) }}">
                                                        {{ $product->product_name }}
                                                        </a>
                                                    </h4>
                                                    {{--Biding Button Condition--}}
                                                    @guest
                                                        @if($product->auctions['0']->is_expired == 1 && ($product->winer_user_id == 'NULL' || $product->winer_user_id == 0 ))

                                                                <a class="add-to-bid" href="{{ route('login') }}">Bid</a>

                                                        @endif

                                                    @else

                                                        @if($product->auctions['0']->is_expired == 1 && ($product->winer_user_id == 'NULL' || $product->winer_user_id == 0 ))
                                                            <a class="add-to-bid" data-acuction_end_time="{{ $product->auctions['0']->end_time or '' }}" data-bidding_history_id="{{$product->bidingHistories['0']->id  or 0 }}" id="product_id_{{ $product->id }}" data-last_bidding_user_id="{{$product->bidingHistories['0']->user_id or 0 }}" data-product_price="{{ $product->price }}" data-time="{{ $product->auctions['0']->time_inc }}" data-price="{{ $product->auctions['0']->price_inc }}" data-product_id="{{ $product->id }}" data-auction_id="{{ $product->auctions['0']->id }}" data-action="{{ route('front.ajax.addBidd') }}" data-user_id="{{  Auth::user()->id }}" data-user_name="{{  Auth::user()->name }}" data-csrf_token="{{ csrf_token() }}" onclick="goDobidding(this);">Bid </a>

                                                        @endif
                                                    @endguest
                                                    {{--<a class="add-to-bid" href="">Bid</a>--}}
                                                </div>
                                            </div>
                                        </div>

                                                @endif
                                        @endforeach

                                    </div>


                                </div>

                            </div>
                            <!-- product categoru end  -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- product area end  -->

        </div>
    </div>

<script>
    // Set the date we're counting down to
    // 1. JavaScript
    // var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
    // 2. PHP

    
    
    
    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get todays date and time
    // 1. JavaScript
    // var now = new Date().getTime();
    // 2. PHP
    
    //code here
    
    
    var productId = "{{ serialize($productId) }}"
    var CSRF_TOKEN = "{{ csrf_token() }}";
    
    $.ajax({
            type:'POST',
            url: "{{route('front.ajax.showMultipleProduct')}}",
//            data:{ price: price,  _token: $('#_token').val()},
            data:'productId='+productId+'&_token='+CSRF_TOKEN,
//            beforeSend: function () {
//                $('.submitBtn').attr("disabled","disabled");
//                $('.modal-body').css('opacity', '.5');
//            },
            success:function(success_data){
                console.log(success_data);
                if(success_data.success == true){
                    
                    $.each(success_data.products, function(key,data) {
//                        alert(data.id);
                    if(data.biding_histories.length > 0 ){
                    $('#product_username_'+data.biding_histories[0].product_id).html(data.biding_histories[0].username);
                    $('#product_id_'+data.biding_histories[0].product_id).data("bidding_history_id",data.biding_histories[0].id);
                    $('#product_id_'+data.biding_histories[0].product_id).data("product_price",data.biding_histories[0].price);
                    $('#product_id_'+data.biding_histories[0].product_id).data("last_bidding_user_id",data.biding_histories[0].user_id);
                    }
                    $('#product_price_'+data.id).html(' $ '+data.price.toFixed(2));
                    if((data.auctions.length > 0)){
                    $('#product_id_' + data.id).data("acuction_end_time", data.auctions[0].end_time);
                    }
                    console.log(data.price);
                    
                    if(!$.isEmptyObject(data.auctions) ){
                    console.log('time:'+success_data.time);
                    console.log(data.auctions[0].end_time);
                    
                    
                    var countDownDate = data.auctions[0].end_time * 1000;
                    var now = success_data.time*1000;
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
				if(data.winer_user_id == null || data.winer_user_id == 'null' && (data.auctions.length > 0) ){
                    document.getElementById("product_time_"+data.id).innerHTML = formateTwoDigit(hours) + ": " +
                            formateTwoDigit(minutes) + ": " + formateTwoDigit(seconds) ;
				}
                    console.log(hours + "h " + minutes + "m " + seconds + "s ");
                    // If the count down is over, write some text 
                    if (distance < 0) {
                    //clearInterval(x);
                    var last_bidding_user_id =$("#product_id_"+data.id).data('last_bidding_user_id');
                    var bidding_history_id =$("#product_id_"+data.id).data('bidding_history_id');
                    var product_id = $("#product_id_"+data.id).data('product_id');
                    var auction_id = $("#product_id_"+data.id).data('auction_id');
                    var user_id = $("#product_id_"+data.id).data('user_id');
                   
                    $.ajax({
                        url: "{{route('front.ajax.updatewinner')}}",
                        type: "POST",
                        data: {_token: CSRF_TOKEN, bidding_history_id: bidding_history_id , last_bidding_user_id:last_bidding_user_id, product_id:product_id, auction_id:auction_id, user_id:user_id},
                        dataType: 'JSON',
                      })
                      .done(function( msg ) {
                          console.log( "Data update: " + msg );
                            if(msg.winer_user_id == 1){

                              document.getElementById("product_time_"+data.id).innerHTML = "WINNER";

                          } else if(msg.winer_user_id == 1) {

                              document.getElementById("product_time_"+data.id).innerHTML = "EXPIRED";

                          }
                        });
                        
                        if(data.winer_user_id == 1){
                            
                           // document.getElementById("product_time_"+data.id).innerHTML = "WINNER";
                            
                        } else {
                            
                            document.getElementById("product_time_"+data.id).innerHTML = "EXPIRED";
                            
                        }
                    $("#product_id_"+data.id ).remove();
                    
                    }
                  }
                  }); 
                    
                }else{
                    
                }
                
            }
        });
    
    
    
    
    }, 1000);
</script>




@endsection
