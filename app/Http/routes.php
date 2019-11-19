<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('pagenotfound',[
	'as'=>'notfound',
	'uses'=>'PageController@pagenotfound'
]);


Route::get('password/reset/{token?}','Auth\PasswordController@showResetForm');
	Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset' ,'Auth\PasswordController@reset');

Route::get('/', function () {
    return view('welcome');
});
Route::get('login',[
	'as'=>'dangnhap',
	'uses'=>'PageController@getLogin'
]);
Route::post('login',[
	'as'=>'dangnhap',
	'uses'=>'PageController@postLogin'
]);
Route::get('dang-ki',[
	'as'=>'signin',
	'uses'=>'PageController@getRegister'
]);
Route::post('dang-ki',[
	'as'=>'dangki',
	'uses'=>'PageController@postRegister'
]);
Route::get('send-to-mail/{id}/{token}',[
	'as'=>'send-to-mail',
	'uses'=>'PageController@activeUser'
]);
Route::post('lienhe',[
	'as' =>'lien-he',
	'uses' =>'mailcontroller@post_lienhe'
]);
Route::get('send-to-maildh/{id}/{token}',[
	'as'=>'send-to-maildh',
	'uses'=>'CheckoutController@activeUser'
]);
Route::group(['middleware' => 'IsUser'], function () {
Route::get('',[
	'as'=>'index',
	'uses'=>'PageController@getIndex'
]);

Route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);


Route::get('lienhe',[
	'as' =>'lien-he',
	'uses' =>'PageController@contact'
]);
Route::get('tintuc',[
	'as' =>'tintuc',
	'uses' =>'PageController@gettintuc'
]);
Route::get('chitiettintuc/{id}',[
	'as' =>'chitiettintuc',
	'uses' =>'PageController@getchitiet'
]);
Route::get('loaisanpham/{id}',[
	'as' =>'loaisanpham',
	'uses' =>'PageController@getloaisp'
]);


Route::get('dang-xuat',[
	'as'=>'dangxuat',
	'uses'=>'PageController@getLogout'
]);


Route::get('addToWishList', 'HomeController@wishList');
Route::get('WishList/' , 'HomeController@View_wishList');
Route::post('/shop',[
		'as' => 'search', 
		'uses' => 'PageController@search'
	]);



Route::get('removeWishList/{id}' , 'HomeController@removeWishList');


// Route::get('gio-hang',[
// 	'as'=>'giohang',
// 	'uses'=>'CartController@getgiohang'
// ]);

Route::get('thongbao','CartController@thongbaothanhtoan');
Route::get('gio-hang','CartController@getgiohang');

Route::get('gio-hang/addItem/{id}', 'CartController@addItem');

Route::get('gio-hang/addItem/{id}',[
	 	'as' => 'addgiohang', 
	 	'uses' => 'CartController@addItem'
	 ]);
Route::get('gio-hang/remove/{id}', 'CartController@destroy');

Route::get('gio-hang/update/{id}', 'CartController@update');

Route::get('product_details/{id}', 'HomeController@product_details');

Route::get('selectSize' , 'HomeController@selectSize');
Route::get('products/{name}' , 'PageController@proCats');

Route::get('shop' , 'PageController@shop');
Route::get('products' , 'PageController@shop');

Route::group(['middleware' =>'auth'] , function(){


 	Route::get('checkout', 'CheckoutController@index');
    Route::post('/formvalidate','CheckoutController@formvalidate');

	Route::get('profile' ,[
		'as'=>'profile',
		'uses'=>'ProfileController@index'
	]);
	Route::get('orders' ,[
		'as'=>'orders',
		'uses'=>'ProfileController@orders'
	]);
	Route::get('order-detail/{id}' ,[
		'as'=>'order_detail',
		'uses'=>'ProfileController@order_detail'
	]);
	Route::get('address', 'ProfileController@Address');
	Route::post('updateAddress', 'ProfileController@UpdateAddress');
	Route::get('password', 'ProfileController@Password');
	Route::post('updatePassword', 'ProfileController@updatePassword');

});
});
//route admin
Route::get('admin/dang-nhap',[
	 	'as' => 'dangnhapadmin', 
	 	'uses' => 'AdminController@getLoginAdmin'
	 ]);
	Route::post('admin/dang-nhap',[
	 	'as' => 'dangnhapadmin', 
	 	'uses' => 'AdminController@postLoginAdmin'
	 ]);
Route::group(['prefix' => 'admin','middleware'=>'AminLogin'], function() {
	Route::get('trang-chu',[
		'as' => 'trangchu', 
		'uses' => 'AdminController@trangchu_admin'
	]);
	//search
	Route::get('search',[
		'as' => 'postsearch',
		'uses' => 'AdminQuanlyController@postsearch_admin'
	]);
	Route::post('search',[
		'as' => 'postsearch',
		'uses' => 'AdminQuanlyController@postsearch_admin'
	]);
	//thông tin tài khoản admin
	Route::get('thong-tin-tai-khoan',[
		'as' => 'thongtintaikhoan',
		'uses' => 'AdminQuanlyController@thongtintaikhoan_admin'
	]);
	Route::post('thong-tin-tai-khoan',[
		'as' => 'postthongtintaikhoan',
		'uses' => 'AdminQuanlyController@postthongtintaikhoan_admin'
	]);
	Route::get('/thong-tin-tai-khoan/doi-mat-khau',[
		'as' => 'doimatkhau',
		'uses' => 'AdminQuanlyController@doimatkhau_admin'
	]);
	Route::post('/thong-tin-tai-khoan/doi-mat-khau',[
		'as' => 'postdoimatkhau',
		'uses' => 'AdminQuanlyController@postdoimatkhau_admin'
	]);
	//danh sách slide banner
	Route::get('danh-sach-slide-banner',[
		'as' => 'danhsachslide',
		'uses' => 'AdminQuanlyController@danhsachslide_admin'
	]);
	Route::get('them-slide-banner',[
		'as' => 'themslide',
		'uses' => 'AdminQuanlyController@getThemslide_admin'
	]);
	Route::post('them-slide-banner',[
		'as' => 'postthemslide',
		'uses' => 'AdminQuanlyController@postThemslide_admin'
	]);
	Route::get('cap-nhat-slide-banner/{id}',[
		'as' => 'capnhatslide', 
		'uses' => 'AdminQuanlyController@getCapnhatslide_admin'
	]);
	Route::post('cap-nhat-slide-banner',[
		'as' => 'postcapnhatslide', 
		'uses' => 'AdminQuanlyController@postCapnhatslide_admin'
	]);
	Route::post('xoa-slide-banner',[
		'as' => 'postxoaslide', 
		'uses' => 'AdminQuanlyController@postXoaslide_admin'
	]);
	//danh sách tin tức
	Route::get('danh-sach-tin-tuc',[
		'as' => 'danhsachtintuc',
		'uses' => 'AdminQuanlyController@danhsachtintuc_admin'
	]);
	Route::get('dang-tin-moi',[
		'as' => 'dangtinmoi',
		'uses' => 'AdminQuanlyController@themtinmoi_admin'
	]);
	Route::post('dang-tin-moi',[
		'as' => 'postdangtinmoi',
		'uses' => 'AdminQuanlyController@postthemtinmoi_admin'
	]);
	Route::get('cap-nhat-tin-tuc/{id}',[
		'as' => 'capnhattintuc', 
		'uses' => 'AdminQuanlyController@getCapnhattintuc_admin'
	]);
	Route::post('cap-nhat-tin-tuc',[
		'as' => 'postcapnhattintuc', 
		'uses' => 'AdminQuanlyController@postCapnhattintuc_admin'
	]);
	Route::post('xoa-tin-tuc',[
		'as' => 'postxoatintuc', 
		'uses' => 'AdminQuanlyController@postXoatintuc_admin'
	]);
	//quản lí khách hàng
	Route::get('quan-ly-thanh-vien',[
		'as' => 'quanlythanhvien',
		'uses' => 'AdminQuanlyController@danhsachtaikhoan_admin'
	]);
	Route::get('them-thanh-vien-moi',[
		'as' => 'themthanhvien',
		'uses' => 'AdminQuanlyController@themthanhvien_admin'
	]);
	Route::post('them-thanh-vien-moi',[
		'as' => 'postthemthanhvien',
		'uses' => 'AdminQuanlyController@postthemthanhvien_admin'
	]);
	Route::get('danh-sach-thanh-vien',[
		'as' => 'danhsachthanhvien',
		'uses' => 'AdminQuanlyController@danhsachtaikhoan_admin'
	]);
	Route::get('danh-sach-thanh-vien/cap-nhat-tai-khoan/{id}',[
		'as' => 'capnhattaikhoan',
		'uses' => 'AdminQuanlyController@capnhattaikhoan_admin'
	]);
	Route::post('danh-sach-thanh-vien/cap-nhat-tai-khoan/',[
		'as' => 'postcapnhattaikhoan',
		'uses' => 'AdminQuanlyController@postcapnhattaikhoan_admin'
	]);
	Route::post('danh-sach-thanh-vien/xoa-tai-khoan/',[
		'as' => 'postxoataikhoan',
		'uses' => 'AdminQuanlyController@postxoataikhoan_admin'
	]);
	Route::get('danh-sach-member',[
		'as' => 'danhsachmember',
		'uses' => 'AdminQuanlyController@danhsachmember_admin'
	]);
	// quản lí đơn đặt hàng
	Route::get('quan-ly-don-hang',[
		'as' => 'quanlydonhang',
		'uses' => 'AdminController@danhsachdonhangmoi_admin'
	]);
	Route::get('danh-sach-don-dat-hang-moi',[
		'as' => 'danhsachdonhangmoi',
		'uses' => 'AdminController@danhsachdonhangmoi_admin'
	]);
	Route::get('danh-sach-don-dat-hang-moi/chi-tiet-don-hang/{id}',[
		'as' => 'chitietdonhang',
		'uses' => 'AdminController@chitietdonhang_admin'
	]);
	Route::get('danh-sach-don-dat-hang-cu',[
		'as' => 'danhsachdonhangcu',
		'uses' => 'AdminController@danhsachdonhangcu_admin'
	]);
	Route::post('danh-sach-don-dat-hang-moi/chi-tiet-don-hang/',[
		'as' => 'postcapnhatttdonhang',
		'uses' => 'AdminController@postcapnhatttdonhang_admin'
	]);
	
	Route::get('ajax_cap_nhat_trang_thai_don_hang', 'AdminController@cap_nhat_trang_thai_don_hang');
	//quản lí loại sản phẩm
	Route::get('quan-ly-loai-san-pham',[
		'as' => 'quanlyloaisanpham', 
		'uses' => 'AdminController@danhsachloaisanpham_admin'
	]);
	Route::get('cap-nhat-loai-san-pham/{id}',[
		'as' => 'capnhatloaisanpham', 
		'uses' => 'AdminController@getCapnhatloaisp_admin'
	]);
	Route::post('cap-nhat-loai-san-pham',[
		'as' => 'postcapnhatloaisanpham', 
		'uses' => 'AdminController@postCapnhatloaisp_admin'
	]);
	Route::get('danh-sach-loai-san-pham',[
		'as' => 'danhsachloaisanpham', 
		'uses' => 'AdminController@danhsachloaisanpham_admin'
	]);
	Route::get('them-loai-san-pham-moi',[
		'as' => 'themloaisanpham', 
		'uses' => 'AdminController@getThemloaisp_admin'
	]);
	Route::post('them-loai-san-pham-moi',[
		'as' => 'postthemloaisanpham', 
		'uses' => 'AdminController@postThemloaisp_admin'
	]);
	Route::post('xoa-loai-san-pham',[
		'as' => 'postxoaloaisanpham', 
		'uses' => 'AdminController@xoa_loai_san_pham'
	]);
	//quản lí sản phẩm
	Route::get('quan-ly-san-pham',[
		'as' => 'quanlysanpham', 
		'uses' => 'AdminController@danhsachsanpham_admin'
	]);
	Route::get('them-san-pham-moi',[
		'as' => 'themsanpham', 
		'uses' => 'AdminController@getThemsp_admin'
	]);
	Route::post('them-san-pham-moi',[
		'as' => 'postthemsanpham', 
		'uses' => 'AdminController@postThemsp_admin'
	]);
	Route::post('xoa-san-pham',[
		'as' => 'postxoasanpham', 
		'uses' => 'AdminController@xoa_san_pham'
	]);
	Route::get('danh-sach-san-pham',[
		'as' => 'danhsachsanpham', 
		'uses' => 'AdminController@danhsachsanpham_admin'
	]);
	Route::get('cap-nhat-san-pham/{id}',[
		'as' => 'capnhatsanpham', 
		'uses' => 'AdminController@getCapnhatsp_admin'
	]);
	Route::post('cap-nhat-san-pham',[
		'as' => 'postcapnhatsanpham', 
		'uses' => 'AdminController@postCapnhatsp_admin'
	]);
	// quản lí sản phẩm theo sizeo
	Route::get('them-san-pham-moi-theo-size',[
		'as' => 'themsanphamsize', 
		'uses' => 'AdminController@getThemspsize_admin'
	]);
	Route::post('them-san-pham-moi-theo-size',[
		'as' => 'postthemsanphamsize', 
		'uses' => 'AdminController@postThemspsize_admin'
	]);
	 Route::get('dangxuat',[
		 'as' => 'dangxuatad',
		 'uses' => 'AdminController@logoutAdmin'
	 ]);
});





















