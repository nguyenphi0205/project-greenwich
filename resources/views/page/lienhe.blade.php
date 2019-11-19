@extends('master')
@section('content')
<style>
	.brandLi{
		padding: 10px;
	}
	.brandLi b { font-size: 16px; color: #FE980F; }
</style>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=328424237576689";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">  

					<h2 class="title text-center">CONTACT <strong>US</strong></h2>    			    				    							
					<div id="gmap"  class="contact-map">

							
							<div class="abs-fullwidth beta-map wow flipInX">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.819272251633!2d106.63503531435008!3d10.748407992340546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752e7d8ff778a9%3A0xbee3bd9e7d97322e!2zNDYxIEjhuq11IEdpYW5nLCBwaMaw4budbmcgMTEsIFF14bqtbiA2LCBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1498195772835" width="1150px" height="420px" frameborder="0" style="border:1px solid white;border-radius: 10px 10px 10px 10px;" allowfullscreen></iframe>							
					</div>
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">contact</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form  action="{{route('lien-he')}}" method="post" class="contact-form" id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				    	<input type="hidden" name="_token" value="{{csrf_token()}}">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" placeholder="name" required="required" value="">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" placeholder="Email" required="required" value="">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Send">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">CONTACT INFO</h2>
	    				<address>
	    					<p>Find Good Foods</p>
							<p>416 Hậu Giang, phường 12, Quận 6, TP.HCM, Việt Nam</p>
							<p></p>
							<p>Phone: +84 0797804001</p>
							<p></p>
							<p>Email: nguyenphi0511@yahoo.com.vn</p>
	    				</address>
	    				<div class="social-networks">
	    					 <div class="fb-page" data-href="https://www.facebook.com/Tu%E1%BA%A5n-Th%E1%BA%AFng-Bakery-307549689685452/" data-tabs="timeline" data-width="270" data-height="600" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Tu%E1%BA%A5n-Th%E1%BA%AFng-Bakery-307549689685452/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Tu%E1%BA%A5n-Th%E1%BA%AFng-Bakery-307549689685452/">Find Good Foods</a></blockquote>
                              </div>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
@endsection