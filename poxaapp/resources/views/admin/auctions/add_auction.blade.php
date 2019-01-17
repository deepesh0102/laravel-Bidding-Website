@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('product.viewproduct') }}">Products</a> <a href="#{{-- url('admin/add-product') --}}" class="current">{{$title}}</a> </div>
    <h1>Products</h1>
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
            <div class="buttons"> <a href="{{ route('product.viewproduct') }}" class="btn btn-info btn-mini"> Back</a></div>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ $action }}" name="add_auction" id="add_auction" novalidate="novalidate"> {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Start Time*</label>
                <div class="controls controls-row">
                    <select class="span3 m-wrap" name="smonth" id="smonth" >{!! $start_months_dropdown !!}</select>
                    <select class="span1 m-wrap" name="sdays" id="sdays" >{!! $start_days_dropdown !!}</select>
                    <select class="span2 m-wrap" name="syear" id="syear" >{!! $start_years_dropdown !!}></select>
                    <select class="span1 m-wrap" name="shours" id="shours" >{!! $start_hours_dropdown !!}</select>
                    <select class="span1 m-wrap" name="smin" id="smin" >{!! $start_minutes_dropdown !!}</select>
                    <select class="span1 m-wrap" name="ssec" id="ssec" >{!! $start_seconds_dropdown !!}</select>

                    
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">End Time*</label>
                <div class="controls controls-row">
                    <select class="span3 m-wrap" name="emonth" id="emonth" >{!! $end_months_dropdown !!}</select>
                    <select class="span1 m-wrap" name="edays"  id="edays" >{!! $end_days_dropdown !!}</select>
                    <select class="span2 m-wrap" name="eyear"  id="eyear" >{!! $end_years_dropdown !!}></select>
                    <select class="span1 m-wrap" name="ehours" id="ehours" >{!! $end_hours_dropdown !!}</select>
                    <select class="span1 m-wrap" name="emin"   id="emin" >{!! $end_minutes_dropdown !!}</select>
                    <select class="span1 m-wrap" name="esec"   id="esec" >{!! $end_seconds_dropdown !!}</select>
                   
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Price Increment</label>
                <div class="controls">
                  <input type="text" name="price_inc" id="price_inc" value="{{ $auctionDetails->price_inc or '0.01' }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Time Increment</label>
                <div class="controls">
                    <input type="text" name="time_inc" id="time_inc" value="{{ $auctionDetails->time_inc or '20'}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Min Real Bids</label>
                <div class="controls">
                  <input type="text" name="min_real_bids" id="min_real_bids" value="{{ $auctionDetails->min_real_bids or '20'}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Autobid Limit</label>
                <div class="controls">
                  <input type="text" name="autobid_limit" id="autobid_limit" value="{{ $auctionDetails->autobid_limit or '10' }}">
                </div>
              </div>
              <div class="control-group">
              <label class="control-label">Active - show this auction on the website : </label> 
              <div class="controls">
                <label>
                    @if(isset($auctionDetails->status))
                    
                         <input type="checkbox" name="status" value="1"  @if($auctionDetails->status == 1) checked @endif />
                    
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