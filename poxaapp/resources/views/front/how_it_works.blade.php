@extends('layouts.frontnewLayout.front_design')
@section('content')
<div class="wrapperc">
    <div class="bg-how-it">
        <!-- header shadow  start  -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header-shadow"><img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'header-shadow.png') }}" alt="topshadow"/></div>
                </div>
            </div>
        </div>
        <!-- header shadow  end   -->

        <!-- icons start here -->
        <div class="icons-box">
            <!-- main heading start -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1 class="main-heading btm-arrow">How Poxa Works</h1>
                    </div>
                    <!-- heading shadow start  -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-shadow"><img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'bottom-shadow.png') }}" alt="bottomshadow"/>	</div>
                    </div>
                </div>
            </div>

            <!-- main heading end  -->

            <!-- all icons  start -->
            <div class="icns-block">
                <div class="container">
                    <!-- repeat div  start -->
                    <div class="row">
                        <div class="main-parent">
                            <div class="main-child">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <h1>Sign Up and Buy Bids</h1>
                                    <p>Bids cost just <span>$0.50</span> apiece. Stock up and
                                        start searching our auctions for brand-new
                                        products.</p>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="icn-img"><img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'graphic-icon/notebook.png') }}" alt="notebook-icn"/></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- repeat div  end  -->

                    <!-- repeat div  start -->
                    <div class="row">
                        <div class="main-parent">
                            <div class="main-child custom-reversed">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="icn-img"><img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'graphic-icon/choose-products.png') }}" alt="notebook-icn"/></div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <h1>Choose Products</h1>
                                    <p>Pick whatever you want — an <span>HDTV, a new
		laptop, or even more bids.</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- repeat div  end  -->
                    <!-- repeat div  start -->
                    <div class="row">
                        <div class="main-parent">
                            <div class="main-child">
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                    <h1>Bid and Win</h1>
                                    <p>Just keep clicking that Bid button — if you’re the last to bid when the timer winds down,<span> YOU WIN!</span></p>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="icn-img"><img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'graphic-icon/bid-icn.png') }}" alt="notebook-icn"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- repeat div  end  -->

                </div>
            </div>
            <!-- all icons  end  -->
        </div>
        <!-- icons end  here -->

        <!-- register now button start -->
        <div class="signup-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sign-block">
                            <h1>Sign up and <span>Start Winning</span> Today!</h1>
                            <a href="{{ route('register') }}">Register Now!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- register now button end  -->

    </div>
</div>
@endsection
