@extends('template_admin.master_admin')
@section('css')
<link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
<div class="main_form_admin">
    <div class="title_main_form_admin">
        Account information
    </div>
    <div class="div_form_thong_tin">
        @if(Session::has('status'))
        <p class="alert alert-success">{{ Session::get('status') }}</p>
        @endif

        <ul class="validation_error">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        {{-- <div class="div_danh_sach_items">
                    <div class="thong_tin_nguoi_mua">
                    <table>
                    <tr>
                        <td>
                            Fullname:
                        </td>
                        <td>
                        <input style="border: 1px dotted #ddd;" name="hoten" value="{{Auth::user()->name}}">
        </td>
        </tr>
        <tr>
            <td> Email: </td>
            <td>
                <input style="border: 1px dotted #ddd;" disabled="disabled" name="hoten" value="{{Auth::user()->email}}">
            </td>
        </tr>
        <tr>
            <td>Address:</td>
            <td>
                <input style="border: 1px dotted #ddd;" name="hoten" value="{{Auth::user()->address}}">
            </td>
        </tr>
        <tr>
            <td> Phone:</td>
            <td>
                <input style="border: 1px dotted #ddd;" name="hoten" value="{{Auth::user()->phone}}">
            </td>
        </tr>
        </table>
    </div>
    <input class="btn_password" type="submit" value="Change Password">
    <input id="sua" class="btn_sua" type="submit" onclick="Sua()" value="Modify">
    <input id="sua" class="btn_luu" type="submit" value="Save">
    <div class="clear"></div>

</div>
</div> --}}
{!! Form::open(array('route'=>'postthongtintaikhoan','id'=>'form_cap_nhat_san_pham','class' => 'form_cap_nhat_san_pham', 'files'=>true)) !!}
<input type="hidden" name="_token" value="{{csrf_token()}}">
<table class="form_cap_nhat">
    <tbody>
        <tr>
            <td>
                Email:
            </td>
            <td>
                <input required="required" disabled="disabled" name="email" value="{{Auth::user()->email}}" type="text">
            </td>
        </tr>

        <tr>
            <td>
               Fullname:
            </td>
            <td>
                <input required="required" name="name" value="{{Auth::user()->name}}" type="text">
            </td>
        </tr>
        <tr>
            <td>
               Address:
            </td>
            <td>
                <input required="required" value="{{Auth::user()->address}}" name="address" type="text">
            </td>
        </tr>
        <tr>
            <td>
               Phone:
            </td>
            <td>
                <input required="required" value="{{Auth::user()->phone}}" name="phone" type="text">
            </td>
        </tr>
        <tr>
            <td>
               Account type:
            </td>
            <td>
                @if(Auth::user()->power==2)
                <input required="required" disabled="disabled" value="admin" name="power" type="text">
                @endif
                @if(Auth::user()->power==3)
                <input required="required" disabled="disabled" value="super admin" name="power" type="text">
                @endif
            </td>
        </tr>
    </tbody>
</table>
<div class="ds_button_admin">
    <div class="btn_xoa" onclick="window.location='{{url('/')}}/admin/thong-tin-tai-khoan/doi-mat-khau';">Change Password</div>
    <input class="btn_them" type="submit" value="Save">
    <div class="clear"> </div>
</div>
</form>
</div>
@endsection
@section('script')
<script>
    function Sua() {
        if ('input:disabled') {
            $('input:disabled').removeAttr('disabled');
        }
    }
</script>
<script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>


{{-- <script src="{{url('/')}}/admin/js/custom.js"></script> --}}

@endsection