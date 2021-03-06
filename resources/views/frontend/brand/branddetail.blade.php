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
    		<h1 class="text-center text-white"> {{$brand->name}} </h1>
  		</div>
	</div>
	
	<!-- cart -->
 	<div class="container">
		<nav aria-label="breadcrumb ">
		  	<ol class="breadcrumb bg-transparent">
    			@php
    				$temp_items=Items::where('brand_id','=',$brand->id)->first();
    				$temp_subcate=Subcategories::find($temp_items->subcategory_id);
    				$temp_cate=Categories::find($temp_subcate->category_id);
    			@endphp
		    	<li class="breadcrumb-item">
		    		<a href="{{route('home')}}" class="text-decoration-none secondarycolor">
		    			Home
		    		</a>
		    	</li>
 		    	<li class="breadcrumb-item">
					<form id="detail{{$temp_cate->id}}" method="POST" action="" class="d-none">
		    			{{-- @csrf --}}
		    			@method('GET')
		    			<input type="text" name="id" value="{{$temp_cate->id}}">
		    		</form>
		    		<a href="" class="text-decoration-none secondarycolor" onclick="event.preventDefault();
	    			document.getElementById('detail{{$temp_cate->id}}').submit();">
		    			{{$temp_cate->name}}
	    			</a>
		    	</li>
		    	<li class="breadcrumb-item">
					<form id="detail{{$temp_subcate->id}}" method="POST" action="{{route('subcategorydetail')}}" class="d-none">
		    			{{-- @csrf --}}
		    			@method('GET')
		    			<input type="text" name="id" value="{{$temp_subcate->id}}">
		    		</form>
		    		<a href="" class="text-decoration-none secondarycolor" onclick="event.preventDefault();
	    			document.getElementById('detail{{$temp_subcate->id}}').submit();">
		    			{{$temp_subcate->name}}
		    		</a>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
					<a href="javascript:void(0)" class="text-decoration-none primarycolor">
						{{$brand->name}}
					</a>
		    	</li>
		  	</ol>
		</nav>

	<div class="row mt-5">

		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
			<ul class="list-group">
				@php
				$otherbrands=Brands::all();
				@endphp
				@foreach($otherbrands as $otherbrand)
					@php
					if ($otherbrand->name==$brand->name){
						$state=' active';
					}else{
						$state=' ';
					}
					
					@endphp
			  	<li class="list-group-item {{$state}}">
			  		<form id="subdetail{{$otherbrand->id}}" method="POST" action="{{route('branddetail')}}" class="d-none">
			  			@method('GET')
			  			<input type="" name="id" value="{{$otherbrand->id}}">
			  		</form>
			  		<a href="" class="text-decoration-none secondarycolor"
			  		onclick="event.preventDefault();
			  		document.getElementById('subdetail{{$otherbrand->id}}').submit();">
			  		{{$otherbrand->name}} 
			  		</a>
			  	</li>
			  	@endforeach
			</ul>
			{{-- <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>	 --}}
			{{-- <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>	 --}}
			<nav class="pt-5">
			  <ul class="pagination justify-content-center pagination-sm">
			  </ul>
			</nav>
		</div>	


		<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
			<div class="row">
			@php
				$items=Items::all()->where('brand_id','=',$brand->id);
			@endphp
			@foreach($items as $item)
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" id="jar">
					<div class="card pad15 mb-3 content">
							<form id="detail{{$item->id}}" method="POST" action="{{ route('itemdetail') }}" class="d-none">
                            @method('GET')
                            <input type="text" name="id" value="{{$item->id}}">
				            </form>						
						<a class="" href=""
				            onclick="event.preventDefault();
				            document.getElementById('detail{{$item->id}}').submit();">
					  		<img src="{{$item->photo}}" class="card-img-top" alt="...">
					  	</a>
					  	<div class="card-body text-center">
					    	<h5 class="card-title text-truncate">{{$item->name}}</h5>
					    	
					    	<p class="item-price">
	                        	@if($item->discount>0)
		                		<strike>{{number_format($item->price,2)}} Ks </strike>
                        		<span class="d-block">{{number_format($item->discount,2)}} Ks</span>
	                        	@else
                        		<span class="d-block">{{number_format($item->price,2)}} Ks</span>
	                        	@endif
	                        </p>

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

							<button name="addToCart"
							class="addtocartBtn text-decoration-none"
							id='fs{{$item->id}}'
							data-myid='#fs{{$item->id}}'
							data-id='{{$item->id}}'
							data-code='{{$item->codeno}}'
							data-name='{{$item->name}}'
							data-photo='{{$item->photo}}'
							data-price='{{$item->price}}'
							data-discount='{{$item->discount}}'
							>Add to Cart</button>
					  	</div>
					</div>
				</div>
			@endforeach
			</div>
		</div>

	</div>

@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/pagination.js')}}"></script>
<script type="text/javascript" src="{{asset('js/cart.js')}}"></script>
@endsection