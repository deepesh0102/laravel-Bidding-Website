@extends('layouts.adminLayout.admin_design')
@section('content')
<?php use App\Http\Controllers\CategoryController;?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('category.viewcategory') }}">Categories</a> <a href="{{-- url('admin/category/list-categories') --}}#" class="current">List Categories</a> </div>
    <h1>Categories</h1>
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
            <h5>View Categories</h5>
            
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Category ID</th>
                  <th>Category Name</th>

                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @if($parent_id)
                    @foreach($categories as $category)
                    <tr class="gradeX">
                      <td>{{$no++}}</td>
                      <td>{{ $category->name }}</td>

                      <td class="center">
                          <a href="{{ route('category.editcategory', ['id'=>$category->id]) }}" class="btn btn-primary btn-mini">Edit</a> 
                          <a id="updateStatusCat" onclick="return confirm('Are you sure'.{{$category->status == 1 ? 'De-Active':'Active' }}.' Sub-Category?');" href=" {{ route('category.updatestatuscategory', ['id'=>$category->id, 'status'=>$category->status == 1 ? 0 : 1]) }}" class="btn btn-mini  {{$category->status == 1 ? 'btn-success':'btn-warning' }} ">{{$category->status == 1 ? 'Active':'De-Active' }}</a>
                          <a id="delCat" onclick="return confirm('Are you sure Delete Category?');" href="{{ route('category.deletecategory', ['id'=>$category->id]) }}" class="btn btn-danger btn-mini">Delete</a>
                      </td>
                    </tr>
                    @endforeach
                    
                @else
                
                    
                    @foreach($categories as $category)
                    <tr class="gradeX">
                      <td>{{$no++}}</td>
                      <td>{{ $category->name }}</td>

                      <td class="center">
                          <a href="{{ route('category.editcategory', ['id'=>$category->id]) }}" class="btn btn-primary btn-mini">Edit</a> 
                           @if( CategoryController::getChiderenCount($category->id)> 0 )
                          <a href="{{ route('category.viewchildcategory', ['id'=>$category->id]) }}"  class="btn btn-primary btn-mini"> Child Category</a> 
                          @endif 
                           <a id="updateStatusCat" onclick="return confirm('Are you sure {{$category->status == 1 ? 'De-Active':'Active' }} Category?');" href="{{ route('category.updatestatuscategory', ['id'=>$category->id, 'status'=>$category->status == 1 ? 0 : 1]) }}" class="btn btn-mini  {{$category->status == 1 ? 'btn-success':'btn-warning' }} ">{{$category->status == 1 ? 'Active':'De-Active' }}</a>
                          <a id="delCat" href="{{ route('category.deletecategory', ['id'=>$category->id]) }}" onclick="return confirm('Are you sure Delete Category?');" class="btn btn-danger btn-mini">Delete</a>
                       </td>
                    </tr>
                    @endforeach
                
                @endif
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection