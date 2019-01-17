<!-- header-wrap-->
<section id="header-wrap">
    <!-- header-block-->
    <section class="header-block">
        <!-- top -->
<!--        <div class="top">		
            <div class="container">	
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                        <div class="top-nav">
                            <a href="javascript:void(0);" class="toggle">Menu<i class="fa fa-angle-down"></i>
                            </a>
                            <ul>								
                                <li><a href="about-us.html">About</a></li> 
                                <li><a href="contact.html">Contact <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                </li>
                                <li><a href="order-history.html">Order History</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <!--/ top -->
        <!-- bottom -->
        <div class="bottom">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset(Config::get('constants.frontend_image_url.frontend_common_url').'logo.png') }}" alt="">
                    </a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="top-right">
                    <div class="call-us">
                        <ul>
                            @if (Route::has('login'))
                            
                            @auth
							<!-----startlogin---------------->
                             <li class="logout"><a href="#"><em>Hi</em><span class="user_mm">{{ Auth::user()->name }}</span></a></li>
                             <li class="logout">
                                 
                                 <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span>{{ __('Logout') }}</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
									
									<!-----end login---------------->
                           
                            @else
                            <!--<li class="login"><a href="{{ route('login') }}"><i></i><span>login</span></a></li>
                            <li class="login"><a href="{{ route('register') }}"><i></i><span>Register</span></a></li>-->
							<li class="login"><a href="{{ route('login') }}"><span>login</span></a></li>
							<li class="login"><a href="{{ route('register') }}"><span>Register</span></a></li>
                            @endauth
                            
                            @endif
                            <!--<li class="search"><a href="product-search-results.html"><i></i><span>Search </span></a></li>-->
                            <!--<li class="cart"><a href="shopping-cart.html"><i></i><span>cart</span></a></li>-->
                            

                        </ul>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">                            
                        <li>
                            <!--<a href="product-categories.html">PRODUCTS <i class="fa fa-angle-down"></i></a>-->
                            <a href="{{ route('front.show.products') }}">PRODUCTS </a>
<!--                            <ul>
                                <li><a href="category.html">PRODUCTS -1</a></li>
                                <li><a href="category.html">PRODUCTS -2</a></li>
                                <li><a href="category.html">PRODUCTS -3</a></li>
                            </ul>-->
                        </li>                      
                        <li><a href="{{route('aboutus')}}">About </a></li>
						<li><a href="{{route('packages')}}">Buy Bids </a></li>
                        <li><a href="#">Contact </a></li>								
                    </ul>
                </div>
            </div>
        </div>
        <!--/ bottom -->				

    </section>
    <!--/ header-block-->
</section>
<!--/ header-wrap-->