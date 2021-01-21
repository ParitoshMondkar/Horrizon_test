<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckAdminSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        if(! $request->session()->get('admin_id')){
            return redirect('/');
        }else{
            return $next($request);
        }

        return $next($request);
    }
}
