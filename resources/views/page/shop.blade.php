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
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
	$(function() {
		$("#slider-range").slider({
			range: true,
			min: 0,
			max: 500000,
			values: [75000, 450000],
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
<script>
	$(document).ready(function() {
		<?php $maxP = count($sanpham);
		for ($i = 0; $i < $maxP; $i++) { ?>
			$('#successMsg<?php echo $i; ?>').hide();
			$('#cartBtn<?php echo $i; ?>').click(function() {
				var pro_id<?php echo $i; ?> = $('#pro_id<?php echo $i; ?>').val();
				$.ajax({
					type: 'get',
					url: '<?php echo url('gio-hang/addItem'); ?>/' + pro_id<?php echo $i; ?>,
					success: function() {
						//alert('done');
						$('#cartBtn<?php echo $i; ?>').hide();
						$('#successMsg<?php echo $i; ?>').show();
						$('#successMsg<?php echo $i; ?>').append('products are added to the cart');
					}
				});
			});
		<?php } ?>
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


<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">

					<div class="brands_products">
						<!--brands_products-->
						<h2>Product type</h2>
						<div class="brands-name">
							<ul class="nav nav-pills nav-stacked">
								<?php $cats = DB::table('product_type')->orderby('name', 'ASC')->get(); ?>

								@foreach($cats as $cat)
								<div class="checkbox">
									<li class="brandLi"><input type="checkbox" id="brandId" value="{{$cat->id}}" class="try" />
										<span class="pull-right">({{App\products::where('id_type',$cat->id)->count()}})</span> <b>{{ucwords($cat->name) }}</b>
									</li>
								</div>


								@endforeach
								<?php  /*<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li> */ ?>
							</ul>
						</div>
					</div>
					<!--/brands_products-->


					<div class="price-range">
						<!--price-range-->
						<div style="background: none" class="well">
							<h2>price VNĐ</h2>
							<div id="slider-range"></div>
							<br>
							<b class="pull-left">
								<input size="4" type="text" id="amount_start" name="start_price" value="75.000" style="border:0px; font-weight: bold; color:green;background: none;" readonly="readonly" /></b>
							<b class="pull-right">
								<input size="4" type="text" id="amount_end" name="end_price" value="350.000" style="border:0px; font-weight: bold; color:green;background: none" readonly="readonly" /></b>
						</div>
					</div>
					<!--/price-range-->


					<div class="shipping text-center">
						<!--shipping-->
						<div class="fb-page" data-href="https://www.facebook.com/Tu&#x1ea5;n-Th&#x1eaf;ng-Bakery-307549689685452/" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
							<blockquote cite="https://www.facebook.com/Tu&#x1ea5;n-Th&#x1eaf;ng-Bakery-307549689685452/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Tu&#x1ea5;n-Th&#x1eaf;ng-Bakery-307549689685452/">Find Good Foods</a></blockquote>
						</div>
					</div>
					<!--/shipping-->

				</div>
			</div>

			<div class="col-sm-9 padding-right" id="updateDiv">
				<div class="features_items">
					<!--features_items-->
					<h2 class="title text-center"> <span style="color: orange; font-weight: bold;">List of products</span> </h2>
					<?php $countP = 0;  ?>
					@foreach($sanpham as $sl)
					<input type="hidden" id="pro_id<?php echo $countP; ?>" value="{{$sl->id}}" />
					<div class="col-sm-4">
						<div class="product-image-wrapper" style="box-shadow: 2px 4px 2px 0px #bbb;">
							<div class="single-products">
								<div class="productinfo text-center">
									<a href="product_details/{{$sl->id}}"><img src="source/images/product/{{$sl->image}}" alt="" height="200px" /></a>
									<h2><?php echo number_format($sl->price, 0, ",", ".") ?> VNĐ</h2>
									<p><a href="product_details/{{$sl->id}}">{{$sl->name}}</a></p>
									<a href="gio-hang/addItem/{{$sl->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Cart</a>
								</div>

							</div>
							@if(Auth::check())
							<div class="choose">
								<?php
								$wishData = DB::table('wishlist')->leftJoin('product', 'wishlist.pro_id', '=', 'product.id')->where('wishlist.pro_id', '=', $sl->id)->get();
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
					<?php $countP++ ?>
					@endforeach


				</div>
				<!--features_items-->
				<div>
					<ul style="margin-left: 250px" class="pagination">

						{{ $sanpham->render()}}
					</ul>
				</div>
				<!--features_items-->
			</div>





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
		//alert(end);
	}
</script>

@endsection