@extends('master')
@section('css')
<style>
	.brandLi{
		padding: 5px;
        padding-left : 20px;
	}
	.brandLi b { font-size: 15px; color: #FE980F; }
</style>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
@endsection
@section('content')
<div class="container" >
			<div class="row">
				<div class="col-sm-3">
					<div style="height: 1000px" class="left-sidebar">
									
						<div class="brands_products"><!--brands_products-->
							<h2>Categories</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								<?php $cats = DB::table('product_type')->orderby('name', 'ASC')->get();?>

									@foreach($cats as $cat)
									<li class="brandLi">
									<span style="margin:0;padding:0"><a href="{{route('loaisanpham',$cat->id)}}">  <b>{{ucwords($cat->name) }}</b></a></span>
									</li>
									
									@endforeach
									<?php  /*<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li> */?>
								</ul>
							</div>
						</div><!--/brands_products-->

						
						<div class="shipping text-center"><!--shipping-->
							<div class="fb-page" data-href="https://www.facebook.com/Tu&#x1ea5;n-Th&#x1eaf;ng-Bakery-307549689685452/" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Tu&#x1ea5;n-Th&#x1eaf;ng-Bakery-307549689685452/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Tu&#x1ea5;n-Th&#x1eaf;ng-Bakery-307549689685452/">Find Good Foods</a></blockquote></div>
						</div><!--/shipping-->
					
					</div>
				</div>
                <div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">News</h2>
                      <?php $countP = 0;  ?>
						@foreach($loaisp as $sl)
						<input type="hidden" id="pro_id<?php echo $countP;?>" value="{{$sl->id}}" />
						<div class="col-sm-4">
							<div class="product-image-wrapper" style="box-shadow: 2px 4px 2px 0px #bbb;">
								<div class="single-products">
										<div class="productinfo text-center" >
											<a href="product_details/{{$sl->id}}"><img src="source/images/product/{{$sl->image}}" alt="" height="200px" /></a>
												<h2 ><?php echo number_format($sl->price,0,",",".") ?> VNĐ</h2>
											<p><a href="product_details/{{$sl->id}}">{{$sl->name}}</a></p>
											<a href="gio-hang/addItem/{{$sl->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Cart</a>
										</div>
										
								</div>
								<div class="choose">
								@if(Auth::check())
									<?php
									$wishData = DB::table('wishlist')->leftJoin('product', 'wishlist.pro_id' , '=' , 'product.id')->where('wishlist.pro_id','=',$sl->id)->get();
									//echo $wishData['id'];
									//if($wishData==''){ echo 'empty';} else { echo 'filled'; }
								$count = App\wishList::where(['pro_id' => $sl->id,'user_id'=>Auth::user()->id])->count();
								 ?>
						
								<?php if($count== "0"){?>
								<form action="{{url('addToWishList')}}">
									{{ csrf_field() }}
								<input type="hidden" value="{{$sl->id}}" name="pro_id" />
								<p align="center"><input style=" width:30px;height:30px;background: rgba(254, 152, 15, 0);background-image:url('source/images/home/love.png'); background-size: 20px 20px; background-repeat: no-repeat" type="submit" value="" title="Yêu thích" class="btn btn-primary"></p>
								</form>
								<?php } else {?>
									<p style="height:46px" align="center"><a href="{{url('WishList')}}"><img title="Đã yêu thích" width="20px" style="cursor: pointer; margin-top:16px;" src="{{url('/')}}/source/images/home/loved2.png"></a></p>
									{{-- <h5 align="center" style="color: green"> Added to item <a href="{{url('WishList')}}">Favorite</a></h5>  --}}
								<?php } ?>
								@endif
								</div>
							</div>
						</div>
						<?php $countP++ ?>
						@endforeach

						
					</div><!--features_items-->
					<div>
						<ul style="margin-left: 250px" class="pagination">

                    {{ $loaisp->render()}}
						</ul>
					</div><!--features_items-->
				</div>
					</div>
				</div>
                </div>
                </div>
				
@endsection
@section('script')

@endsection