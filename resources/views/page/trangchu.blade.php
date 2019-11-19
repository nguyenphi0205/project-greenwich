@extends('master')
@section('content')


<style>
	.brandLi {
		padding: 10px;
	}

	.brandLi b {
		font-size: 16px;
		color: #FE980F;
	}
</style>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$(function() {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 800,
			values: [75, 800],
			slide: function(event, ui) {
				$("#amount_start").val(ui.values[0]);

				$("#amount_end").val(ui.values[1]);


				var start = $('#amount_start').val();

				var end = $('#amount_end').val();

				$.ajax({
					type: 'get',
					dataType: 'html',
					url: '',
					data: "start=" + start + "& end=" + end,

					success: function(response) {

						console.log(response);
						$('#updateDiv').html(response);
					}


				});
			}
		});
		$('.try').click(function() {
			//alert('Tuan');
			var brand = [];
			$('.try').each(function() {
				if ($(this).is(":checked")) {
					brand.push($(this).val());
				}
			});
			Finalbrand = brand.toString();
			$.ajax({
				type: 'get',
				dataType: 'html',
				url: '',
				data: "brand=" + Finalbrand,
				success: function(response) {
					console.log(response);
					$('#updateDiv').html(response);
				}
			});
		});

	});
</script>
<div id="fb-root"></div>
<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=328424237576689";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
<section id="slider">
	<!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						@for($i=0;$i<=count($dsslide);$i++) <li data-target="#slider-carousel" data-slide-to="{{$i}}" class="active">
							</li>

							@endfor
					</ol>
					<div class="carousel-inner">
						<div class="item active" style="padding:0px">

							<img src="source/images/slide/banner1.jpg" style="height: 400px; width:1140px; " class="girl img-responsive" alt="" />

						</div>
						@foreach($dsslide as $slide)
						<div class="item" style="padding:0px">
							<img src="{{url('/')}}/source/images/slide/{{$slide->image}}" style="height: 400px; width:1140px; " class="girl img-responsive" alt="" />
						</div>
						@endforeach


					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>

			</div>
		</div>
	</div>
</section>
<!--/slider-->
<section>
	<div class="container">
		<div class="row">

			<div class="col-sm-12 padding-right">

				<div class="features_items">
					<!--features_items-->
					<h2 class="title text-center"> <span style="color: orange; font-weight: bold;">New product </span> </h2>
					@foreach($sanphammoi as $sl)

					<div class="col-sm-3">
						<div class="product-image-wrapper" style="box-shadow: 2px 4px 2px 0px #bbb;">
							<div class="single-products">
								<div class="productinfo text-center">
									<a href="product_details/{{$sl->id}}"><img src="source/images/product/{{$sl->image}}" alt="" height="200px" /></a>
									<h2><?php echo number_format($sl->price, 0, ",", ".") ?> VNĐ</h2>
									<p><a href="product_details/{{$sl->id}}">{{$sl->name}}</a></p>
									<a href="gio-hang/addItem/{{$sl->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Cart</a>
								</div>

							</div>
							@if(isset(Auth::user()->id))
							<div class="choose">
								<?php
								//$wishData = DB::table('wishlist')->leftJoin('product', 'wishlist.pro_id' , '=' , 'product.id') ->join('users','users.id','=','wishlist.user_id')->where('wishlist.pro_id','=',$sl->id)->where('user_id','=',Auth::user()->id)->get();
								//echo $wishData['id'];
								//if($wishData==''){ echo 'empty';} else { echo 'filled'; }
								$count = App\wishList::where(['pro_id' => $sl->id, 'user_id' => Auth::user()->id])->count();
								?>
								<?php if ($count == "0") { ?>
									<form action="{{url('addToWishList')}}">
										{{ csrf_field() }}
										<input type="hidden" value="{{$sl->id}}" name="pro_id" />
										<p align="center"><input style=" width:30px;height:30px;background: rgba(254, 152, 15, 0);background-image:url('source/images/home/love.png'); background-size: 20px 20px; background-repeat: no-repeat" type="submit" value="" title="Favourite" class="btn btn-primary"></p>
									</form>
								<?php } else { ?>
									<p style="height:46px" align="center"><a href="{{url('WishList')}}"><img title="Đã yêu thích" width="20px" style="cursor: pointer; margin-top:16px;" src="{{url('/')}}/source/images/home/loved2.png"></a></p>
									{{-- <h5 align="center" style="color: green"> Added to item <a href="{{url('WishList')}}">Favorite</a></h5> --}}
								<?php } ?>
							</div>
							@endif
						</div>
					</div>
					@endforeach

				</div>
				<!--features_items-->
				<div style="margin-left: 400px" class="pagination">
					{{$sanphammoi->render()}}
				</div>
				<div class="features_items">
					<!--features_items-->
					<h2 class="title text-center"> <span style="color: orange; font-weight: bold;">Top selling products</span> </h2>
					@foreach($sanphambanchay as $sl)

					<div class="col-sm-3">
						<div class="product-image-wrapper" style="box-shadow: 2px 4px 2px 0px #bbb;">
							<div class="single-products">
								<div class="productinfo text-center">
									<a href="product_details/{{$sl->id}}"><img src="source/images/product/{{$sl->image}}" alt="" height="200px" /></a>

									<h2><?php echo number_format($sl->price, 0, ",", ".") ?> VNĐ</h2>
									<p><a href="product_details/{{$sl->id}}">{{$sl->name}}</a></p>
									<a href="gio-hang/addItem/{{$sl->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Cart</a>
								</div>

							</div>
							@if(isset(Auth::user()->id))
							<div class="choose">
								<?php
								//$wishData = DB::table('wishlist')->leftJoin('product', 'wishlist.pro_id' , '=' , 'product.id') ->join('users','users.id','=','wishlist.user_id')->where('wishlist.pro_id','=',$sl->id)->where('user_id','=',Auth::user()->id)->get();
								//echo $wishData['id'];
								//if($wishData==''){ echo 'empty';} else { echo 'filled'; }
								$count = App\wishList::where(['pro_id' => $sl->id, 'user_id' => Auth::user()->id])->count();
								?>
								<?php if ($count == "0") { ?>
									<form action="{{url('addToWishList')}}">
										{{ csrf_field() }}
										<input type="hidden" value="{{$sl->id}}" name="pro_id" />
										<p align="center"><input style=" width:30px;height:30px;background: rgba(254, 152, 15, 0);background-image:url('source/images/home/love.png'); background-size: 20px 20px; background-repeat: no-repeat" type="submit" value="" title="Yêu thích" class="btn btn-primary"></p>
									</form>
								<?php } else { ?>
									<p style="height:46px" align="center"><a href="{{url('WishList')}}"><img title="Đã yêu thích" width="20px" style="cursor: pointer; margin-top:16px;" src="{{url('/')}}/source/images/home/loved2.png"></a></p>
									{{-- <h5 align="center" style="color: green"> Added to item <a href="{{url('WishList')}}">favorite</a></h5> --}}
								<?php } ?>
							</div>
							@endif
						</div>
					</div>
					@endforeach


				</div>
				<!--features_items-->
				<div class="features_items">
					<!--features_items-->
					<h2 class="title text-center"> <span style="color: orange; font-weight: bold;">Top favorite products </span> </h2>
					@foreach($sanphamduocyeuthich as $sl)

					<div class="col-sm-3">
						<div class="product-image-wrapper" style="box-shadow: 2px 4px 2px 0px #bbb;">
							<div class="single-products">
								<div class="productinfo text-center">
									<a href="product_details/{{$sl->id}}"><img src="source/images/product/{{$sl->image}}" alt="" height="200px" /></a>

									<h2><?php echo number_format($sl->price, 0, ",", ".") ?> VNĐ</h2>
									<p><a href="product_details/{{$sl->id}}">{{$sl->name}}</a></p>
									<a href="gio-hang/addItem/{{$sl->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Cart</a>

								</div>

							</div>

							@if(isset(Auth::user()->id))
							<div class="choose">
								<?php
								//$wishData = DB::table('wishlist')->leftJoin('product', 'wishlist.pro_id' , '=' , 'product.id') ->join('users','users.id','=','wishlist.user_id')->where('wishlist.pro_id','=',$sl->id)->where('user_id','=',Auth::user()->id)->get();
								//echo $wishData['id'];
								//if($wishData==''){ echo 'empty';} else { echo 'filled'; }
								$count = App\wishList::where(['pro_id' => $sl->id, 'user_id' => Auth::user()->id])->count();
								?>



								<?php if ($count == "0") { ?>
									<form action="{{url('addToWishList')}}">
										{{ csrf_field() }}
										<input type="hidden" value="{{$sl->id}}" name="pro_id" />
										<p align="center"><input style=" width:30px;height:30px;background: rgba(254, 152, 15, 0);background-image:url('source/images/home/love.png'); background-size: 20px 20px; background-repeat: no-repeat" type="submit" value="" title="Yêu thích" class="btn btn-primary"></p>
									</form>
								<?php } else { ?>
									<p style="height:46px" align="center"><a href="{{url('WishList')}}"><img title="Đã yêu thích" width="20px" style="cursor: pointer; margin-top:16px;" src="{{url('/')}}/source/images/home/loved2.png"></a></p>
									{{-- <h5 align="center" style="color: green"> Added to item <a href="{{url('WishList')}}">favourite</a></h5> --}}
								<?php } ?>
							</div>
							@endif
						</div>
					</div>
					@endforeach


				</div>
				<!--features_items-->
			</div>
		</div>
	</div>
</section>

<script>
	function send() {

		var start = $('#amount_start').val();

		var end = $('#amount_end').val();

		$.ajax({
			type: 'get',
			dataType: 'html',
			url: '',
			data: "start=" + start + "& end=" + end,

			success: function(response) {

				console.log(response)
				$('#updateDiv').html(response);
			}
		});

	}
</script>

@endsection