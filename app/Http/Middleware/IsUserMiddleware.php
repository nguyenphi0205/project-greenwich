<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
class IsUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->power==1)
            {

                 return $next($request);
            }
            else
            {
                $request->session()->flash('status', 'Your account does not have permission to use this page. Please login member account');
                 return redirect('login');
                //     echo "<script>
                // alert('Tài khoản bạn không được quyền sử dụng trang này. Vui lòng đăng kí tài khoản thành viên');
                // window.location ='".url('dang-ki')."'
                    
                // </script>";
            }
                // return redirect('admin/dang-nhap');
        }
        else
        {
            return $next($request);
        }
        
    }
}
