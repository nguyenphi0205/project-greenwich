@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
<div class="main_form_admin">
              <div class="title_main_form_admin">
                    Update product categories
                </div>
                <div class="div_form_thong_tin">
                    <ul class="validation_error">
                     @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                     <script language="javascript" src="{{url('/')}}/admin/vendors/ckeditor/ckeditor.js" type="text/javascript"></script>
                      {!! Form::open(array('route'=>'postcapnhatloaisanpham','id'=>'form_cap_nhat_san_pham','class' => 'form_cap_nhat_san_pham', 'files'=>true)) !!}
                    {{-- <form method="POST" action="{{route('postcapnhatsanpham')}}" accept-charset="UTF-8" id="form_them_san_pham_moi" class="form_them_san_pham_moi" enctype="multipart/form-data"> --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="form_cap_nhat">
                            <tbody><tr>
                                <td>
                                    Product type name (*): 
                                </td>
                                <td>
                                    <input required="required" placeholder="Product type name" name="ten_loai_san_pham" value="{{$thongtinloaisp->name}}" type="text">
                                     {!! Form::hidden('ma', $thongtinloaisp->id) !!}
                                </td>
                            </tr>
                            {{-- <tr>
                                <td>
                                    Product Type:
                                </td>
                                <td> --}}
                                {{-- <select name="ma_loai">
                                      <option value="{{$thongtinloaisp->Category->id}}">{{$thongtinloaisp->Category->name}}</option>
                                </select> --}}
                                {{-- {!! Form::select('ma_loai',$dsloaisp,$thongtinloaisp->Category->id) !!}
                                </td>
                            </tr> --}}
                            <tr>
                                <td>
                                    Type of product (*):
                                </td>
                                <td>
                                <div class="hinh_minh_hoa">
                                        @if($thongtinloaisp->image)
                                            <img style="width: 300px; border:inset 3px pink" alt="{{$thongtinloaisp->name}}" src="{{url('/')}}/source/images/product-type/{{$thongtinloaisp->image}}" />
                                        @endif
                                    </div>
                                    <div>
                                        <input accept=".png,.jpg,.gif" name="hinh_loai_san_pham" type="file">
                                         {!! Form::hidden('hinh',$thongtinloaisp->image) !!}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Description(*):
                                </td>
                                <td>
                                    {!! Form::textarea('mo_ta', $thongtinloaisp->intro,
                                        array('required','id'=>'mo_ta', 'placeholder'=>'Brief description','required')) !!}
                                     <script type="text/javascript">CKEDITOR.replace( 'mo_ta', { customConfig: '{{url('/')}}/admin/vendors/ckeditor/baiviet_config.js' } ); </script>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Status:
                                </td>
                                <td>
                                    @if($thongtinloaisp->status==1)
                                        <input type="checkbox" name="status" checked>
                                    @else
                                        <input type="checkbox" name="status">
                                    @endif
                                </td>
                            </tr>
                        </tbody></table>
                        <p style="padding-left:90px;font-size:15px; color:grey">(*)Required</p>
                        <div class="ds_button_admin">
                            <div class="btn_xoa" onclick="window.location='{{url('/')}}/admin/danh-sach-loai-san-pham';">Cancel</div>
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