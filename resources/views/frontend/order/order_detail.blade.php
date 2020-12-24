@extends('frontend.master.master')
@php
use App\Order;
use App\Items;

@endphp
@section('body')

<!-- Subcategory Title -->
<div class="jumbotron jumbotron-fluid subtitle">
		<div class="container">
		<h1 class="text-center text-white"> Order Detail </h1>
		</div>
</div>
<div class="container">
	<!-- Shopping Cart Div -->
	<div class="row mt-5 shoppingcart_div">
		<div class="col-12">
			<a href="{{route('orders.index')}}" class="btn mainfullbtncolor btn-secondary float-right px-3" > 
				<i class="icofont-reply"></i>
				Order History 
			</a>
		</div>
	</div>
	<div class="mt-5 d-flex justify-content-between mb-3">
		@php
			$order=Order::find($item_orders[0]->order_id);
		@endphp
		<div class="p-2 text-muted">
			<h4>Date : {{$order->orderdate}}	</h4> 
		</div>
		<div class="p-2 text-muted">
			<h4>Voucherno - #{{$order->voucherno}} </h4>
		</div>
	
	</div>	
	<div class="row  shoppingcart_div">
		<div class="table-responsive">
			<table class="table" border="0">
				<thead>
					<tr>
						<th class="text-center"> No </th>
						<th class="text-center"> Photo </th>
						<th class="text-center"> Product </th>
						<th class="text-center"> Qty </th>
						<th class="text-center"> Price </th>
						<th class="text-center"> Total </th>
					</tr>
				</thead>
				<tbody>
					@php
						$i=0
					@endphp
					@foreach ($item_orders as $item_order)
					@php
						$item=Items::find($item_order->item_id);
					@endphp
					<tr>
						<td class="text-center align-middle">{{++$i}}</td>
						<td class="text-center align-middle">
							<img src="{{$item->photo}}" class='img-fluid' style='width: 100px'>
						</td>
						<td class="text-left align-middle">
							<span>{{$item->name}}</span><br>
							<span>{{$item->codeno}}</span>
						</td>
						@php
							if ($item->discount!='') {
								$price = $item->discount;
							} else {
								$price = $item->price;
							}
							$total = $item_order->qty * $price;
							$subtotal = $order['total'];
						@endphp
						<td class="text-center align-middle">{{$item_order->qty}}</td>
						<td class="text-right align-middle">{{number_format($price)}}</td>
						<td class="text-right align-middle">{{number_format($total,2)}}</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="5" class="text-right align-middle font-weight-bold">
							Sub Total
						</td>
						<td class="text-right align-middle font-weight-bold">
							{{number_format($subtotal,2)}}
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- Shopping Cart Div -->
	<div class="row mt-5 shoppingcart_div">
		<div class="col-12">
			<a href="{{route('orders.index')}}" class="btn mainfullbtncolor btn-secondary float-right px-3" > 
				<i class="icofont-reply"></i>
				Order History 
			</a>
		</div>
	</div>
</div>

@endsection