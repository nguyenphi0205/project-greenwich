     <div class="features_items">
       <!--features_items-->
       <h2 class="title text-center"> <span style="color: orange; font-weight: bold;">List of products </span> </h2>
       <?php $countP = 0;  ?>
       @foreach($sanpham as $sl)
       <input type="hidden" id="pro_id<?php echo $countP; ?>" value="{{$sl->id}}" />
       <div class="col-sm-4">
         <div class="product-image-wrapper" style="box-shadow: 2px 4px 2px 0px #bbb;">
           <div class="single-products">
             <div class="productinfo text-center">
               <a href="product_details/{{$sl->id}}"><img src="source/images/product/{{$sl->image}}" alt="" height="200px" /></a>
               <h2><?php echo number_format($sl->price, 0, ",", ".") ?> VNĐ</h2>
               <p><a href="product_details/{{$sl->id}}">{{$sl->name}}</a></p>
               <a href="gio-hang/addItem/{{$sl->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Cart</a>
             </div>

           </div>
           @if(Auth::check())
           <div class="choose">
             <?php
              $wishData = DB::table('wishlist')->leftJoin('product', 'wishlist.pro_id', '=', 'product.id')->where('wishlist.pro_id', '=', $sl->id)->get();
              //echo $wishData['id'];
              //if($wishData==''){ echo 'empty';} else { echo 'filled'; }
              $count = App\wishList::where(['pro_id' => $sl->id, 'user_id' => Auth::user()->id])->count();
              ?>
             <?php if ($count == "0") { ?>
               <form action="{{url('addToWishList')}}">
                 {{ csrf_field() }}
                 <input type="hidden" value="{{$sl->id}}" name="pro_id" />
                 <p align="center"><input style=" width:30px;height:30px;background: rgba(254, 152, 15, 0);background-image:url('source/images/home/love.png'); background-size: 20px 20px; background-repeat: no-repeat" type="submit" value="" title="Yêu thích" class="btn btn-primary"></p>
               </form>
             <?php } else { ?>
               <p style="height:46px" align="center"><a href="{{url('WishList')}}"><img title="Đã yêu thích" width="20px" style="cursor: pointer; margin-top:16px;" src="{{url('/')}}/source/images/home/loved2.png"></a></p>
               {{-- <h5 align="center" style="color: green"> Added to item <a href="{{url('WishList')}}">favorite</a></h5> --}}
             <?php } ?>

           </div>
           @endif
         </div>
       </div>
       <?php $countP++ ?>
       @endforeach


     </div>
     <!--features_items-->