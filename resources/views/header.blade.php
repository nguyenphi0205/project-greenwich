<style>
.fa-star{
	color: orange;
}

.fa-shopping-cart{
	color: orange;
}
.fa-user{
	color: white;
}
</style>
</head><!--/head-->
<header ><!--header-->
<div class="header">
	 <div class="header_top" style="background-color: #3B5598; height: 40px"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								 @if(Auth::check())
									<li><a style="color: white" href="{{url('profile')}}"><i class="fa fa-user"></i style="color: white;">{{Auth::user()->name}}</a></li>
									<li><a style="color: white" href="{{ route('dangxuat')}}"><i style="color: white" class="glyphicon glyphicon-share"></i>Log out</a></li>
								@else
									<li><a style="color: white" href="{{route('dangki')}}"><i style="color: white" class="fa fa-user"></i>Registration</a></li>
									<li><a style="color: white" href="{{route('dangnhap')}}"><i  style="color: white" class="fa fa-user"></i>Log in</a></li>
								@endif
							</ul>
						</div>
							<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								@if(isset(Auth::user()->id))
								<li><a style="color: white; background:none; font-weight: bold;"  href="{{url('/')}}/WishList"><img title="Đã yêu thích" width="20px" style="cursor: pointer" src="{{url('/')}}/source/images/home/loved2.png">Favourite<span  style="color: white; font-weight: bold;">( {{App\wishList::where('user_id',Auth::user()->id)->count()}})</span></a></li>
								<?php /*<li><a href="{{url('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng <span  style="color: green; font-weight: bold;">({{Cart::count()}})</span> <br> 
								<p align="center" style="color: green; font-weight: bold;">({{ Cart::subtotal()}})</p></a></li> */?>
								@endif
					                </ul>
					              </li>
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div><!--/header_top-->
		<div id="Header" class="header-middle" ><!--header-middle-->
		<style>
					#Header {
				background-image: url('source/images/home/top_banner.png');
				height: 151px;
			}
		</style>
			
		</div><!--/header-middle-->
	
		<div id="id_content" class="header-bottom" style="border-top: 1px solid #cccccc;text-align: center; border-bottom: double #cccccc; background-color: transparent; height: 50px; margin-bottom: 10px; padding-bottom: 25px; padding-top: 0px;"  ><!--header-bottom-->
			<div class="container"  style=" height: 30px">
				<div class="row"  >
					<div class="col-sm-5" style="padding-top: 15px" >
						<div class="navbar-header" >
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left" >
						<ul id="nav" class="nav navbar-nav collapse navbar-collapse">
							<li id="nav-1" class="level0 nav-1 first current parent " style="z-index:2000;">
                    <a href="{{route('index')}}">
                        <span>Home page</span>
                    </a>
                    
                </li>
				<li id="nav-2" class="level0 nav-2 parent" style="z-index:2000;">
                    <a href="{{'shop'}}">
                        <span>Product</span>
                    </a>
                    
                </li>
				<li id="nav-3" class="level0 nav-3 parent" style="z-index:2000;">
                    <a href="{{'tintuc'}}">
                        <span>News</span>
                    </a>
                    
                </li>
				<li id="nav-4" class="level0 nav-4 parent" style="z-index:2000;">
                    <a href="{{'lienhe'}}">
                        <span>Contact</span>
                    </a>
                    
                </li>
								
							</ul>
						</div>
					</div>

					<div class="col-sm-5" style="padding-top: 5px">
						<div  class="search_box pull-right">
							<form  action='{{route('search')}}' method="post" >
								<input style="height:35px; width:500px; background-color: #fff; opacity: 0.5;border: 1px solid #bdb3b3;border-radius: 5px;" type="text" name="search_data" id="proList" placeholder="Search for the product"  id="proList" />
								<input type="hidden" name="_token" value="{{ csrf_token()  }}">

							</form>
						</div>			
					</div>
   				<div class="col-sm-2" style="width: 90px;" >
				   	<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
				                <li id="drop" style="padding-right:0" class="dropdown" >
					                <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									@if(Cart::count()<1)
									<img style="width:20px; height:25px" src="{{url('/')}}/source/images/home/cart_empty.png"><span class="badge"> {{Cart::count() }}</span></a>
					                @else
									<img style="width:20px; height:25px" src="{{url('/')}}/source/images/home/cart_full.png"><span class="badge"> {{Cart::count() }}</span></a>
									@endif
									<ul class="dropdown-menu"  style="min-width: 245px; left: 15px;" >
					          
					                <p align="center" class="pull-right" >Tổng:<span style="color: green">{{ Cart::subtotal()}}</span></p>
					                <?php
					                	//data from cart
					                	$cartData = Cart::content();

					                ?>
					                	@foreach($cartData as $cartID)
						                <div class="col-md-12" >
							                  		<div class="col-md-5">
							                  			<img src="source/images/product/{{$cartID->options->img}}"  style="width: 90%" />
							                  		</div>
							                  		<div class="col-md-7">
							                  			<h4 style="margin:0px">{{$cartID->name}}</h4>
							                  			<p>Price: {{$cartID->price}}</br> Quantity: {{$cartID->qty}}</p>
							                  		</div>
						                 </div>
						                 @endforeach
						                 <br><br>
							
						                 <div class="row">
						                 	<div class="col-md-5 pull-left">
						                 	<a href="{{url('checkout')}}" style="padding: 5px; color: #fff ; background-color: orange" class="btn btn-primary">Checkout</a>
						                 	</div>

						                 	<div class="col-md-5 pull-right">
						                 	<a href="{{url('gio-hang')}}" style="padding: 5px; color: #fff ; background-color: blueviolet" class="btn btn-info">Cart</a>
						                 	</div>

						                 </div>
								</div>
								</div>
				</div>
				</div>
			</div>
		</div><!--/header-bottom-->
		</div>
	</header><!--/header-->