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
        <div class="col-md-10">
            <div class="card">
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
                          <th>Created_at</th>
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
                          <td>{{ $scat->created_at != null ? $scat->created_at->diffForHumans():'N/A'}}</td>
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

            </div>


        </div>
        {{-- <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center bg-info"><b>{{ __('Sub Category Add') }}</b></div>
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
					    <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror subcategory_name" name="subcategory_name" id="subcategory_name" value="{{old('subcategory_name')}}" aria-describedby="emailHelp" placeholder="Enter category name">
								@error('subcategory_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>

                      <div class="form-group">
                          <select class="form-control @error('category_id') is-invalid @enderror category_id" name="category_id">
                            <option value="">select one</option>
                              @foreach ($categories as $item)
                              <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                              @endforeach
                          </select>
                          @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>


					  <div class="text-center">
					  <button type="submit" class="btn btn-primary">Submit</button>
					</div>
					</form>

                </div>

            </div>

        </div> --}}
    </div>

</div>
@endsection
