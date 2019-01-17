@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('product.viewproduct') }}">Products</a> <a href="#{{-- route('product.addproduct') --}}" class="current">{{$title}}</a> </div>
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
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ $action }}" name="add_product" id="add_product" novalidate="novalidate"> {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Category*</label>
                <div class="controls">
                  <select name="category_id" id="category_id" style="width: 220px;">  
                    <?php echo $categories_dropdown; ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Name*</label>
                <div class="controls">
                    <input type="text" name="product_name" id="product_name" value="{{  $productDetails->product_name or  old('product_name')  }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code" value="{{ $productDetails->product_code or old('product_code') }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea name="description" id="description">{{ $productDetails->description or old('description') }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Price*</label>
                <div class="controls">
                  <input type="text" name="price" id="price" value="{{ $productDetails->price or old('price')}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Buy Now Price</label>
                <div class="controls">
                  <input type="text" name="buy_now_price" id="buy_now_price" value="{{ $productDetails->buy_now_price or old('buy_now_price') }}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta Description</label>
                <div class="controls">
                  <textarea name="meta_description" id="description">{{ $productDetails->meta_description or old('meta_description') }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta Keywords</label>
                <div class="controls">
                  <textarea name="meta_keywords" id="description">{{ $productDetails->meta_keywords or old('meta_keywords') }}</textarea>
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