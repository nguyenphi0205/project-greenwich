@extends('master')
@section('css')
<style>
    /* chi tiết đơn hàng user */
    .w3-grey,
    .w3-hover-grey:hover,
    .w3-gray,
    .w3-hover-gray:hover {
        color: #000 !important;
        background-color: #bbb !important;
    }

    .thong_tin_nguoi_mua {
        width: 300px;
        float: left;
        margin-left: 20px;
        line-height: 30px;
    }

    .thong_tin_nguoi_mua>div {
        font-weight: bold;
    }

    .thong_tin_nguoi_nhan {
        width: 300px;
        float: left;
        margin-left: 100px;
        line-height: 30px;
    }

    .thong_tin_nguoi_nhan>div {
        font-weight: bold;
    }
</style>
@endsection
@section('content')

<style>
    table td {
        padding: 10px;

    }
</style>

<section id="cart_items">
    <div style="height:50px" class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('profile')}}">Account management</a></li>
                <li class="active">@yield('tieude')</li>
            </ol>
        </div>
        <!--/breadcrums-->
    </div>

    <div style="width: 1349px" class="row">
        <div class="col-md-3 well well-sm" style="margin-left: 120px;width:250px">
            <ul class="nav navbar">
                <h3 class="">Account management</h3>
                <li><a href="{{url('profile')}}">Account information</a></li>
                <li><a href="{{url('password')}}">Change Password</a></li>
                <li><a href="{{url('orders')}}">List of orders</a></li>
            </ul>
        </div>

        <div class="col-md-6">
            <?php /*
             <table border="0" align="center">
                        <tr>
                            <td> <a  href="{{url('/')}}/orders" class="btn btn-success">My Orders</a></td>
                            <td> <a  href="" class="btn btn-success">My Address</a></td>
                            <td> <a  href="" class="btn btn-success">Change Password</a></td>
                        </tr>

             </table>
             */ ?>
            @yield('noidung')
        </div>
</section>
@endsection