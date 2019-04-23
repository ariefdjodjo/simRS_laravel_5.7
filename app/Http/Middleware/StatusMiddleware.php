<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;


class StatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $status)
    {
        $user = Auth::user();
        if(Auth::user()->status != $status) {

            return redirect('/status');
            
        }
        
        return $next($request);
    }
}
