@extends('layouts.frontLayout.front_design')
@section('content')

<section class="tittle-block">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="product-title">
					<h1><span>Bid Packages<span></span></span></h1>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="package-block">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
		<div class="doc_width shadow_bg"> 
			<div id="rightcol" class="package_box package_page">
				<h2> Which Package Is Right For You?</h2>
				<div class="perfect_text">Perfect For Beginners  </div>

				<ul>


					@foreach($BiddingPackages as $BiddingPackage)
					<li>
						<form action="{{route('payment')}}" method="POST" name="formulario">
							@csrf
							<label class="bid_park">{{$BiddingPackage->number_of_bids}} Bid Pak</label>
							<span class="bid"><strong>{{$BiddingPackage->number_of_bids}}</strong> Bids</span>				 
							<p class="bid_price">  $ {{$BiddingPackage->price}} </p>
							<input type="hidden" name ="id" value="{{ $BiddingPackage->id }}" />
							<input type="hidden" name ="price" value="{{ $BiddingPackage->price }}" />
							<input type="hidden" name ="number_of_bids" value="{{ $BiddingPackage->number_of_bids }}" />
							<input type="hidden" name ="name" value="{{ $BiddingPackage->name }}" />


							<div class="package_btn"> 
								<input class="paybtn" type="submit" name="submit_package_10" id="submit" value="Purchase Using Paypal!" class="send" style="cursor:pointer;">
							</div>                                              

						</form>     
					</li> 


					@endforeach



				</ul>
			</div>
		</div>
</div>
    </div>
</div>
</section>


@endsection