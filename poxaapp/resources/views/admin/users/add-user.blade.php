@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('autobidder.index') }}">Autobidders</a> <a href="#{{-- url('admin/add-product') --}}" class="current">{{$title}}</a> </div>
    <h1>Autobidders</h1>
    @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
  </div>
  <div class="container-fluid">
      <hr>
      @if ($errors->any())
              <!--server side validation errors block -->
                    <div class="alert alert-error alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>
                            <ul>
                               @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                               @endforeach
                           </ul>
                        </strong>
                    </div>
              <hr>
              <!--server side validation errors block -->
        @endif
         <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>{{$title}}</h5>
            <div class="buttons"> <a href="{{ route('user.userlisting') }}" class="btn btn-info btn-mini"> Back</a></div>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ $action }}" name="add_autobidder" id="add_autobidder" novalidate="novalidate"> {{ csrf_field() }}

              <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                  <input placeholder="Enter Name" type="text" name="name" id="name" value="{{ $users->name or old('name') }}">
                    {{--@if ($errors->has('name'))--}}
                        {{--<span class="invalid-feedback" role="alert">--}}
                                                {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                            {{--</span>--}}
                    {{--@endif--}}
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                  <input placeholder="Enter Email"  type="text" name="email" id="email" value="{{ $users->email or old('email')  }}">
                    {{--@if ($errors->has('email'))--}}
                        {{--<span class="invalid-feedback" role="alert">--}}
                                                {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                            {{--</span>--}}
                    {{--@endif--}}
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                  <input placeholder="Enter Password" type="text" name="password" id="password" value="">
                    {{--@if ($errors->has('password'))--}}
                        {{--<span class="invalid-feedback" role="alert">--}}
                                                {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                            {{--</span>--}}
                    {{--@endif--}}
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Confirm Password</label>
                <div class="controls">
                  <input placeholder="Enter Confirm Password" type="text" name="password_confirmation" id="password-confirm" value="">
                </div>
              </div>
              <div class="control-group">
              <label class="control-label">Active </label>
              <div class="controls">
                <label>
                    @if(isset($autobidders->status))

                         <input type="checkbox" name="status" value="1"  @if($autobidders->status == 1) checked @endif />

                    @else
                         <input type="checkbox" name="status" value="1" />
                    @endif

                  </label>

              </div>
            </div>

              <div class="form-actions">
                <input type="submit" value="{{$button_title}}" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
