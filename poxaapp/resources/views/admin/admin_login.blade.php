<!DOCTYPE html>
<html lang="en">

    <head>
        <title>{{ __('Poxa Admin')}}</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="{{ asset('public/css/backend_css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('public/css/backend_css/bootstrap-responsive.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('public/css/backend_css/matrix-login.css')}}" />
        <link href="{{ asset('public/fonts/backend_fonts/font-awesome/css/font-awesome.css')}}        " rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox"> 
            @if(Session::has('flash_message_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismis                s="alert">×</button>	
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
            @endif  
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif   
            <form id="loginform" class="form-vertical" method="post" action="{{ route('admin.login.submit') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="control-group normal_text"> <h3><img src="{{ asset('public/images/backend_images/logo.png')}}" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="Email Address" name="email" value="{{ old('email') }}" required autofocus/>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required type="password" placeholder="Password" name="password" />
                        </div>
                    </div>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-actions">
                    <input style="display: none;" class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                           <span class="pull-left"><a href="{{ route('admin.password.request') }}" class="flip-link btn btn-info" id="password-recover">Lost password?</a></span>
                    <span class="pull-right"><input type="submit" value="Login" class="btn btn-success" /></span>
                </div>
            </form>

        </div>

        <script src="{{ asset('public/js/backend_js/jquery.min.js')}}"></script>  
        <script src="{{ asset('public/js/backend_js/bootstrap.min.js')}}"></script> 
        <script src="{{ asset('public/js/backend_js/matrix.login.js')}}"></script> 
    </body>

</html>
