@extends('frontend.master.master')
@section('body')

	<div class="jumbotron jumbotron-fluid subtitle">
		<div class="container">
			<h1 class="text-center text-white"> Order Received</h1>
		</div>
	</div>

	<div class="container my-5">
		<!-- Shopping Cart Div -->
		<div class="row mt-5 shoppingcart_div">
			<div class="col-12">
				<a href="{{route('home')}}" class="btn mainfullbtncolor btn-secondary float-right px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue
				</a>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="row">
				<div class="col-4">
					<img src="{{asset('image/success-tick-dribbble.gif')}}" class="img-fluid">		
				</div>
				<div class="col-8 pt-5">
					<h1>Your order is complete</h1>
					<p>You order will be delivered in a 4 days</p>
				</div>
				
			</div>
			
		</div>
		
	</div>

@endsection