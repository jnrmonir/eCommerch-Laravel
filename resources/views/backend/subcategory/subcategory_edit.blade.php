@extends('backend.master')
@section('breadcrumb')
    Sub_Category
@endsection
@section('subcategory')
active
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <div class="card">
                <div class="card-header text-center bg-success">{{ __('Sub Category List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					@if(session('delete'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					 {{session('delete')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif

                    <table class="table table-bordered">
					  <thead>
					    <tr>
					      <th scope="col">SL</th>
                          <th scope="col">Name</th>
                          <th scope="col">Category Name</th>
					      <th scope="col">Slug</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
					  @foreach($subcategories as $key => $scat)
					    <tr>
						  <th scope="row"> {{$subcategories->firstItem() + $key}} </th>
                          <td>{{$scat->subcategory_name}}</td>
					      <td>{{$scat->get_category->category_name}}</td>
					      <td>{{$scat->slug}}</td>
					      <td class="text-center">
							<a class="btn btn-outline-success" href="{{url('/subcategory/edit/'. $scat->id)}}">Edit</a>
							<a class="btn btn-outline-danger" href="{{url('/subcategory/delete/'. $scat->id)}}">Delete</a>
						  </td>
					    </tr>
						@endforeach
					  </tbody>

					</table>
					{{$subcategories->links()}}
                </div>

            </div> --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-info"><b>{{ __('Sub Category Edit') }}</b></div>
                    @if(session('insert'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                         {{session('insert')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{url('subcategory/post')}}" method="post">
                            @csrf
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror name" name="name" id="name" value="{{$scats->subcategory_name??old('name')}}" aria-describedby="emailHelp" placeholder="Enter category name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                          </div>

                          <div class="form-group">
                              <select class="form-control" name="category_id">
                                <option value="">select one</option>
                                  @foreach ($categories as $item)
                                  <option @if ($scats->category_id==$item->id) selected @endif value="{{ $item->id }}">{{ $item->category_name }}</option>
                                  @endforeach
                              </select>
                          </div>


                          <div class="text-center">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
@endsection
