<table class="table">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    @foreach ($data as $item)
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>{{ $item->id }}</td>
        <td>{{ $item->get_product->title }}</td>
        <td>{{ $item->get_product->price }}</td>
      </tr>

    </tbody>
    @endforeach
  </table>
