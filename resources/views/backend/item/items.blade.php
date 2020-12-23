@extends('backend.master.master')
@section('body')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Items </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="{{route('items.create')}}" class="btn btn-outline-primary">
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
                                  <th class="align-middle text-center">Code No</th>
                                  <th class="align-middle text-center">Name</th>
                                  <th class="align-middle text-center">Price</th>
                                  <th class="align-middle text-center">Discount</th>
                                  <th class="align-middle text-center">Description</th>
                                  <th class="align-middle text-center">Brand Name</th>
                                  <th class="align-middle text-center">Subcategory</th>
                                  <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i=1;

                                @endphp
                                @foreach($items as $item)                                                     
                                <tr>
                                    <td class="align-middle"> {{$i++}} </td>
                                    <td class="align-middle"> {{$item->codeno}} </td>
                                    <td class="align-middle"> {{$item->name}} </td>
                                    <td class="align-middle text-right"> {{$item->price}} </td>
                                    <td class="align-middle text-right"> {{$item->discount}} </td>
                                    <td class="align-middle"> {{$item->description}} </td>
                                    <td class="align-middle"> {{$item->brand->name}} </td>
                                    <td class="align-middle"> {{$item->subcategory->name}} </td>
                                    <td>
                                        <a href="{{route('items.edit',$item->id)}}" class="btn btn-warning">
                                            <i class="icofont-ui-settings"></i>
                                        </a>

                                        <form action="{{route('items.destroy',$item->id)}}" method="POST" onsubmit="return confirm('Are you sure?')"
                                        class="d-inline-block">
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