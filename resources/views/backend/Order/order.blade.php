@extends('backend.master')
@section('breadcrumb')
    Order
@endsection
@section('Order')
    active
@endsection
@section('content')

<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Order List</h5>
      <a style="float:right" class="btn btn-success" href="{{ route('ExportExcel') }}">Excel Download</a>
    </div><!-- sl-page-title -->
    <div class="card pd-20 pd-sm-40 mg-t-50">
      <h6 class="card-body-title">Total Order</h6>
      <div class="table-responsive">
        <table class="table table-bordered mg-b-0">
          <thead>
            <tr>
              <th>SL</th>
              <th>Product Title</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Status</th>
              <th>Created_at</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($order as $key=>$orders)
            <tr>
                <td>{{ $order -> firstItem() + $key }}</td>
                <td>{{ $orders->get_product->title}}</td>
                <td>{{ $orders->quantity}}</td>
                <td>{{ $orders->product_unit_price}}</td>
                <td>{{ $orders->get_shipping->payment_status }}</td>
                <td>{{ $orders->created_at != null ? $orders->created_at->diffForHumans():'N/A'}}</td>
              
              </tr>
            @empty

            @endforelse
          </tbody>
        </table>
      </div><!-- table-responsive -->
    </div><!-- card -->
</div>

@endsection
