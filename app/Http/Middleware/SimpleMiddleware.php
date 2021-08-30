<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SimpleMiddleware
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
        if ($request->name = 'abc'){
            return response('Dung r nhe');
        }
        
        return $next($request);
    }
}
