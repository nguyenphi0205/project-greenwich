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
	$(document).ready(function() {
		$('#size').change(function() {
			var size = $('#size').val();
			var proDum = $('#proDum').val();
			var theValue = $('input[name="newPrice"]').prop('value'); //<--HERE IS HOW YOU GET THE VALUE
			console.log(theValue);
			$.ajax({
				type: 'get',
				dataType: 'html',
				url: '<?php echo url('/selectSize'); ?>',
				data: "size=" + size + "& proDum=" + proDum,
				success: function(response) {
					console.log(response);
					$('#price').html(response);
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
<section>
	<div class="container">
		<div class="row">

			@foreach($Products as $value)
			<div class="col-sm-10 padding-right">
				<div class="product-details">
					<!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<img src="source/images/product/{{$value->image}}" alt="" />
							<h3>ZOOM</h3>
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">

							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<div class="item active">
									<a href=""><img src="source/images/product/{{$value->image}}" width="10px;" alt=""></a>

								</div>
								<div class="item">
									<a href=""><img src="source/images/product/{{$value->image}}" alt=""></a>
								</div>
								<div class="item">
									<a href=""><img src="source/images/product/{{$value->image}}" alt=""></a>
								</div>

							</div>

							<!-- Controls -->
							<a class="left item-control" href="#similar-product" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right item-control" href="#similar-product" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>

					</div>
					<div class="col-sm-7">
						<div class="product-information">
							<!--/product-information-->
							<h2><?php echo ucwords($value->name); ?></h2>
							<p>Mã: {{$value->id}}</p>
							@if(Auth::check())
							<?php
							//$wishData = DB::table('wishlist')->leftJoin('product', 'wishlist.pro_id' , '=' , 'product.id') ->join('users','users.id','=','wishlist.user_id')->where('wishlist.pro_id','=',$value->id)->where('user_id','=',Auth::user()->id)->get();
							//echo $wishData['id'];
							//if($wishData==''){ echo 'empty';} else { echo 'filled'; }
							$count = App\wishList::where(['pro_id' => $value->id, 'user_id' => Auth::user()->id])->count();
							?>



							<?php if ($count == "0") { ?>
								<form action="{{url('addToWishList')}}">
									{{ csrf_field() }}
									<input type="hidden" value="{{$value->id}}" name="pro_id" />
									<input style=" width:30px;height:30px;background: rgba(254, 152, 15, 0);background-image:url('source/images/home/love.png'); background-size: 20px 20px; margin-top:0px; background-repeat: no-repeat" type="submit" value="" title="Yêu thích" class="btn btn-primary">
								</form>
							<?php } else { ?>
								<p style="height:46px" align="center"><a href="{{url('WishList')}}"><img title="Đã yêu thích" width="20px" style="cursor: pointer; margin-top:16px;" src="{{url('/')}}/source/images/home/loved2.png"></a></p>
								{{-- <h5 align="center" style="color: green"> Added to item <a href="{{url('WishList')}}">favorite</a></h5> --}}
							<?php } ?>
							@endif
							<form action="{{url('/gio-hang/addItem')}}/<?php echo $value->id; ?>">
								<span>
									<span style="font-size: 22px;" id="price"><?php echo number_format($value->price, 0, ",", ".") ?> VND</span>

									<label>Quantity:</label>
									<input type="number" value="1" id="qty" readonly="true" autocomplete="off" style="text-align: center; max-width: 50px;" MIN="1" MAX="30" />


									<button style="width:90px" type="submit" class="btn btn-fefault cart" id="addToCart">
										<i style="color: white" class="fa fa-shopping-cart"></i> Add

									</button>
									<input type="text" value="<?php echo $value->id; ?>" id="proDum" />
								</span>




								<?php $sizes = DB::table('products_properties')->join('product_size', 'products_properties.size_id', '=', 'product_size.id')->where('pro_id', $value->id)->get(); ?>

								@if(count($sizes)>0)
								<p><b>Chọn kích cỡ:</b> </p>
								<select style="width:200px; margin-bottom:5px" name="size" id="size">
									@foreach($sizes as $size)
									<option>{{$size->size}}</option>
									@endforeach

								</select>
								@else


								@endif
							</form>
							<!-- <?php
									//$wishData = DB::table('wishlist')->where('pro_id', $value->id)->get();

									//print_r($wishData);
									?> -->

						</div>
						<!--/product-information-->
					</div>
				</div>
				<!--/product-details-->
				<div style="border-top: 1px solid #e9ebee; margin-bottom: 50px">
					<h3> Description </h3>
					<p>{!!$value->intro!!}</p>
				</div>
				<div class="category-tab shop-details-tab">
					<!--category-tab-->
					<div style="font-size: 16px ; font-weight: bold;">Please comment</div>
					<div class="fb-comments" data-width="700" data-numposts="5"></div>
				</div>
				<!--/category-tab-->


			</div>
			@endforeach
		</div>
	</div>
</section>
@endsection