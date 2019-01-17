<!--sidebar-menu-->
<div id="sidebar"><a href="{{ url('/') }}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="{{ request()->is('admin') ? 'active' : '' }}"><a href="{{ url('admin') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>

    <li class="submenu"> <a href="#"><i class="icon icon-cog"></i> <span>Settings</span> <span class="label label-important">1</span></a>
      <ul>
        <li><a href="{{ url('admin/updatepassword') }}">Password</a></li>
      </ul>
    </li>
    <li class="submenu {{ request()->is('admin/category/*') ? 'active open' : '' }}"> <a href="#"><i class="icon icon-cog"></i> <span>Categories</span> </a>
      <ul>

            <li > <a href="{{ route('category.viewcategory') }}"> <span>List Categories</span></a> </li>
            <li > <a href="{{ route('category.addcategory') }}"> <span>Add Categories</span></a> </li>
      </ul>
    </li>
   <li class="submenu {{ request()->is('admin/product/*') ? 'active open' : '' }}"> <a href="#"><i class="icon icon-cog"></i> <span>Products</span> </a>
      <ul>


            <li > <a href="{{ route('product.viewproduct') }}"> <span>Product Listing</span></a> </li>
            <li > <a href="{{ route('product.addproduct') }}"> <span>Add Product</span></a> </li>
      </ul>
    </li>
    <!--All Live Auctions Listing-->
   <li class="submenu {{ request()->is('admin/auction/*') ? 'active open' : '' }}"> <a href="#"><i class="icon icon-cog"></i> <span>Auctions</span> </a>
      <ul>

            <li > <a href="{{ route('auction.live_acuction') }}"> <span>Live Auction Listing</span></a> </li>
            <li > <a href="{{ route('auction.up_coming_acuction') }}"> <span>Upcoming Auction Listing</span></a> </li>
            <li > <a href="{{ route('auction.won_acuction') }}"> <span>Won Auction Listing</span></a> </li>
            <li > <a href="{{ route('auction.bidlisting') }}"> <span>Bid Placed</span></a> </li>


      </ul>
    </li>
    <!--All Live Auctions Listing-->
    <!--User Manager Start!-->

    <li class="submenu {{ request()->is('admin/users/*') ? 'active open' : '' }}"> <a href="#"><i class="icon icon-cog"></i> <span>Manage User</span> </a>
      <ul>

            <li > <a href="{{ route('autobidder.index') }}"> <span>Autobidders</span></a> </li>
            <li > <a href="{{ route('autobidder.create') }}"> <span>Add Autobidders</span></a> </li>
            <li > <a href="{{ route('user.userlisting') }}"> <span>Users Listing</span></a> </li>
            <li > <a href="{{ route('user.create') }}"> <span>Add User</span></a> </li>



      </ul>
    </li>
    <!--User Manager End!-->
    <!--Bidding Package Start!-->

    <li class="submenu {{ request()->is('admin/bidding/*') ? 'active open' : '' }}"> <a href="#"><i class="icon icon-cog"></i> <span>Manage Bidding Packages</span> </a>
      <ul>

            <li > <a href="{{ route('bidding.index') }}"> <span>Bidding Packages</span></a> </li>
            <li > <a href="{{ route('bidding.create') }}"> <span>Add Bidding Packages</span></a> </li>



      </ul>
    </li>
     <!--Bidding Package End!-->


  </ul>
</div>
<!--sidebar-menu-->
<!--
<script>
$(".submenu li a").on("click", function(){
     $(this).parent().parent().addClass("active") ;
     $(this).parent().parent().addClass("open") ;
    });
</script>-->
