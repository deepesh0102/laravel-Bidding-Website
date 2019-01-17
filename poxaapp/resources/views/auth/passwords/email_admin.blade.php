<!DOCTYPE html>
<html lang="en">

    <head>
        <title>{{ __('Poxa Admin')}}</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ asset('public/css/backend_css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('public/css/backend_css/bootstrap-responsive.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('public/css/backend_css/matrix-login.css')}}" />
        <link href="{{ asset('public/fonts/backend_fonts/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox"> 
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
            @endif  
            <form  method="POST"  id="recover_form" action="{{ route('admin.password.email') }}" class="form-vertical">
                @csrf
                <div class="control-group normal_text"> <h3><img src="{{ asset('public/images/backend_images/logo.png')}}" alt="Logo" /></h3></div>
                <p class="normal_text">{{ __('Enter your e-mail address below and we will send you instructions how to recover a password.') }}</p>

                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input name="email" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-mail address')}}" required value="{{ old('email') }}" />
                        @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-actions">
                    <span class="pull-left"><a href="{{ route('admin.login') }}" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><input type="submit" value="{{ __('Send Password Reset Link') }}" class="btn btn-info" /></span>
                </div>
            </form>
        </div>

        <script src="{{ asset('public/js/backend_js/jquery.min.js')}}"></script>  
        <script src="{{ asset('public/js/backend_js/bootstrap.min.js')}}"></script> 
        <script src="{{ asset('public/js/backend_js/matrix.login.js')}}"></script> 
    </body>

</html>
