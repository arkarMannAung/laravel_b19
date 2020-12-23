@php
use App\Categories;
use App\Subcategories;
use App\Brands;
use App\Items;
@endphp
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title> Shopules </title>

	<!-- Favicon-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
	<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">

    <!-- iconfont CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('icon/icofont/icofont.min.css') }}">
	<!-- Boxicon CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('icon/boxicons-master/css/boxicons.min.css') }}">
    
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/media_query.css') }}">
    
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- OWL CAROUSEL -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.css') }}">

</head>
<body>
	<div id="myPage"></div>
	<!-- Navigation-->
	<div class="container-fluid">

		<div class="row shadow-sm p-3 bg-white rounded d-flex align-items-center">
			<!-- LOGO -->
			<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-4 order-1">
				<span class="d-xl-none d-lg-none d-md-inline d-sm-inline d-inline  p-1 navslidemenu">
					<i class="icofont-navigation-menu"></i>
				</span>
				<img src="{{ asset('logo/logo_big.jpg') }}" class="img-fluid d-xl-inline d-lg-inline d-md-none d-sm-none d-none">

				<img src="{{ asset('logo/logo_med.jpg') }}" class="img-fluid d-xl-none d-lg-none d-md-inline d-sm-none d-none" style="width: 100px">

				<img src="{{ asset('logo/logo.jpg') }}" class="img-fluid d-xl-none d-lg-none d-md-none d-sm-inline d-inline pl-2" style="width: 30px">
			</div>
			
			<!-- Search Bar -->
			<div class="col-xl-6 col-lg-6 col-md-4 col-sm-2 col-2 order-xl-2 order-lg-2 order-md-3 order-sm-3 order-3">
				<div class="row">
					<div class="col-lg-8 col-2 ">
						<div class="has-search d-xl-block d-lg-block d-none ">
						    <div class="input-group">
				                <input class="form-control pl-4 border-right-0 border" type="search" placeholder="Search" id="">
				                <span class="input-group-append searchBtn">
				                    <div class="input-group-text bg-transparent">
				                    	<i class="icofont-search"></i>
				                    </div>
				                </span>
				            </div>
						</div>
					</div>
					<div class="col-lg-4 col-10">
						@if(Auth::user()!=null)
					        <a href="javascript:void(0)" class="d-xl-block d-lg-block d-md-block d-none  text-decoration-none loginLink float-right" data-toggle="dropdown" role="button"> 
					            {{Auth::user()->name}}
					            <i class="icofont-rounded-down"></i>
					        </a>

					        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					            <a class="dropdown-item" href="profile.php">
					                Profile
					            </a>
					            <div class="dropdown-divider"></div>


					            <a class="dropdown-item" href="{{ route('orders.index')}}">
					                Order History
					            </a>
					            <div class="dropdown-divider"></div>

					            <a class="dropdown-item" href="secret.php">
					                Change Password
					            </a>
					            <div class="dropdown-divider"></div>
					            <a class="dropdown-item" href=""
					            onclick="event.preventDefault();
					            document.getElementById('logout').submit();">
					                Logout
					            </a>
					            <form id="logout" method="POST" action="{{ route('logout')}}" class="d-none">
					            @csrf
					            </form>
					        </div>

					    @else

					        <a href="{{ route('login')}}" class="d-xl-block d-lg-block d-md-block d-none  text-decoration-none loginLink float-right"> Login | Sign-up </a>

					    @endif
					</div>
				</div>
			</div>
			


			<!-- Shopping-cart -->
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 order-xl-3 order-lg-3 order-md-4 order-sm-4 order-4 text-right">
				<!-- Search ICON shopping cart -->

				<div class="d-xl-none d-lg-none d-md-none d-sm-inline d-inline searchiconBtn mr-2">
					<i class="icofont-search"></i>
				</div>
				<form id="shopcart" method="POST" action="{{route('cartdetail')}}" class="d-none">
					@method('GET')
					<input type="text" name="id" value="id">
				</form>
				<a href="" class="text-decoration-none d-xl-inline d-lg-inline d-md-inline d-sm-none d-none shoppingcartLink"
				onclick="event.preventDefault();document.getElementById('shopcart').submit();"> 
					<i class="icofont-shopping-cart"></i> 
					<span class="badge badge-pill badge-light badge-notify cartNotistyle cartNoti" 
					id="itemNo">  </span>
					<span id="itemTotal">  </span>  <!-- 4,800 -->
				</a>

				<a href="" class="text-decoration-none d-xl-none d-lg-none d-md-none d-sm-inline-block d-inline-block shoppingcartLink" 
				onclick="event.preventDefault();document.getElementById('shopcart').submit();"> 
					<i class="icofont-shopping-cart"></i>
					<span class="badge badge-pill badge-light badge-notify cartNotistyle cartNoti" id="itemNo2"> </span>
				</a>

				<!-- App Download -->

				<img src="{{ asset('image/download.png') }}" class="img-fluid d-xl-inline d-lg-inline d-md-none d-sm-none d-none" style="width: 150px">
			</div>
		</div>
	</div>
	

<style type="text/css">
	div.stroke a{
	  margin: 0 auto;
	  color: gray;
	  padding: 15px 0;
	}

	div.stroke a,
	div.stroke a:after,
	div.stroke a:before {
	  transition: all .5s;
	}
	div.stroke a:hover {
	  color: black;
	}
	div.stroke a{
	  position: relative;
	}
	div.stroke a:after{
	  position: absolute;
	  bottom: 0;
	  left: 0;
	  right: 0;
	  margin: auto;
	  width: 0%;
	  content: '.';
	  color: transparent;
	  background: #aaa;
	  height: 2px;
	}
	div.stroke a:hover:after {
	  width: 100%;
	}
</style>	
	<!-- Sub Nav (MOBILE) -->
	<div class="container subNav d-xl-block d-lg-block d-none my-3">
		<div class="d-flex justify-content-between align-items-center">
			<div class="stroke">
				{{-- <p class="d-inline pr-3"> Shop By </p> --}}
				<a href="{{route('home')}}" class="text-decoration-none p-3 font-weight-bold {{ Request::is('/home') ? 'text-dark' : '' }}"> HOME </a>
			</div>
			<div class="align-items-center">	
				<div class="dropdown d-inline-block stroke">
          			<a class="nav-link text-decoration-none d-block p-3 font-weight-bold" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          	<span class="mr-2"> CATEGORY </span>
						<i class="icofont-rounded-down pt-2"></i>

			        </a>
			        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			        	@php 
			        	$categories=Categories::orderBy('id','asc')->get();
			        	@endphp
				        @foreach ($categories as $categorie)	
			          	<li class="dropdown-submenu">
			          		<a class="dropdown-item ml-3" style="width: 90%" href="javascript:void(0)">
			          			{{$categorie->name}}
			          			<i class="icofont-rounded-right float-right"></i>
			          		</a>
				            <ul class="dropdown-menu">

				            	<h6 class="dropdown-header">
				            		{{$categorie->name}}

				            	</h6>

				            	<!-- sub drop -->
				            	@php
								$subcates=Subcategories::where('category_id','=',$categorie->id)->get();
				            	@endphp
				            	@foreach($subcates as $subcate)
								<li>
									<form id="subdetail{{$subcate->name}}" action="{{route('subcategorydetail')}}" method="POST" class="d-none">
										@method('GET')
										<input type="" name="id" value="{{$subcate->id}}">
										
									</form>
									<a class="dropdown-item ml-3" style="width: 90%"  
									href="" onclick="event.preventDefault();
									document.getElementById('subdetail{{$subcate->name}}').submit();"
									>{{$subcate->name}}</a>
								</li>
				              				      
				            	@endforeach

				              	<!-- sub drop -->

				            </ul>
			          	</li>
			          	<div class="dropdown-divider"></div>

			          	@endforeach

			        </ul>
        		</div>
			</div>
			<div class="align-items-center">
				<div class="dropdown d-inline-block stroke">
          			<a class="nav-link text-decoration-none p-3 font-weight-bold" href="#" id="navbarDropdown2"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          				<span class="mr-2"> MERCHANTS </span>
						<i class="icofont-rounded-down pt-2"></i>

          			</a>
           			<ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
          				@php
          				$brands=Brands::all();
          				@endphp

          				@foreach($brands as $brand)
	
          				<li>
				  		<form id="detail{{$brand->id}}" method="POST" action="{{route('branddetail')}}" class="d-none">
				  			@method('GET')
				  			<input type="" name="id" value="{{$brand->id}}">
				  		</form>	
            			<a class="dropdown-item ml-3" style="width: 90%" href=""
            			onclick="event.preventDefault();document.getElementById('detail{{$brand->id}}').submit();" 
            			>{{$brand->name}}</a>
            			<div class="dropdown-divider"></div>
            			</li>
            			@endforeach

          			</ul>
        		</div>
			</div>

			<div class="align-items-center">
				<div class="dropdown d-inline-block stroke">
          			<a class="nav-link text-decoration-none p-3 font-weight-bold" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          				<span class="mr-2"> SERVICES </span>
						<i class="icofont-rounded-down pt-2"></i>

          			</a>
          			<ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
            			<a class="dropdown-item ml-3" style="width: 90%" href="#">
            				Help Center
            			</a>
            			<div class="dropdown-divider"></div>
            			
            			<a class="dropdown-item ml-3" style="width: 90%" href="#">
            				Order
            			</a>
            			<div class="dropdown-divider"></div>
            			
            			<a class="dropdown-item ml-3" style="width: 90%" href="#">
            				Shipping & Delivery
            			</a>
            			<div class="dropdown-divider"></div>

            			<a class="dropdown-item ml-3" style="width: 90%" href="#">
            				Payment
            			</a>
            			<div class="dropdown-divider"></div>

            			<a class="dropdown-item ml-3" style="width: 90%" href="#">
            				Returns & Refunds
            			</a>

          			</ul>
        		</div>
			</div>
		</div>
	</div>

	<!-- Sub Nav (WEB) -->
	<div id="mySidebar" class="sidebar">
		<div class="row">
			<div class="col-10">
	  			<img src="{{ asset('logo/logo_med_trans.png') }}" class="img-fluid" style="width: 100px">
			</div>
			<div class="col-2">
				<a href="javascript:void(0)" class="closebtn text-decoration-none">
			  		<i class="icofont-close-line"></i>
			  	</a>
			</div>
		</div>
		
		<div class="mt-3">
			<p class="text-muted ml-4"> Shop By </p>
			<hr>
			<a href="{{route('home')}}"> HOME </a>
			<hr>
        	@php 
        	$categories=Categories::orderBy('id','asc')->get();
        	@endphp
	        @foreach ($categories as $categorie)
		  	<a data-toggle="collapse" href="#category{{$categorie->id}}" role="button" aria-expanded="false" aria-controls="category">
		   		{{$categorie->name}}
		   		<i class="icofont-rounded-down float-right mr-3"></i>

		  	</a>

			<div class="collapse sidebardropdown_container_category mt-3" id="category{{$categorie->id}}">
            	@php
				$subcates=Subcategories::where('category_id','=',$categorie->id)->get();
            	@endphp
            	@foreach($subcates as $subcate)
					<form id="subdetail{{$subcate->name}}" action="{{route('subcategorydetail')}}" method="POST" class="d-none">
						@method('GET')
						<input type="" name="id" value="{{$subcate->id}}">
						
					</form>
			    	<a href="" class="py-2" onclick="event.preventDefault();
			    	document.getElementById('subdetail{{$subcate->name}}').submit();">
			    	 {{$subcate->name}} </a>
				@endforeach
			</div>
			<hr>
			@endforeach

		  	<a data-toggle="collapse" href="#brand" role="button" aria-expanded="false" aria-controls="brand">
		   		 MERCHANTS
		   		<i class="icofont-rounded-down float-right mr-3"></i>

		  	</a>

			<div class="collapse sidebardropdown_container_category mt-3" id="brand">
  				@php
  				$brands=Brands::all();
  				@endphp

  				@foreach($brands as $brand)
		  		<form id="details{{$brand->id}}" method="POST" action="{{route('branddetail')}}" class="d-none">
		  			@method('GET')
		  			<input type="" name="id" value="{{$brand->id}}">
		  		</form>	
			    <a href="" class="py-2" onclick="event.preventDefault();document.getElementById('details{{$brand->id}}').submit();"> {{$brand->name}} </a>
				@endforeach
			</div>
			<hr>

			<a data-toggle="collapse" href="#service" role="button" aria-expanded="false" aria-controls="service">
		   		Service
		   		<i class="icofont-rounded-down float-right mr-3"></i>
		  	</a>

			<div class="collapse sidebardropdown_container_category mt-3" id="service">
			    <a href="" class="py-2"> Help Center </a>
			    <a href="" class="py-2"> Order </a>
			    <a href="" class="py-2"> Shipping & Delivery </a>
			    <a href="" class="py-2"> Payment </a>
			    <a href="" class="py-2"> Returns & Refunds </a>
			</div>
			<hr>
			@if(Auth::user()!=null)
	   
	    	<a data-toggle="collapse" href="#login" role="button" aria-expanded="false" aria-controls="login">
				{{Auth::user()->name}}
	   			<i class="icofont-rounded-down float-right mr-3"></i>
	  		</a>

	        <div class="collapse sidebardropdown_container_category mt-3" id="login">
	            <a class="py-2" href="profile.php">
	                Profile
	            </a>

	            <a class="py-2" href="{{ route('orders.index')}}">
	                Order History
	            </a>

	            <a class="py-2" href="secret.php">
	                Change Password
	            </a>
	            <div class="dropdown-divider"></div>

				<a class="dropdown-item py-2" href=""
	            onclick="event.preventDefault();
	            document.getElementById('logout').submit();">
	                Logout
	            </a>
	            <form id="logout" method="POST" action="{{ route('logout')}}" class="d-none">
	            @csrf
	            </form>
	        </div>

		    @else

		       	<a href="{{route('login')}}"> Login | Signup</a>

		   	@endif
			<hr>

			<a href="" 
			onclick="event.preventDefault();document.getElementById('shopcart').submit();">
			 Cart [ <span id="itemNo3">  </span> ]  </a>
			<hr>

			<img src="{{ asset('image/download.png') }}" class="img-fluid ml-2 text-center" style="width: 150px">
			<hr>

			<p class="text-white ml-3"> Copyright &copy; <img src="{{ asset('logo/logo_wh_transparent.png') }}" style="width: 20px; height: 20px"> 2019  </p>

		</div>
	  	
	</div>

@yield('body')

  <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

  <div class="container">
    <!-- Brand Store -->
    <div class="row mt-5">
    <h1> Top Brand Stores </h1>
    </div>
      <!-- Brand Store Item -->
      <section class="customer-logos slider mt-5">
      	@php
      		$brand=Brands::all();
      	@endphp
      	@foreach($brand as $photo)
          <div class="slide">
	  		<form id="detail{{$photo->id}}" method="POST" action="{{route('branddetail')}}" class="d-none">
	  			@method('GET')
	  			<input type="" name="id" value="{{$photo->id}}">
	  		</form>
            <a href="" onclick="event.preventDefault();document.getElementById('detail{{$photo->id}}').submit();">
              <img src="{{$photo->photo}}">
            </a>
          </div>
        @endforeach
      </section>
    </div>
  </div>

  <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>




  <!-- Footer -->
  <div class="container-fluid bg-light p-5 align-content-center align-items-center mt-5">
    
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="row">
            <div class="col-md-4">
              <i class="icofont-fast-delivery serviceIcon maincolor"></i>
            </div>
          
            <div class="col-md-8">
                <h6>Door to Door Delivery</h6>
                <p class="text-muted" style="font-size: 12px">On-time Delivery</p>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="row">
            <div class="col-md-4">
              <i class="icofont-headphone-alt-2 serviceIcon maincolor"></i>
            </div>
          
            <div class="col-md-8">
                <h6> Customer Service </h6>
                <p class="text-muted" style="font-size: 12px">  09-780-132-792 ၊ <br> 09-779-999-913 </p>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="row">
            <div class="col-md-4">
              <i class='bx bx-undo serviceIcon maincolor'></i>
            </div>
          
            <div class="col-md-8">
                <h6 > 100% satisfaction </h6>
                <p class="text-muted" style="font-size: 12px"> 3 days return </p>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="row">
            <div class="col-md-4">
              <i class="icofont-credit-card serviceIcon maincolor"></i>
            </div>
          
            <div class="col-md-8">
                <h6> Cash on Delivery </h6>
                <p class="text-muted" style="font-size: 12px"> Door to Door Service </p>
            </div>
          </div>
        </div>
      </div>
  </div>
  
  <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

  <div class="container">
    <div class="row text-center">
      <div class="col-12">
        <h1> News Letter </h1>
        <p>
          Subscribe to our newsletter and get 10% off your first purchase
        </p>

      </div>
      
      <div class="offset-2 col-8 offset-2 mt-5">
        <form>
          <div class="input-group mb-3">
            <input type="text" class="form-control form-control-lg px-5 py-3" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" style="border-top-left-radius: 15rem; border-bottom-left-radius: 15rem">
              
              <div class="input-group-append">
                <button class="btn btn-secondary subscribeBtn" type="button" id="button-addon2"> Subscribe </button>
              </div>


          </div>
        </form>
      </div>

    </div>
  </div>


  <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>
  

    <footer class="py-3 mt-5">
      <div class="container">
        <div class="text-center pb-3">
        <a href="#myPage" title="To Top" class="text-white to_top text-decoration-none">
            <i class="icofont-rounded-up" style="font-size: 20px"></i>
        </a>
      </div>

          <p class="m-0 text-center text-white">Copyright &copy; <img src="{{ asset('logo/logo_wh_transparent.png') }}" style="width: 30px; height: 30px"> 2021 By Arkar Mann Aung</p>
      </div>
    </footer>

  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  <!-- BOOTSTRAP JS -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script> -->
    <script type="text/javascript" src="{{ asset('js/slick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

    <!-- Owl Carousel -->
    <script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>

</body>
</html>

@yield('script')

