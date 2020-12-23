@extends('backend.master.master')
@section('body')

<main class="app-content">
	<div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Item Edit </h1>
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
					<form action="{{route('items.update',$items->id)}}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Code </label>
							<div class="col-sm-10">
								<input type="text" class="form-control @error('code') is-invalid @enderror" id="code_id" name="code" value="{{$items->codeno}}">
								@error('code')
									<div class="alert alert-danger">{{$message}}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Name </label>
							<div class="col-sm-10">
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="name_id" name="name" value="{{$items->name}}">
								@error('name')
									<div class="alert alert-danger">{{$message}}</div>
								@enderror
							</div>
						</div>		


						<div class="form-group row">
							<label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
							<div class="col-sm-10">
								<input type="file" id="photo_id" name="photo">
								<img class="img-fluid" id="oldphoto" width="100px" src="{{$items->photo}}">
							</div>
						</div>		

						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Price </label>
							<div class="col-sm-10">
								<input type="text" class="form-control @error('price') is-invalid @enderror" id="price_id" name="price" value="{{$items->price}}">
								@error('price')
									<div class="alert alert-danger">{{$message}}</div>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Discount </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="discount_id" name="discount" value="{{$items->discount}}">
							</div>
						</div>

						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Description </label>
							<div class="col-sm-10">
								<textarea  type="text" class="form-control" id="description_id" name="description" >{{$items->description}}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="photo_id" class="col-sm-2 col-form-label"> Brand </label>
							<div class="col-sm-10">
								
								<select class="form-control" name="brandid">
								@php 
								use App\Brands;
								$brands=Brands::all(); 
								@endphp
								@foreach($brands as $brand)


								<option value="{{$brand->id}}"
								 @if($brand->name==$items->brand->name)selected="" @endif >{{$brand->name}}</option>
									
								@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="photo_id" class="col-sm-2 col-form-label"> Subategory </label>
							<div class="col-sm-10">
								
								<select class="form-control" name="subcategoryid">
								@php 
								use App\Subcategories;
								$datas=Subcategories::all(); 
								@endphp
								@foreach($datas as $data)								
								<option value="{{$data->id}}" 
									@if($data->name==$items->subcategory->name)selected="" @endif >{{$data->name}}</option>

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

@section('script')

<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('change',"input[name='photo']",function(){
			var myVal = URL.createObjectURL(event.target.files[0]);
			$('#oldphoto').attr('src',myVal);
		})

	})
</script>

@endsection