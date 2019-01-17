@extends('layouts.frontnewLayout.front_design')
@section('content')
<div class="detail_prdct">
    <div class="container">
        <div class="card">
            <h1 class="auctions_is">LIVE AUCTIONS </h1>
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-4">

                        <div class="preview-pic tab-content">
                            @foreach( $products->productImages as $key => $productImage )
                            <div class="tab-pane {{$key == 0?'active':''}}" class="tab-pane active" id="pic-{{$productImage->id}}">
                                <img src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$productImage->image_name) }}" />
                            </div>

                            @endforeach
                        </div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            @foreach( $products->productImages as $key =>$productImage )
                            <li class="{{$key == 0?'active':''}}"><a data-target="#pic-{{$productImage->id}}" data-toggle="tab">
                                    <img src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$productImage->image_name) }}" />
                                </a></li>
                            @endforeach

                        </ul>

                    </div>
                    <div class="details col-md-4">
                        <h3 class="product-title">{{ $products->product_name }}</h3>
                        <button type="button" class="btn  custm_btn"> <span>Auction Price:</span> <span class="cstm_clr" id="product_price_{{$products->id}}">$ {{ number_format($products->price, 2) }}</span></button>
                        <p class="custm_text"><span>Bidder:</span> <span class="span_cstm" id="product_username_{{$products->id}}">{{$products->bidingHistories['0']->username or ''}}</span></p>
                        <div>

                            <div class="wact_img">
                                <img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'w.png') }}">
                            </div>
                            <div class="detail_watch">
                                @if(($products->winer_user_id == 'NULL' || $products->winer_user_id == 0 ))
                                {{--<p class="demo cstm_detail_timer">09:50:08</p>--}}
                                <p class="demo cstm_detail_timer" id="product_time_{{$products->id}}" style="width: 500px">time</p>
                                @else
                                    <p class="demo cstm_detail_timer">WINNER</p>
                                @endif
                                {{--<p class="demo cstm_detail_timer">09:50:08 <br><span>$ 0.50 15 seconds.</span></p>--}}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="line"></div>
                        <p class="detl_cnt">Xtra Time Auction : 10 hours added at the bid
                            deadline if it's not ended at 11:00 p.m.</p>
                        <p class="detl_cnt" id="product_msg_{{$products->id}}"></p>


                        @if($products->auctions->isNotEmpty())
                            @guest
                                @if($products->auctions['0']->is_expired == 1 && ($products->winer_user_id == 'NULL' || $products->winer_user_id == 0 ))

                                        <a class="add-to-bid cstm_btn_dt" href="{{ route('login') }}">Bid</a>

                                @endif
                            @else
                                @if($products->auctions['0']->is_expired == 1 && ($products->winer_user_id == 'NULL' || $products->winer_user_id == 0 ))
                                    <a class="add-to-bid cstm_btn_dt" data-acuction_end_time="{{ $products->auctions['0']->end_time or '' }}" data-bidding_history_id="{{$products->bidingHistories['0']->id or 0 }}" id="product_id_{{ $products->id }}" data-last_bidding_user_id="{{$products->bidingHistories['0']->user_id  or 0 }}" data-product_price="{{ $products->price }}" data-time="{{ $products->auctions['0']->time_inc }}" data-price="{{ $products->auctions['0']->price_inc }}" data-product_id="{{ $products->id }}" data-auction_id="{{ $products->auctions['0']->id }}" data-action="{{ route('front.ajax.addBidd') }}" data-user_id="{{  Auth::user()->id }}" data-user_name="{{  Auth::user()->name }}" data-csrf_token="{{ csrf_token() }}" onclick="goDobidding(this);">
                                        Bid
                                    </a>
                                @endif
                            @endguest

                        @endif

                    </div>
                    <div class="col-md-4">
                        <div class="head_detail">
                            <h4 class="cstm-head">Bid Histories</h4>
                        </div>
                        @if($products->bidingHistories->isNotEmpty())
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Time</th>
                                <th>Username</th>
                                <th>BID TYPE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products->bidingHistories as $bidingHistory)
                            <tr>
                                <td>{{ $bidingHistory->created_at }}</td>
                                <td>{{ $bidingHistory->username}}</td>
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
    </div>

</div>

<div class="clearfix"></div>
<div class="tabt_detail">
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active custm_tab_dtl"><a data-toggle="tab" href="#home">Description</a></li>
            <li><a data-toggle="tab" href="#menu1">Reviews</a></li>
            <li><a data-toggle="tab" href="#menu2">Statistics</a></li>
            <li><a data-toggle="tab" href="#menu3">Similar Auctions</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <h4>Description :</h4>
                <p>
                    {{ $products->description }}
                </p>
                {{--<h4>Details :</h4>--}}
                {{--<p>B06XPX66BN</p>--}}
                {{--<h4>Delivery: $ 10.00</h4>--}}
            </div>
            <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
            <div id="menu3" class="tab-pane fade">
                <h3>Menu 3</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>


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
