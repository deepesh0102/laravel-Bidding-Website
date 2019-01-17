@extends('layouts.frontnewLayout.front_design')
@section('content')


    <div class="wrapperc">
        <div class="category-bg">

            <div class="product-box">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!-- product category start -->
                            <div id="overviews" class="section wb">
                                <div class="">
                                    <h3 class="h3_head">Your Account

                                    </h3>
                                    <!--code Added by Deepesh-->

                                    <div class="container">

                                        <div class="row">
                                            <div class="col-sm-3"><!--left col-->

                                                <ul class="list-group">
                                                    <li class="list-group-item text-muted">Profile</li>
                                                    <li class="list-group-item text-right"><span class="pull-left"><strong>Joined</strong></span>{{date('d-m-Y', strtotime(Auth::user()->created_at))}}</li>
                                                    <li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> {{Auth::user()->email}}</li>
                                                    <li class="list-group-item text-right"><span class="pull-left"><strong>Name</strong></span> {{Auth::user()->name}}</li>

                                                </ul>

                                                {{--<div class="panel panel-default">--}}
                                                {{--<div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>--}}
                                                {{--<div class="panel-body"><a href="http://bootply.com">bootply.com</a></div>--}}
                                                {{--</div>--}}


                                                {{--<ul class="list-group">--}}
                                                {{--<li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>--}}
                                                {{--<li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>--}}
                                                {{--<li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>--}}
                                                {{--<li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>--}}
                                                {{--<li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>--}}
                                                {{--</ul>--}}

                                                {{--<div class="panel panel-default">--}}
                                                {{--<div class="panel-heading">Social Media</div>--}}
                                                {{--<div class="panel-body">--}}
                                                {{--<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>--}}
                                                {{--</div>--}}
                                                {{--</div>--}}

                                            </div><!--/col-3-->
                                            <div class="col-sm-9">

                                                <form class="form" action="##" method="post" id="registrationForm">
                                                    <div class="form-group">

                                                        <div class="col-xs-6">
                                                            <label for="first_name"><h4>Name</h4></label>
                                                            <input type="text" value="{{Auth::user()->name}}" style="max-width: 360px;" class="form-control" name="name" id="name" placeholder="Name" title="enter your  name .">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">

                                                        <div class="col-xs-6">
                                                            <label for="email"><h4>Email</h4></label>
                                                            <input type="email" value="{{Auth::user()->email}}" readonly style="max-width: 360px;" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">

                                                        <div class="col-xs-6">
                                                            <label for="password"><h4>Password</h4></label>
                                                            <input type="password" style="max-width: 360px;" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">

                                                        <div class="col-xs-6">
                                                            <label for="password2"><h4>Confirm Password</h4></label>
                                                            <input type="password" style="max-width: 360px;" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-xs-12">
                                                            <br>
                                                            {{--<button class="btn btn-lg btn-success" type="submit"> Save</button>--}}
                                                            {{--<button class="btn btn-lg" type="reset"> Reset</button>--}}
                                                        </div>
                                                    </div>
                                                </form>


                                            </div><!--/tab-content-->

                                        </div><!--/col-9-->
                                    </div><!--/row-->
                                    <!--code Added by Deepesh-->

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@section('script')
    {{--<script type="text/javascript" >--}}
    /* pagination */
    $.fn.pageMe = function(opts){
    var $this = this,
    defaults = {
    perPage: 7,
    showPrevNext: false,
    numbersPerPage: 1,
    hidePageNumbers: false
    },
    settings = $.extend(defaults, opts);

    var listElement = $this;
    var perPage = settings.perPage;
    var children = listElement.children();
    var pager = $('.pagination');

    if (typeof settings.childSelector!="undefined") {
    children = listElement.find(settings.childSelector);
    }

    if (typeof settings.pagerSelector!="undefined") {
    pager = $(settings.pagerSelector);
    }

    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);

    if (settings.showPrevNext){
    $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
    }

    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
    $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
    curr++;
    }

    if (settings.numbersPerPage>1) {
    $('.page_link').hide();
    $('.page_link').slice(pager.data("curr"), settings.numbersPerPage).show();
    }

    if (settings.showPrevNext){
    $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
    }

    pager.find('.page_link:first').addClass('active');
    if (numPages<=1) {
    pager.find('.next_link').hide();
    }
    pager.children().eq(1).addClass("active");

    children.hide();
    children.slice(0, perPage).show();

    pager.find('li .page_link').click(function(){
    var clickedPage = $(this).html().valueOf()-1;
    goTo(clickedPage,perPage);
    return false;
    });
    pager.find('li .prev_link').click(function(){
    previous();
    return false;
    });
    pager.find('li .next_link').click(function(){
    next();
    return false;
    });

    function previous(){
    var goToPage = parseInt(pager.data("curr")) - 1;
    goTo(goToPage);
    }

    function next(){
    goToPage = parseInt(pager.data("curr")) + 1;
    goTo(goToPage);
    }

    function goTo(page){
    var startAt = page * perPage,
    endOn = startAt + perPage;

    children.css('display','none').slice(startAt, endOn).show();

    if (page>=1) {
    pager.find('.prev_link').show();
    }
    else {
    pager.find('.prev_link').hide();
    }

    if (page<(numPages-1)) {
    pager.find('.next_link').show();
    }
    else {
    pager.find('.next_link').hide();
    }

    pager.data("curr",page);

    if (settings.numbersPerPage>1) {
    $('.page_link').hide();
    $('.page_link').slice(page, settings.numbersPerPage+page).show();
    }

    pager.children().removeClass("active");
    pager.children().eq(page+1).addClass("active");
    }
    };

    $('#items').pageMe({pagerSelector:'#myPager',childSelector:'tr',showPrevNext:true,hidePageNumbers:false,perPage:5});
    /****/

@stop
{{--// </script>--}}

@endsection

