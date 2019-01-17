@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ route('category.viewcategory') }}">Categories</a> <a href="#{{-- url(Request::path()) --}}" class="current">{{$title}}</a> </div>
    <h1>Categories</h1>
  </div>
  <div class="container-fluid"><hr>
      
       @if ($errors->any())
              <!--server side validation errors block -->
                    <div class="alert alert-error alert-block">
                        <button type="button" class="close" data-dismiss="alert">Ã—</button> 
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
      
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
              <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>{{$title}}</h5>
            <div class="buttons"> <a href="{{ route('category.viewcategory') }}" class="btn btn-info btn-mini"> Back</a></div>
            <!--<a href="{{ URL::previous()}}" class="btn btn-primary pull-right">Back</a>-->
          </div>
          <div class="widget-content nopadding">
              

             
              <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ $action }}" name="add_category" id="add_category" novalidate="novalidate"> {{ csrf_field() }}
              

              
              
                
              <div class="control-group">
                <label class="control-label">Category</label>
                <div class="controls">
                  <select name="parent_id" style="width: 220px;">
                    <option value="0">No Parent (Top Level)</option>
                    @foreach($levels as $val)
                        @if(isset($categoryDetails->parent_id))
                        
                             <option value="{{ $val->id }}"  @if($val->id == $categoryDetails->parent_id) selected @endif > {{ $val->name }} </option>
                        
                        @else
                             <option value="{{ $val->id }}"  > {{ $val->name }} </option>
                        @endif
                      
                    @endforeach
                  </select>
                </div>
              </div>
                
                <div class="control-group">
                <label class="control-label">Name*</label>
                <div class="controls">
                  <input type="text" name="category_name" id="category_name" value="{{ $categoryDetails->name or '' }}">
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Meta Description</label>
                <div class="controls">
                  <textarea name="meta_description" id="description">{{ $categoryDetails->meta_description or '' }}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Meta Keywords</label>
                <div class="controls">
                  <textarea name="meta_keywords" id="description">{{ $categoryDetails->meta_keywords or ''}}</textarea>
                </div>
              </div>
             

            <div class="control-group">
              <label class="control-label">Featured</label>
              <div class="controls">
                <label>
                    @if(isset($categoryDetails->featured))
                    
                         <input type="checkbox" name="featured" value="1"  @if($categoryDetails->featured == 1) checked @endif />
                    
                    @else
                         <input type="checkbox" name="featured" value="1" />
                    @endif
                   
                  </label>
                
              </div>
            </div>
                  @if(isset($categoryDetails->image))
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                    <ul class="thumbnails">
                        <li class="span2"> 
                            <a>
                                <img src="{{ asset('public/media/categories/large/'.$categoryDetails->image) }}" alt="{{$categoryDetails->image}}" >
                            </a>
                            
                            
                            <input type="hidden" name="old_image" value="{{$categoryDetails->image}}"/>
                            
                            
                         
                        </li>
                    </ul>
                </div>
                
              </div>
                  
                  @endif
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                    <input type="file" name="image"/>
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