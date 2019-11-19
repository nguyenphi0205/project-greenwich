<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart; // for cart lib
use App\Http\Requests;
use App\products;
use App\product_properties;
class CartController extends Controller
{
    // public function getgiohang(){
    //  //$cartItems = Cart::content();
    //  return view('page.giohang');
    // }
    public function getgiohang(){
        $cartItems = Cart::content();
        return view('cart.index', compact('cartItems'));
    }

    public function addItem($id, Request $request)
    {
        //echo $id;
         $products = products::find($id); // get product by id
         if($request->newPrice!=null)
         {
            $price = $request->newPrice;
         }
         else
         {
            $price =$products->price;
         }
         Cart::add($id,$products->name, 1, $price , ['img'=> $products->image]);
         // return back();
         //return redirect('gio-hang');
         return redirect('shop');
    }

    public function destroy($id){
        //echo $id;
        Cart::remove($id);
        return back();
    }

    public function update(Request $request , $id)
    {
        //echo $id;
        
        $qty = $request->qty;
        $proId = $request->proId;
        $rowId = $request->rowId;
            Cart::update($rowId,$qty);
            $cartItems = Cart::content();
        return view('cart.upCart' , compact('cartItems'))->with('status', 'cart updated');

       // echo Cart::content();
       /* if($qty <10){
            $msg = 'Đã được update';
            Cart::update($id,$request->qty);
            return redirect('gio-hang')->with('status',$msg);
        }*/
    }
    public function thongbaothanhtoan()
    {
        return view('page.thongbao');
    }
}

