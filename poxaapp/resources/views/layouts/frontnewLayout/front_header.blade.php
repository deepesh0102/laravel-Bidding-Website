<!-- register popup start -->
<div class="register-popup">
    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="loginmodal-container">
                <div class="pop-head">
                    <h1>Registration</h1>
                    <p>To register with Poxa, please complete the following:</p>
                </div>
                <form id="register" method="POST" action="javascript:void(0);">
                    @csrf

                    <div class="full-from">
                        <div class="formgrup">
                            <input id="name" type="text" placeholder="Your Name" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif

                        </div>
                        <div class="formgrup">
                            <input id="email" placeholder="Your Email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            <span id="email-error" class="invalid-feedback" role="alert"></span>
                            @if ($errors->has('email'))
                                <span id="email-error" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="formgrup">

                            <input pattern=".{6,15}" title="6 to 15 characters " placeholder="Create Password" id="password" min="6" max="15" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            <span id="password-error" class="invalid-feedback" role="alert"></span>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            {{--<span class="eror">Demo</span>--}}
                            <span class="chractr">Must be at least 6 characters.</span>
                        </div>
                        <div class="formgrup">

                            <input placeholder="Confirm Password" pattern=".{6,15}" title="6 to 15 characters " id="password-confirm" type="password"  name="password_confirmation" required>

                            {{--<span class="eror">Demo</span>--}}
                            {{--<span class="chractr">Must be at least 10 characters.</span>--}}
                        </div>
                        <div class="textstart">
                            <label class="contanr">I have read and accept the <span>Terms of Use and
	Privacy Policy</span>.
                                <input type="checkbox" checked="checked"/>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <input type="submit" name="LetGo" class="login loginmodal-submit" value="Let’s Go">
                </form>

                <div class="login-help">
                    <p>Already have an account?  <a href="{{route('login')}}">LogIn</a></p>
                </div>
                <span class="close-icn"><i class="fa fa-times" aria-hidden="true" data-dismiss="modal"></i></span>
            </div>
        </div>
    </div>
</div>
<!-- register popup end  -->

{{--<header class="header header_style_01">--}}
<header class="header header_style_01 hide-topbar">
    <nav class="megamenu navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="{{ url('/') }}">

                    <img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/logos/Logo.png') }}" alt="image"/>

                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div class="navbar-right">
                    <ul class="top_head">
                        @if (Auth::check())
							{{--<li class="logout"><a href="#"><span>Hello,  </Span><span class="user_mm">{{ Auth::user()->name }}</span></a></li>
                            <li>

                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <span>{{ __('Logout') }}</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>


                            </li>--}}
                        @else
                            <li><a href="#" data-toggle="modal" data-target="#register-modal">Register</a></li>
                            {{--<li><a href="{{ route('register') }}"><span>Register</span></a></li>--}}
                        @endif
                        {{--<li><a href="#">New Account</a></li>--}}
                        <li><a href="#">Help </a></li>
                        <li><a href="#">Feedback</a></li>
                    </ul>
                    <!-- Start Check Login Condition-->
                    @auth
                        {{--if logedin--}}
						<!-- hi vikas is here  -->
						<ul class="logedin">
                        <li class="logout"><a href="#"><span>Hello,  </Span><span class="user_mm">{{ Auth::user()->name }}</span></a></li>
                        <li class="logout">

                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form-2').submit();">
                                <span class="lgout">{{ __('Logout') }}</span>
                            </a>

                            <form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
						</ul>
						<div class="clearfix"></div>
						<!-- hi vikas is here end  -->
						
                    @else
                        <div class="top-formsection">
                            {{--if not logged in--}}
                            <ul class="form-cstm">
                            <form method="POST" class="form-inline pull-right" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group custm-btn-top ">
                                    {{--<span class="custm-fb"></span>--}}
                                    {{--<button type="submit" class="btn btn-info custm-btn"> Login with Facebook</button>--}}
                                    {{--<br><label></label>--}}
                                </div>
                                <div class="form-group customform">
                                    <span class="custm-user"></span>
                                    <input name="email"  type="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email-login" placeholder="Username:" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback eror" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <br><label style="visibility: hidden;"><input type="checkbox" class="inpt-check"> <span class="remeber1">Remember me</span></label>
                                </div>
                                <div class="form-group custm-pwd">

                                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password-login" placeholder="Password:" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <br>
                                    <label>
                                        <span class="remeber2">
                                            <a href="{{ route('password.request') }}" class="white_color">{{ __('Forgot Your Password?') }}</a>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default custm-btn-login">{{ __('Login') }}</button>
                                    <br><label></label>
                                </div>
                            </form>
                        </ul>
                        </div>

                    @endauth
                    {{-- End Check Login Condition--}}


                    <ul class="nav navbar-nav custm-menu">
                        <li><a class="active" href="{{ route('front.show.products') }}">Auctions <span></span></a></li>
                        <li><a href="{{route('howItWorks')}}">How it works <span></span></a></li>
                        <li><a href="{{route('aboutus')}}">About <span></span></a></li>
                        <li class="nth"><a href="{{Auth::check()?route('home'):route('login')}}"> My Account</a></li>
                    </ul>

                </div>
                <ul class="nav navbar-nav navbar-right">
                    <!--  <li><a class="btn-light btn-radius btn-brd log" href="#" data-toggle="modal" data-target="#login"><i class="flaticon-padlock"></i> Customer Login</a></li> -->



                </ul>
            </div>

        </div>
    </nav>
</header>

