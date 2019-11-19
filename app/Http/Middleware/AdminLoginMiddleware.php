<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AdminLoginMiddleware
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
            if($user->power>1)
            {

                 return $next($request);
            }
            else
            {
                 $request->session()->flash('status', 'You do not have admin rights');
                 return redirect('admin/dang-nhap');
            }
                // return redirect('admin/dang-nhap');
        }
        else{
            return redirect('admin/dang-nhap');
        }
    }
}
