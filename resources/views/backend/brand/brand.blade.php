@extends('backend.master.master')
@section('body')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Brand </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="{{route('brands.create')}}" class="btn btn-outline-primary">
                <i class="icofont-plus"></i>
                
            </a>
        </ul>
         
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                  <th class="align-middle text-center">#</th>
                                  <th class="align-middle text-center">Name</th>
                                  <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $i=1 @endphp
                                @foreach ($brands as $brand)
                                <tr>
                                    <td class="align-middle">{{$i++}}</td>
                                    <td>
                                        <img width="100px" class="mr-3 img-fluid" src="{{$brand->photo}}">
                                        <span class="text font-weight-bold"> {{$brand->name}}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{route('brands.edit',$brand->id)}}" class="btn btn-warning mr-3">
                                            <i class="icofont-ui-settings"></i>
                                        </a>

                                        <form action="{{route('brands.destroy',$brand->id)}}"
                                        onsubmit="return confirm('Are you sure?')" 
                                        method="POST" class="d-inline-block ml-3">
                                        @csrf
                                        @method('DELETE')
                                            <button class="btn btn-outline-danger">
                                                <i class="icofont-close"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection