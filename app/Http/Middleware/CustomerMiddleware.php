<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guard('cus')->check()){
            return redirect()->route('customer.login')->with('error', 'Vui lòng đăng nhập tài khoản của bạn');
        }elseif(Auth::guard('cus')->user()->status == 0){
            Auth::guard('cus')->logout();
            return redirect()->route('customer.login')->with('error', 'Tài khoản của bạn chưa được kích hoạt');
        }
        
        return $next($request);
    }
}