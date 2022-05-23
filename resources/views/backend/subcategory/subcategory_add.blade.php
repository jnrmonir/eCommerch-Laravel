@extends('backend.master')
@section('breadcrumb')
    Sub_Category
@endsection
@section('subcategory')
active
@endsection

@section('content')
    <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-info"><b>{{ __('Sub Category Add') }}</b></div>
				@if(session('add'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					 {{session('add')}}
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
					    <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror subcategory_name" name="subcategory_name" id="subcategory_name" value="{{old('subcategory_name')}}" aria-describedby="emailHelp" placeholder="Enter subcategory name">
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

        </div>
@endsection
