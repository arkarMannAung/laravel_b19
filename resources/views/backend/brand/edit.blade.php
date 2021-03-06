@extends('backend.master.master')
@section('body')

<main class="app-content">

	<div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Brand Edit </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="{{route('brands.index')}}" class="btn btn-outline-primary">
                <i class="icofont-reply"></i>
            </a>
        </ul>
    </div>
	<div class="row">
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<form action="{{route('brands.update',$brands->id)}}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<input type="hidden" value="$brands['id']" name="id">
						<input type="hidden" value="$brands['photo'] " name="oldphoto">

						<div class="form-group row">
							<label for="name_id" class="col-sm-2 col-form-label"> Name </label>
							<div class="col-sm-10">
								<input type="text" class="form-control @error('name') is-invalid @enderror" id="name_id" name="name" value="{{$brands->name}}">
								@error('name')
									<div class="alert alert-danger">{{$message}}</div>
								@enderror
							</div>

						</div>

							<div class="form-group row">
							<label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Old Photo</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">New Photo</a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									<br>
									<img width="200px" class="img-fluid" src="{{$brands->photo}}">

								</div>
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								
									
									<div class="col-sm-10">
										<br>
										<input type="file" id="photo_id" name="photo">
									</div>
								</div>
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
	</div>
</main>

@endsection