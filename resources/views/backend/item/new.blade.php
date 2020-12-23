@extends('backend.master.master')
@section('body')

<main class="app-content">
	<div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Item Form </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="{{route('items.index')}}" class="btn btn-outline-primary">
                <i class="icofont-reply"></i>
            </a>
        </ul>
    </div>

	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<form action="{{route('items.store')}}" method="POST" enctype="multipart/form-data">
					@csrf
						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Code </label>
							<div class="col-sm-10">
								<input type="text" class="form-control @error('code') is-invalid @enderror" id="code_id" name="code">
								@error('code')
									<div class="alert alert-danger">{{$message}}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Name </label>
							<div class="col-sm-10">
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="name_id" name="name">
								@error('name')
									<div class="alert alert-danger">{{$message}}</div>
								@enderror
							</div>
						</div>


						<div class="form-group row">
							<label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
							<div class="col-sm-10">
								<input type="file" id="photo_id" name="photo">
							</div>
						</div>

						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Price </label>
							<div class="col-sm-10">
								<input type="text" class="form-control @error('price') is-invalid @enderror" id="price_id" name="price">
								@error('price')
									<div class="alert alert-danger">{{$message}}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Discount </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="discount_id" name="discount">
							</div>
						</div>

						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Description </label>
							<div class="col-sm-10">
								<textarea  type="text" class="form-control" id="description_id" name="description" ></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="photo_id" class="col-sm-2 col-form-label"> Brand </label>
							<div class="col-sm-10">
								
								<select class="form-control" name="brandid">
									@php
										use App\Brands;
										use App\Subcategories;
										$brands=Brands::orderBy('id','desc')->get();
										$subcategories=Subcategories::orderBy('id','desc')->get();
									@endphp
									@foreach($brands as $brand)					
										<option value="{{$brand->id}}">{{$brand->name}}</option>
									@endforeach
								
									
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="photo_id" class="col-sm-2 col-form-label"> Subategory </label>
							<div class="col-sm-10">
								
								<select class="form-control" name="subcategoryid">
									@foreach($subcategories as $subcategory)
									<option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary">
									<i class="icofont-save"></i>
									Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>

@endsection