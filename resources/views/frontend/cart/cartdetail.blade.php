@extends('frontend.master.master')
@section('body')

	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Your Shopping Cart </h1>
  		</div>
	</div>

		<!-- Content -->
	<div class="container mt-5">
		
		<!-- Shopping Cart Div -->
		<div class="row mt-5 shoppingcart_div">
			<div class="col-12">
				<a href="{{route('home')}}" class="btn mainfullbtncolor btn-secondary float-right px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue Shopping 
				</a>
			</div>
		</div>

		<div class="row mt-5 shoppingcart_div" id="cartTable">
			<div class="table-responsive">
				<table class="table" border="0">
					<thead>
						<tr>
							<th colspan="3" class="text-center"> Product </th>
							<th colspan="3" class="text-center"> Qty </th>
							<th class="text-center"> Price </th>
							<th class="text-center"> Total </th>
						</tr>
					</thead>
					<tbody id="shoppingcart_table">
						
					</tbody>
					<tfoot>
						<tr id="shoppingcart_tfoot">
							
						</tr>
						<tr> 
							<td colspan="5"> 
								<textarea class="form-control" id="notes" placeholder="Any Request..."></textarea>
							</td>
							<td colspan="3">
								@if(Auth::user()!=null)
									@if(Auth::user()->email_verified_at)
									<button name='checkOut' class="btn btn-secondary btn-block mainfullbtncolor checkoutbtn"> 
										Check Out
									</button>	
									@else
									<a href='{{route('verification.notice')}}' class="btn btn-secondary btn-block mainfullbtncolor checkoutbtn"> 
										Please Verify Email!
									</a>
									@endif
								@else
								<a href='{{route('login')}}' class="btn btn-secondary btn-block mainfullbtncolor checkoutbtn"> 
									Please Signin
								</a>
								@endif
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
	// for ajax
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	// for ajax
	$('button[name=checkOut').click(function(){
		var note = $('#notes').val();
		var myLocal = 'shopcart';
		var myArray=JSON.parse(localStorage.getItem(myLocal));

		if (myArray) {
			var carts = myArray;
			var total = 0;
			// var noti = 0;
			$.each(myArray, function(i,v){
				var price = v.price;
				var discount = v.discount;
				var qty = v.qty;
				if (discount){
					var price=discount;
				}
				var subTotal = price * qty;
				// noti += qty ++;
				total += subTotal ++;
			})

			$.post("{{ route('orders.store') }}",{
				carts:carts,
				note:note,
				total:total
			},function (response){
				if (response=='done') {
					localStorage.removeItem(myLocal);
					location.href='{{route('ordersucess')}}';
				}
			})
		}
	})
})
</script>
<script type="text/javascript" src="{{asset('js/cart.js')}}"></script>
@endsection