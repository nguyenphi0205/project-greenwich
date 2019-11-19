@extends('master')
@section('css')
<style>
	.brandLi {
		padding: 5px;
		padding-left: 20px;
	}

	.brandLi b {
		font-size: 15px;
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
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<div style="height: 1000px" class="left-sidebar">

				<div class="brands_products">
					<!--brands_products-->
					<h2>Product type</h2>
					<div class="brands-name">
						<ul class="nav nav-pills nav-stacked">
							<?php $cats = DB::table('product_type')->orderby('name', 'ASC')->get(); ?>

							@foreach($cats as $cat)
							<li class="brandLi">
								<span style="margin:0;padding:0"><a href="{{route('loaisanpham',$cat->id)}}"> <b>{{ucwords($cat->name) }}</b></a></span>
							</li>

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


				<div class="shipping text-center">
					<!--shipping-->
					<div class="fb-page" data-href="https://www.facebook.com/Tu%E1%BA%A5n-Th%E1%BA%AFng-Bakery-307549689685452/" data-tabs="timeline" data-width="270" data-height="600" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
						<blockquote cite="https://www.facebook.com/Tu%E1%BA%A5n-Th%E1%BA%AFng-Bakery-307549689685452/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Tu%E1%BA%A5n-Th%E1%BA%AFng-Bakery-307549689685452/">Find Good Foods</a></blockquote>
					</div>
				</div>
				<!--/shipping-->

			</div>
		</div>
		<div class="col-sm-9">
			<div class="blog-post-area">
				<h2 class="title text-center">News</h2>
				<div class="single-blog-post">
					<h3>{{$cttintuc->title}}</h3>
					{!!$cttintuc->content!!}

					<div class="pager-area">
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-594c07aa525acc52"></script>
						<!-- Go to www.addthis.com/dashboard to customize your tools -->
						<div class="addthis_inline_share_toolbox"></div>
						<ul class="pager pull-right">
							<li><a href="#">Pre</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')

@endsection