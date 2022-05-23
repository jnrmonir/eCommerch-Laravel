<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <!-- Material form login -->
<div class="card">

  <h5 class="card-header info-color white-text bg-success text-center py-4">
    <strong>header</strong>
  </h5>

  @yield('content');
  
  <h5 class="card-header info-color white-text bg-info text-center py-4">
    <strong>Footer</strong>
  </h5>

</div>
<!-- Material form login -->
</div>

</body>
</html>
