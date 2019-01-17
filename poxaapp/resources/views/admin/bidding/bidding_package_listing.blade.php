@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('bidding.index') }}">{{ __('Bidding Packages') }}</a> <a href="#{{-- url(Request::path()) --}}" class="current">{{ __('Bidding Packages') }}</a> </div>
    <h1>{{ __('View Bidding Packages') }}</h1>
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
            <h5>{{ __('Bidding Packages') }}</h5>
            <div class="buttons"> <a href="{{ route('bidding.create') }}" class="btn btn-info btn-mini"> {{ __('Add a Package') }} </a></div>
          </div>
          <div class="widget-content nopadding">
            <table id="example" class="table table-bordered data-table">
              <thead>
                <tr>
                  
                  <th>S.No.</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>No. Bids</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
                
                  
                                 
                  
              	@foreach($BiddingPackages as $BiddingPackage)
<!--              <pre>
                {{ print_r($BiddingPackage) }}
                </pre>-->
                <tr class="gradeX">
                    <td>{{$no++}}</td>
                    <td style="text-align: center;">{{$BiddingPackage->name}}</td>
                    <td style="text-align: center;">{{$BiddingPackage->price}}</td>
                    <td style="text-align: center;">{{$BiddingPackage->number_of_bids}}</td>
                    <td style="text-align: center;">{{$BiddingPackage->status == 1?'Active':'De-Active'}}</td>
                    <td style="text-align: center;">
                        
                        <a href="{{ route('bidding.update', ['autobidder_id'=>$BiddingPackage->id]) }}" class="btn btn-primary btn-mini">Edit</a> 
                        <a id="delCat" href="{{ route('bidding.destroy', ['autobidder_id'=>$BiddingPackage->id]) }}" onclick="return confirm('Are you sure Delete Package?');" class="btn btn-danger btn-mini">Delete</a>
                  
                        
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