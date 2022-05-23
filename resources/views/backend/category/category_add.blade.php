@extends('backend.master')
@section('breadcrumb')
    Category Add
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-info"><b>{{ __('Category Add') }}</b></div>
				@if(session('insert'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					 {{session('insert')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
                <div class="card-body">
                	<form action="{{url('category/post')}}" method="post">
                        @csrf
					  <div class="form-group">
					    <label for="name">Name</label>
					    <input type="text" class="form-control @error('category_name') is-invalid @enderror category_name" name="category_name" id="category_name"  aria-describedby="emailHelp" placeholder="Home & Garden">
								@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					  </div>
					  <div class="form-group">
					    <label for="slug">Slug</label>
					    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug"  placeholder="home-&-gerden">
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
