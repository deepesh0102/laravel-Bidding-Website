@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('product.viewproduct') }}">Products</a> <a href="#{{-- url(Request::path()) --}}" class="current">View Products</a> </div>
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
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  
                  <th>Image</th>
                  <th>Product ID</th>
                  <!--<th>Category ID</th>-->
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
<!--                  <th>Product Color</th>-->
                  <th>Price</th>
                  
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($products as $product)
<!--              <pre>
                {{-- print_r($product) --}}
                </pre>-->
                <tr class="gradeX">
                    <td>
                    @if(!empty($product->product_images))
                      <img src="{{ asset(Config::get('constants.image_url.backend_product_small_url').$product->product_images['0']->image_name) }}" style="width:60px;">
                    @else
                    
                       <img src="{{ asset(Config::get('constants.image_url.backend_common_url').'no_image.jpg') }}" style="width:60px;">
                    
                    @endif
                  </td>
                  <td>{{ $product->id }}</td>
                  <!--<td>{{-- $product->category_id --}}</td>-->
                  <td>{{ $product->category_name }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->product_code }}</td>
                  <!--<td>{{-- $product->product_color --}}</td>-->
                  <td>{{ $product->price }}</td>
                  
                  <td class="center">
                      
                      <a href="#" class="btn btn-success btn-mini" onclick="document.getElementById('copy_product_{{  $product->id }}').submit();">
                          <form action="{{ route('product.copyproduct') }}" id="copy_product_{{  $product->id }}" method="POST">
                              {{ csrf_field() }}
                              <input type="hidden" name="category_id"  value="{{  $product->category_id }}">
                              <input type="hidden" name="product_name"  value="{{  $product->product_name }}">
                              <input type="hidden" name="product_code"  value="{{ $product->product_code }}">
                              <textarea style="display:none;" name="description" >{{ $product->description  }}</textarea>
                              <input type="hidden" name="price"  value="{{ $product->price }}">
                              <input type="hidden" name="buy_now_price"  value="{{ $product->buy_now_price  }}">
                              <input type="hidden" name="image_name"  value="{{ $product->product_images['0']->image_name or 'no_image.jpg'  }}">
                              <textarea name="meta_description" style="display:none;" >{{ $product->meta_description  }}</textarea>
                              <textarea name="meta_keywords" style="display:none;" >{{ $product->meta_keywords  }}</textarea>
                              
                              
                          </form>
                          
                          
                          
                          
                          
                          Copy</a> 
                      <a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a> 
                      <a href="{{ route('product.editproduct', ['id'=>$product->id]) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a href="{{ route('product.viewproductimage', ['id'=>$product->id]) }}" class="btn btn-warning btn-mini">Image</a> 
                      <a href="{{ route('auction.store', ['id'=>$product->id]) }}" class="btn btn-info btn-mini">Create Auction</a> 
                      <a href="{{ route('auction.index', ['id'=>$product->id]) }}" class="btn btn-primary btn-mini">Auctions</a> 
                      <a id="updateStatusCat" onclick="return confirm('Are you sure {{$product->status == 1 ? 'De-Active':'Active' }} Product?');" href="{{ route('product.updatestatusproduct', ['id'=>$product->id, 'status'=>$product->status == 1 ? 0 : 1]) }}" class="btn btn-mini  {{$product->status == 1 ? 'btn-success':'btn-warning' }} ">{{$product->status == 1 ? 'Active':'De-Active' }}</a>
                      <a id="delCat" href="{{ route('product.deleteproduct', ['id'=>$product->id]) }}" onclick="return confirm('Are you sure Delete Product?');" class="btn btn-danger btn-mini">Delete</a>
                  </td>
                </tr>
                    <div id="myModal{{ $product->id }}" class="modal hide">
                      <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>{{ $product->product_name }} Full Details</h3>
                      </div>
                      <div class="modal-body">
                        <!--<p>Product ID: {{ $product->id }}</p>-->
                        <p>Category ID: {{ $product->category_name }}</p>
                        <p>Product Code: {{ $product->product_code }}</p>
                        <!--<p>Product Color: {{-- $product->product_color --}}</p>-->
                        <p>Price: {{ $product->price }}</p>
                        <p>Fabric: </p>
                        <p>Material: </p>
                        <p>Description: {{ $product->description }}</p>
                      </div>
                    </div>
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