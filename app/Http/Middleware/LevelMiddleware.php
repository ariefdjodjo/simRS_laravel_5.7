<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Auth as Auth;

class LevelMiddleware
{
   
    public function handle($request, Closure $next, $level)
    {
        $user = Auth::user();
        if(Auth::user()->level != $level) {
            return App::abort(Auth::check() ? 403 : 401, Auth::check() ? 'Forbiden' : 'Unauthorized');
            
        }
        
        return $next($request);
    }
}
