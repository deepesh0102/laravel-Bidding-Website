@extends('layouts.frontLayout.front_design')
@section('content')

<section class="tittle-block">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="product-title">
							<h1><span>Checkout Now<span></span></span></h1>
						</div>
					</div>
				</div>
			</div>
		</section>

{{-- print_r($packageDetails) --}}
<section class="about-block">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <button class="btn btn-success">Checkout Now</button>
    </div>
</div>
</section>



@endsection