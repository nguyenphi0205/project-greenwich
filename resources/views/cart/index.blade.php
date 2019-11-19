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
</style>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<meta name="csrf-token" content="<?= csrf_token() ?>">


<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$(document).ready(function() {
		<?php for ($i = 1; $i < 20; $i++) { ?>
			$('#upCart<?php echo $i; ?>').on('change keyup', function() {
				var newqty = $('#upCart<?php echo $i; ?>').val();
				var rowId = $('#rowId<?php echo $i; ?>').val();
				var proId = $('#proId<?php echo $i; ?>').val();
				//alert(newqty);
				if (newqty < 0) {
					alert('enter only valid qty')
				} else {
					$.ajax({
						type: 'get',
						dataType: 'html',
						url: '<?php echo url('/gio-hang/update'); ?>/' + proId,
						data: "qty=" + newqty + "& rowId=" + rowId + "& proId=" + proId,
						success: function(response) {
							console.log(response);
							$('#updateDiv').html(response);
						}
					});
				}
			});
		<?php } ?>
	});
</script>
<?php
if ($cartItems->isEmpty()) { ?>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">HomePage</a></li>
					<li class="active">Cart</li>
				</ol>
			</div>
			<div align="center"><img src="source/images/cart/empty-cart.png" /></div>
		<?php } else {
			?>
		</div>
	</section>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">HomePage</a></li>
					<li class="active">Cart</li>
				</ol>
			</div>
			<div id="updateDiv">
				<!-- 		@if(session('status'))
									<div class="alert alert-success">

										{{session('status')}}
									</div>

									@endif -->
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image">Image</td>
								<td class="description">Description</tD>
								<td class="price">Price</td>
								<td class="quantity">Quantity</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<?php $count = 1;  ?>
						@foreach($cartItems as $cartItem)
						<tbody>
							<tr>
								<td class="cart_product">
									<a href=""><img src="source/images/product/{{$cartItem->options->img}}" height="150px" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{$cartItem->name}}</a></h4>
									<p>Product code: {{$cartItem->id}}</p>
								</td>
								<td class="cart_price">
									<p>{{ number_format($cartItem->price,0,",",".")}} vnđ</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<input type="hidden" id="rowId<?php echo $count; ?>" value="{{$cartItem->rowId}}" />
										<input type="hidden" id="proId<?php echo $count; ?>" value="{{$cartItem->id}}" />
										<!--	{!! Form::open(['url' => ['gio-hang/update',$cartItem->rowId], 'method' => 'put']) !!}-->
										<!--<form action="{{url('/gio-hang/update')}}/{{$cartItem->id}}" method="get">-->
										<?php /*
									<input type="button" value="-" id="moins{{$cartItem->id}}" onclick="minus{{$cartItem->id}}()"> */ ?>
										<input type="number" required size="2" value="{{$cartItem->qty}}" name="qty" id="upCart<?php echo $count; ?>" id="count{{$cartItem->id}}" autocomplete="off" style="text-align: center;max-width: 50px" MIN="1" MAX="30">
										<?php /*
									<input type="button" value="+" id="plus{{$cartItem->id}}" onclick="plus{{$cartItem->id}}()"> */ ?>
										<!--<button type="submit" class="btn btn-success btn-sm" title="Update Count">-->
										<!--<span class="glyphicon glyphicon-edit"></span></button>-->
										<!--</form>-->
										<!--{!! Form::close() !!}-->
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">{{ number_format($cartItem->subtotal,0,",",".")}} vnđ</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" style="background-color: red;" href="{{url('/gio-hang/remove')}}/<?php echo $cartItem->rowId; ?>"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<?php $count++; ?>
						</tbody>
						@endforeach
					</table>
					<section id="do_action">
						<div class="container">
							<div class="row">
								<div class="col-sm-6">
								</div>
								<div class="col-sm-6">
									<div class="total_area" style="margin-right: 30px;">
										<ul>
											<li>Subtotal <span>{{Cart::subtotal()}} vnđ</span></li>
											<li>Tax<span>{{Cart::tax() }} vnđ</span></li>
											<li>Ship <span>Free</span></li>
											<li>Total <span>{{Cart::total()}} vnđ</span></li>
										</ul>
										<a class="btn btn-default check_out " href="{{url('/')}}/checkout"">Order</a>
					</div>

				</div>
			</div>
		</div>
	</section><!--/#do_action-->
			</div>
</div>
		</div>



<?php  } ?>

@endsection