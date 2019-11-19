<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\address;
use App\products;
use App\orders;
use App\Http\Requests;
use App\khachhang;
use App\Bill;
use App\BillDetail;
use Session;
use App\WC_Order;
use Mail;
class CheckoutController extends Controller
{
    public function index(){
            $cartItems = Cart::content();
            //echo "checkout";
            return view('page.checkout' , compact(('cartItems')));
    }

     public function formvalidate(Request $request){
       $cartItems = Cart::content();
       $cart = Session::get('cart');
	   if(count($cartItems)>0)
       {
      // dd($cartItems);
         $customer = new khachhang;
            $customer->name = $request->fullname;

            $customer->email = $request->email;
            $customer->address = $request->diachi;
            $customer->phone = $request->sdt;
            
           // $address->pincode = $request->pincode;
           // $address->payment_type = $request->pay;
            $customer->save();
            $bill = new Bill;
            //$bill->id = $userid;
            $bill->date_order = date('Y-m-d H:i:s');
            $bill->total =$request->tongtien;
            $bill->payments = $request->pay;
            $bill->note = $request->note;
            $bill->status = 1;     
                
            if($request->pay =="COD")
            {
                $bill->payment_status = 1;
            }
            if ($request->pay =="paypal") {
                $bill->payment_status = 2;
            }
            if ($request->pay =="Ngân lượng") {
                $bill->payment_status = 1;
            }
            $data_send_mail = array(
                'HoTen' => $request->input('fullname'),
                'diachi' => $request->input('diachi'),
                'sdt' => $request->input('sdt'),
                'cartItems' => $cartItems,
                'email' => $request->input('email'),
            );
            $customer->bill()->save($bill);
            foreach($cartItems as $cartItem){
            $bill_detail = new BillDetail;
            $bill_detail->order_id   = $bill->id;
            $bill_detail->product_id = $cartItem->id;
            $bill_detail->quantity = $cartItem->qty;
            $bill_detail->unit_price =  $cartItem->price;
            $bill_detail->save();
            
            Cart::destroy();
            }
                Mail::send('page.maildh',$data_send_mail, function ($message) use($data_send_mail)
                {
                    $message->from('phingt60908@fpt.edu.vn',"Find Good Food");
                    $message->to($data_send_mail["email"]);
                    $message->subject('Sales receipt from Find Good Food');
                });
            
            if ($request->pay =="Ngân lượng")
            {
                return redirect('https://www.nganluong.vn/button_payment.php?receiver=tranthanhthang2008@gmail.com&product_name='.$bill->id.'&price='.$request ->price.'return_url=tuanthangbakery.hol.es&comments=thanh cong');
            }
            else{
                return redirect('thongbao');
            }
		
		}
        else
        {
            return redirect(url('/')."/gio-hang");
        }
        }
        public function activeUser($id){
        $order =  Bill::Find($id);
        if($order){
            $order->status = 1;
            $order->save();
            return redirect()->route('dangki')->with(['thanhcong'=>'You have just placed an order successfully']);
        }
    }

    
        //Session::forget('cart');
        //return redirect()->back()->with('thongbao','Đặt hàng thành công');



     

}
