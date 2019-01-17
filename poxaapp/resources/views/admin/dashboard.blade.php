@extends('layouts.adminLayout.admin_design')
@section('content')
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb"> <a href="{{ route('admin.dashboard') }}"> <i class="icon-dashboard"></i> My Dashboard </a> </li>


      </ul>
    </div>

  </div>
</div>

<!--end-main-container-part-->
@endsection