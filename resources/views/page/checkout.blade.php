@extends('master')
@section('content')


<style>
    .brandLi {
        padding: 10px;
    }

    .brandLi b {
        font-size: 16px;
        color: #FE980F;
    }
</style>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 800,
            values: [75, 800],
            slide: function(event, ui) {
                $("#amount_start").val(ui.values[0]);

                $("#amount_end").val(ui.values[1]);


                var start = $('#amount_start').val();

                var end = $('#amount_end').val();

                $.ajax({
                    type: 'get',
                    dataType: 'html',
                    url: '',
                    data: "start=" + start + "& end=" + end,

                    success: function(response) {

                        console.log(response);
                        $('#updateDiv').html(response);
                    }


                });
            }
        });
        $('.try').click(function() {
            //alert('Tuan');
            var brand = [];
            $('.try').each(function() {
                if ($(this).is(":checked")) {
                    brand.push($(this).val());
                }
            });
            Finalbrand = brand.toString();
            $.ajax({
                type: 'get',
                dataType: 'html',
                url: '',
                data: "brand=" + Finalbrand,
                success: function(response) {
                    console.log(response);
                    $('#updateDiv').html(response);
                }
            });
        });

    });
</script>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Payment</li>
            </ol>
        </div>
        <!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Complete the payment</h2>
        </div>

        <?php // form start here
        ?>

        <form action="{{url('/')}}/formvalidate" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="shopper-info">
                            <p style="color: red; font-weight: bold;">Buyer information</p>

                            <input type="text" name="fullname" placeholder="Customer name" class="form-control" value="{{ Auth::user()->name}}">

                            <span style="color:red">{{ $errors->first('fullname') }}</span>
                            <hr>

                            <input type="text" placeholder="Email" name="email" class="form-control" value="{{ Auth::user()->email }}">

                            <span style="color:red">{{ $errors->first('email') }}</span>

                            <hr>

                            <input type="text" placeholder="Address" name="diachi" class="form-control" value="{{ old('diachi') }}">

                            <span style="color:red">{{ $errors->first('diachi') }}</span>

                            <hr>
                            <input type="text" placeholder="Phone" name="sdt" class="form-control" value="{{ old('sdt') }}">

                            <span style="color:red">{{ $errors->first('sdt') }}</span>
                            <hr>
                            {!! Form::textarea('note', null,
                            array('id'=>'note', 'placeholder'=>'Order notes','class'=>'form-control' )) !!}

                            <span style="color:red">{{ $errors->first('sdt') }}</span>
                            <hr>
                            @foreach($cartItems as $cartItem)
                            <input type="hidden" name="qty" class="form-control" value=" {{$cartItem->qty}} ">

                            <input type="hidden" name="price" class="form-control" value=" {{$cartItem->price}} ">



                            @endforeach
                            <div class="payment-options">
                                <!-- <span>
                <input type="radio" name="pay" value="COD" checked="checked" id="cash"> COD
            </span>
            <hr> -->
                                {{ Form::radio('pay', 'COD') }}
                                <span style="padding: 5px;">
                                    <input type="submit" value="COD" class="btn btn-primary"  name="pay" id="cashbtn">
                                </span>
                                <hr>
                                <!-- <span>
                                    {{ Form::radio('pay', 'NL') }}
                                    <input type="submit"  name="pay" value="Ngân Lượng" class="btn btn-primary" id="cashbtn">

                                </span> -->
                                <!-- <hr> -->
                                <br>
                                <span style="margin-top: 2px;">
                                    <!-- {{ Form::radio('pay', 'paypal') }}PayPal -->
                                    <input type="submit" type="radio" name="pay" value="paypal" id="paypal"> PayPal
                                    @include('page.paypal')
                                </span>
                            </div>


                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="order-message">
                            <div class="table-responsive cart_info">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="cart_menu">
                                            <td class="image">Product</td>
                                            <td class="description">description</td>
                                            <td class="price">Price</td>
                                            <td class="quantity">Quantity</td>
                                            <td class="total">Total</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tongthanhtien = 0; ?>
                                        @foreach($cartItems as $cartItem)
                                        <tr>
                                            <td class="cart_product">
                                                <a href=""><img src="source/images/product/{{$cartItem->options->img}}" width="70px" alt=""></a>
                                            </td>
                                            <td class="cart_description">
                                                <h4><a href="">{{$cartItem->name}}</a></h4>
                                                <p>Mã: {{$cartItem->id}}</p>
                                            </td>
                                            <td class="cart_price">
                                                <p>{{ number_format($cartItem->price,0,",",".")}} vnđ</p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">

                                                    <input class="cart_quantity_input" type="text" value="{{$cartItem->qty}}" readonly="readonly" size="2">

                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">{{ number_format($cartItem->subtotal,0,",",".")}} vnđ</p>
                                                <?php $tongthanhtien += $cartItem->subtotal; ?>
                                            </td>
                                            <td class="cart_delete">
                                                <a class="cart_quantity_delete" style="background-color: red;" href="{{url('/gio-hang/remove')}}/{{$cartItem->rowId}}"><i class="fa fa-times"></i></a>

                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4">&nbsp;</td>
                                            <td colspan="2">
                                                <table class="table table-condensed total-result">
                                                    <tr>
                                                        <td>Total money</td>
                                                        <td> {{number_format($tongthanhtien,0,",",".")}} vnđ </td>
                                                        {{-- <td>{{Cart::subtotal()}} vnđ
                                            </td> --}}
                                        </tr>
                                        <tr>
                                            <td> Tax</td>
                                            <?php $thue = 0;
                                            $thue = ($tongthanhtien * 10) / 100;
                                            $tongthanhtien += $thue;
                                            ?>
                                            <td> {{number_format($thue,0,",",".")}} vnđ </td>
                                            {{-- <td>{{Cart::tax()}} vnđ</td> --}}
                                        </tr>
                                        <tr class="shipping-cost">
                                            <td>Ship</td>
                                            <td>Free</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td><span> {{number_format($tongthanhtien,0,",",".")}} vnđ</span> </td>
                                            <input type="hidden" name="tongtien" value="{{$tongthanhtien}}" />
                                            {{-- <td><span>{{Cart::total()}} vnđ</span></td> --}}
                                        </tr>
                                </table>
                                </td>
                                </tr>

                                </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </form>





        <script>
            $('#paypalbtn').hide();
            //$('#cashbtn').hide();

            $(':radio[id=paypal]').change(function() {
                $('#paypalbtn').show();
                //$('#cashbtn').hide();

            });

            $(':radio[id=cash]').change(function() {
                $('#paypalbtn').hide();
                $('#cashbtn').show();

            });
        </script>
</section>
<!--/#cart_items-->
@endsection