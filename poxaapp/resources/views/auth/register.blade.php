@extends('layouts.frontnewLayout.custom_front_design')
@section('content')

    <div class="wrapperc">
        <!-- customer block -->
        <section class="customer-block cutm-register">
            <div class="container">
{{--                <h1 class="global-heading">{{ __('Register') }}</h1>--}}
                <h1 class="global-heading"><span>{{ __('Register') }}</span></h1>
                <div class="register">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 login-cont">
                            <div class="left">
                                <form method="POST" action="{{ route('register') }}" aria-label="Login">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}<sub>*</sub></label>
                                        {{--<input id="name" type="input" class="form-control" name="email" value="" required="" autofocus=""><span class="eror">Eror</span>--}}
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('E-Mail Address') }}<sub>*</sub></label>
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Password') }}<sub>*</sub></label>
                                        <input placeholder="Password" pattern=".{6,15}" title="6 to 15 characters " id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                        <span class="chractr">Must be at least 6 characters.</span>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Confirm Password') }}<sub>*</sub></label>
                                        <input placeholder="Confirm Password" pattern=".{6,15}" title="6 to 15 characters " id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                    <button type="submit" class="btn btn-default">Register</button>
                                    <a href="{{route('login')}}"  class="btn btn-default">Login</a>
                                </form>
                                <!--<p>contact essco For Password?</p>-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- customer block -->
    </div>

@endsection
