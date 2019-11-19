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
<section>
	<div class="container">

		<div class="col-sm-12 padding-right">

			<div class="features_items">
				<!--features_items-->
				<h2 class="title text-center">
					You have <span style="color: red; font-weight: bold;">{{count($Products)}}</span> favorite product
					<?php if (isset($msg)) {
						echo $msg;
					} ?>
				</h2>

				@foreach($Products as $sl)
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<a href="product_details/{{$sl->id}}"><img src="source/images/product/{{$sl->image}}" alt="" height="200px" /></a>
								<h2><?php echo number_format($sl->price, 0, ",", ".") ?> VNĐ</h2>
								<p><a href="product_details/{{$sl->id}}">{{$sl->name}}</a></p>
								<a href="gio-hang/addItem/{{$sl->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Cart</a>
							</div>

						</div>
						<div class="choose">
							<ul class="nav nav-pills nav-justified">
								<li><a href="removeWishList/{{$sl->id}}" style="color: red"><i class="fa fa-minus-square"></i>Remove from favorites</a></li>

							</ul>
						</div>
					</div>
				</div>
				@endforeach

			</div>
			<!--features_items-->


		</div>

	</div>
	</div>
</section>
@endsection