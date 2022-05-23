@extends('backend.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-success">{{ __('Category List') }}</div>

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
					      <th scope="col">Slug</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
					  @foreach($categories as $key => $cat)
					    <tr>
					      <!-- <th scope="row"> {{$loop->index + 1}} </th> -->
						  <th scope="row"> {{$categories->firstItem() + $key}} </th>
					      <td>{{$cat->category_name}}</td>
					      <td>{{$cat->slug}}</td>
					      <td class="text-center">
							<a class="btn btn-outline-success" href="{{url('/category/edit/'. $cat->id)}}">Edit</a>
							<a class="btn btn-outline-danger" href="{{url('/category/delete/'. $cat->slug)}}">Delete</a>
						  </td>
					    </tr>
						@endforeach
					  </tbody>

					</table>
					<!-- {{$categories}} -->
					{{$categories->links()}}
                </div>

            </div>


        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center bg-info"><b>{{ __('Category Edit') }}</b></div>
				@if(session('insert'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					 {{session('insert')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
                <div class="card-body">
                	<form action="{{url('category/update')}}" method="post">
                        @csrf
                        <input type="hidden" name="category_id"  value="{{$cats->id}}">
					  <div class="form-group">
					    <label for="name">Name</label>
					    <input type="text" class="form-control @error('name') is-invalid @enderror name" name="name" id="name" value="{{$cats->category_name??old('name')}}" aria-describedby="emailHelp" placeholder="Enter category name">
								@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					  </div>
					  <div class="form-group">
					    <label for="slug">Slug</label>
					    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{$cats->slug??old('slug')}}" placeholder="home-&-gerden">
								@error('slug')
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

        </div>
    </div>
</div>
@endsection
