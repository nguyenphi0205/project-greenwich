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
      <h2 class="heading">You have completed the payment. Invoice information has been sent to your email for verification</h2>
    </div>
</section>
<script>
  $('#paypalbtn').hide();
  //  $('#cashbtn').hide();
  $(':radio[id=paypal]').change(function() {
    $('#paypalbtn').show();
    $('#cashbtn').hide();
  });

  $(':radio[id=cash]').change(function() {
    $('#paypalbtn').hide();
    $('#cashbtn').show();

  });
</script>
</section>
<!--/#cart_items-->
@endsection