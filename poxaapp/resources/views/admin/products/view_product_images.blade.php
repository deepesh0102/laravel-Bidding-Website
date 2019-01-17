@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('product.viewproduct') }}">Products</a> <a href="#" class="current">Product Image</a> </div>
    <h1>Product Images</h1>
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
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-picture"></i> </span>
            <h5>Product Images</h5>
            <div class="buttons"> <a href="{{ route('product.viewproduct') }}" class="btn btn-info btn-mini"> Back</a></div>
            <div class="buttons"> <a href="{{ route( 'product.addproductimage', ['id'=>Request::segment(4)] ) }}" class="btn btn-primary btn-mini"> Upload a new image </a></div>
            
          </div>
          <div class="widget-content">
            <ul class="thumbnails">
                @if(!empty($productImages))
                    @foreach($productImages as $product)
                    <li class="span2"> 
                        <a class="thumbnail lightbox_trigger" href="{{ asset(Config::get('constants.image_url.backend_product_small_url').$product->image_name) }}">
                         <img src="{{ asset(Config::get('constants.image_url.backend_product_small_url').$product->image_name) }}" alt="" > 
                        </a>
                      <div class="actions"> 
                          <a id="delProImg" href="{{ route( 'product.deleteproductimage', ['id'=>$product->id] ) }}" onclick="return confirm('Are you sure Delete Product Image?');" title="Delete Image" class="" href="#">
                              <i class="icon-trash"></i>
                          </a> 
                          <a class="lightbox_trigger" title="View Image" href="{{ asset(Config::get('constants.image_url.backend_product_small_url').$product->image_name) }}">
                              <i class="icon-search"></i>
                          </a>
                      </div>
                    </li>
                  @endforeach
                @else
                <div class="text-center">No Image Found</div>
                @endif 
                 
            </ul>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection