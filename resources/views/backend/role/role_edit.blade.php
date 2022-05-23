@extends('backend.master')
@section('breadcrumb')
    Permission
@endsection
@section('permission')
    active
@endsection
@section('content')

<div class="sl-pagebody">
  <div class="sl-page-title">
    <h5>Edit Permission to {{ $users->name }}</h5>
  </div><!-- sl-page-title -->
  <form action="{{ route('PermissionEditPost') }}" enctype="multipart/form-data" method="post">
      @csrf
      <input type="hidden" value="{{ $users->id }}" name="user_id">
      <div class="row row-sm mg-t-20">
          <div class="col-xl-12">
            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
              <div class="row">
                <label class="col-sm-4 form-control-label">User Name: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <ul>
                        @foreach ($permissions as $permission)
                        <label class="ckbox">
                            <input name="permission[]" value="{{ $permission->name }}" type="checkbox" {{ $users->hasPermissionTo($permission->name) ? "checked":'' }}><span>{{ $permission->name }}</span>                          
                        </label>
                        @endforeach
                    </ul>
                </div>
              </div><!-- row -->                 

              <div class="form-layout-footer mg-t-30 text-center">
                <button class="btn btn-info mg-r-5">Submit Form</button>
              </div><!-- form-layout-footer -->
            </div><!-- card -->
          </div><!-- col-6 -->

        </div><!-- row -->
  </form>




</div>

@endsection
