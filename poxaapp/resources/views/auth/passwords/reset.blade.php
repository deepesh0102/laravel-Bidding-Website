@extends('layouts.frontnewLayout.custom_front_design')
@section('content')
<div class="wrapperc">
    <!-- customer block -->
    <section class="customer-block cutm-register">
        <div class="container">
            <h1 class="global-heading"><span>{{ __('Reset Password') }}</span></h1>
            <div class="register">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 login-cont">
                        <div class="left">
                            <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">

                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <label for="email">{{ __('E-Mail Address') }}<sub>*</sub></label>
                                    <input placeholder="E-Mail Address" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

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
                                <button type="submit" class="btn btn-default">{{ __('Reset Password') }}</button>
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
