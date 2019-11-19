@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
<div class="main_form_admin">
              <div class="title_main_form_admin">
                    Member update
                </div>
                <div class="div_form_thong_tin">
                    <ul class="validation_error">
                     @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @if(Session::has('status'))
                        <p class="alert alert-danger">{{ Session::get('status') }}</p>
                    @endif
                    </ul>
                     <script language="javascript" src="{{url('/')}}/admin/vendors/ckeditor/ckeditor.js" type="text/javascript"></script>
                      {!! Form::open(array('route'=>'postcapnhattaikhoan','id'=>'form_cap_nhat_san_pham','class' => 'form_cap_nhat_san_pham', 'files'=>true)) !!}
                    {{-- <form method="POST" action="{{route('postcapnhatsanpham')}}" accept-charset="UTF-8" id="form_them_san_pham_moi" class="form_them_san_pham_moi" enctype="multipart/form-data"> --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="form_cap_nhat">
                            <tbody>
                            <tr>
                                <td>
                                   Email:
                                </td>
                                <td>
                                    <input required="required" disabled="disabled" value="{{$taikhoan->email}}" placeholder="Đơn giá" name="email" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   Fullname(*):
                                </td>
                                <td>
                                    <input required="required" placeholder="Tên sản phẩm" name="name" value="{{$taikhoan->name}}" type="text">
                                     {!! Form::hidden('ma', $taikhoan->id) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Account type(*):
                                </td>
                                <td>
                                {!! Form::select('power',$dsquyen,$taikhoan->power) !!}
                                
                                {{-- {!! Form::select('power',$dsquyen,$taikhoan->power,array('disabled')) !!} --}}
                                {{-- @if($taikhoan->power==1)
                                    <input type="radio" name="power" value="3"> Super Admin<br>
                                    <input type="radio" name="power" value="2" > Admin<br>
                                    <input type="radio" name="power" value="1" checked> Member<br>
                                @endif
                                @if(($taikhoan->power==2))
                                    <input type="radio" name="power" value="3"> Super Admin<br>
                                    <input type="radio" name="power" value="2" checked> Admin<br>
                                    <input type="radio" name="power" value="1" > Member<br>
                                @endif
                                @if(($taikhoan->power==3))
                                    <input type="radio" name="power" value="3" checked> Super Admin<br>
                                    <input type="radio" name="power" value="2" > Admin<br>
                                    <input type="radio" name="power" value="1" > Member<br>
                                @endif --}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Phone:
                                </td>
                                <td>
                                    <input required="required" value="{{$taikhoan->phone}}" name="phone" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Address:
                                </td>
                                <td>
                                     <input value="{{$taikhoan->address}}" name="address" type="text">
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    Status:
                                </td>
                                <td>
                                    @if($taikhoan->status==1)
                                        <input type="checkbox" name="status" checked>
                                    @else
                                        <input type="checkbox" name="status">
                                    @endif
                                </td>
                            </tr>
                        </tbody></table>
                        <p style="padding-left:90px;font-size:15px; color:grey">(*)required</p>
                        <div class="ds_button_admin">
                            <div class="btn_xoa" onclick="window.location='{{url('/')}}/admin/danh-sach-thanh-vien';">Cancel</div>
                            <input class="btn_them" type="submit" value="Save">
                            <div class="clear"> </div>
                        </div>
                    </form>
                </div>

            </div>
            @endsection
@section('script')

    <script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>

    <script src="{{url('/')}}/admin/vendors/ckeditor/ckeditor.js"></script>
    <script src="{{url('/')}}/admin/vendors/ckfinder/ckfinder.js"></script>
   
    <script src="{{url('/')}}/admin/vendors/ckeditor/adapters/jquery.js"></script>

    <script type="text/javascript" src="{{url('/')}}/admin/vendors/tinymce/js/tinymce/tinymce.min.js"></script>

    {{-- <script src="{{url('/')}}/admin/js/custom.js"></script> --}}
    <script src="{{url('/')}}/admin/js/editors.js"></script>
@endsection