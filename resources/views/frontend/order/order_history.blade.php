@extends('frontend.master.master')
@section('body')

	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Order History </h1>
  		</div>
	</div>

	<div class="container">
		<div class="row">
			@foreach($orders as $order)

			<div class="col-lg-4 col-md-6 col-sm-12 col-12 p-4">
				<div class="card">
					<h5 class="card-header">Voucher No - #{{$order->voucherno}}</h5>
					<div class="card-body">
						<h6 class="card-subtitle mb-2 text-muted">Date - {{$order->orderdate}}</h6>
						<h6 class="card-subtitle mb-2">Total - {{number_format($order->total)}} Kyat</h6>
						<p class="card-text">
							<span>Order Status -</span>
							@if($order->status == 'Order')
								<span class="badge text-white rounded-pill bg-warning">
									{{$order->status}}
								</span>
							@elseif ($order->status == "Confirm")
								<span class="badge text-white rounded-pill bg-info">
									{{$order->status}}
								</span>
							@elseif ($order->status == "Delivery")
								<span class="badge text-white rounded-pill bg-success">
									{{$order->status}}
								</span>
							@else
								<span class="badge text-white rounded-pill bg-danger">
									{{$order->status}}
								</span>
							@endif
						</p>
						<form id="orderdetail{{$order->id}}" action="{{route('orderdetail')}}" method="POST" class="d-none">
							@csrf
							@method('GET')
							<input type="text" name="id" value="{{$order->id}}">
						</form>
						<a href="{{route('orderdetail')}}" class="btn btn-primary card-link float-right" onclick="
						event.preventDefault();document.getElementById('orderdetail{{$order->id}}').submit();"> Detail </a>
					</div>
					
				</div>
			</div>
			@endforeach
		</div>
	</div>

@endsection