@extends('layouts.frontLayout.front_design')
@section('content')

		<section class="tittle-block">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="product-title">
							<h1><span>Reset Password<span></span></span></h1>
						</div>
					</div>
				</div>
			</div>
		</section>
<section class="register-block">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!--<div class="card-header">{{ __('Reset Password') }}</div>-->

                <div class="card-body">
                    <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            
                        </div>

                        <div class="form-group row mb-0">
                          
                                <button type="submit" class="btn btn-primary custmbtn">
                                    {{ __('Reset Password') }}
                                </button>
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
