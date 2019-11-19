@extends('template_admin.master_admin')
@section('css')
<link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
<style>
    a.morelink {
        text-decoration: none;
        outline: none;
    }

    .morecontent span {
        display: none;
    }

    .comment {
        width: 400px;
        margin: 10px;
        padding: 10px;
    }
</style>
@endsection
@section('content')
<div class="title_main_form_admin">
    List of news
</div>
<div class="main_form_admin">

    <form method="POST" action="{{route('postxoatintuc')}}" accept-charset="UTF-8" id="form_xoa_san_pham" class="form_xoa_san_pham"><input name="_token" type="hidden" value="{{csrf_token()}}">
        <div class="div_danh_sach_items">
            <table class="danh_sach_items">

                <tbody>
                    <tr class="row_header">
                        <td>
                            News code
                        </td>
                        <td>

                            Title
                        </td>
                        <td>
                            Posted by

                        </td>
                        <td>

                            Content summary
                        </td>
                        <td>
                            details
                        </td>
                        <td>
                            Image
                        </td>
                        <td>
                           Status
                        </td>
                        <td>
                            Choose
                        </td>
                    </tr>

                    @foreach ($dstintuc as $tt)
                    <tr class="item_admin">
                        <td class="cell_center">
                            {{$tt->id}}
                        </td>
                        <td>
                            <a href="{{url('/')}}/admin/cap-nhat-tin-tuc/{{$tt->id}}"> {{$tt->title}} </a>
                        </td>
                        <td class="cell_center">
                            {{$tt->User->name}}
                        </td>
                        <td class="comment">
                            {{$tt->intro}}
                        </td>
                        <td class="comment">
                            {{$tt->content}}
                        </td>
                        <td class="cell_center">
                            <img src="{{url('/')}}/source/images/news/{{$tt->images}}">
                        </td>

                        <td class="cell_center">
                            <img style="width: 32px;" src="
                            @if($tt->status == 1){{url('/')."/source/images/home/on.png"}} @else {{url('/')."/source/images/home/off.png"}}
                             @endif" title="@if($tt->status == 1){{"Hiển thị"}} @else {{"Không hiển thị"}} @endif">
                        </td>
                        <td class="cell_center">
                            <input name="thao_tac[]" type="checkbox" value="{{$tt->id}}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
    <div class="phan_trang_admin">
        {{$dstintuc->render()}}
    </div>
    <div class="ds_button_admin">
        <div class="btn_xoa" onclick="kiem_tra_xoa()">Delete the selected list</div>
        <a href="{{route('dangtinmoi')}}">
            <div class="btn_them">Post a new message</div>
        </a>
        <div class="clear"> </div>
    </div>
</div>

@endsection
@section('script')
<script>
    function kiem_tra_xoa() {
        //alert();
        if ($("input:checkbox:checked").length) {
            kq = confirm("Are you sure you want to delete the selected list?");
            if (kq) {
                document.getElementById('form_xoa_san_pham').submit();
            }
        } else {
            alert("Please select the product you want to delete");
        }
    }
</script>
<script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>


{{-- <script src="{{url('/')}}/admin/js/custom.js"></script> --}}
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="{{url('/')}}/admin/js/jquery.shorten.1.0.js"></script>
<script type="text/javascript">
    $(".comment").shorten({
        "showChars": 200,
        "moreText": "See more",
        "lessText": "shortcut",
    });
</script>
@endsection