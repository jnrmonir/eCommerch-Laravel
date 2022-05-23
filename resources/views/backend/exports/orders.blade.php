<table>
    <thead>
    <tr>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Status</th>
        <th>Time</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Orders as $order)
        <tr>
            <td>{{ $order->get_product->title }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->product_unit_price }}</td>
            <td>{{ $order->get_shipping->payment_status }}</td>
            <td>{{ $order->created_at->format('d-m-Y')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>