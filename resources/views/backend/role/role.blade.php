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
      <h5>Role List</h5>
      {{--  <a style="float:right" class="btn btn-success" href="{{ route('ExportExcel') }}">Excel Download</a>  --}}
    </div><!-- sl-page-title -->
    <div class="card pd-20 pd-sm-40 mg-t-50">
      <h6 class="card-body-title">Role Assigne to Permission</h6>
      <div class="table-responsive">
        <table class="table table-bordered mg-b-0">
          <thead>
            <tr>
              <th>SL</th>
              <th>Role Name</th>
              <th>Role Assigne to Permission</th>
              <th>Created_at</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($roles as $role)
            <tr>
                <td>{{ $loop->index+1}}</td>
                <td>{{ $role->name}}</td>
                <td>
                  <ul>
                    @foreach ($role->getPermissionNames() as $item)
                       <li> {{ $item }}</li>
                    @endforeach
                  </ul>
                </td>
                <td>{{ $role->created_at != null ? $role->created_at->diffForHumans():'N/A'}}</td>
              
              </tr>
            @empty

            @endforelse
          </tbody>
        </table>
      </div><!-- table-responsive -->
    </div><!-- card -->
</div>

<div class="sl-pagebody">
  <div class="sl-page-title">
    <h5>User List</h5>
    {{--  <a style="float:right" class="btn btn-success" href="{{ route('ExportExcel') }}">Excel Download</a>  --}}
  </div><!-- sl-page-title -->
  <div class="card pd-20 pd-sm-40 mg-t-50">
    <h6 class="card-body-title">User Assigne to Role</h6>
    <div class="table-responsive">
      <table class="table table-bordered mg-b-0">
        <thead>
          <tr>
            <th>SL</th>
            <th>User Name</th>
            <th>Role Assign</th>
            <th>Users All Permission</th>
            <th>Created_at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
          <tr>
              <td>{{ $loop->index+1}}</td>
              <td>{{ $user->name}}</td>
              <td>
                <ul>
                  @foreach ($user->getRoleNames() as $item)
                     <li> {{ $item }}</li>
                  @endforeach
                </ul>
              </td>
              <td>
                <ul>
                  @foreach ($user->getAllPermissions() as $item2)
                     <li> {{ $item2->name }}</li>
                  @endforeach
                </ul>
              </td>
              <td>{{ $user->created_at }}</td>
              <td>
                <a href="{{ route('EditUserPermission',$user->id) }}" class="btn btn-outline-info">Edit</a>
              </td>
            
            </tr>
          @empty

          @endforelse
        </tbody>
      </table>
    </div><!-- table-responsive -->
  </div><!-- card -->
</div>

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Role Form</h5>
    </div><!-- sl-page-title -->
    <form action="{{ route('RoleAddToPermission') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
              <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                <div class="row">
                  <label class="col-sm-4 form-control-label">Role Name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <select name="role_name" class="form-control">
                          <option value="">Select Role</option>
                          @foreach ($roles as $role)
                          <option value="{{ $role->name }}">{{ $role->name }}</option>                              
                          @endforeach
                      </select>
                  </div>
                </div><!-- row -->

                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Permission: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      @foreach ($permission as $permissions)
                      <li>
                        <input id="permission_name{{ $permissions->id }}" type="checkbox" name="permission_name[]" value="{{ $permissions->name }}" >
                        <lebel for="permission_name{{ $permissions->id }}">{{ $permissions->name }}</lebel>
                      </li>
                      @endforeach
                  </div>
                </div>                    

                <div class="form-layout-footer mg-t-30 text-center">
                  <button class="btn btn-info mg-r-5">Submit Form</button>
                </div><!-- form-layout-footer -->
              </div><!-- card -->
            </div><!-- col-6 -->

          </div><!-- row -->
    </form>




</div>

<div class="sl-pagebody">
  <div class="sl-page-title">
    <h5>User Form</h5>
  </div><!-- sl-page-title -->
  <form action="{{ route('UserAddToRole') }}" enctype="multipart/form-data" method="post">
      @csrf
      <div class="row row-sm mg-t-20">
          <div class="col-xl-12">
            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
              <div class="row">
                <label class="col-sm-4 form-control-label">User Name: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <select name="user_name" class="form-control">
                        <option value="">Select User Name</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->name }}">{{ $user->name }}</option>                              
                        @endforeach
                    </select>
                </div>
              </div><!-- row -->

              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Role: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    @foreach ($roles as $role)
                    <li>
                      <input id="role_name{{ $role->id }}" type="checkbox" name="role_name[]" value="{{ $role->name }}" >
                      <lebel for="role_name{{ $role->id }}">{{ $role->name }}</lebel>
                    </li>
                    @endforeach
                </div>
              </div>                    

              <div class="form-layout-footer mg-t-30 text-center">
                <button class="btn btn-info mg-r-5">Submit Form</button>
              </div><!-- form-layout-footer -->
            </div><!-- card -->
          </div><!-- col-6 -->

        </div><!-- row -->
  </form>




</div>

@endsection
