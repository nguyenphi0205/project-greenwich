<?php

namespace App\Http\Controllers;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;
use Socialite;
use App\SocialProvider;
use Mail;
use DB;
use Request;


class mailcontroller extends Controller
{
    public function get_lienhe()
    {
    	return view('page.lienhe');
    }
     public function post_lienhe(Request $request){
        $user = new User();
        
        $data = ['hoten'=>Request::input('name'),'email'=>Request::input('email'),'subject'=>Request::input('subject'),'tinnhan'=>Request::input('message')];
        Mail::send('page.blanks',$data, function($msg){
            $msg->from('phingt60908@fpt.edu.vn','Phi Nguyen');
            $msg->to('phingt60908@fpt.edu.vn', 'Phi Nguyen')->subject('This is the customer email');
        });
        echo "<script>
            alert('Thank you for your suggestions. We will contact you as soon as possible');
            window.location ='".url('/index')."'
                
            </script>";
    }
}