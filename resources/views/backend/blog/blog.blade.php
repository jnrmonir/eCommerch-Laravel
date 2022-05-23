@extends('backend.master')
@section('breadcrumb')
    Blog
@endsection
@section('blog')
    active
@endsection
@section('content')

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Category List</h5>
    </div><!-- sl-page-title -->
    @can('Category List')     
    <div class="card pd-20 pd-sm-40 mg-t-50">
      <h6 class="card-body-title">Total Blog</h6>
      <div class="table-responsive">
        <table class="table table-bordered mg-b-0">
          <thead>
            <tr>
              <th>SL</th>
              <th>Name</th>
              <th>Slug</th>
              <th>Created_at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($blogs as $key=>$blog)
            <tr>
                <td>{{ $blogs -> firstItem() + $key }}</td>
                <td>{{ $blog->title}}</td>
                <td>{{ $blog->slug}}</td>
                <td>{{ $blog->created_at != null ? $item->created_at->diffForHumans():'N/A'}}</td>
                <td>
                    <a href="{{url('/category/edit/'. $item->id)}}" class="btn btn-outline-info">Edit</a>
                    <a href="{{url('/category/delete/'. $item->id)}}" class="btn btn-outline-danger">Delete</a>
                </td>
              </tr>
            @empty

            @endforelse
          </tbody>
        </table>
      </div><!-- table-responsive -->
    </div><!-- card -->
    @else 
    <h1>!SORRY YOU ARE IN WRONG LOCATION</h1>
    @endcan
</div>
@endsection


@section('footer.js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
    @if(session('deleted'))
    Toast.fire({
      icon: 'error',
      title: '{{ session('deleted') }}'
    })
    @endif
    @if(session('success'))
    Toast.fire({
      icon: 'error',
      title: '{{ session('success') }}'
    })
    @endif
  </script>
@endsection
