</html>
<html class="html_2"><head>
<title>Log in admin|Find Good Foods</title>
        {{-- <script src="http://localhost/laravel_5.1/resources/assets/js/jquery.js" async=""></script>
<link rel="stylesheet" href="http://localhost/laravel_5.1/resources/assets/css/template.css" type="text/css"> --}}
<link rel="stylesheet" href="{{url('/')}}/admin/css/quanly.css" type="text/css">

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

{{-- <link rel="stylesheet" href="http://localhost/laravel_5.1/resources/assets/css/jquery-ui.css">
<script src="http://localhost/laravel_5.1/resources/assets/js/jquery-ui.js"></script>

<!-- css bootstrap -->
<link rel="stylesheet" href="http://localhost/laravel_5.1/resources/assets/css/bootstrap_custom.css"> --}}

<style>
  html, body {
    margin: 0px;
  }
  .wrapper {
    width: 100%;
  }
</style>    </head>
    <body>
                <div class="header">
                    <div class="header_banner">
            {{-- <div class="logo_cua_hang">
                <img src="{{url('/')}}/source/images/home/logo1.png">
            </div> --}}
            <div class="chao_nguoi_dung">
                
            </div>
        </div>

        </div>
        <div style="clear: both;"></div>
        <div class="container">
            <div class="content">
                <div class="left-content">
                                    </div>
                <div class="main_content_admin">
                        <div id="all">
        <div id="noidung">
            <div class="login" id="element-box">
                <div class="m wbg">
                    <h1 style="text-align: center">Sign in</h1>
                     <div class="thong_bao_dang_nhap_admin">
                     <ul>
                         @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                         @endforeach
                         
                        @if(isset($thongbao))
                           <li> {{$thongbao}}</li>
                        @endif
                        @if(Session::has('status'))
                        <p class="alert alert-danger">{{ Session::get('status') }}</p>
                        @endif
                     </ul>
                    </div>
                    <div id="section-box">
                        <div class="m">
                        {{-- @if(Session::has('flag'))
						<div class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
                        @endif --}}
                        
                            {{-- <form method="POST" action="http://localhost/laravel_5/admin/quan-tri" accept-charset="UTF-8" class="form_dang_nhap_admin" name="form_dang_nhap_admin"><input name="_token" type="hidden" value="FwqDYCV8CC1cv1XZM4z4GVHEkeA8OdE9Fr3QY2MW"> --}}
                            <form action="{{route('dangnhapadmin')}}" method="post" accept-charset="UTF-8" class="form_dang_nhap_admin" name="form_dang_nhap_admin">
						    <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <fieldset class="loginform">
                                <label for="login-username" id="login-username-lbl">Email</label>
                                <input type="text" size="15" class="inputbox" id="login-username" name="email" value="">
                                <label for="login-password" id="login-password-lbl">Password</label>
                                <input type="password" size="15" class="inputbox" id="login-password" name="password">
                                <div class="button-holder">
                                    <div class="button1">
                                        <div class="next">
                                            <input class="btndangnhap" type="submit" name="dangnhap" id="dangnhap" value="Sign in">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            </form>
                        
                        </div>
                    </div>
                    <div id="lock">
                    <img src="{{url('/')}}/source/images/home/logo1.png" style="width:150px; height:120px">
                    </div>
                </div>
            </div>
        </div> <!-- nd -->
        <div class="clear"> </div>

    </div>
                </div>
            </div>
        </div>
        <div style="clear: both;"></div>
        <div class="footer">
            <div>
</div>        </div>
        <div style="clear: both;"></div>
    

</body></html>