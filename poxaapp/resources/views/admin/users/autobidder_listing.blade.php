@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="{{ __('Go to Home') }}" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('autobidder.index') }}">{{ __('Autobidders') }}</a> <a href="#{{-- url(Request::path()) --}}" class="current">{{ __('View Auctions') }}</a> </div>
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
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Autobidders</h5>
            <div class="buttons"> <a href="{{ route('autobidder.create') }}" class="btn btn-info btn-mini"> Add a Autobidder </a></div>
          </div>
          <div class="widget-content nopadding">
            <table id="example" class="table table-bordered data-table">
              <thead>
                <tr>
                  
                  <th>S.No.</th>
                  <th>User Name</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
                
                  
                                 
                  
              	@foreach($autobidders as $autobidder)
<!--              <pre>
                {{ print_r($autobidders) }}
                </pre>-->
                <tr class="gradeX">
                    <td>{{$no++}}</td>
                    <td style="text-align: center;">{{$autobidder->name}}</td>
                    <td style="text-align: center;">{{$autobidder->status == 1?'Active':'De-Active'}}</td>
                    <td style="text-align: center;">
                        
                        <a href="{{ route('autobidder.update', ['autobidder_id'=>$autobidder->id]) }}" class="btn btn-primary btn-mini">Edit</a> 
                        <a id="delCat" href="{{ route('autobidder.destroy', ['autobidder_id'=>$autobidder->id]) }}" onclick="return confirm('Are you sure Delete User?');" class="btn btn-danger btn-mini">Delete</a>
                  
                        
                    </td>
                    
                </tr>
                
                @endforeach
                
                
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection