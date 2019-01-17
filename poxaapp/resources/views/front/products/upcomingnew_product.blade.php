@extends('layouts.frontnewLayout.front_design')
@section('content')
    <div class="detail_prdct">
        <div class="container">
            <div class="card">
                <h1 class="auctions_is">UPCOMING AUCTION </h1>
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-4">

                            <div class="preview-pic tab-content">
                                @foreach( $upcomingproducts->productImages as $key => $productImage )
                                    <div class="tab-pane {{$key == 0?'active':''}}" class="tab-pane active" id="pic-{{$productImage->id}}">
                                        <img src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$productImage->image_name) }}" />
                                    </div>

                                @endforeach
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                                @foreach( $upcomingproducts->productImages as $key =>$productImage )
                                    <li class="{{$key == 0?'active':''}}"><a data-target="#pic-{{$productImage->id}}" data-toggle="tab">
                                            <img src="{{ asset(Config::get('constants.image_url.backend_product_large_url').$productImage->image_name) }}" />
                                        </a></li>
                                @endforeach

                            </ul>

                        </div>
                        <div class="details col-md-4">
                            <h3 class="product-title">{{ $upcomingproducts->product_name }}</h3>
                            <button type="button" class="btn  custm_btn"> <span>Auction Price:</span> <span class="cstm_clr" id="product_price_{{$upcomingproducts->id}}">$ {{ number_format($upcomingproducts->price, 2) }}</span></button>
                            <p class="custm_text"><span><strong>Live Auction After:</strong></span> </p>
                            <div>

                                <div class="wact_img">
                                    <img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'w.png') }}">
                                </div>
                                <div class="detail_watch">
                                    @if(($upcomingproducts->winer_user_id == 'NULL' || $upcomingproducts->winer_user_id == 0 ))
                                        {{--<p class="demo cstm_detail_timer">09:50:08</p>--}}
                                        <p class="demo cstm_detail_timer" id="product_time_{{$upcomingproducts->id}}" style="width: 500px">time</p>
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
                            <p class="detl_cnt" id="product_msg_{{$upcomingproducts->id}}"></p>




                        </div>
                        <div class="col-md-4">
                            <div class="head_detail">
                                <h4 class="cstm-head">Bid Histories</h4>
                            </div>
                            @if($upcomingproducts->bidingHistories->isNotEmpty())
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Username</th>
                                        <th>BID TYPE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($upcomingproducts->bidingHistories as $bidingHistory)
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
                        {{ $upcomingproducts->description }}

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


    <!--/ alter-block -->
    <script>

        //upcoming product function in javascript;
        var xv = setInterval(function () {
            var productId;
            var countDownDate;
            var now;
            var distance;
            var data = {!! $upcomingproducts !!};

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
