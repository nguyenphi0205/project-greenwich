<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests;
use App\Http\Requests\ThemspadminRequest;
use App\Http\Requests\ThemspSizeadminRequest;
use App\products;
use App\Category;
use Hash;
use DB;
use App\Bill;
use App\BillDetail;
use App\khachhang;
use App\product_properties;
use App\product_size;
class AdminController extends Controller
{
    public function trangchu_admin()
    {
            $dsdonhang = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            ->join('payment_status','order.payment_status','=','payment_status.id')
            ->join('order_status','order.status','=','order_status.id')
            ->where('order.payment_status','<>',2)
            ->where('order.status','<>',3)
            ->where('order.status','<>',4)
            ->selectRaw('order.id as id_order, order.status as status_order, order.date_order, order.total, order.note as note_order,order.payments, order.payment_status,
            payment_status.id as id_payment, payment_status.name as name_payment, order_status.id as id_orderstatus, order_status.name as name_orderstatus, customer.*')
            ->get();
            $spmoi = products::where('new',1)->get();
            $user = User::where('active',1)->where('status',1)->where('power',1)->get();
        return view('admin.trangchu_admin',['dsdonhang'=>$dsdonhang,'spmoi'=>$spmoi,'user'=>$user]);
    }
    //quản lí đơn hàng
    public function quanlydonhang_admin()
    {
        return view('admin.danhsachdonhangmoi_admin');
    }
    public function danhsachdonhangcu_admin(){
        $dsdonhang = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            ->join('payment_status','order.payment_status','=','payment_status.id')
            ->join('order_status','order.status','=','order_status.id')
            ->where('order.status','>',2)
            ->selectRaw('order.id as id_order, order.status as status_order, order.date_order, order.total, order.note as note_order,order.payments, order.payment_status,
            payment_status.id as id_payment, payment_status.name as name_payment, order_status.id as id_orderstatus, order_status.name as name_orderstatus, customer.*')
            ->orderBy('id_order','asc')->paginate(10);
        return view('admin.danhsachdonhangcu_admin',['dsdonhang'=>$dsdonhang]);
    }
    public function danhsachdonhangmoi_admin()
    {
        $dsdonhang = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            ->join('payment_status','order.payment_status','=','payment_status.id')
            ->join('order_status','order.status','=','order_status.id')
            ->where('order.payment_status','<>',2)
            ->where('order.status','<>',3)
            ->where('order.status','<>',4)
            ->selectRaw('order.id as id_order, order.status as status_order, order.date_order, order.total, order.note as note_order,order.payments, order.payment_status,
            payment_status.id as id_payment, payment_status.name as name_payment, order_status.id as id_orderstatus, order_status.name as name_orderstatus, customer.*')
            ->orderBy('date_order','desc')->paginate(10);
        return view('admin.danhsachdonhangmoi_admin',['dsdonhang'=>$dsdonhang]);
    }
    public function chitietdonhang_admin($id)
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
        $dstrangthai= DB::table('order_status')->get();
        $dstrangthai = $this->chuyen_mang_doi_tuong_sang_mang_key($dstrangthai);
        // $dssanpham = DB::table('order_detail')
        //     ->join('product','order_detail.product_id','=','product.id')
        //     ->join('product_type','product.id_type','=','product_type.id')
        //     ->where('order_detail.order_id','=',$id)
        //     ->get();
        return view('admin.capnhatdonhang_admin',['thongtindonhang'=>$thongtindonhang,'chitiet'=>$chitiet,'dstrangthai'=>$dstrangthai]);
    }
    public function cap_nhat_trang_thai_don_hang(Request $request)
    {
        DB::table('order')
            ->where('id', $request->get('id'))
            ->update(
                [
                    'payment_status' => 3 - $request->get('payment_status'),
                ]
            );
        // echo $request->get('ma_don_hang')."<br/>".$request->get('payment_status')."<br/>";
        echo (3- $request->input('payment_status'));
    }
    public function postcapnhatttdonhang_admin(Request $req)
    {
        DB::table('order')
            ->where('id',$req->input('id'))
            ->update(
                [
                    'status' => $req->input('trangthai'),
                ]
            );
        $req->session()->flash('status', 'Updated!');
        return back();
    }
    //quản lí loại sản phẩm
    public function dsloaisanpham()
    {
        $dsloaisp = Category::all();
        return $dsloaisp;
    }
    public function danhsachloaisanpham_admin()
    {
        $loaisp = Category::paginate(10);
        return view('admin.danhsachloaisp_admin',['loaisp'=>$loaisp]);
    }
    public function getThemloaisp_admin()
    {
        return view('admin.themloaisp_admin');
    }
    public function postThemloaisp_admin(Request $reqaddloai)
    {
         $this->validate($reqaddloai,[
            'ten_loai_san_pham' => 'required',
            'mo_ta' => 'required',
        ],[
            'ten_loai_san_pham.required' => 'Please enter the product type name',
            'mo_ta.required' => 'Please enter a description for this type of product'
        ]);
         if($reqaddloai->file('hinh_loai_san_pham'))
        {
            if($reqaddloai->file('hinh_loai_san_pham')->isValid())
            {
                $reqaddloai->file('hinh_loai_san_pham')->move("source/images/product-type",$reqaddloai->file('hinh_loai_san_pham')->getClientOriginalName());
                $hinh_loai_san_pham = $reqaddloai->file('hinh_loai_san_pham')->getClientOriginalName();
                //print_r($request->file('hinh_san_pham')->getClientOriginalName());exit;
            }
        }
        else
        {
            echo "<script>alert('You must choose an avatar for the new product type!')</script>";
            echo "<script>window.location = '".url('/')."/admin/them-loai-san-pham-moi"."'</script>";
            die;
        }

                if(isset($reqaddloai->status))
                {
                    $trangthai=1;
                }  
                
                else  
                {
                    $trangthai=0;
                }
        $dsloaisp = Category::where('name','=',$reqaddloai->input('ten_loai_san_pham'))->get();
        if(count($dsloaisp)<1)
        {
            DB::table('product_type')->insertGetId(
            [
                'name' => $reqaddloai->input('ten_loai_san_pham'),
                'intro' => $reqaddloai->input('mo_ta'),
                'status' =>$trangthai,
                'image' => $hinh_loai_san_pham,
            ]
            );
            return redirect("/admin/danh-sach-loai-san-pham");
        }
        $reqaddloai->session()->flash('status', 'This type of product already exists!');
        return redirect(url('/')."/admin/them-loai-san-pham-moi");
    }
    public function getCapnhatloaisp_admin($id)
    {
        // $dsloaisp = Category::all();
        // $dsloaisp = $this->chuyen_mang_doi_tuong_sang_mang_key($dsloaisp);
        $thongtinloaisp = Category::find($id);
        // print_r($dsloaisp);
        return view('admin.capnhatloaisp_admin',['thongtinloaisp'=>$thongtinloaisp]);
    }
     public function postCapnhatloaisp_admin(Request $reqcapnhat)
    {
         $this->validate($reqcapnhat,[
            'ten_loai_san_pham' => 'required',
            'mo_ta' => 'required',
        ],[
            'ten_loai_san_pham.required' => 'Please enter the product type name',
            'mo_ta.required' => 'Please enter a description for this type of product'
        ]);
        if($reqcapnhat->file('hinh_loai_san_pham'))
        {
            if($reqcapnhat->file('hinh_loai_san_pham')->isValid())
            {
                $reqcapnhat->file('hinh_loai_san_pham')->move("source/images/product-type",$reqcapnhat->file('hinh_loai_san_pham')->getClientOriginalName());
                $hinh_loai_san_pham = $reqcapnhat->file('hinh_loai_san_pham')->getClientOriginalName();
                //print_r($request->file('hinh_san_pham')->getClientOriginalName());exit;
            }
        }
        else
        {
            $hinh_loai_san_pham = $reqcapnhat->input('hinh');
        }
        if(isset($reqcapnhat->status))
         {
            $trangthai=1;
         }  
                
         else  
         {
            $trangthai=0;
         }
        //echo $hinh_san_pham;exit;
        DB::table('product_type')
            ->where('id', $reqcapnhat->input('ma'))
            ->update(
                [
                     'name' => $reqcapnhat->input('ten_loai_san_pham'),
                     'intro' => $reqcapnhat->input('mo_ta'),
                     'status' =>$trangthai,
                     'image' => $hinh_loai_san_pham,
                ]
            );
        if($trangthai==0){
            $sanpham = DB::table('product')->where('id_type',$reqcapnhat->ma)->update(['status'=>0]);
        }
        return redirect(url('/')."/admin/danh-sach-loai-san-pham");
    
    }
    public function xoa_loai_san_pham(Request $request)
    {
        //print_r($_POST);
        $ds_xoa = $request->input('thao_tac');
        $loaisanpham = DB::table('product_type')->whereIn('id', $ds_xoa)->update(['status' => 0]);
        $sanpham = DB::table('product')->whereIn('id_type',$ds_xoa)->update(['status'=>0]);
        return redirect("/admin/danh-sach-loai-san-pham");
        //print_r($ds_xoa);
    }
    //quản lí sản phẩm
    public function danhsachsanpham_admin()
    {
        $sanpham = products::with('Category')->orderBy('id','asc')->paginate(10);
        return view('admin.danhsachsp_admin',['sanpham'=>$sanpham]);
    }
    public function getCapnhatsp_admin($id)
    {
        $dsloaisp = Category::where('status','=','1')->get();
        $dsloaisp = $this->chuyen_mang_doi_tuong_sang_mang_key($dsloaisp);
        $thongtinsp = products::find($id);
        // $size = DB::table('product')
        // ->join('products_properties','product.id','=','products_properties.pro_id')
        // ->selectRaw('products_properties.id as id_proper,products_properties.size, product.*')
        // ->where('product.id','=',$id)
        // ->get();
        $dssize = DB::table('products_properties')->join('product_size','products_properties.size_id','=','product_size.id')->where('pro_id','=',$id)->get();
        // if($size!=null)
        // {
        //     $thongtinsp = $size;
        //     $thongtinsp = $this->chuyen_mang_doi_tuong_sang_mang_key($thongtinsp);
        // }
        // print_r($dssize);
        // print_r($thongtinsp);
        return view('admin.capnhatsp_admin',['thongtinsp'=>$thongtinsp,'dsloaisp'=>$dsloaisp,'dssize'=>$dssize]);
    }
    public function postCapnhatsp_admin(ThemspadminRequest $reqcapnhat)
    {
        
        if($reqcapnhat->file('hinh_san_pham'))
        {
            if($reqcapnhat->file('hinh_san_pham')->isValid())
            {
                $reqcapnhat->file('hinh_san_pham')->move("source/images/product",$reqcapnhat->file('hinh_san_pham')->getClientOriginalName());
                $hinh_san_pham = $reqcapnhat->file('hinh_san_pham')->getClientOriginalName();
                //print_r($request->file('hinh_san_pham')->getClientOriginalName());exit;
            }
        }
        else
        {
            $hinh_san_pham = $reqcapnhat->input('hinh');
        }
        if(isset($reqcapnhat->status))
         {
            $trangthai=1;
         }  
                
         else  
         {
            $trangthai=0;
         }
        //echo $hinh_san_pham;exit;
        // $kiemtraloai = DB::table('product_type')->where('id',$reqcapnhat->input('ma_loai'))->select('status')->get();
        // if($kiemtraloai==1){
            
        if($reqcapnhat->ma_loai!=null)
        {
        // DB::table('product')
        //     ->where('id', $reqcapnhat->input('ma'))
        //     ->update(
        //         [
        //              'name' => $reqcapnhat->input('ten_san_pham'),
        //              'id_type' => $reqcapnhat->input('ma_loai'),
        //              'intro' => $reqcapnhat->input('mo_ta'),
        //              'price' => $reqcapnhat->input('don_gia'),
        //              'unit' => $reqcapnhat->input('don_vi_tinh'),
        //              'new' => 1,
        //              'status' =>$trangthai,
        //              'image' => $hinh_san_pham,
        //         ]
        // );
             if(isset($reqcapnhat->product_new))
                {
                    $moi=1;
                }  
                
                else  
                {
                    $moi=0;
                }
            
                if($reqcapnhat->gia1=="")
                {

                    $gia = $reqcapnhat->input('don_gia');
                }
                else
                {
                    $gia =  $reqcapnhat->gia1;
                }
            $product = products::find($reqcapnhat->input('ma'));
            $product->name =$reqcapnhat->input('ten_san_pham');
            $product->id_type = $reqcapnhat->input('ma_loai');
            $product->intro = $reqcapnhat->input('mo_ta');
            $product->price = $gia;
            $product->unit = $reqcapnhat->input('don_vi_tinh');
            $product->new = $moi;
            $product->status = $trangthai;
            $product->image = $hinh_san_pham;
            $product->save();
            if($reqcapnhat->size1!=null && $reqcapnhat->gia1!=null)
            {
                $pro_per = product_properties::where('pro_id',$reqcapnhat->input('ma'))->where('size_id',$reqcapnhat->input('id_size1'))->first();
                $size = product_size::where('id',$reqcapnhat->input('id_size1'))->first();
                $size->size = $reqcapnhat->size1;
                $pro_per->p_price = $reqcapnhat->gia1;
                $size->save();
                $size->product_properties()->save($pro_per);
                $product->product_properties()->save($pro_per);
            }
            if($reqcapnhat->size2!=null && $reqcapnhat->gia2!=null)
            {
               $pro_per2 = product_properties::where('pro_id',$reqcapnhat->input('ma'))->where('size_id',$reqcapnhat->input('id_size2'))->first();
               $size2 = product_size::where('id',$reqcapnhat->input('id_size2'))->first();
                $size2->size = $reqcapnhat->size2;
                $pro_per2->p_price = $reqcapnhat->gia2;
                $size2->save();
                $size2->product_properties()->save($pro_per2);
                 $product->product_properties()->save($pro_per2);
            }
            if($reqcapnhat->size3!=null && $reqcapnhat->gia3!=null)
            {
                $pro_per3 = product_properties::where('pro_id',$reqcapnhat->input('ma'))->where('size_id',$reqcapnhat->input('id_size3'))->first();
                $size3 = product_size::where('id',$reqcapnhat->input('id_size3'))->first();
                 $size3->size = $reqcapnhat->size3;
                 $pro_per3->p_price = $reqcapnhat->gia3;
                  $size3->save();
                $size3->product_properties()->save($pro_per3);
                 $product->product_properties()->save($pro_per3);
            }
        
        return redirect(url('/')."/admin/danh-sach-san-pham");
        }
        else
        {
            // echo "<script>alert('Loại sản phẩm đã ngừng bán không thể cập nhật sản phẩm!')</script>";
            $reqcapnhat->session()->flash('status', 'Product type discontinued cannot update product!');
            return redirect(url('/')."/admin/cap-nhat-san-pham/".$reqcapnhat->ma);
        }
    }
    //quản lí sp theo size
    public function getThemspsize_admin()
    {
        $loaisp = Category::all();
        return view('admin.themsptheosize_admin',['loaisp'=>$loaisp]);
    }
    public function postThemspsize_admin(ThemspSizeadminRequest $req)
    {
         if($req->file('hinh_san_pham'))
        {
            if($req->file('hinh_san_pham')->isValid())
            {
                $req->file('hinh_san_pham')->move("source/images/product",$req->file('hinh_san_pham')->getClientOriginalName());
                $hinh_san_pham = $req->file('hinh_san_pham')->getClientOriginalName();
                //print_r($request->file('hinh_san_pham')->getClientOriginalName());exit;
            }
        }
        else
        {
            echo "<script>alert('You have to choose the image for the new product!')</script>";
            echo "<script>window.location = '".url('/')."/admin/them-san-pham-moi"."'</script>";
            die;
        }
        
                if(isset($req->product_new))
                {
                    $moi=1;
                }  
                
                else  
                {
                    $moi=0;
                }
               
        $product = new products();
        $product->name =$req->input('ten_san_pham');
        $product->id_type = $req->input('ma_loai');
        $product->intro = $req->input('mo_ta');
        $product->price = $req->input('gia1');
        $product->unit = $req->input('don_vi_tinh');
        $product->new = $moi;
        $product->status = 1;
        $product->image = $hinh_san_pham;
        $product->save();
        $pro_per = new product_properties();
        $pro_per2 = new product_properties();
        $pro_per3 = new product_properties();
         $size = new product_size();
         $size2 = new product_size();
         $size3 = new product_size();
        if($req->size1!=null && $req->gia1!=null)
        {
            $size->size = $req->size1;
            $pro_per->p_price = $req->gia1;
            $size->save();
            $size->product_properties()->save($pro_per);
           $product->product_properties()->save($pro_per);
         }
        if($req->size2!=null && $req->gia2!=null)
        {
            $size2->size = $req->size2;
            $pro_per2->p_price = $req->gia2;
            $size2->save();
            $size2->product_properties()->save($pro_per2);
           $product->product_properties()->save($pro_per2);
        }
        if($req->size3!=null && $req->gia3!=null)
        {
            $size3->size = $req->size3;
            $pro_per3->p_price = $req->gia3;
            $size3->save();
            $size3->product_properties()->save($pro_per3);
           $product->product_properties()->save($pro_per3);
        }
        
        return redirect("/admin/danh-sach-san-pham");
    }
    //quản lí sp
    public function getThemsp_admin()
    {
        $loaisp = Category::all();
        return view('admin.themsp_admin',['loaisp'=>$loaisp]);
    }
     public function postThemsp_admin(ThemspadminRequest $reqaddsp)
    {
         if($reqaddsp->file('hinh_san_pham'))
        {
            if($reqaddsp->file('hinh_san_pham')->isValid())
            {
                $reqaddsp->file('hinh_san_pham')->move("source/images/product",$reqaddsp->file('hinh_san_pham')->getClientOriginalName());
                $hinh_san_pham = $reqaddsp->file('hinh_san_pham')->getClientOriginalName();
                //print_r($request->file('hinh_san_pham')->getClientOriginalName());exit;
            }
        }
        else
        {
            echo "<script>alert('You have to choose the image for the new product!')</script>";
            echo "<script>window.location = '".url('/')."/admin/them-san-pham-moi"."'</script>";
            die;
        }
        
                if(isset($reqaddsp->product_new))
                {
                    $moi=1;
                }  
                
                else  
                {
                    $moi=0;
                }
        // if($reqaddsp->gia_khuyen_mai!=null)
        // {
        //     $giakm = $reqaddsp->gia_khuyen_mai;
        // }
        // else
        // {
        //     $giakm = 0;
        // }
        if($reqaddsp->size1=="" && $reqaddsp->gia1=="")
        {

            $gia = $reqaddsp->input('don_gia');
        }
        else
        {
            $gia =  $reqaddsp->gia1;
        }
        
        $product = new products();
        $product->name =$reqaddsp->input('ten_san_pham');
        $product->id_type = $reqaddsp->input('ma_loai');
        $product->intro = $reqaddsp->input('mo_ta');
        $product->price = $gia;
        $product->unit = $reqaddsp->input('don_vi_tinh');
        $product->new = $moi;
        $product->status = 1;
        $product->image = $hinh_san_pham;
        $product->save();
        $pro_per = new product_properties();
        $pro_per2 = new product_properties();
        $pro_per3 = new product_properties();
        if($reqaddsp->size1!=null && $reqaddsp->gia1!=null)
        {
            $pro_per->size = $reqaddsp->size1;
            $pro_per->p_price = $reqaddsp->gia1;
           $product->product_properties()->save($pro_per);
         }
        if($reqaddsp->size2!=null && $reqaddsp->gia2!=null)
        {
             $pro_per2->size = $reqaddsp->size2;
             $pro_per2->p_price = $reqaddsp->gia2;
             $product->product_properties()->save($pro_per2);
        }
        if($reqaddsp->size3!=null && $reqaddsp->gia3!=null)
        {
                 $pro_per3->size = $reqaddsp->size3;
                 $pro_per3->p_price = $reqaddsp->gia3;
                 $product->product_properties()->save($pro_per3);
        }
        
        // DB::table('product')->insertGetId(
        //     [
        //         'name' => $reqaddsp->input('ten_san_pham'),
        //         'id_type' => $reqaddsp->input('ma_loai'),
        //         'intro' => $reqaddsp->input('mo_ta'),
        //         'price' => $reqaddsp->input('don_gia'),
        //         'promo_price' => $giakm,
        //         'unit' => $reqaddsp->input('don_vi_tinh'),
        //         'new' => $moi,
        //         'status' => 1,
        //         'image' => $hinh_san_pham,
        //     ]
        // );
        return redirect("/admin/danh-sach-san-pham");
        
    }
    public function xoa_san_pham(Request $request)
    {
        //print_r($_POST);
        $ds_xoa = $request->input('thao_tac');
        $sanpham = DB::table('product')->whereIn('id', $ds_xoa)->update(['status' => 0]);
        return redirect("/admin/danh-sach-san-pham");
        //print_r($ds_xoa);
    }
    //Dang nhap
    public function getLoginAdmin()
    {
            return view('admin.dangnhap_admin');
    }
    public function postLoginAdmin(Request $req)
    {
        $this->validate($req,[
            'email' => 'required|email',
            'password' => 'required|min:3|max:32',
        ],[
            'email.required' => 'You did not enter an email',
            'email.email' => 'Email invalidate',
            'password.required' => 'You have not entered the password',
            'password.min' => 'Password must be more than 3 characters',
            'password.max' => 'Password cannot be larger than 32 characters'
        ]);
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password]))
        {
           
            return redirect('admin/trang-chu');
        }
        else
        {
            $thongbao = "The email address or password is incorrect";
            return view('admin.dangnhap_admin')->with('thongbao',$thongbao);
        }
    }
    public function logoutAdmin()
    {
        Auth::logout();
        return redirect('admin/dang-nhap');
    }
    //function hỗ trợ xử lí
    public function chuyen_mang_doi_tuong_sang_mang_key($mang_doi_tuong)
    {
        $mang_key = array();
        foreach($mang_doi_tuong as $doi_tuong)
        {
            $mang_key[$doi_tuong->id] = $doi_tuong->name;
        }
         return $mang_key;
    } 
}
