<?php

namespace App\Http\Middleware;

use Closure;

class LevelAdminMiddleware extends LevelMiddleware
{ 
    protected $level = '1';
}
