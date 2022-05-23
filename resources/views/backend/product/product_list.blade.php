@extends('backend.master')
@section('breadcrumb')
    Product
@endsection
@section('product')
    active
@endsection
@section('content')

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Product List</h5>
    </div><!-- sl-page-title -->
    @can('Product List')
    <div class="card pd-20 pd-sm-40 mg-t-50">
      <h6 class="card-body-title">Total Product</h6>
      <div class="table-responsive">
        <table class="table table-bordered mg-b-0">
          <thead>
            <tr>
              <th>SL</th>
              <th>Name</th>
              <th>Category</th>
              <th>Sub Category</th>
              <th>Slug</th>
              <th>Price</th>
              <th>Image</th>
              <th>Image Gallery</th>
              <th>Available Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $key=>$item)
            <tr>
                <td>{{ $products -> firstItem() + $key }}</td>
                <td>{{ $item->title}}</td>
                <td>{{ $item->get_category->category_name}}</td>
                <td>{{ $item->get_subcategory->subcategory_name}}</td>
                <td>{{ $item->slug}}</td>
                <td>{{ $item->price}}</td>
                <td><img width="90" src="{{ asset('/product/thumbnail/'.$item->thumbnail) }}" alt="{{ $item->title}}"></td>
                <td>
                    @foreach ($item->get_product_images as $images)
                        <img width="50" src="{{ asset('/product/images/'.$item->id.'/'.$images->images) }}" alt="{{ $item->title}}">
                        <a href="{{ route('ProductImageDelete',$images->id) }}"><i class="fa fa-times"></i></a>
                     @endforeach
                </td>
                <td>
                    @php
                        $qt=0;
                    @endphp
                    @foreach ($item->product_attribute as $qnt)
                        {{--  {{ $qnt->quantity }}  --}}
                        @php
                            $qt += $qnt->quantity;
                        @endphp
                    @endforeach
                    @if ($qt>0 && $qt<=10)
                        {{ $qt }} (<span class="text-danger">Stock Low</span>)
                    @elseif($qt==0)
                    <span class="text-danger">(StockOut)</span>
                    @else
                    <span class="text-success">{{ $qt }}</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('ProductEdit',$item->id) }}" class="btn btn-outline-info">Edit</a>
                    <a href="{{ route('ProductDelete',$item->id) }}" class="btn btn-outline-danger">Delete</a>
                </td>
              </tr>
            @empty
            @endforelse
          </tbody>
        </table>
        {{$products->links()}}
      </div><!-- table-responsive -->
    </div><!-- card -->
    @else
    <h1>You are Not Allowed</h1>
    @endcan
</div>
{{-- <div class="container">
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
							<!-- <a class="btn btn-outline-danger" href="{{url('/category/delete/'. $cat->id)}}">Delete</a> -->
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
					    <input type="text" class="form-control @error('name') is-invalid @enderror name" name="name" id="name" value="{{old('name')}}" aria-describedby="emailHelp" placeholder="Enter category name">
								@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					  </div>
					  <div class="form-group">
					    <label for="slug">Slug</label>
					    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" placeholder="home-&-gerden">
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
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-success">{{ __('Deleted Category List') }}</div>

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
                      @forelse($delete_cat as $key => $dcat)
                        <tr>
                          <th scope="row"> {{$delete_cat->firstItem() + $key}} </th>
                          <td>{{$dcat->category_name}}</td>
                          <td>{{$dcat->slug}}</td>
                          <td class="text-center">
                            <a class="btn btn-outline-success" href="{{url('/category/restore/'. $dcat->id)}}">Restore</a>
                            <a class="btn btn-outline-danger" href="{{url('/category/permanent/'. $dcat->id)}}">Permanent Delete</a>
                          </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="10">No Data Available</td>
                        </tr>
                        @endforelse
                      </tbody>

                    </table>
                    <!-- {{$categories}} -->
                    {{$categories->links()}}
                </div>

            </div>


        </div>
    </div>
</div> --}}
@endsection
