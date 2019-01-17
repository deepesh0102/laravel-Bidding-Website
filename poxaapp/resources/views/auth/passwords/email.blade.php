@extends('layouts.frontnewLayout.custom_front_design')
@section('content')
    <div class="wrapperc">
        <!-- customer block -->
        <section class="customer-block cutm-register">
            <div class="container">
                <h1 class="global-heading"><span>{{ __('FORGOT PASSWORD') }} </span></h1>
                <div class="register">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 login-cont">
                            <div class="left">
                                <form method="POST" action="{{ route('password.email') }}" aria-label="Login">
                                    @csrf
                                    <input placeholder="Enter Email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <button type="submit" class="btn btn-default">{{ __('Send Password Reset Link') }}</button>
                                    <a href="{{route('register')}}"  class="btn btn-default">Create Account</a>
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
