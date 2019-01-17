@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('product.viewproduct') }}">Products</a> <a href="#{{-- url(Request::path()) --}}" class="current">View Auctions</a> </div>
    <h1>Auctions</h1>
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
            <h5>Auctions for : {{ $product_name->product_name }} </h5>
              <div class="buttons">
                  <a href="{{ route('auction.store', ['id'=>request()->segment(count(request()->segments()))]) }}" class="btn btn-info btn-mini"> Create Auction</a>
              </div>
          </div>
          <div class="widget-content nopadding">
            <table id="example" class="table table-bordered data-table">
              <thead>
                <tr>
                  
                  <th>S.No.</th>
                  <th>Auction ID</th>
                  <!--<th>Category ID</th>-->
                  <th>Title</th>
                  <th>Category</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Price</th>
                  <th>Active</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                
                  
                                 
                  
              	@foreach($auctions as $auction)
<!--              <pre>
                {{ print_r($auction) }}
                </pre>-->
                <tr class="gradeX">
                    <td>{{$no++}}</td>
                    <td>{{$auction->id}}</td>
                    <td>{{$auction->product->product_name}}</td>
                    <td>{{$auction->product->category->name}}</td>
                   
                    <td>{{ date("M j G:i:s ", $auction->start_time)}}</td>
                    <td>{{ date("M j G:i:s ", $auction->end_time)}}</td>
                    <td>{{$auction->price_inc}}</td>
                    <td>{{$auction->status == 1 ? 'Active':'De-Active' }}</td>
                    <td>Live</td>
                   
                  
                  <td class="center">

                      <a href="{{ route('auction.update', ['auction_id'=>$auction->id]) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a id="delCat" href="{{ route('auction.destroy', ['id'=>$auction->id]) }}" onclick="return confirm('Are you sure Delete Auction?');" class="btn btn-danger btn-mini">Delete</a>
                      <a href="{{ route('auction.bidlistingByProduct', ['product_id'=>$auction->product->id,'auction_id'=>$auction->id]) }}" class="btn btn-primary btn-mini">Bids Placed</a> 
                      <a href="javascript:void(0);" class="btn btn-primary btn-mini">View Winner</a> 
                      <!--<a href="{{ route('auction.destroy', ['id'=>$auction->id]) }}" class="btn btn-primary btn-mini">Auction</a>--> 
                      <!--<a id="updateStatusCat" onclick="return confirm('Are you sure {{$auction->status == 1 ? 'De-Active':'Active' }} Product?');" href="{{ url('/admin/update-status-product/'.$auction->id.'/'.($auction->status == 1 ? 0 : 1)  ) }}" class="btn btn-mini  {{$auction->status == 1 ? 'btn-success':'btn-warning' }} ">{{$auction->status == 1 ? 'Active':'De-Active' }}</a>-->
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
