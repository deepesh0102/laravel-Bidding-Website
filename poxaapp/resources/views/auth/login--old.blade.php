@extends('layouts.frontLayout.front_design')
@section('content')



    <!--tubo block -->
    <section class="tubo-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <ul>
                        <li><a href="{{ url('/') }}"> {{ __('Home') }}<i class="fa fa-angle-right"
                                                                         aria-hidden="true"></i></a></li>
                        <li class="active">{{ __('Login') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / tubo block -->

    <!--tittle block -->
    <section class="tittle-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="product-title">
                        <h1><span>Login<span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / tittle block -->

    <!--customer block -->
    <section class="customer-block">
        <div class="container">
            <div class="register">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 login-cont">
                        <div class="left">
                            <div class="or">
                                <em>OR</em>
                            </div>
                            <h2>I am a registered customer</h2>
                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">

                                @csrf

                                <div class="form-group">
                                    <label for="email">{{ __('E-Mail Address') }}<sub>*</sub></label>
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $errors->first('email') }}</strong>
                                                                            </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="pwd">{{ __('Password') }}<sub>*</sub></label>
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $errors->first('password') }}</strong>
                                                                            </span>
                                    @endif
                                </div>
                            <!--                                                                  <div class="form-group row">
                                                                    <div class="col-md-6 offset-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                                            <label class="form-check-label" for="remember">
                                                                                {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>-->
                                <button type="submit" class="btn btn-default">{{ __('Login') }}</button>

                            </form>
                            <!--<p>contact essco For Password?</p>-->
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12 login-cont">
                        <div class="right">
                            <div class="dealer">
                                <!--<a href="" class="btn">Request a New Dealer’s Account</a>-->

                                <a href="{{ route('password.request') }}"
                                   class="white-btn">{{ __('Forgot Your Password?') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / customer block -->



@endsection
