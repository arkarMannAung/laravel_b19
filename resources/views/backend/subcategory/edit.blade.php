@extends('backend.master.master')
@section('body')

<main class="app-content">


	<div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Sub-category Edit Form </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="{{route('subcategories.index')}}" class="btn btn-outline-primary">
                        <i class="icofont-reply"></i>
                    </a>
                </ul>
            </div>

	<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<form action="{{route('subcategories.update',$subcate->id)}}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="form-group row">
						<label for="name_id" class="col-sm-2 col-form-label"> Name </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name_id" name="name" value="{{$subcate->name}}">
						</div>
					</div>

					<div class="form-group row">
						<label for="photo_id" class="col-sm-2 col-form-label"> Category </label>
						<div class="col-sm-10">
							

							<select class="form-control" name="categoryid">
								@php
									use App\Categories;
									$cate=Categories::all();
								@endphp
								@foreach($cate as $cates)
									<option value="{{$cates->id}}" 
										@if(($cates->name)==($subcate->category->name))
										echo selected=""
										@endif 
										>{{$cates->name}}</option>
								@endforeach
							</select>

						</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-primary">
								<i class="icofont-save"></i>
								Update
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</main>

@endsection