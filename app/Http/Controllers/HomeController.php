<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\wishList;
use App\recommends;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function product_details($id){
        //insert command for views


        $Products = DB::table('product')->where('id',$id)->get();

        //echo $id;
        return view('page.product_details',compact('Products'));
    }

    
    public function contact()
    {
        return view('page.contact');
    }
   

    public function wishList(Request $request){
        //dd($request->all());
        //$pro_id = $request->id;
       // $user_id = Auth::user()->id;
        $wishList = new wishList;
        $wishList->user_id = Auth::user()->id;
        $wishList->pro_id = $request->pro_id;

        $wishList->save();

        $Products = DB::table('product')->where('id', $request->pro_id)->get();
        //$Products = DB::table('wishlist')->leftJoin('product', 'wishlist.pro_id' , '=' , 'product.ic')->get();
        //return view('page.product_details' , compact('Products'));
        return back();
    }

    public function View_wishList(){
        $Products = DB::table('wishlist')
                    ->leftJoin('product', 'wishlist.pro_id' , '=' , 'product.id')
                    ->join('users','users.id','=','wishlist.user_id')
                    ->selectRaw('users.id as id_user, users.name as name_user, product.*, wishlist.id as id_wishlist')
                    ->where('user_id',Auth::user()->id)
                    ->get();
        return view('page.wishList' , compact('Products'));

    }

    public function removeWishList($id){
        //echo  $id;
        DB::table('wishlist')->where('pro_id', '=' ,$id)->delete();

        return back()->with('msg' , 'Product has been removed from favorites list');
    }

    public function selectSize(Request $har)
    {
        //echo $har->proDum;
        $proDum = $har->proDum;
        $size = $har->size;
        $s_price = DB::table('products_properties')
                    ->join('product_size','products_properties.size_id','=','product_size.id')
        ->where('pro_id' , $proDum)
        ->where('size' , $size)
        ->get();

        foreach($s_price as $sPrice){
            echo $sPrice->p_price ?>
            <input type="hidden" value="<?php echo $sPrice->p_price; ?>" name="newPrice" /> VND
            <div style="background: <?php echo $sPrice->p_price; ?>; width:40px; height: 40px"></div>
            <?php
        }
    }




}
















