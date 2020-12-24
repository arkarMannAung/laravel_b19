@extends('backend.master.master')
@php
use App\Order;
use App\User;
use App\Items;
use App\Item_order;
@endphp
@section('body')

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>A Printable Invoice Format</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> <?= $user['name'] ?></h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: {{$order->orderdate}}</h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">From
                  <address><strong>{{$user->name}}</strong><br>user address<br>Email: {{$user->email}}</address>
                </div>
                <div class="col-4">To
                  <address><strong>{{Auth::user()->name}}</strong><br>admin address<br>Email: {{Auth::user()->mail}}</address>
                </div>
                <div class="col-4"><b>Invoice #{{$order->voucherno}}</b><br><br><b>Order ID:</b> {{$order->id}}<br><b>Payment Due:</b> -<br><b>Account ID:</b> {{$user->id}}</div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Qty</th>
                        <th>Product Name</th>
                        <th>codeno</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                    	@php
                    		$item_orders=Item_order::where('order_id','=',$order->id)->get();
                    	@endphp
                    	@foreach ($item_orders as $item_order)
                    		@php 
                    			$item=Items::find($item_order->item_id);
                    			if ($item->discount=='') {
                    				$price=$item->price;
                    			}else{
									$price=$item->discount;
                    			}
                    		@endphp
	                    <tr>
	                    	<td>{{$item_order->qty}}</td> 
	                        <td>{{$item->name}}</td> 
	                        <td>{{$item->codeno}}</td> 
	                        <td>{{$item->description}}</td> 
	                        <td class="text-right">{{number_format(($item_order->qty)*$price,2)}}</td>
	                    </tr>
                      	@endforeach
                      	<tr>
                      		<td colspan="4" class="text-right font-weight-bold">Total</td>
                      		<td class="text-right font-weight-bold">{{number_format($order->total,2)}}</td>
                      	</tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="{{route('order_list')}}"><i class="fa fa-print"></i> Back</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>

@endsection