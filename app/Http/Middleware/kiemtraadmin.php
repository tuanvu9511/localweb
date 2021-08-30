<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class kiemtraadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('_loainhanvien') == 2)
        {
            return $next($request);

            
        } else
            return redirect('/thongbaoloi');
    }
}
