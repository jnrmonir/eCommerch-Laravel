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
      <h5>Product Add</h5>
    </div><!-- sl-page-title -->
    @can('Product Edit')
    <form action="{{ route('ProductUpdate') }}" enctype="multipart/form-data" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $products->id }}">
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
              <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                {{-- <h6 class="card-body-title">Left Label Alignment</h6>
                <p class="mg-b-20 mg-sm-b-30">A basic form where labels are aligned in left.</p> --}}
                <div class="row">
                  <label class="col-sm-4 form-control-label">Title: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" name="title" value="{{ $products->title }}" class="form-control" placeholder="Enter Title">
                  </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Category: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <select name="category_id" id="category_id" class="form-control">
                        <option>Select One</option>
                        @foreach ($cat as $c)
                        <option @if ($products->category_id==$c->id) selected @endif value="{{ $c->id }}">{{ $c->category_name }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                        @foreach ($scat as $sc)
                        <option @if ($products->subcategory_id==$sc->id) selected @endif value="{{ $sc->id }}">{{ $sc->subcategory_name }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                {{-- <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Size: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <select name="size_id" id="size_id" class="form-control">
                          <option>Select One</option>
                          @foreach (App\Models\Size::get() as $size)
                          <option value="{{ $size->id }}">{{ $size->name }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div> --}}
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Summary: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <textarea rows="2" name="summary" class="form-control" placeholder="Enter your summary">{{ $products->summary }}</textarea>
                  </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Description: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <textarea rows="2" name="description" class="form-control" placeholder="Enter your description">{{ $products->description }}</textarea>
                    </div>
                  </div>
                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Price: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="text" name="price" value="{{ $products->price }}" class="form-control" placeholder="Enter price">
                    </div>
                  </div>
                  <div class="field_wrapper">
                    <div class="row mg-t-20">
                        @foreach ($products->product_attribute as $attribute)
                      <input type="hidden" name="attribute_id[]" value="{{ $attribute->id }}">

                        <label class="col-sm-4 form-control-label">Color\Size\Quantity: <span class="tx-danger">*</span></label>
                        <div class="col-sm-2 mg-t-10 mg-sm-t-0">
                            <select name="color_id[]" id="color_id" class="form-control">
                                <option >Select One</option>
                                @foreach ($colors as $color)
                                <option @if ($attribute->color_id==$color->id) selected @endif value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-sm-2 mg-t-10 mg-sm-t-0">
                                <select name="size_id[]" id="size_id" class="form-control">
                                    <option>Select One</option>
                                    @foreach (App\Models\Size::get() as $size)
                                    <option @if ($attribute->size_id==$size->id) selected @endif value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                              </div>

                            {{-- <label class="col-sm-2 form-control-label">Quantity: <span class="tx-danger">*</span></label> --}}
                            <div class="col-sm-3 mg-t-10 mg-sm-t-0">
                            <input disabled type="number" value="{{ $attribute->quantity }}" name="quantity[]" id="quantity" class="form-control" placeholder="Enter quantity">
                            </div>
                        @endforeach

                        <div class="col-sm-1 mg-t-10 mg-sm-t-0">
                            <a href="javascript:void(0);" class="add_button"><i class="fa fa-plus">Add</i></a>
                        </div>
                    </div>
                  </div>
                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Thumbnail: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror ">
                      <img width="30" src="{{ asset('product/thumbnail/'.$products->thumbnail) }}" >
                      @error('thumbnail')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                  </div>

                  <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Images: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="file" multiple name="images[]" class="form-control @error('images') is-invalid @enderror ">
                      @foreach ($products->get_product_images as $images)
                        <img width="50" src="{{ asset('product/images/'.$images->product_id.'/'.$images->images) }}" alt="">
                      @endforeach
                      @error('images')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                  </div>

                <div class="form-layout-footer mg-t-30 text-center">
                  <button class="btn btn-info mg-r-5">Submit Form</button>
                </div><!-- form-layout-footer -->
              </div><!-- card -->
            </div><!-- col-6 -->

          </div><!-- row -->
    </form>
    @else
    <h1>You are Not Allowed</h1>
    @endcan
</div>

@endsection
@section('footer.js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="row mg-t-20"><label class="col-sm-4 form-control-label">Color/Size/Quantity: <span class="tx-danger">*</span></label><div class="col-sm-2 mg-t-10 mg-sm-t-0"><select name="color_id[]" id="color_id" class="form-control"><option >Select One</option>@foreach ($colors as $color)<option value="{{ $color->id }}">{{ $color->color_name }}</option>@endforeach</select></div><div class="col-sm-2 mg-t-10 mg-sm-t-0"><select name="size_id[]" id="size_id" class="form-control"><option>Select One</option>@foreach (App\Models\Size::get() as $size)<option value="{{ $size->id }}">{{ $size->name }}</option>@endforeach</select></div><div class="col-sm-3 mg-t-10 mg-sm-t-0"><input type="number" name="quantity[]" class="form-control" placeholder="Enter quantity"></div><a class="remove_button" href="javascript:void(0);"><i class="fa fa-cross">Remove</i></a></div>';        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    //Dropdown Dependency
    $('#category_id').change(function(){
    var category_id = $(this).val();
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        if(category_id){
            $.ajax({
            type:"GET",
            url:"{{ url('subcategory/get-ajax-list/') }}/"+category_id,
            // data: [name:category_id]
            success:function(res){
                if(res){
                    $("#subcategory_id").empty();
                    $("#subcategory_id").append('<option>Select One</option>');
                    $.each(res,function(key,value){
                        $("#subcategory_id").append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                    });
                }else{
                $("#subcategory_id").empty();
                }
            }
            });
        }
        else{
            $("#subcategory_id").empty();
        }
    });
    </script>
@endsection


