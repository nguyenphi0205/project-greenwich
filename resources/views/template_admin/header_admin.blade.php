	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<!-- Logo -->
					<div class="logo">
						<h1><a href="{{route('trangchu')}}">Find Good Foods</a></h1>
					</div>
				</div>
				<div class="col-md-5">
					<div class="row">
						<div class="col-lg-12">
							{{-- <form method="post" action="">
	                  <div class="input-group form">
										
	                       <input type="text" class="form-control" name="search_data" placeholder="Enter the name to search...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="submit">Search</button>
	                       </span>
	                  </div>
						</form> --}}
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="navbar navbar-inverse" role="banner">
						<nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
							<ul class="nav navbar-nav">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi,{{Auth::user()->name}} <b class="caret"></b></a>
									<ul class="dropdown-menu animated fadeInUp">
										<li><a href="{{route('thongtintaikhoan')}}">account information</a></li>
										<li><a href="{{route('dangxuatad')}}">Log outt</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-content">
		<div class="row">
			<div class="col-md-2">
				<div class="sidebar content-box" style="display: block;">
					<ul class="nav">
						<!-- Main menu -->
						<li class="current"><a href="{{route('trangchu')}}"><i class="glyphicon glyphicon-home"></i> Home Page</a></li>
						<li class="submenu">
							<a href="{{route('quanlydonhang')}}">
								<i class="glyphicon glyphicon-calendar"></i> <span class="caret pull-right"></span> Manage orders</a>
							<ul>
								<li><a href="{{route('danhsachdonhangmoi')}}"><i class="glyphicon glyphicon-record"></i> List of new orders</a></li>
							</ul>
							<ul>
								<li><a href="{{ route('danhsachdonhangcu') }}"><i class="glyphicon glyphicon-record"></i> Old order list</a></li>
							</ul>
						</li>
						{{-- <li><a href="stats.html"><i class="glyphicon glyphicon-stats"></i> Manage product categories</a></li> --}}
						<li class="submenu">
							<a href="{{ route('quanlyloaisanpham') }}">
								<i class="glyphicon glyphicon-stats"></i>
								<span class="caret pull-right"></span> Manage product categories
							</a>

							<ul>
								<li><a href="{{route('danhsachloaisanpham')}}"><i class="glyphicon glyphicon-record"></i> List of product types</a></li>
							</ul>
							<ul>
								<li><a href="{{ route('themloaisanpham') }}"><i class="glyphicon glyphicon-record"></i> Add new product categories</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="{{ route('quanlysanpham') }}">
								<i class="glyphicon glyphicon-list"></i>
								<span class="caret pull-right"></span>Product management
							</a>

							<ul>
								<li><a href="{{route('danhsachsanpham')}}"><i class="glyphicon glyphicon-record"></i> List of products</a></li>
							</ul>
							<ul>
								<li><a href="{{ route('themsanpham') }}"><i class="glyphicon glyphicon-record"></i> Add new products</a></li>
							</ul>
							<ul>
								<li><a href="{{ route('themsanphamsize') }}"><i class="glyphicon glyphicon-record"></i> Add products by size</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="{{route('quanlythanhvien')}}">
								<i class="glyphicon glyphicon-pencil"></i>
								<span class="caret pull-right"></span> Member management</a>
							@if(Auth::user()->power==3)
							<ul>
								<li><a href="{{route('danhsachthanhvien')}}"><i class="glyphicon glyphicon-record"></i> Members list</a></li>
							</ul>
							<ul>
								<li><a href="{{ route('themthanhvien') }}"><i class="glyphicon glyphicon-record"></i> Add new members</a></li>
							</ul>
							@endif
							@if(Auth::user()->power==2)
							<ul>
								<li><a href="{{route('danhsachmember')}}"><i class="glyphicon glyphicon-record"></i> List of user accounts</a></li>
							</ul>
							@endif
						</li>
						<li class="submenu">
							<a href="{{ route('quanlysanpham') }}">
								<i class="glyphicon glyphicon-tasks"></i>
								<span class="caret pull-right"></span> Manage slide banners
							</a>

							<ul>
								<li><a href="{{route('danhsachslide')}}"><i class="glyphicon glyphicon-record"></i> List of slide banner</a></li>
							</ul>
							<ul>
								<li><a href="{{ route('themslide') }}"><i class="glyphicon glyphicon-record"></i> Add a new side banner</a></li>
							</ul>
						</li>
						<li class="submenu">
							<a href="{{ route('quanlysanpham') }}">
								<i class="glyphicon glyphicon-tasks"></i>
								<span class="caret pull-right"></span> News management
							</a>

							<ul>
								<li><a href="{{route('danhsachtintuc')}}"><i class="glyphicon glyphicon-record"></i> List of news</a></li>
							</ul>
							<ul>
								<li><a href="{{route('dangtinmoi')}}"><i class="glyphicon glyphicon-record"></i>Post a news</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>