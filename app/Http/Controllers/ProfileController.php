<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Bill;
use App\khachhang;
class ProfileController extends Controller
{
    public function  index(){
    	
    	return view('profile.profile');

    }
    public function orders(){
        $user_id = Auth::user()->id;
        // $orders = DB::table('order')
        //         ->join('order_status' ,'order.status', '=' , 'order_status.id')
        //         ->join('order_detail','order.id','=','order_detail.order_id')
        //         ->join('customer','order.customer_id','=','customer.id')
        //         ->join('payment_status','order.payment_status','=','payment_status.id')
        //         ->selectRaw('order.id, order.updated_at, order.total, payment_status.name as name_payment, order_status.name')
        //         ->where('customer.user_id','=',$user_id)
        //         ->orderBy('order.updated_at','desc')
        //         ->paginate(10);
          $orders = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            ->join('payment_status','order.payment_status','=','payment_status.id')
            ->join('order_status','order.status','=','order_status.id')
            ->selectRaw('order.id as id_order, order.status as status_order, order.date_order, order.total, order.note as note_order,order.payments, order.payment_status,
            payment_status.id as id_payment, payment_status.name as name_payment, order_status.id as id_orderstatus, order_status.name as name_orderstatus, customer.*')
             ->where('customer.user_id','=',$user_id)
            ->orderBy('date_order','desc')->paginate(10);
        return view('profile.orders' , compact('orders'));

        //return view('profile.orders');
    }
    public function order_detail($id)
    {
        $thongtindonhang = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            ->join('payment_status','order.payment_status','=','payment_status.id')
            ->join('order_status','order.status','=','order_status.id')
            ->selectRaw('order.id as id_order, order.status as status_order, order.date_order, order.total, order.note as note_order,order.payments, order.payment_status,
            payment_status.id as id_payment, payment_status.name as name_payment, order_status.id as id_orderstatus, order_status.name as name_orderstatus, customer.*')
            ->where('order.id','=',$id)
            ->first();
        $chitiet = DB::table('order_detail')
            ->join('order','order_detail.order_id','=','order.id')
            ->join('product','order_detail.product_id','=','product.id')
            ->join('product_type','product.id_type','=','product_type.id')
            ->selectRaw('order.id as id_order, order.status as status_order, order.date_order, order.total, order.note,order.payments, order.payment_status,
            order_detail.id as id_orderdetail, order_detail.order_id,order_detail.product_id, order_detail.quantity, order_detail.unit_price, order_detail.user_id,
            product.id as id_product, product.name as name_product, product.image,
            product_type.id as id_producttype, product_type.name as name_producttype')
            ->where('order_detail.order_id','=',$id)
            ->orderBy('id_product','asc')
            ->get();
        return view('profile.order_detail',['thongtindonhang'=>$thongtindonhang,'chitiet'=>$chitiet]);
    }

    public function  updateAddress(Request $request){
        $this->validate($request, [
            'fullname' => 'required|min:5|max:35',
            'sdt' => 'required|numeric',
            'diachi' => 'required|min:10|max:100',
            ],[
                'fullname.required' => 'Please enter your full name',
                'fullname.min' => 'Name at least 5 characters',
                'fullname.max' => 'Maximum name 35 characters',
                'diachi.required' => 'Please enter your address',
                'diachi.min' => 'Address must be at least 10 characters',
                'diachi.max' => 'Address up to 100 characters',
            ]);

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(
                [
                     'name' => $request->input('fullname'),
                     'address' => $request->input('diachi'),
                     'phone' => $request->input('sdt'),
                ]
        );
        return back()->with('msg' , 'Your information has been updated');
    }
    public function Password(){
        return view('profile.updatePassword');
    }

    public function updatePassword(Request $request){
         $this->validate($request,[
            'newPassword' => 'required|min:6',
            'rePassword' => 'required|same:newPassword',
            'oldPassword' => 'required',
        ],[
            'newPassword.required' => 'Password can not be blank',
            'oldPassword.required' => 'Please enter the old password',
            'newPassword.min' => 'Password at least 6 characters',
            'rePassword.required' => 'Retype password must not be blank',
            'rePassword.same' => 'Retype the password incorrectly with the password'
        ]);
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        if(!Hash::check($oldPassword, Auth::user()->password)){
           return back()->with('msg' ,'The old password is incorrect ');
        }
        else{
            $request->user()->fill(['password' => Hash::make($newPassword)])->save();
           return back()->with('msg' ,'Password has been changed');
        }
    }

}








