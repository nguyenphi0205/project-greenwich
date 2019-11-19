<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="container">
    <ul class="nav nav-pills nav-stacked col-md-4">
      {{-- <li ><a href="#">My information</a></li> --}}
      <li class="active"><a href="{{url('/address')}}">Account information</a></li>
      <li><a href="{{url('/password')}}">Change Password</a></li>
      <li><a href="#">List of orders</a></li>
    </ul>
  </div>

</body>

</html>