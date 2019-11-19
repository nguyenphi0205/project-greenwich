<!DOCTYPE html>
<html>

<head>
  <title>Find Good Foods @yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="{{url('/')}}/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- styles -->
  <link href="{{url('/')}}/admin/css/styles.css" rel="stylesheet">
  <link rel="stylesheet" href="{{url('/')}}/admin/css/quanly.css" type="text/css">
  <link href="{{url('/')}}/admin/css/styles1.css" rel="stylesheet">
  @yield('css')
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  @include('template_admin.header_admin')

  <div class="col-md-10">
    <div class="content-box-large">
      @yield('content')
    </div>
  </div>
  </div>
  </div>

  <footer>
    @include('template_admin.footer_admin')
  </footer>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{url('/')}}/admin/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{url('/')}}/admin/js/custom.js"></script>
  @yield('script')
</body>

</html>