<header class="header header_style_01 custom-header">
    <nav class="megamenu navbar navbar-default">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset(Config::get('constants.frontendnew_image_url.frontend_common_url').'/logos/Logo.png') }}" alt="image"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div class="navbar-right">
                    <ul class="nav navbar-nav custm-menu">
                        <li><a  href="JavaScript:Void(0);">Auctions <span></span></a></li>
                        <li><a   href="{{route('howItWorks')}}">How it works <span></span></a></li>
                        <li><a href="JavaScript:Void(0);">About <span></span></a></li>
                        <li class="nth"><a href="JavaScript:Void(0);"> My Account</a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <!--  <li><a class="btn-light btn-radius btn-brd log" href="#" data-toggle="modal" data-target="#login"><i class="flaticon-padlock"></i> Customer Login</a></li> -->
                </ul>
            </div>
        </div>
    </nav>
</header>
