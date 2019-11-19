@extends('profile.index')
@section('tieude')
List of orders
@endsection
@section('noidung')
<div class=" alert alert-info" style="width: 900px;">

    @if(session('msg'))
    <div class="alert alert-info">
        {{session('msg')}}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
    </div>
    @endif

    <h4 class="heading"> <span style='color:green'>{{ucwords(Auth::user()->name)}} , Recent orders</span></h4>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th style="text-align: center">Code orders</th>
                <th style="text-align: center">Order date</th>
                <th style="text-align: center">Total money</th>
                <th style="text-align: center">Status</th>
                <th style="text-align: center">Payment</th>
                <th style="text-align: center">Action</th>

            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
            <tr>
                <td style="text-align: center">{{$order->id_order}}</td>
                <td style="text-align: center">{{$order->updated_at}}</td>
                <td style="text-align: center">{{ number_format($order->total,0,",",".")}} đ</td>
                <td style="text-align: center">{{$order->name_orderstatus}}</td>
                <td style="text-align: center">{{$order->name_payment}}</td>
                <td style="text-align: center"><a style="color:green" href="{{url('/')}}/order-detail/{{$order->id_order}}">Theo dõi đơn hàng</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-left:300px">
        {{$orders->render()}}
    </div>

</div>
@endsection