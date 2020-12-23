@extends('frontend.master.master')
@php
use App\Categories;
use App\Subcategories;
use App\Brands;
use App\Items;
@endphp
@section('body')

<!-- Subcategory Title -->
<div class="jumbotron jumbotron-fluid subtitle">
	<div class="container">
		<h1 class="text-center text-white"> Code Number : {{$items->codeno}} </h1>
	</div>
</div>

<!-- Content -->
<div class="container">
	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb ">
    	@php
			$subcate=Subcategories::find($items->subcategory_id);
			$categorie=Categories::find($subcate->category_id);
			$brand=Brands::find($items->brand_id);
		@endphp
	  	<ol class="breadcrumb bg-transparent">
	    	<li class="breadcrumb-item">
	    		<a href="{{route('home')}}" class="text-decoration-none secondarycolor">
	    			Home
	    		</a>
	    	</li>
	    	<li class="breadcrumb-item">
	    		<a href="javascript:void(0)" class="text-decoration-none secondarycolor">
	    			{{$categorie->name}}
    			</a>
	    	</li>
	    	<li class="breadcrumb-item">
	    		<form id="subcatedetail" method="POST" action="{{route('subcategorydetail')}}" class="d-none">
	    			{{-- @csrf --}}
	    			@method('GET')
	    			<input type="text" name="id" value="{{$subcate->id}}">
	    		</form>
	    		<a href="" class="text-decoration-none secondarycolor"
	    		onclick="event.preventDefault();
	    		document.getElementById('subcatedetail').submit();">
	    			{{$subcate->name}}
	    		</a>
	    	</li>
	    	<li class="breadcrumb-item active" aria-current="page">
				<a href="" class="text-decoration-none primarycolor"onclick="
					event.preventDefault();
					document.getElementById('detail{{$brand->id}}').submit();">
					{{$brand->name}}
				</a>
	    	</li>
	  	</ol>
	</nav>

	<div class="row mt-5">
		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
			<img src="{{asset($items->photo)}}" class="border border-dark img-fluid" style="border-radius: 40px">
		</div>	


		<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
			
			<h4> {{$items->name}} </h4>

			<div class="star-rating">
				<ul class="list-inline">
					@php
						$myram=rand(1,4);
					@endphp
					@for ($i=0; $i < $myram ; $i++)
					<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
					@endfor	
					<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
				</ul>
			</div>

			<p>
				{{$items->description}}
				<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum. -->
			</p>

			<p> 
				<span class="text-uppercase "> Current Price : </span>
				<span class="maincolor ml-3 font-weight-bolder"> 
				@if($items->discount>0) 
					{{$items->discount}}
				@else 
					{{$items->price}}
				@endif Ks </span>
			</p>

			<p> 
				<span class="text-uppercase"> Brand : 
					<a href="" class="text-decoration-none text-muted" onclick="
					event.preventDefault();
					document.getElementById('detail{{$brand->id}}').submit();">{{$brand->name}}
					</a></span>
				<span class="ml-3">
					<form id="detail{{$brand->id}}" method="POST" action="{{route('branddetail')}}" class="d-none">
						@method('GET')
						<input type="text" name="id" value="{{$brand->id}}">
					</form>
				</span>
			</p>

			<button name="addToCart"
			class="addtocartBtn text-decoration-none"
			id='fs{{$items->id}}'
			data-myid='#fs{{$items->id}}'
			data-id='{{$items->id}}'
			data-code='{{$items->codeno}}'
			data-name='{{$items->name}}'
			data-photo='{{$items->photo}}'
			data-price='{{$items->price}}'
			data-discount='{{$items->discount}}'
			>Add to Cart</button>
			
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-12">
			<h3> Related Item </h3>
			<hr>
		</div>

		@php
			$moreItems=DB::table('items')
				->where('subcategory_id','=',$subcate->id)
				->inRandomOrder()
				->get()
		@endphp
		@foreach($moreItems as $moreItem)
		<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12" id="jar">
			<div class="content">
			<form id="detail{{$moreItem->id}}" method="POST" action="{{ route('itemdetail') }}" class="d-none">
            @method('GET')
            <input type="text" name="id" value="{{$moreItem->id}}">
            </form>
			<a class="" href=""
            onclick="event.preventDefault();
            document.getElementById('detail{{$moreItem->id}}').submit();">
                <img src="{{$moreItem->photo}}" class="border border-info img-fluid" style="border-radius: 30px">
            </a>
        	</div>
		</div>
		@endforeach

	</div>
	<nav class="pt-5">
	  <ul class="pagination justify-content-center pagination-sm">
	  </ul>
	</nav>
</div>

@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/item.pj.js')}}"></script>
<script type="text/javascript" src="{{asset('js/cart.js')}}"></script>
@endsection