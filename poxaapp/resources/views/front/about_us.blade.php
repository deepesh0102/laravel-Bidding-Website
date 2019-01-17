@extends('layouts.frontnewLayout.front_design')
@section('content')


    <div class="wrapperc">
        <div class="bg-how-it">
            <!-- header shadow  start  -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-shadow"><img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'header-shadow.png') }}" alt="topshadow"></div>
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
                            <h1 class="main-heading btm-arrow">{{ __('About Us') }}</h1>
                        </div>
                        <!-- heading shadow start  -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-shadow"><img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'bottom-shadow.png') }}" alt="bottomshadow">	</div>
                        </div>
                    </div>
                </div>

                <!-- main heading end  -->

                <!-- all icons  start -->

                <!-- all icons  end  -->
            </div>
            <!-- icons end  here -->

            <!-- register now button start -->
            <div class="signup-box">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="sign-block">
                                <h1>{{ __('Sign up and') }} <span>{{ __('Start Winning') }}</span> {{ __('Today!') }}</h1>
                                <a href="{{route('register')}}">{{ __('Register Now!') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- register now button end  -->

        </div>
    </div>


@endsection
