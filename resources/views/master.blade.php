<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Find Good Foods</title>
    <base href="{{asset('')}}">
    <link href="{{url('/')}}/source/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/source/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('/')}}/source/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{url('/')}}/source/css/price-range.css" rel="stylesheet">
    <link href="{{url('/')}}/source/css/animate.css" rel="stylesheet">
	<link href="{{url('/')}}/source/css/main.css" rel="stylesheet">
    
	<link href="{{url('/')}}/source/css/responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="source/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="source/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="source/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="source/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="source/images/ico/apple-touch-icon-57-precomposed.png">
    @yield('css')
</head><!--/head-->
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=328424237576689";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

            @include('header')
    <div class="rev-slider">
        @yield('content')
    </div> <!-- .container -->
    <footer id="footer"><!--Footer-->
    @include('footer')
	</footer><!--/Footer-->
</script>
@yield('script')

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5948b0dee9c6d324a473646e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
  <!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-594c07aa525acc52"></script> 
    <script src="{{url('/')}}/source/js/jquery.js"></script>
    <script src="{{url('/')}}/source/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/source/js/jquery.scrollUp.min.js"></script>
    <script src="{{url('/')}}/source/js/price-range.js"></script>
    <script src="{{url('/')}}/source/js/jquery.prettyPhoto.js"></script>
   <!-- <script src="source/js/main.js"></script>-->
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script type="text/javascript">

 <?php $pros = DB::table('product')->get();?>
    $(document).ready(function(){
//drupal_add_library('system', 'ui.autocomplete');

   

        var source = [
            @foreach($pros as $pro)
            {
                value: "<?php  echo url('/');?>/product_details/<?php echo $pro->id; ?>",
                label: "<?php  echo $pro->name;?>"
            },
            @endforeach

        ];

 $("#proList").autocomplete({
     source: source,
     select: function(event, ui){
         window.location.href = ui.item.value;
     }
 });
 
 });
 </script>
<a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; margin-bottom:40px"><i class="fa fa-angle-up"></i></a>
    
</body>
</html>