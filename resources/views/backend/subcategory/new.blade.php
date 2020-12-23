@extends('backend.master.master')
@section('body')

<div class="app-title">
	<div>
		<h1> <i class="icofont-list"></i> Category Form </h1>
	</div>
	<ul class="app-breadcrumb breadcrumb side">
		<a href="" class="btn btn-outline-primary">
			<i class="icofont-double-left"></i>
		</a>
	</ul>
</div>

<main class="app-content">


	<div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Sub-category Form </h1>
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
				<form action="{{route('subcategories.store')}}" method="POST" enctype="multipart/form-data">
				@csrf
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
						<label for="photo_id" class="col-sm-2 col-form-label"> Category </label>
						<div class="col-sm-10">
							

							<select class="form-control" name="categoryid">
								@foreach($categorys as $category)	
									<option value="{{$category['id']}}">
										{{$category['name']}}
									</option>
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