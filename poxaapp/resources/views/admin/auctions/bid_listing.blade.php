@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('admin/product-listing') }}">Products</a> <a href="#{{-- url(Request::path()) --}}" class="current">View Auctions</a> </div>
    <h1>{{$title}}</h1>
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
            <h5>Bids Placed </h5>
          </div>
          <div class="widget-content nopadding">
            <table id="example" class="table table-bordered data-table">
              <thead>
                <tr>
                  
                  <th>S.No.</th>
                  <th>Auction ID</th>
                  <th>User Name</th>
                  <th>Auction Title</th>
                  <th>Bid Type</th>
                  <th>Date Placed</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
                
                  
                                 
                  
              	@foreach($bidingHistories as $bidingHistory)
<!--              <pre>
                {{ print_r($bidingHistory) }}
                </pre>-->
                <tr class="gradeX">
                    <td>{{$no++}}</td>
                    <td style="text-align: center;">{{$bidingHistory->auction_id}}</td>
                    <td style="text-align: center;">{{$bidingHistory->user->name}}</td>
                    <td style="text-align: center;">{{$bidingHistory->product->product_name}}</td>
                    <td style="text-align: center;">{{$bidingHistory->bid_type == 1?'Bid':'Auto Bid'}}</td>
                    <td style="text-align: center;">{{ date("M j G:i:s ", strtotime($bidingHistory->created_at))}}</td>
                    <td style="text-align: center;">

                      <a href="{{ route('auction.bidlistingByProduct', ['product_id'=>$bidingHistory->product_id,'auction_id'=>$bidingHistory->auction_id]) }}" class="btn btn-primary btn-mini">View</a> 
                      
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