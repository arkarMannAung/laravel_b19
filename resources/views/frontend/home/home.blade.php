@extends('frontend.master.master')
@php
use App\Categories;
use App\Subcategories;
use App\Brands;
use App\Items;
@endphp
@section('body')

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
		<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		
		<div class="carousel-inner">
		<div class="carousel-item active">
	      	<img src="{{ asset('image/banner/ac.jpg') }}" class="d-block w-100 bannerImg" alt="">
	    </div>
	    <div class="carousel-item">
	      	<img src="{{ asset('image/banner/giordano.jpg') }}" class="d-block w-100 bannerImg" alt="...">
	    </div>
	    <div class="carousel-item">
	      	<img src="{{ asset('image/banner/garnier.jpg') }}" class="d-block w-100 bannerImg" alt="...">
	    </div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  	</a>
	  	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	    	<span class="sr-only">Next</span>
	  	</a>
</div>

<!-- Content -->
<div class="container mt-5 px-5">
	<!-- Category -->
	<div class="row">
		@php
			$categorys=Categories::all();
		@endphp
		@foreach($categorys as $category)
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 ">
			<div class="card categoryCard border-0 shadow-sm p-3 mb-5 rounded text-center">
			  	<img src="{{ asset($category->logo)}}" class="card-img-top" alt="...">
			  	<div class="card-body">
			    	<p class="card-text font-weight-bold text-truncate"> {{$category->name}} </p>
			  	</div>
			</div>
		</div>
		@endforeach
	</div>

	<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>	
	<!-- Discount Item -->
	<div class="row mt-5">
		<h1> Discount Item </h1>
	</div>
	<span class="text text-muted">Note * retrieve only having discount and order by price</span>
    <!-- Disocunt Item -->
	<div class="row">
		<div class="col-12">
			<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">

	            <div class="MultiCarousel-inner">
	            @php
	            	$items=DB::table('Items')
	            			->where('discount','>',0)
	            			->orderBy('price','desc')
	            			->get();
	            	// $items=Items::all();
	            @endphp
	            @foreach($items as $item)
	                <div class="item">
	                    <div class="pad15">
				            <form id="detail{{$item->id}}" method="POST" action="{{ route('itemdetail') }}" class="d-none">
                            @method('GET')
                            <input type="text" name="id" value="{{$item->id}}">
				            </form>
							<a class="" href=""
				            onclick="event.preventDefault();
				            document.getElementById('detail{{$item->id}}').submit();">
				                <img src="{{$item->photo}}" class="img-fluid">
				            </a>

	                        <p class="text-truncate">{{$item->name}}</p>
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
							id='di{{$item->id}}'
							data-myid='#di{{$item->id}}'
							data-id='{{$item->id}}'
							data-code='{{$item->codeno}}'
							data-name='{{$item->name}}'
							data-photo='{{$item->photo}}'
							data-price='{{$item->price}}'
							data-discount='{{$item->discount}}'
							>Add to Cart</button>

	                    </div>
	                </div>                

					@endforeach

	             </div>


	            <button class="btn btnMain leftLst"><</button>
	            <button class="btn btnMain rightLst">></button>
	        </div>
	    </div>
	</div>

	<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>	
	<!-- Discount Item -->
	<div class="row mt-5">
		<h1> Fresh Picks  </h1>
		
	</div>
	<span class="text text-muted">Note * Pick latest (3) items per (1) subcategories</span>
    <!-- Fresh Item -->
	<div class="row">
		<div class="col-12">
			<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">

	        <div class="MultiCarousel-inner">
	        @php
	        	$subcates=Subcategories::all()
	        @endphp
	        @foreach($subcates as $subcate)
	            @php
	            	$items=DB::table('Items')
	            			->where('subcategory_id','=',$subcate->id)
	            			->orderBy('id','desc')
	            			->limit(3)
	            			->get();
	            	// $items=Items::all();
	            @endphp
	            @foreach($items as $item)
	                <div class="item">
	                    <div class="pad15">
				            <form id="detail{{$item->id}}" method="POST" action="{{ route('itemdetail') }}" class="d-none">
                            @method('GET')
                            <input type="text" name="id" value="{{$item->id}}">
				            </form>
							<a class="" href=""
				            onclick="event.preventDefault();
				            document.getElementById('detail{{$item->id}}').submit();">
				                <img src="{{$item->photo}}" class="img-fluid">
				            </a>
	                        <p class="text-truncate">{{$item->name}}</p>
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
							id='fr{{$item->id}}'
							data-myid='#fr{{$item->id}}'
							data-id='{{$item->id}}'
							data-code='{{$item->codeno}}'
							data-name='{{$item->name}}'
							data-photo='{{$item->photo}}'
							data-price='{{$item->price}}'
							data-discount='{{$item->discount}}'
							>Add to Cart</button>
	                    </div>
	                </div>                

					@endforeach
			@endforeach
	        </div>


	            <button class="btn btnMain leftLst"><</button>
	            <button class="btn btnMain rightLst">></button>
	        </div>
	    </div>
	</div>


		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>	
	<!-- Flash Item -->
	<div class="row mt-5">
		<h1> Flash Item </h1>
	</div>
	<span class="text text-muted">Note * this is random all from items table</span>
    <!-- Flash Item -->
	<div class="row">
		<div class="col-12">
			<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">

	            <div class="MultiCarousel-inner">
	            @php
	            	$items=DB::table('Items')
	            			->inRandomOrder()
	            			->get();
	            @endphp
	            @foreach($items as $item)
	                <div class="item">
	                    <div class="pad15">
				            <form id="detail{{$item->id}}" method="POST" action="{{ route('itemdetail') }}" class="d-none">
                            @method('GET')
                            <input type="text" name="id" value="{{$item->id}}">
				            </form>
							<a class="" href=""
				            onclick="event.preventDefault();
				            document.getElementById('detail{{$item->id}}').submit();">
				                <img src="{{$item->photo}}" class="img-fluid">
				            </a>
	                        <p class="text-truncate">{{$item->name}}</p>
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

					@endforeach

	             </div>

	            <button class="btn btnMain leftLst"><</button>
	            <button class="btn btnMain rightLst">></button>
	        </div>
	    </div>
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript" src="{{asset('js/cart.js')}}"></script>
@endsection