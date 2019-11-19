@extends('profile.index')
@section('tieude')
Chi tiết đơn hàng
@endsection
@section('noidung')
<div class=" alert alert-info" style="width: 900px;">

    @if(session('msg'))
    <div class="alert alert-info">
        {{session('msg')}}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
    </div>
    @endif

    <h4 class="heading"> <span style='color:green'>{{ucwords(Auth::user()->name)}} , product code: {{$thongtindonhang->id_order}}</span></h4>

    <div style="color: black" class="thong_tin_don_hang">
        <div class="thong_tin_nguoi_mua">
            <div>buyer information</div>
            Full name: {{$thongtindonhang->name}}<br />
            Email: {{$thongtindonhang->email}}<br />
            Address: {{$thongtindonhang->address}}<br />
            Phone: {{$thongtindonhang->phone}}<br />
            Date order: {{date("d-m-y H:i:s",strtotime($thongtindonhang->updated_at))}}<br />
            {{-- <div class="w3-border">
                        
                        <img width="30px" style="margin-bottom:15px" src="{{url('/')}}/source/images/home/ship.png">
            <div class="w3-grey" style="margin-top:10px;margin-left:110px;height:8px;width: 200%">

            </div>Processing

        </div> --}}

        <div style="width:600px;margin-left:100px;margin-top: 20px;margin-bottom: 20px;">
            @if($thongtindonhang->id_orderstatus==1)
            <img width="50px" style="padding-right:10px" src="{{url('/')}}/source/images/home/ship.png">
            <style>
                #tt {
                    width: 1%;
                }
            </style>
            @else
            @if($thongtindonhang->id_orderstatus==2)
            <img width="60px" style="padding-right:10px;margin-left:280px" src="{{url('/')}}/source/images/home/ship3.png">
            <style>
                #tt {
                    width: 50%;
                }
            </style>
            @else
            <img width="60px" height="45px" style="padding-right:10px;margin-left:560px" src="{{url('/')}}/source/images/home/ship4.png">
            <style>
                #tt {
                    width: 100%;
                }
            </style>
            @endif
            @endif
            <div style="margin-bottom:0px; margin-left:10px; height:25px " class="progress">
                <div id="tt" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">

                    {{-- <img width="45px" style="padding-right:10px;margin-left:280px" src="{{url('/')}}/source/images/home/ship2.png"> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">In process</div>
                <div style="padding-left: 50px" class="col-sm-4">On delivery</div>
                <div style="padding-left: 140px" class="col-sm-4">successful delivery</div>
            </div>
        </div>
        </form>
    </div>
    <div class="thong_tin_nguoi_nhan">
        <div>Receiver's information</div>
        Full Name: {{$thongtindonhang->name}}<br />
        Address: {{$thongtindonhang->address}}<br />
        Phone: {{$thongtindonhang->phone}}<br />


    </div>
</div>
<div style="clear: both"></div>
<div>
    <p>
        <h3>List of items in the invoice</h3>
</div>
<table class="table table-responsive">
    <thead>
        <tr style="background: #3E8DEC;color: #fff;">
            <th style="text-align: center">Product code</th>
            <th style="text-align: center">Product's name</th>
            <th style="text-align: center">Product`s image</th>
            <th style="text-align: center">Product type</th>
            <th style="text-align: center">Unit price</th>
            <th style="text-align: center">Quantity</th>
            <th style="text-align: center">Total </th>

        </tr>
        @foreach($chitiet as $ct)
        <tr>
            <th style="text-align: center;vertical-align: middle;font-size: 14px;font-weight: normal">{{$ct->id_product}}</th>
            <th style="text-align: center;vertical-align: middle;font-size: 14px;font-weight: normal">{{$ct->name_product}}</th>
            <th style="text-align: center"><img width="80px" src="{{url('/')}}/source/images/product/{{$ct->image}}"></th>
            <th style="text-align: center;vertical-align: middle;font-size: 14px;font-weight: normal">{{$ct->name_producttype}}</th>
            <th style="text-align: center;vertical-align: middle;font-size: 14px;font-weight: normal"> {{ number_format($ct->unit_price,0,",",".")}}</th>
            <th style="text-align: center;vertical-align: middle;font-size: 14px;font-weight: normal">{{$ct->quantity}}</th>
            <th style="text-align: center;vertical-align: middle;font-size: 14px;font-weight: normal">{{ number_format($thanhtien=($ct->quantity)*($ct->unit_price),0,",",".")}}</th>

        </tr>
        @endforeach
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                &nbsp;
            </td>
            <td>
                &nbsp;
            </td>
            <td style="margin-left:50px">
                Tổng tiền
            </td>
            <td>
                {{number_format($thongtindonhang->total,0,",",".")}} VNĐ
            </td>
        </tr>
    </thead>

    <tbody>

    </tbody>
</table>
<div>
    <div style="margin-left:300px">
    </div>

</div>
@endsection