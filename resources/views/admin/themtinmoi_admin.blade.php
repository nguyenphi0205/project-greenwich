@extends('template_admin.master_admin')
@section('css')
<link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
{{-- <label>Product's name</label></br>
            	
            <script src="{{url('/')}}/admin/vendors/ckeditor/ckeditor.js"></script>
<textarea row="3" id="summary" name="txtIntro"></textarea>
<script type="text/javascript">
    CKEDITOR.replace("summary")
</script> --}}
<div class="title_main_form_admin">
    Post a news
</div>
<div class="main_form_admin">
    <div class="div_form_thong_tin">
        <ul class="validation_error">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            @if(Session::has('status'))
            <p class="alert alert-warning">{{ Session::get('status') }}</p>
            @endif
        </ul>
        <script language="javascript" src="{{url('/')}}/admin/vendors/ckeditor/ckeditor.js" type="text/javascript"></script>
        <form method="POST" action="{{route('postdangtinmoi')}}" accept-charset="UTF-8" id="form_them_san_pham_moi" class="form_them_san_pham_moi" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table class="form_cap_nhat">
                <tbody>
                    <tr>
                        <td>
                            Title(*):
                        </td>
                        <td>
                            <input required="required" placeholder="Title of the article" name="title" type="text">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Avatar(*)
                        </td>
                        <td>
                            <div>
                                <input accept=".png,.jpg,.gif" name="hinh" type="file">

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Content summary (*):
                        </td>
                        <td>
                            {!! Form::textarea('intro', null,
                            array('id'=>'intro', 'placeholder'=>'Content summary','required')) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Details(*):
                        </td>
                        <td>
                            {!! Form::textarea('mo_ta', null,
                            array('id'=>'mo_ta', 'placeholder'=>'details','required')) !!}
                            <script type="text/javascript">
                                CKEDITOR.replace('mo_ta', {
                                    customConfig: '{{url(' / ')}}/admin/vendors/ckeditor/baiviet_config.js'
                                });
                            </script>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p style="padding-left:90px;font-size:15px; color:grey">(*)Required</p>
            <div class="ds_button_admin">

                <div class="btn_xoa" onclick="window.location='{{url('/')}}/admin/danh-sach-tin-tuc';">Cancel</div>
                <input class="btn_them" type="submit" value="Save">
                <div class="clear"> </div>
            </div>
        </form>
    </div>

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